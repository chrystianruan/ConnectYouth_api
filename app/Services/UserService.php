<?php

namespace App\Services;


use App\Models\User;

class UserService  {

    public function newUser($request, $admin, $master) {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->admin = $admin;
        $user->master = $master;
        $user->completed_personal_infos = false;
        $user->save();

        return response()->json([
            'response' => 'User cadastrado com sucesso'
        ], 201);
    }
}
