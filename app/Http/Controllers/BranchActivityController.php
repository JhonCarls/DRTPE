<?php

namespace App\Http\Controllers;

use App\Models\BranchActivity;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BranchActivityController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $sede = $user->sede;

        // El administrador ve todo; el operador de sede ve solo su jurisdicción.
        $activities = ($user->role === 'admin')
            ? BranchActivity::orderBy('created_at', 'desc')->get()
            : BranchActivity::where('sede', $sede)->orderBy('created_at', 'desc')->get();

        // Actividades normalizadas para Alpine.js (con tipo de intervención y galería).
        $mappedActivities = $activities->map(function ($a) {
            return [
                'id'              => $a->id,
                'title'           => $a->title,
                'description'     => preg_replace('/\s+/', ' ', (string) $a->description),
                'type'            => $a->type ?? 'asesoria',
                'date_string'     => $a->created_at->format('d/m/Y h:i A'),
                'created_at'      => $a->created_at->toIso8601String(),
                'attendees_count' => (int) ($a->attendees_count ?? 0),
                'photos_count'    => count($a->photos ?? []),
                'photos'          => collect($a->photos ?? [])->map(fn ($p) => asset('storage/' . $p))->values()->all(),
                'first_photo'     => isset($a->photos[0]) ? asset('storage/' . $a->photos[0]) : null,
                'url_edit'        => route('branch-activities.edit', $a->id),
                'url_destroy'     => route('branch-activities.destroy', $a->id),
            ];
        })->values();

        // Comunicados visibles para la sede: institucionales primero (prioridad jerárquica).
        $announcements = Announcement::with('user')
            ->visibleForSede($sede)
            ->orderByRaw('CASE WHEN sede IS NULL THEN 0 ELSE 1 END')
            ->latest()
            ->get()
            ->map(function ($an) {
                return [
                    'id'                => $an->id,
                    'title'             => $an->title,
                    'content'           => preg_replace('/\s+/', ' ', (string) $an->description),
                    'fecha_publicacion' => optional($an->published_at)->format('d/m/Y') ?: $an->created_at->format('d/m/Y'),
                    'fecha_vencimiento' => optional($an->expired_at)->format('d/m/Y') ?: 'Sin Límite',
                    'is_institucional'  => is_null($an->sede),
                ];
            })->values();

        // KPIs operativos
        $totalActs      = $activities->count();
        $totalAttendees = (int) $activities->sum('attendees_count');
        $totalPhotos    = $activities->sum(fn ($a) => count($a->photos ?? []));
        $metaAnual      = 24; // Meta POI referencial de intervenciones por año fiscal
        $cumplimiento   = $metaAnual > 0 ? min(100, (int) round($totalActs / $metaAnual * 100)) : 0;

        $kpis = [
            'totalActs'      => $totalActs,
            'totalAttendees' => $totalAttendees,
            'totalPhotos'    => $totalPhotos,
            'cumplimiento'   => $cumplimiento,
            'metaAnual'      => $metaAnual,
        ];

        $sedeName = $sede ? 'Sede ' . ucfirst($sede) : 'Sede Central';

        return view('internal.branch-activities.index', compact(
            'mappedActivities', 'announcements', 'kpis', 'sedeName'
        ));
    }

    public function create()
    {
        return view('internal.branch-activities.create');
    }

    public function store(Request $request)
    {
        // Añadida validación para 'intervention_type' respetando tus reglas base
        $request->validate([
            'title' => 'required|string|max:255',
            'intervention_type' => 'required|string|in:feria,capacitacion,asesoria', // 👈 Nuevo campo validado
            'description' => 'required|string',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:3072', // Máx 3MB por foto
            'attendees_count' => 'nullable|integer|min:0',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Almacena intacto en storage/app/public/branch_activities
                $photoPaths[] = $photo->store('branch_activities', 'public');
            }
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        BranchActivity::create([
            'user_id' => $user->id,
            'sede' => $user->sede, // Se hereda de forma obligatoria de la sesión
            'title' => $request->title,
            'type' => $request->intervention_type, // 👈 El form envía 'intervention_type' → columna real 'type'
            'description' => $request->description,
            'photos' => $photoPaths,
            'attendees_count' => $request->attendees_count,
        ]);

        return redirect()->route('branch-activities.index')->with('success', 'Actividad registrada correctamente.');
    }

    public function edit($id)
    {
        $activity = BranchActivity::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Seguridad intacta: Evitar accesos cruzados por URL entre sedes
        if ($user->role !== 'admin' && $activity->sede !== $user->sede) {
            abort(403, 'Acción no autorizada para su sede.');
        }

        return view('internal.branch-activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $activity = BranchActivity::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'admin' && $activity->sede !== $user->sede) {
            abort(403, 'Acción no autorizada.');
        }

        // Añadida validación para 'intervention_type' en el flujo de actualización
        $request->validate([
            'title' => 'required|string|max:255',
            'intervention_type' => 'required|string|in:feria,capacitacion,asesoria', // 👈 Validado al actualizar
            'description' => 'required|string',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:3072',
            'attendees_count' => 'nullable|integer|min:0',
        ]);

        $photoPaths = $activity->photos; // Conservar las fotos actuales por defecto

        // Si se suben nuevas fotos, reemplazamos las anteriores
        if ($request->hasFile('photos')) {
            foreach ($activity->photos as $oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
            $photoPaths = [];
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('branch_activities', 'public');
            }
        }

        $activity->update([
            'title' => $request->title,
            'type' => $request->intervention_type, // 👈 Mapeado a la columna real 'type'
            'description' => $request->description,
            'photos' => $photoPaths,
            'attendees_count' => $request->attendees_count,
        ]);

        return redirect()->route('branch-activities.index')->with('success', 'Actividad actualizada.');
    }

    public function destroy($id)
    {
        $activity = BranchActivity::findOrFail($id);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'admin' && $activity->sede !== $user->sede) {
            abort(403, 'Acción no autorizada.');
        }

        // Eliminar archivos físicos del disco duro manteniendo tu ciclo iterativo
        foreach ($activity->photos as $photo) {
            Storage::disk('public')->delete($photo);
        }

        $activity->delete();

        return redirect()->route('branch-activities.index')->with('success', 'Actividad eliminada.');
    }
}