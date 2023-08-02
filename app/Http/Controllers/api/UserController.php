<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Personal_informations_user;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function newSimpleUser(Request $req) {
        $requests = $req;
        $admin = false;
        $master = false;

        $response = $this->userService->newUser($requests, $admin, $master);

        if ($response->status() === 201) {
            return $response;
        }
        return response()->json([
            'response' => 'Erro ao cadastrar usuário'
        ], 405);
    }

    public function newAdminUser(Request $req) {
        $requests = $req;
        $admin = true;
        $master = false;

        $response = $this->userService->newUser($requests, $admin, $master);

        if ($response->status() === 201) {
            return $response;
        }
        return response()->json([
            'response' => 'Erro ao cadastrar usuário'
        ], 405);
    }

    public function newMasterUser(Request $req) {
        $requests = $req;
        $admin = false;
        $master = true;

        $response = $this->userService->newUser($requests, $admin, $master);

        if ($response->status() === 201) {
            return $response;
        }
        return response()->json([
            'response' => 'Erro ao cadastrar usuário'
        ], 405);
    }


    public function getUsers() {
        $users = User::all();

        return $users;
    }

    public function getPersonalInfosToUser($id) {
        $user = User::select('*')
            ->join('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->findOrFail($id);

        return $user;
    }
}
