<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /** Sedes disponibles para asignar operadores (etiqueta + ícono). */
    public const SEDES = [
        'juliaca' => ['label' => 'Sede Juliaca',       'icon' => 'fa-city',          'desc' => 'Zona Norte'],
        'taraco'  => ['label' => 'Sede Taraco',        'icon' => 'fa-building-flag',  'desc' => 'Itinerante'],
        'puno'    => ['label' => 'Sede Central Puno',  'icon' => 'fa-landmark',       'desc' => 'Sede Principal'],
    ];

    /** Solo el administrador general gestiona usuarios. */
    private function authorizeAdmin(): void
    {
        /** @var \App\Models\User|null $u */
        $u = Auth::user();
        if (! $u || $u->role !== 'admin') {
            abort(403, 'No tiene permisos para gestionar usuarios.');
        }
    }

    /**
     * Página de gestión: formulario de alta + tabla de operadores agrupados por sede.
     */
    public function create()
    {
        $this->authorizeAdmin();

        return view('internal.users.create', [
            'sedes'     => self::SEDES,
            'operators' => User::orderBy('sede')->orderByDesc('created_at')->get()->groupBy('sede'),
        ]);
    }

    /** Alias de listado → misma pantalla de gestión. */
    public function index()
    {
        return $this->create();
    }

    /**
     * Procesa e inserta el nuevo operador de sede.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'     => 'required|string|max:255',
            'dni'      => 'nullable|digits:8',
            'username' => 'required|string|max:255|unique:users,username',
            'email'    => 'nullable|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,director,user',
            'sede'     => 'required|in:' . implode(',', array_keys(self::SEDES)),
        ], [], [
            'dni' => 'DNI',
        ]);

        User::create([
            'name'      => $request->name,
            'dni'       => $request->dni,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'sede'      => $request->sede,
            'is_active' => true,
        ]);

        return redirect()->route('users.index')->with('success', '¡Operador de sede creado y asignado con éxito!');
    }

    /**
     * Activa / desactiva una cuenta (restablecimiento de acceso).
     */
    public function toggle(User $user)
    {
        $this->authorizeAdmin();

        // Un administrador no puede desactivarse a sí mismo.
        if ($user->id === Auth::id()) {
            return back()->with('error', 'No puede desactivar su propia cuenta.');
        }

        $user->update(['is_active' => ! $user->is_active]);

        return back()->with('success', 'Estado de la cuenta actualizado.');
    }
}
