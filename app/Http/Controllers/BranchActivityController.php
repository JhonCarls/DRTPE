<?php

namespace App\Http\Controllers;

use App\Models\BranchActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BranchActivityController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // El administrador ve todo, el usuario de sede ve solo lo de su jurisdicción
        $activities = ($user->role === 'admin') 
            ? BranchActivity::orderBy('created_at', 'desc')->get()
            : BranchActivity::where('sede', $user->sede)->orderBy('created_at', 'desc')->get();

        return view('internal.branch-activities.index', compact('activities'));
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
            'intervention_type' => $request->intervention_type, // 👈 Registrado de forma masiva
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
            'intervention_type' => $request->intervention_type, // 👈 Sincronizado en la persistencia de cambios
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