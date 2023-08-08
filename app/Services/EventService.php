<?php

namespace App\Services;


use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventService {

    public function newEvent($request) {
        $image = $request->image->store('images');

        $authUser = User::leftJoin('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->findOrFail(auth()->user()->id);
        
        $event = new Event;
        $event->title = $request->title;
        $event->image = $image;
        $event->description = $request->description;
        $event->free = $request->free;
        $event->price = $request->price;
        $event->location = $request->location;
        $event->congregacao_id = $authUser->congregacao_id;
        $event->save();

        return response()->json([
            'response' => 'Evento cadastrado com sucesso'
        ],201);
    }

    public function getEvents() {
        $events = Event::all();

        return $events;
    }

    public function showEvent($eventId) {

    }
    public function updateEvent($eventId) {

    }
    public function deleteEvent($eventId) {

    }
}

