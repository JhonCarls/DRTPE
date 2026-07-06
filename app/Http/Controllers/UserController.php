<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Muestra el formulario de creación de usuarios.
     */
    public function create()
    {
        // Seguridad: Solo el administrador general puede acceder a esta sección
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tiene permisos para gestionar usuarios.');
        }

        return view('internal.users.create');
    }

    /**
     * Procesa e inserta el nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Seguridad complementaria en la petición
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Acción no autorizada.');
        }

        // 2. Validación estricta de campos
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username', // Evita duplicados
            'password' => 'required|string|min:6', // Contraseña segura (mínimo 6 caracteres)
            'role' => 'required|in:admin,director,user',
            'sede' => 'required|in:puno,juliaca,taraco',
        ]);

        // 3. Inserción limpia respetando el modelo de Laravel 11
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // 👈 Encriptación segura nativa
            'role' => $request->role,
            'sede' => $request->sede,
        ]);

        // 4. Redirección al dashboard con mensaje de éxito
        return redirect()->route('dashboard')->with('success', '¡Usuario creado y asignado a su sede con éxito!');
    }
}