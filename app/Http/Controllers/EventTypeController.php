<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventTypes = EventType::get();

        return view('event-types/index', [
            'eventTypes' => $eventTypes
        ]);
    }

    public function get()
    {
        $eventTypes = EventType::get();

        return response()->json([
            'message' => 'Tipos de eventos obtenidos con exito',
            'data' => $eventTypes
        ]);
    }

    public function save(Request $request)
    {
        $eventType = new EventType();

        $eventType->name = $request->name;
        $eventType->background_color = $request->background_color;
        $eventType->text_color = $request->text_color;
        $eventType->border_color = $request->border_color;

        $eventType->save();

        return response()->json([
            'message' => 'Tipo de evento creado con exito',
            'data' => $eventType
        ]);
    }
    
    public function update(Request $request)
    {
        $id = $request->id;

        $eventType = EventType::find($id);

        $eventType->name = $request->name;
        $eventType->background_color = $request->background_color;
        $eventType->text_color = $request->text_color;
        $eventType->border_color = $request->border_color;

        $eventType->update();
        
        return response()->json([
            'message' => 'Tipo de evento editado con exito',
            'data' => $eventType
        ]);
    }

    public function delete($id)
    {
        $eventType = EventType::find($id);

        $eventType->delete();

        return response()->json([
            'message' => 'Tipo de evento eliminado con exito',
            'data' => $eventType
        ]);
    }
}
