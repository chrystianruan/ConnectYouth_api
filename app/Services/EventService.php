<?php

namespace App\Services;


use App\Models\Event;

class EventService {

    public function newEvent($request) {
        $image = $request->image->store('images');
        $event = new Event;
        $event->title = $request->title;
        $event->image = $image;
        $event->description = $request->description;
        $event->free = $request->free;
        $event->price = $request->price;
        $event->location = $request->location;
        $event->congregacao_id = $request->congregacao_id;
        $event->save();

        return response()->json([
            'response' => 'Evento cadastrado com sucesso'
        ],201);
    }
    public function getEvents() {
        $events = Event::all();

        return $events;
    }
}

