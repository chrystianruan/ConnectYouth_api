<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{

    protected $eventService;

    public function __construct(EventService $eventService) {
        $this->eventService = $eventService;
    }

    public function newEvent(Request $request) {
        $response = $this->eventService->newEvent($request);

        if ($response->status() === 201) {
            return $response;
        }
        return response()->json([
            'response' => 'Erro ao cadastrar evento'
        ], 405);
    }

    public function getAllEvents() {
        $events = $this->eventService->getEvents();

        return $events;
    }
}
