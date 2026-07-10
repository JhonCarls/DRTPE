<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * Si la petición es AJAX (login sin recargar la página), devolvemos el destino en
     * JSON; si falla la validación, el LoginRequest lanza una ValidationException que
     * Laravel serializa automáticamente como 422 JSON, evitando la recarga completa.
     */
    public function store(LoginRequest $request): RedirectResponse|JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Se consume UNA sola vez la URL "intended" y se reutiliza en ambos flujos.
        $target = redirect()->intended(route('dashboard', absolute: false))->getTargetUrl();

        if ($request->expectsJson()) {
            return response()->json(['redirect' => $target]);
        }

        return redirect()->to($target);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
