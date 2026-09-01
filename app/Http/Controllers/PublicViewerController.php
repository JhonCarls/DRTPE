<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\BranchActivity;
use App\Models\Bulletin;
use App\Models\Coordination;
use App\Models\Event;
use App\Models\PhotoReport;
use App\Models\Workshop;

class PublicViewerController extends Controller
{
    public function index()
    {
        $now = now();
        $today = $now->toDateString();

        // 1. Cronología y actividades operativas base (Modelo Event)
        $actividades = Event::with(['category', 'subEvents' => function ($query) {
            $query->orderBy('event_date', 'desc');
        }])->get();

        // 2. Reportes fotográficos generales (Sliders frontales)
        $photoReports = PhotoReport::latest()->take(8)->get();

        // 3. Separación de Difusiones y Eventos Institucionales para los Sliders
        $difusiones = $photoReports->where('type', 'difusion')->values();
        $institucionales = $photoReports->where('type', 'evento')->values();

        // 4. Boletines Informativos para el footer claro
        $bulletins = Bulletin::latest()->take(4)->get();

        // 5. Comunicados Oficiales Vigentes. La portada los reparte en dos lugares:
        //
        //    a) Ventana emergente de bienvenida: TODOS los comunicados activos de la
        //       institución, con prioridad Sede Central → Juliaca → Taraco. Cada uno
        //       lleva su etiqueta de sede en la vista.
        //    b) Tablón de la parte inferior: apartado propio de la Sede Central, así
        //       que solo recoge los institucionales (sede = NULL).
        //
        //    El LOWER() no es decorativo: la colación de TiDB es binaria y sin él la
        //    comparación de sede distinguiría mayúsculas.
        $comunicadosActivos = Announcement::with('user')
            ->where('published_at', '<=', $today)
            ->where('expired_at', '>=', $today)
            ->orderByRaw("CASE
                WHEN sede IS NULL THEN 0
                WHEN LOWER(sede) = 'juliaca' THEN 1
                WHEN LOWER(sede) = 'taraco' THEN 2
                ELSE 3 END")
            ->latest()
            ->get();

        $comunicadosCentral = $comunicadosActivos->whereNull('sede')->values();

        // 6. PROCESAMIENTO SEGURO: Ordenar fotos de sub-eventos por prioridad en el servidor
        $todosSubEventos = collect();
        foreach ($actividades as $aIdx => $act) {
            foreach ($act->subEvents as $se) {
                $se->category_name = $act->category->name ?? 'General';
                $se->parent_description = $act->description;
                $se->activity_index = $aIdx;

                // Decodificamos las fotos reales
                $rawPh = is_string($se->photos) ? json_decode($se->photos, true) : ($se->photos ?? []);
                $photosArr = is_array($rawPh) ? $rawPh : [];

                // Decodificamos las prioridades asignadas
                $rawPrio = is_string($se->photo_priority) ? json_decode($se->photo_priority, true) : ($se->photo_priority ?? []);
                $prioArr = is_array($rawPrio) ? $rawPrio : [];

                // Si coinciden en tamaño, ordenamos por prioridad, si no, mantenemos el orden de subida
                if (! empty($prioArr) && count($prioArr) === count($photosArr)) {
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
        $ultimos3 = $todosSubEventos->filter(fn ($s) => $s->cover !== null)
            ->sortByDesc('event_date')
            ->take(3)
            ->values();

        // 7. TALLERES Y CAPACITACIONES (ciclo de vida Programado/Ejecutado)
        //    + COORDINACIONES (módulo independiente). Se normalizan a estructuras planas.
        $talleresProximos = Workshop::programados()->orderBy('scheduled_date')->get()->map->toPublicArray()->values();
        $talleresEjecutados = Workshop::ejecutados()->orderByDesc('executed_date')->get()->map->toPublicArray()->values();
        $coordinaciones = Coordination::orderByDesc('coordination_date')->get()->map->toPublicArray()->values();

        return view('welcome', compact(
            'actividades',
            'photoReports',
            'bulletins',
            'comunicadosActivos',
            'comunicadosCentral',
            'difusiones',
            'institucionales',
            'ultimos3',
            'talleresProximos',
            'talleresEjecutados',
            'coordinaciones'
        ));
    }

    /** Página pública dedicada: Talleres y Capacitaciones (próximos + ejecutados). */
    public function talleresCapacitaciones()
    {
        $talleresProximos = Workshop::programados()->orderBy('scheduled_date')->get()->map->toPublicArray()->values();
        $talleresEjecutados = Workshop::ejecutados()->orderByDesc('executed_date')->get()->map->toPublicArray()->values();

        return view('portal.talleres-capacitaciones', compact('talleresProximos', 'talleresEjecutados'));
    }

    /** Página pública dedicada: Coordinaciones Institucionales Realizadas. */
    public function coordinaciones()
    {
        $coordinaciones = Coordination::orderByDesc('coordination_date')->get()->map->toPublicArray()->values();

        return view('portal.coordinaciones', compact('coordinaciones'));
    }

    public function showSede($slug)
    {
        // Validamos que el slug corresponda a una sede desconcentrada válida
        if (! in_array($slug, Announcement::SEDES_DESCONCENTRADAS, true)) {
            abort(404);
        }

        // Consultamos únicamente las actividades de la sede seleccionada
        $activities = BranchActivity::where('sede', $slug)
            ->orderBy('created_at', 'desc')
            ->get();

        // Nombre estético para los títulos de la vista pública
        $sedeName = ($slug === 'juliaca') ? 'Sede Juliaca' : 'Sede Taraco';

        // Normalizamos las colecciones en el servidor: la vista solo renderiza HTML.
        // $activities (modelos) se envía además del índice plano porque la
        // cronología se arma en servidor, igual que la de la portada: así las
        // galerías y los videos son HTML real y no nodos creados por Alpine.
        $mappedActivities = $this->mapActivities($activities);
        $mappedAnnouncements = $this->mapAnnouncements($this->resolveAnnouncements($slug));

        return view('portal.sede-desconcentrada', compact(
            'sedeName',
            'slug',
            'activities',
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
                'id' => $a->id,
                'title' => $a->title,
                'description' => preg_replace('/\s+/', ' ', (string) $a->description),
                'created_at' => $a->created_at->toIso8601String(),
                'date_string' => $a->created_at->format('d/m/Y h:i A'),
                'attendees_count' => (int) ($a->attendees_count ?? 0),
                'intervention_type' => $a->type ?? 'asesoria', // La columna real es 'type'; el front consume la clave 'intervention_type'
                'photos' => $a->photos ?? [],
                // Difusión en redes ya normalizada (YouTube / Facebook / TikTok).
                'videos' => $a->videoEmbeds(),
                'videos_count' => count($a->videoEmbeds()),
            ];
        })->values();
    }

    /**
     * Resuelve los comunicados que se publican en el portal de una sede.
     *
     * AISLAMIENTO ESTRICTO: cada página muestra ÚNICAMENTE los comunicados de
     * su propia sede. Los institucionales de la Sede Central tienen su propio
     * apartado en la portada, así que aquí no se mezclan; y los de la otra sede
     * desconcentrada no aparecen en ningún caso.
     *
     * El scope bySede() aplica LOWER() sobre la columna porque la colación de
     * TiDB es binaria: sin eso, 'Juliaca' y 'juliaca' no coincidirían.
     */
    private function resolveAnnouncements(string $slug)
    {
        return Announcement::with('user')
            ->bySede($slug)
            ->latest()
            ->get();
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
                    'url' => asset('storage/'.$path),
                    'is_pdf' => str_ends_with(strtolower($path), '.pdf'),
                    'label' => 'Anexo N° '.($i + 1),
                ];
            })->values();

            return [
                'id' => $an->id,
                'title' => $an->title,
                'content' => preg_replace('/\s+/', ' ', (string) $an->description),
                'date' => $an->created_at->format('d/m/Y'),
                'fecha_publicacion' => $an->published_at
                    ? $an->published_at->format('d/m/Y')
                    : $an->created_at->format('d/m/Y'),
                'fecha_vencimiento' => $an->expired_at
                    ? $an->expired_at->format('d/m/Y')
                    : 'Sin Límite',
                'file_url' => $an->file_path ? asset('storage/'.$an->file_path) : null,
                'is_image' => $an->file_type === 'image',
                'is_pdf' => $an->file_type === 'pdf',
                'attachments' => $attachments,
                'is_urgent' => (bool) ($an->is_urgent ?? false),
                // sede = NULL ⇒ comunicado institucional de la Sede Central.
                'is_institucional' => is_null($an->sede),
            ];
        })->values();
    }
}
