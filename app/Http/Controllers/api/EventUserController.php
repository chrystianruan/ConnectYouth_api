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

    public function storeUserInEvent() {

    }
}
