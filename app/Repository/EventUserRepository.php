<?php

namespace App\Repository;
use App\Models\EventUser;
class EventUserRepository
{
    public function getAllPartipantsOfEvent($eventId) {
        $eventUsers = EventUser::select('users.name', 'personal_informations_users.telephone', 'congregacaos.name as congregacao_name', 'setors.name as setor_name', 'events.title as event_title')
            ->join('users', 'users.id', '=', 'event_user.user_id')
            ->join('events', 'events.id', '=', 'event_user.event_id')
            ->leftJoin('personal_informations_users', 'users.id', '=', 'personal_informations_users.user_id')
            ->leftJoin('congregacaos', 'congregacaos.id', '=', 'personal_informations_users.congregacao_id')
            ->leftJoin('setors', 'setors.id', '=', 'congregacaos.setor_id')
            ->where('event_id', $eventId)
            ->get();

        return $eventUsers;
    }
}
