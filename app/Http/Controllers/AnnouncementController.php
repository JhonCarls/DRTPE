<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $query = Announcement::with('user')->latest();

        // Aislamiento interno: un operador de sede desconcentrada solo administra
        // los comunicados de SU sede; el administrador central (ej. 'puno') ve todo.
        if (in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true)) {
            $query->bySede($user->sede);
        }

        $announcements = $query->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isCentral = ! in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true);

        // Sede Central → layout administrativo global; Sede Desconcentrada → layout de sede.
        return view('announcements.create', [
            'layout'    => $isCentral ? 'app-layout' : 'branch-layout',
            'isCentral' => $isCentral,
            'backUrl'   => $isCentral ? route('announcements.index') : route('branch-activities.index'),
        ]);
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isCentral = ! in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true);

        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'file'          => 'required|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'published_at'  => 'required|date',
            'expired_at'    => 'required|date|after_or_equal:published_at',
            'attachments'   => 'nullable|array|max:6', // Límite estricto de 6 archivos
            'attachments.*' => 'file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
        ]);

        // Sede destino: el admin/central emite Difusión Oficial INSTITUCIONAL (sede = NULL,
        // visible en todo el sistema). El operador de sede la hereda FORZADA de su sesión.
        $sedeDestino = $isCentral ? null : $user->sede;

        // 1. Guardar el archivo principal del comunicado
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $fileType = ($extension === 'pdf') ? 'pdf' : 'image';
        $mainPath = $file->store('announcements', 'public');

        // 2. Procesar los archivos adjuntos complementarios opcionales
        $attachmentsPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachedFile) {
                $attachmentsPaths[] = $attachedFile->store('announcements/attachments', 'public');
            }
        }

        // 3. Crear el registro consolidado
        Announcement::create([
            'user_id'      => $user->id,
            'sede'         => $sedeDestino,
            'title'        => $request->title,
            'description'  => $request->description,
            'file_path'    => $mainPath,
            'file_type'    => $fileType,
            'attachments'  => $attachmentsPaths, // Laravel lo parsea a JSON automáticamente por el cast
            'published_at' => $request->published_at,
            'expired_at'   => $request->expired_at,
        ]);

        return $this->redirectAfterWrite('Comunicado y adjuntos publicados con éxito.');
    }



    public function edit(Announcement $announcement)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isCentral = ! in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true);

        // Un operador de sede solo puede editar comunicados de SU sede.
        if (! $isCentral && strtolower((string) $announcement->sede) !== strtolower((string) $user->sede)) {
            abort(403, 'No autorizado para editar comunicados de otra sede.');
        }

        return view('announcements.edit', [
            'announcement' => $announcement,
            'layout'       => $isCentral ? 'app-layout' : 'branch-layout',
            'isCentral'    => $isCentral,
            'backUrl'      => $isCentral ? route('announcements.index') : route('portal.sede', ['slug' => $user->sede]),
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isCentral = ! in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true);

        if (! $isCentral && strtolower((string) $announcement->sede) !== strtolower((string) $user->sede)) {
            abort(403, 'No autorizado para editar comunicados de otra sede.');
        }

        $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'nullable|string',
            'file'                  => 'nullable|file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'published_at'          => 'required|date',
            'expired_at'            => 'required|date|after_or_equal:published_at',
            'attachments'           => 'nullable|array|max:6',
            'attachments.*'         => 'file|mimes:pdf,jpeg,png,jpg,webp|max:10240',
            'removed_attachments'   => 'nullable|array',
            'removed_attachments.*' => 'string',
        ]);

        $data = [
            'title'        => $request->title,
            'description'  => $request->description,
            'published_at' => $request->published_at,
            'expired_at'   => $request->expired_at,
        ];

        // El alcance no se reasigna aquí: los comunicados institucionales del central
        // permanecen institucionales (sede = NULL) y los de sede permanecen en su sede.

        // Reemplazo opcional del documento matriz
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($announcement->file_path);

            $file = $request->file('file');
            $extension = strtolower($file->getClientOriginalExtension());

            $data['file_type'] = ($extension === 'pdf') ? 'pdf' : 'image';
            $data['file_path'] = $file->store('announcements', 'public');
        }

        // Gestión de anexos: conservar los existentes menos los marcados para eliminar,
        // y añadir los nuevos (sin romper la carga masiva).
        $existing = $announcement->attachments ?? [];
        $removed  = (array) $request->input('removed_attachments', []);
        $kept     = array_values(array_diff($existing, $removed));

        foreach ($removed as $path) {
            if (in_array($path, $existing, true)) {
                Storage::disk('public')->delete($path);
            }
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachedFile) {
                $kept[] = $attachedFile->store('announcements/attachments', 'public');
            }
        }

        $data['attachments'] = $kept;

        $announcement->update($data);

        return $this->redirectAfterWrite('Comunicado actualizado.');
    }

    public function destroy(Announcement $announcement)
    {
        Storage::disk('public')->delete($announcement->file_path);
        $announcement->delete();

        return $this->redirectAfterWrite('Comunicado eliminado.');
    }

    /**
     * Devuelve al usuario a la vista que corresponde según su origen.
     *
     * Los operadores de sede desconcentrada (Juliaca, Taraco) regresan al portal
     * público de SU sede tras publicar/editar; el administrador central vuelve al
     * listado de gestión. Así se corrige la redirección forzada a la Sede Central.
     */
    private function redirectAfterWrite(string $message)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && in_array($user->sede, Announcement::SEDES_DESCONCENTRADAS, true)) {
            return redirect()
                ->route('portal.sede', ['slug' => $user->sede])
                ->with('success', $message);
        }

        return redirect()->route('announcements.index')->with('success', $message);
    }
}

