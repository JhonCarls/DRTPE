<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\EventProgressExport;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    // Mostrar la lista de Actividades Operativas
    public function index()
    {
        $events = Event::with('category')->get();
        return view('events.index', compact('events'));
    }

    // Mostrar el formulario para crear
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    // Guardar en la base de datos
    public function store(Request $request)
{
    $request->validate([
        'category_id'    => 'required|exists:categories,id',
        
        // 🎯 REPARADO EXPERTO: Quitamos el 'unique:events,event_code' global.
        // Ahora el código A01, A02, etc., se puede repetir todas las veces que quieras.
        'event_code'     => 'required|string|max:50', 
        
        'poi_code'       => 'nullable|string|max:100',
        'description'    => 'required|string',
        'funding_source' => 'required|string|in:gobierno_regional,gobierno_central',
        'unit_measure'   => 'required|string|max:100',
        'goal_people'    => 'required|integer|min:1',
    ]);

    // Tu lógica de guardado clásica de Laravel...
    $data = $request->all();
    Event::create($data); // O el modelo que uses para esta tabla

    return redirect()->route('events.index')->with('success', 'Actividad Operativa registrada con éxito.');
}

    // Mostrar el detalle de una actividad
    public function show(Event $event)
    {
        $event->load('category', 'subEvents');
        return view('events.show', compact('event'));
    }

    // Mostrar el formulario para editar
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    // Actualizar la actividad
    public function update(Request $request, $id) // O (Request $request, Event $event) según tu ruta
{
    $request->validate([
        'category_id'    => 'required|exists:categories,id',
        
        // 🎯 REPARADO: Quitamos 'unique:events,event_code...' de aquí.
        // Al dejarlo solo como 'string', Laravel ya no te rebotará cuando repitas el código A01.
        'event_code'     => 'required|string|max:50', 
        
        'poi_code'       => 'nullable|string|max:100',
        'description'    => 'required|string',
        'funding_source' => 'required|string|in:gobierno_regional,gobierno_central',
        'unit_measure'   => 'required|string|max:100',
        'goal_people'    => 'required|integer|min:1',
    ]);

    // Tu lógica de actualización actual (no la cambies, solo asegúrate de que procese los datos)
    $event = Event::findOrFail($id); // O si usas Route Model Binding, usa directamente $event
    $event->update($request->all());

    return redirect()->route('events.index')->with('success', 'Actividad operativa actualizada con éxito.');
}

    // Soft Delete (mover a papelera)
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Actividad movida a la papelera.');
    }

    // Generar informe Excel
    public function report(Event $event)
    {
        return Excel::download(new EventProgressExport($event), 'reporte-' . $event->event_code . '.xlsx');
    }
}