<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

/**
 * Entrega las guías de uso desde la intranet.
 *
 * Los manuales son documentos HTML autónomos (sin recursos externos, listos
 * para exportar a PDF con Ctrl+P) que viven en resources/manuals/. No se
 * colocan en public/ a propósito: al servirlos desde aquí quedan detrás del
 * middleware 'auth', de modo que solo los ve quien ya inició sesión.
 *
 * Tampoco se renderizan como vistas Blade: son HTML literal con llaves y
 * arrobas en su CSS, y el compilador de Blade los alteraría.
 */
class ManualController extends Controller
{
    /** Guía completa del sistema: portal, intranet y asistente virtual. */
    public function general(): Response
    {
        return $this->entregar('manual-general.html');
    }

    /**
     * Guía específica de las sedes desconcentradas.
     *
     * Accesible también para el administrador general, que necesita conocer
     * el procedimiento de sede para acompañar a sus operadores.
     */
    public function sede(): Response
    {
        return $this->entregar('manual-sede.html');
    }

    /**
     * Devuelve el archivo tal cual, sin pasar por el compilador de plantillas.
     */
    private function entregar(string $archivo): Response
    {
        $ruta = resource_path('manuals/'.$archivo);

        abort_unless(is_file($ruta), 404, 'La guía solicitada no está disponible.');

        return response(file_get_contents($ruta), 200, [
            'Content-Type' => 'text/html; charset=UTF-8',
            // Documento estático: se cachea en el navegador, pero solo en
            // privado (nunca en un proxy compartido), porque exige sesión.
            'Cache-Control' => 'private, max-age=3600',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
