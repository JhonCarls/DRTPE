<?php

namespace App\Http\Controllers;

use App\Models\Coordination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Módulo independiente de Coordinaciones Institucionales Realizadas.
 * No tiene relación con Talleres/Capacitaciones.
 */
class CoordinationController extends Controller
{
    public function index()
    {
        $coordinations = Coordination::orderByDesc('coordination_date')->get();

        return view('coordinations.index', compact('coordinations'));
    }

    public function create()
    {
        return view('coordinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'coordination_date' => 'required|date',
            'description' => 'required|string',
            'photos' => 'required|array|min:1',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $photos = [];
        foreach ($request->file('photos') as $photo) {
            $photos[] = $photo->store('coordinations', 'public');
        }

        Coordination::create([
            'title' => $request->title,
            'coordination_date' => $request->coordination_date,
            'description' => $request->description,
            'photos' => $photos,
        ]);

        return redirect()->route('coordinations.index')
            ->with('success', 'Coordinación registrada correctamente.');
    }

    public function edit(Coordination $coordination)
    {
        return view('coordinations.edit', compact('coordination'));
    }

    public function update(Request $request, Coordination $coordination)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'coordination_date' => 'required|date',
            'description' => 'required|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = [
            'title' => $request->title,
            'coordination_date' => $request->coordination_date,
            'description' => $request->description,
        ];

        // Nuevas fotos se acumulan a las existentes
        if ($request->hasFile('photos')) {
            $photos = $coordination->photos ?? [];
            foreach ($request->file('photos') as $photo) {
                $photos[] = $photo->store('coordinations', 'public');
            }
            $data['photos'] = $photos;
        }

        $coordination->update($data);

        return redirect()->route('coordinations.index')
            ->with('success', 'Coordinación actualizada correctamente.');
    }

    public function destroy(Coordination $coordination)
    {
        foreach (($coordination->photos ?? []) as $path) {
            Storage::disk('public')->delete($path);
        }

        $coordination->delete();

        return redirect()->route('coordinations.index')
            ->with('success', 'Coordinación eliminada correctamente.');
    }
}
