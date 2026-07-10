<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ── REGLA DE CONTRASEÑA INSTITUCIONAL (NIVEL PRODUCCIÓN) ──────────────
        // Se define una sola vez y la heredan TODOS los flujos que usan
        // Password::defaults() (restablecimiento y cambio de clave del perfil):
        //   • Mínimo 8 caracteres
        //   • Al menos una mayúscula y una minúscula (mixedCase)
        //   • Al menos un número
        //   • Al menos un símbolo
        // En producción se añade la verificación contra filtraciones de datos
        // (HaveIBeenPwned mediante k-anonymity). En local se omite para no depender
        // de una llamada externa durante el desarrollo.
        Password::defaults(function () {
            $rule = Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols();

            return $this->app->isProduction()
                ? $rule->uncompromised()
                : $rule;
        });
    }
}
