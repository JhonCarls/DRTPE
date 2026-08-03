<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Workshop;
use App\Rules\SupportedVideoUrl;
use App\Support\VideoEmbed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WorkshopController extends Controller
{
    /**
     * Panel de gestión: separa claramente los eventos Programados (Por Hacer)
     * de los Ejecutados (Hechos).
     */
    public function index()
    {
        $programados = Workshop::programados()->orderBy('scheduled_date')->get();
        $ejecutados = Workshop::ejecutados()->orderByDesc('executed_date')->get();

        return view('workshops.index', compact('programados', 'ejecutados'));
    }

    // ─────────────────────────────────────────────────────────────────────
    // FASE A — EVENTO PROGRAMADO / POR HACER
    // ─────────────────────────────────────────────────────────────────────

    public function create()
    {
        return view('workshops.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:taller,capacitacion',
            'description' => 'required|string',
            'scheduled_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'location' => 'nullable|string|max:255',
            'flyer' => 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'attachments' => 'nullable|array|max:6',
            'attachments.*' => 'file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'videos' => 'nullable|array|max:'.VideoEmbed::MAX_PER_RECORD,
            'videos.*' => ['nullable', 'string', 'max:500', new SupportedVideoUrl],
            'publish_as_announcement' => 'nullable|boolean',
        ]);

        $flyer = $request->file('flyer');
        $flyerType = strtolower($flyer->getClientOriginalExtension()) === 'pdf' ? 'pdf' : 'image';

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $attachments[] = $file->store('workshops/attachments', 'public');
            }
        }

        $workshop = Workshop::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'status' => 'programado',
            'scheduled_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'flyer_path' => $flyer->store('workshops/flyers', 'public'),
            'flyer_type' => $flyerType,
            'attachments' => $attachments,
            // Difusión promocional del evento aún no realizado (reel de TikTok,
            // video de Facebook o spot de YouTube que anuncia la convocatoria).
            'videos' => VideoEmbed::sanitize($request->input('videos')),
            'publish_as_announcement' => $request->boolean('publish_as_announcement'),
        ]);

        $this->syncAnnouncement($workshop);

        return redirect()->route('workshops.index')
            ->with('success', 'Evento programado y publicado en el portal correctamente.');
    }

    // ─────────────────────────────────────────────────────────────────────
    // FASE B — REGISTRO DIRECTO DE EVENTO YA EJECUTADO / HECHO
    // ─────────────────────────────────────────────────────────────────────

    public function createExecuted()
    {
        return view('workshops.create-executed');
    }

    public function storeExecuted(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:taller,capacitacion',
            'description' => 'required|string',
            'executed_date' => 'required|date',
            'attendees_count' => 'nullable|integer|min:0',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'videos' => 'nullable|array|max:'.VideoEmbed::MAX_PER_RECORD,
            'videos.*' => ['nullable', 'string', 'max:500', new SupportedVideoUrl],
        ]);

        $photos = [];
        foreach ($request->file('photos') as $photo) {
            $photos[] = $photo->store('workshops/evidence', 'public');
        }

        Workshop::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'status' => 'ejecutado',
            'executed_date' => $request->executed_date,
            'attendees_count' => $request->attendees_count,
            'photos' => $photos,
            'videos' => VideoEmbed::sanitize($request->input('videos')),
        ]);

        return redirect()->route('workshops.index')
            ->with('success', 'Evento ejecutado registrado con sus evidencias fotográficas.');
    }

    // ─────────────────────────────────────────────────────────────────────
    // EDICIÓN / TRANSICIÓN Programado → Ejecutado
    // ─────────────────────────────────────────────────────────────────────

    public function edit(Workshop $workshop)
    {
        return view('workshops.edit', compact('workshop'));
    }

    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:taller,capacitacion',
            'description' => 'required|string',
            'scheduled_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'flyer' => 'nullable|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'attachments' => 'nullable|array|max:6',
            'attachments.*' => 'file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'mark_executed' => 'nullable|boolean',
            'executed_date' => 'nullable|date',
            'attendees_count' => 'nullable|integer|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'videos' => 'nullable|array|max:'.VideoEmbed::MAX_PER_RECORD,
            'videos.*' => ['nullable', 'string', 'max:500', new SupportedVideoUrl],
            'publish_as_announcement' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'scheduled_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            // Se reemplaza la lista completa: así el operador puede agregar la
            // difusión después del evento o retirar un enlace dado de baja.
            'videos' => VideoEmbed::sanitize($request->input('videos')),
            'publish_as_announcement' => $request->boolean('publish_as_announcement'),
        ];

        // Reemplazo del flyer promocional
        if ($request->hasFile('flyer')) {
            if ($workshop->flyer_path) {
                Storage::disk('public')->delete($workshop->flyer_path);
            }
            $flyer = $request->file('flyer');
            $data['flyer_type'] = strtolower($flyer->getClientOriginalExtension()) === 'pdf' ? 'pdf' : 'image';
            $data['flyer_path'] = $flyer->store('workshops/flyers', 'public');
        }

        // Nuevos documentos/bases (se acumulan)
        if ($request->hasFile('attachments')) {
            $kept = $workshop->attachments ?? [];
            foreach ($request->file('attachments') as $file) {
                $kept[] = $file->store('workshops/attachments', 'public');
            }
            $data['attachments'] = $kept;
        }

        // Nuevas evidencias fotográficas (se acumulan)
        if ($request->hasFile('photos')) {
            $photos = $workshop->photos ?? [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('workshops/evidence', 'public');
            }
            $data['photos'] = $photos;
        }

        // Transición explícita a "ejecutado"
        if ($request->boolean('mark_executed')) {
            $data['status'] = 'ejecutado';
            $data['executed_date'] = $request->executed_date ?: now()->toDateString();
        }

        if ($request->filled('attendees_count')) {
            $data['attendees_count'] = $request->attendees_count;
        }

        $workshop->update($data);
        $workshop->refresh();

        $this->syncAnnouncement($workshop);

        return redirect()->route('workshops.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(Workshop $workshop)
    {
        // Limpieza física de archivos
        if ($workshop->flyer_path) {
            Storage::disk('public')->delete($workshop->flyer_path);
        }
        foreach (($workshop->attachments ?? []) as $path) {
            Storage::disk('public')->delete($path);
        }
        foreach (($workshop->photos ?? []) as $path) {
            Storage::disk('public')->delete($path);
        }

        // Elimina también el comunicado vinculado (si se generó automáticamente)
        if ($workshop->announcement_id) {
            optional($workshop->announcement)->delete();
        }

        $workshop->delete();

        return redirect()->route('workshops.index')->with('success', 'Evento eliminado correctamente.');
    }

    /**
     * Sincronización automática con el módulo de Comunicados.
     *
     * Si el operador marcó la publicación y existe un flyer, se crea/actualiza un
     * comunicado institucional (sede = NULL) que vence el día del evento. Si se
     * desmarca, se elimina el comunicado vinculado.
     */
    private function syncAnnouncement(Workshop $workshop): void
    {
        if (! $workshop->publish_as_announcement || ! $workshop->flyer_path) {
            if ($workshop->announcement_id) {
                optional($workshop->announcement)->delete();
                $workshop->forceFill(['announcement_id' => null])->saveQuietly();
            }

            return;
        }

        $expira = ($workshop->scheduled_date && $workshop->scheduled_date->isFuture())
            ? $workshop->scheduled_date->toDateString()
            : now()->addWeeks(2)->toDateString();

        $payload = [
            'user_id' => Auth::id(),
            'sede' => null, // difusión oficial institucional
            'title' => $workshop->title,
            'description' => $workshop->description,
            'file_path' => $workshop->flyer_path,
            'file_type' => $workshop->flyer_type ?? 'image',
            'attachments' => $workshop->attachments ?? [],
            'published_at' => now()->toDateString(),
            'expired_at' => $expira,
        ];

        if ($workshop->announcement_id && $workshop->announcement) {
            $workshop->announcement->update($payload);
        } else {
            $announcement = Announcement::create($payload);
            $workshop->forceFill(['announcement_id' => $announcement->id])->saveQuietly();
        }
    }
}
