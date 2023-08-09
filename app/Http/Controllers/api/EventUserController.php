<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\EventUserService;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
    protected $eventUserService;

    public function __construct(EventUserService $eventUserService) {
        $this->eventUserService = $eventUserService;
    }

    public function storeUserInEvent(Request $request) {
        $eventId = $request->event_id;
        $response = $this->eventUserService->storeUserInEvent($eventId);

        return $response;
    }

    public function getAllParticipantsOfEvent($id) {
        $result = $this->eventUserService->getAllPartipantsOfEvent($id);

        return $result;
    }
}
