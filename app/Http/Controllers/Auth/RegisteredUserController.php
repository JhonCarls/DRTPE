<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    /**
     * El registro público está deshabilitado de forma intencional.
     *
     * La creación de cuentas es una operación privilegiada reservada al administrador
     * de la Sede Central, que da de alta a los operadores desde el panel interno
     * (App\Http\Controllers\UserController). Cualquier acceso a /register redirige al
     * formulario de acceso con un aviso institucional.
     */
    public function create(): RedirectResponse
    {
        return redirect()
            ->route('login')
            ->with('status', 'El registro de cuentas es exclusivo de la Sede Central. Solicite su acceso al administrador del sistema.');
    }
}
