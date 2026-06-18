<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SubEventController;
use App\Http\Controllers\PublicViewerController;
use App\Models\Event;
use App\Models\SubEvent;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PhotoReportController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\WorkshopController;

/*
|--------------------------------------------------------------------------
| 1. RUTAS 100% PÚBLICAS (Accesibles sin iniciar sesión)
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicViewerController::class, 'index'])->name('public.viewer');

// 🎯 TRASLADADO: Todo el Portal Público ahora es libre de middleware de autenticación
// ── PORTAL PÚBLICO: SECCIÓN INSTITUCIONAL ──────────────────────────
Route::view('/institucional/sobre-nosotros', 'portal.sobre-nosotros')->name('portal.sobre-nosotros');
Route::view('/institucional/organigrama', 'portal.organigrama')->name('portal.organigrama');
Route::view('/institucional/directorio', 'portal.directorio')->name('portal.directorio');
Route::view('/institucional/marco-legal', 'portal.marco-legal')->name('portal.marco-legal');

// ── PORTAL PÚBLICO: ESTRUCTURA ORGÁNICA ────────────────────────────
Route::view('/estructura/gerencia-regional', 'portal.gerencia')->name('portal.gerencia');
Route::view('/estructura/administracion/personal', 'portal.admin-personal')->name('portal.admin-personal');
Route::view('/estructura/administracion/contabilidad', 'portal.admin-contabilidad')->name('portal.admin-contabilidad');
Route::view('/estructura/administracion/abastecimiento', 'portal.admin-abastecimiento')->name('portal.admin-abastecimiento');
Route::view('/estructura/administracion/presupuesto', 'portal.admin-presupuesto')->name('portal.admin-presupuesto');
Route::view('/estructura/empleo/general', 'portal.empleo-general')->name('portal.empleo-general');
Route::view('/estructura/empleo/registros', 'portal.empleo-registros')->name('portal.empleo-registros');

// ── PORTAL PÚBLICO: SERVICIOS AL CIUDADANO ─────────────────────────
Route::view('/servicios/centro-empleo', 'portal.servicio-empleo')->name('portal.servicio-empleo');
Route::view('/servicios/fraccionamiento-multas', 'portal.servicio-multas')->name('portal.servicio-multas');
Route::view('/servicios/capacitacion', 'portal.servicio-capacitacion')->name('portal.servicio-capacitacion');
Route::view('/servicios/defensa-legal', 'portal.servicio-defensa')->name('portal.servicio-defensa');


/*
|--------------------------------------------------------------------------
| 2. RUTAS PRIVADAS / INTRANET (Requieren autenticación obligatoria)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Perfil de Usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard Operativo (Procesamiento analítico de gráficos de Chart.js)
    Route::get('/dashboard', function () {
        $totalMetas = Event::sum('goal_people');
        $totalAvance = SubEvent::sum('attendees_count');
        $porcentajeGlobal = $totalMetas > 0 ? round(($totalAvance / $totalMetas) * 100, 1) : 0;

        $eventos = Event::with('category')
            ->withSum('subEvents as total_attendees', 'attendees_count')
            ->get();

        $chartBar = $eventos->map(function ($e) {
            return [
                'code'   => $e->event_code,
                'avance' => (int)($e->total_attendees ?? 0),
                'meta'   => (int)$e->goal_people,
            ];
        })->values();

        $catData = $eventos->groupBy(function ($e) {
            return $e->category->name ?? 'Sin categoría';
        })->map(function ($items) {
            return $items->sum('total_attendees');
        });

        $monthly = SubEvent::selectRaw("DATE_FORMAT(event_date, '%Y-%m') as mes, SUM(attendees_count) as total")
            ->groupBy('mes')
            ->orderBy('mes')
            ->limit(24)
            ->get();

        $completadas = $eventos->filter(fn($e) => ($e->total_attendees ?? 0) >= $e->goal_people)->count();
        $totalActividades = $eventos->count();

        return view('dashboard', compact(
            'totalMetas',
            'totalAvance',
            'porcentajeGlobal',
            'eventos',
            'chartBar',
            'catData',
            'monthly',
            'completadas',
            'totalActividades'
        ));
    })->name('dashboard');

    // ========================
    // SUBEVENTOS (Reportes de Avance)
    // ========================
    Route::get('/subevents/trashed', [SubEventController::class, 'trashed'])->name('subevents.trashed');
    Route::post('/subevents/{id}/restore', [SubEventController::class, 'restore'])->name('subevents.restore');
    Route::delete('/subevents/{id}/force-delete', [SubEventController::class, 'forceDelete'])->name('subevents.force-delete');
    Route::resource('subevents', SubEventController::class);

    // ========================
    // EVENTOS (Actividades Operativas)
    // ========================
    Route::get('/events/trashed', [EventController::class, 'trashed'])->name('events.trashed');
    Route::post('/events/{id}/restore', [EventController::class, 'restore'])->name('events.restore');
    Route::get('/events/{event}/report', [EventController::class, 'report'])->name('events.report');
    Route::resource('events', EventController::class);

    // ========================
    // CATEGORÍAS (Actividades Generales PP)
    // ========================
    Route::get('/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::resource('categories', CategoryController::class);

    // ========================
    // PAPELERA GENERAL
    // ========================
    Route::get('/papelera', [TrashController::class, 'index'])->name('trash.index');
    Route::post('/papelera/restaurar/{tipo}/{id}', [TrashController::class, 'restore'])->name('trash.restore');

    // ========================
    // REPORTES ANALÍTICOS Y EXCEL
    // ========================
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/general', [ReportController::class, 'generateGeneral'])->name('reports.generate.general');
    Route::get('/reports/specific', [ReportController::class, 'generateSpecific'])->name('reports.generate.specific');
    
    // GALERÍA DE REPORTES FOTOGRÁFICOS
    Route::get('/photo-reports', [PhotoReportController::class, 'index'])->name('photo-reports.index');
    Route::get('/photo-reports/create', [PhotoReportController::class, 'create'])->name('photo-reports.create');
    Route::post('/photo-reports', [PhotoReportController::class, 'store'])->name('photo-reports.store');

    // MANTENIMIENTOS CRUD ADICIONALES
    Route::resource('bulletins', BulletinController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('workshops', WorkshopController::class);    

});

require __DIR__.'/auth.php';