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

        $result = $this->userService->newUser($requests, $admin, $master);

        if ($result !== 200) {
            return $result;
        }
        return response()->json([
            'response' => 'user cadastrado com sucesso'
        ],200);
    }

    public function newAdminUser(Request $req) {
        $requests = $req;
        $admin = true;
        $master = false;

        $result = $this->userService->newUser($requests, $admin, $master);

        if ($result !== 200) {
            return redirect()->back()->with('msgError', 'Erro ao cadastrar usuário.');
        }
        return redirect()->back()->with('msg', 'Usuário Admin cadastrado com sucesso!');
    }

    public function newMasterUser(Request $req) {
        $requests = $req;
        $admin = false;
        $master = true;

        $result = $this->userService->newUser($requests, $admin, $master);

        if ($result !== 200) {
            return redirect()->back()->with('msgError', 'Erro ao cadastrar usuário.');
        }
        return redirect()->back()->with('msg', 'Usuário Master cadastrado com sucesso!');
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
