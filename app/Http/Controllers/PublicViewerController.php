<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PhotoReport;
use App\Models\Bulletin;      
use App\Models\Announcement;
use App\Models\Workshop;
use App\Models\BranchActivity;
use Illuminate\Http\Request;

class PublicViewerController extends Controller
{
    public function index()
    {
        $now = now();
        $today = $now->toDateString();

        // 1. Cronología y actividades operativas base (Modelo Event)
        $actividades = Event::with(['category', 'subEvents' => function($query) {
            $query->orderBy('event_date', 'desc');
        }])->get();

        // 2. Reportes fotográficos generales (Sliders frontales)
        $photoReports = PhotoReport::latest()->take(8)->get();

        // 3. Separación de Difusiones y Eventos Institucionales para los Sliders
        $difusiones      = $photoReports->where('type', 'difusion')->values();
        $institucionales = $photoReports->where('type', 'evento')->values();

        // 4. Boletines Informativos para el footer claro
        $bulletins = Bulletin::latest()->take(4)->get();

        // 5. Comunicados Oficiales Vigentes (Pop-up automático y Alertas)
        //    Eager Loading de 'user' para evitar N+1 al derivar la sede de origen.
        $comunicadosActivos = Announcement::with('user')
            ->where('published_at', '<=', $today)
            ->where('expired_at', '>=', $today)
            ->latest()
            ->get();

        // 6. PROCESAMIENTO SEGURO: Ordenar fotos de sub-eventos por prioridad en el servidor
        $todosSubEventos = collect();
        foreach ($actividades as $aIdx => $act) {
            foreach ($act->subEvents as $se) {
                $se->category_name      = $act->category->name ?? 'General';
                $se->parent_description = $act->description;
                $se->activity_index     = $aIdx;  
               
                // Decodificamos las fotos reales
                $rawPh = is_string($se->photos) ? json_decode($se->photos, true) : ($se->photos ?? []);
                $photosArr = is_array($rawPh) ? $rawPh : [];
               
                // Decodificamos las prioridades asignadas
                $rawPrio = is_string($se->photo_priority) ? json_decode($se->photo_priority, true) : ($se->photo_priority ?? []);
                $prioArr = is_array($rawPrio) ? $rawPrio : [];
               
                // Si coinciden en tamaño, ordenamos por prioridad, si no, mantenemos el orden de subida
                if (!empty($prioArr) && count($prioArr) === count($photosArr)) {
                    $combined = array_combine($prioArr, $photosArr);
                    ksort($combined);
                    $se->photos_sorted = array_values($combined);
                } else {
                    $se->photos_sorted = $photosArr;
                }
               
                // Extraemos la primera foto como portada oficial
                $se->cover = count($se->photos_sorted) > 0 ? $se->photos_sorted[0] : null;
               
                $todosSubEventos->push($se);
            }
        }
       
        // Filtramos el Top 3 de registros recientes para el bloque "Últimos Registros"
        $ultimos3 = $todosSubEventos->filter(fn($s) => $s->cover !== null)
            ->sortByDesc('event_date')
            ->take(3)
            ->values();

        // 7. CONSULTAS DE NUEVO MÓDULO: Talleres regulados por el reloj del servidor
        // Capacitaciones Vigentes (Por Hacer)
        $capacitacionesPorHacer = Workshop::where('type', 'capacitacion')
            ->where('scheduled_at', '>=', $now)
            ->orderBy('scheduled_at', 'asc')
            ->get();

        // Capacitaciones Hechas (Pasadas)
        $capacitacionesHechas = Workshop::where('type', 'capacitacion')
            ->where('scheduled_at', '<', $now)
            ->orderBy('scheduled_at', 'desc')
            ->get();

        // Reuniones de Coordinación Hechas
        $coordinacionesHechas = Workshop::where('type', 'coordinacion')
            ->orderBy('scheduled_at', 'desc')
            ->get();

        // 🎯 RETORNO SEGURO: Empaquetamos las 10 variables juntas hacia la vista welcome sin colisiones
        return view('welcome', compact(
            'actividades',
            'photoReports',
            'bulletins',
            'comunicadosActivos',
            'difusiones',
            'institucionales',
            'ultimos3',
            'capacitacionesPorHacer',
            'capacitacionesHechas',
            'coordinacionesHechas'
        ));
    }
    public function showSede($slug)
    {
        // Validamos que el slug corresponda a una sede desconcentrada válida
        if (!in_array($slug, ['juliaca', 'taraco'])) {
            abort(404);
        }

        // Consultamos únicamente las actividades de la sede seleccionada
        $activities = BranchActivity::where('sede', $slug)
            ->orderBy('created_at', 'desc')
            ->get();

        // Nombre estético para los títulos de la vista pública
        $sedeName = ($slug === 'juliaca') ? 'Sede Juliaca' : 'Sede Taraco';

        // Normalizamos las colecciones en el servidor: la vista solo renderiza HTML.
        $mappedActivities    = $this->mapActivities($activities);
        $mappedAnnouncements = $this->mapAnnouncements($this->resolveAnnouncements($slug));

        return view('portal.sede-desconcentrada', compact(
            'sedeName',
            'slug',
            'mappedActivities',
            'mappedAnnouncements'
        ));
    }

    /**
     * Normaliza las actividades de sede al formato plano que consume Alpine.js.
     * No se usa addslashes(): json_encode() dentro de {{ }} ya escapa de forma segura.
     */
    private function mapActivities($activities)
    {
        return $activities->map(function ($a) {
            return [
                'id'                => $a->id,
                'title'             => $a->title,
                'description'       => preg_replace('/\s+/', ' ', (string) $a->description),
                'created_at'        => $a->created_at->toIso8601String(),
                'date_string'       => $a->created_at->format('d/m/Y h:i A'),
                'attendees_count'   => (int) ($a->attendees_count ?? 0),
                'intervention_type' => $a->intervention_type ?? 'asesoria',
                'photos'            => $a->photos ?? [],
            ];
        })->values();
    }

    /**
     * Resuelve los comunicados relevantes para una sede.
     *
     * El origen de un comunicado se deriva de su autor (user.sede), ya que la tabla
     * 'announcements' no tiene columna 'sede' propia. Se hace Eager Loading de 'user'
     * para evitar N+1, y se usa LOWER() para ser insensible a la colación (utf8mb4_bin
     * en TiDB Cloud).
     */
    private function resolveAnnouncements(string $slug)
    {
        $slugLower = strtolower($slug);

        $announcements = Announcement::with('user')
            ->where(function ($q) use ($slugLower) {
                // Comunicados cuyo autor pertenece a la sede solicitada
                $q->whereHas('user', function ($userQ) use ($slugLower) {
                    $userQ->whereRaw('LOWER(sede) = ?', [$slugLower]);
                })
                // ...o cuyo título menciona explícitamente la sede
                ->orWhereRaw('LOWER(title) LIKE ?', ['%' . $slugLower . '%']);
            })
            ->latest()
            ->limit(5)
            ->get();

        // Contingencia: si la sede aún no tiene comunicados propios, mostramos los
        // últimos globales para que el carrusel no quede vacío.
        if ($announcements->isEmpty()) {
            $announcements = Announcement::with('user')->latest()->limit(3)->get();
        }

        return $announcements;
    }

    /**
     * Normaliza los comunicados al formato plano que consume Alpine.js, incluyendo
     * el archivo principal (imagen/PDF) y sus adjuntos para el banner.
     * OJO: 'content' e 'is_urgent' no existen como columnas hoy; se mapean a las
     * columnas reales ('description') y a un valor por defecto.
     */
    private function mapAnnouncements($announcements)
    {
        return $announcements->map(function ($an) {
            $attachments = collect($an->attachments ?? [])->map(function ($path, $i) {
                return [
                    'url'    => asset('storage/' . $path),
                    'is_pdf' => str_ends_with(strtolower($path), '.pdf'),
                    'label'  => 'Anexo N° ' . ($i + 1),
                ];
            })->values();

            return [
                'id'                => $an->id,
                'title'             => $an->title,
                'content'           => preg_replace('/\s+/', ' ', (string) $an->description),
                'date'              => $an->created_at->format('d/m/Y'),
                'fecha_publicacion' => $an->published_at
                    ? $an->published_at->format('d/m/Y')
                    : $an->created_at->format('d/m/Y'),
                'fecha_vencimiento' => $an->expired_at
                    ? $an->expired_at->format('d/m/Y')
                    : 'Sin Límite',
                'file_url'          => $an->file_path ? asset('storage/' . $an->file_path) : null,
                'is_image'          => $an->file_type === 'image',
                'is_pdf'            => $an->file_type === 'pdf',
                'attachments'       => $attachments,
                'is_urgent'         => (bool) ($an->is_urgent ?? false),
            ];
        })->values();
    }
}


