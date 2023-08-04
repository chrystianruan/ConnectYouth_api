<?php

namespace App\Services;


use App\Models\Personal_informations_user;
use App\Models\User;
use App\Repository\UserRepository;

class UserService  {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

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

    public function storePersonalInfos($request) {
        $personalInfos = new Personal_informations_user;
        $personalInfos->user_id = auth()->user()->id;
        $personalInfos->cep = $request->cep;
        $personalInfos->street = $request->street;
        $personalInfos->district = $request->district;
        $personalInfos->city = $request->city;
        $personalInfos->state = $request->state;
        $personalInfos->number_home = $request->number_home;
        $personalInfos->congregacao_id = $request->congregacao_id;
        $personalInfos->telephone = $request->telephone;
        $personalInfos->birth = $request->birth;
        $personalInfos->save();

        return response()->json([
           "response" => "Informações pessoais cadastradas com sucesso"
        ], 201);
    }

    public function getUsers() {
        $users = User::all();

        return $users;
    }

    public function getAuthUserWithPersonalInfosToAuthUser() {
        $user = User::select('*')
            ->findOrFail(auth()->user()->id);

        return $user;
    }

    public function showUserWithPersonalInfosToAuthUser() {
        $user = User::select('users.name', 'email', 'telephone', 'cep', 'street', 'district', 'city', 'state', 'number_home', 'birth', 'congregacaos.name as congregacao_name', 'setors.name as setor_name')
            ->leftJoin('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->leftJoin('congregacaos', 'congregacaos.id', '=', 'personal_informations_users.congregacao_id')
            ->leftJoin('setors', 'setors.id', '=', 'congregacaos.setor_id')
            ->findOrFail(auth()->user()->id);

        return $user;
    }

    public function showUserWithPersonalInfos($userId) {
        $userSelected = User::findOrFail($userId);
        $authUser = auth()->user();
        $resultValidation = $this->validateUserCongregacao($authUser, $userSelected);

        if (!$resultValidation) {
            $user = $this->userRepository->selectUserDifferentCongregacao($userId);
        } else {
            $user = $this->userRepository->selectUserSameCongregacao($userId);
        }

        return $user;
    }

    public function validateUserCongregacao($authUser, $user) {

        if ($authUser->congregacao_id !== $user->congregacao_id) {
            return null;
        }

        return true;
    }
}
