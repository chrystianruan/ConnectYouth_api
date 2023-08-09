<?php

namespace App\Services;


use App\Models\EventUser;
use App\Repository\EventUserRepository;

class EventUserService {

    protected $eventUserRepository;

    public function __construct(EventUserRepository $eventUserRepository) {
        $this->eventUserRepository = $eventUserRepository;

    }

    public function storeUserInEvent($eventId) {
        $checkParticipation = $this->checkParticipation(auth()->user()->id, $eventId);
        if ($checkParticipation === true) {
            $eventUser = new EventUser;
            $eventUser->user_id = auth()->user()->id;
            $eventUser->event_id = $eventId;
            $eventUser->save();

            return response()->json([
                'response' => 'Usuário está participando do evento!'
            ], 201);
        }

       return response()->json([
          'response' => 'Ação não permitida pois o usuário já está participando do evento'
       ], 403);
    }

    private function checkParticipation($userId, $eventId) {
        $checkParticipation = EventUser::where('user_id', '=', $userId)
                                ->where('event_id', $eventId)
                                ->count();
        if ($checkParticipation > 0) {
            return false;
        }
        return true;
    }

    public function getAllPartipantsOfEvent($eventId) {
        $participants = $this->eventUserRepository->getAllPartipantsOfEvent($eventId);

        if ($participants->count() > 0) {
            return $participants;
        }

        return response()->json([
            'response' => 'Nenhum participante encontrado para o evento'
        ], 200);
    }
}
