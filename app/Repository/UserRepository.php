<?php
namespace App\Repository;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository  {
    //$table->unsignedBigInteger('user_id');
    //$table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
    //$table->unsignedBigInteger('congregacao_id');
    //$table->foreign('congregacao_id')->references('id')->on('congregacaos')->cascadeOnDelete();
    //$table->string('cep');
    //$table->string('street');
    //$table->string('district');
    //$table->string('city');
    //$table->string('state');
    //$table->string('number_home');
    //$table->string('telephone');
    //$table->date('birth');
    public function selectUserDifferentCongregacao($userId) {
        $user = User::select('users.name', 'email', 'telephone', 'birth', 'congregacaos.name')
            ->leftJoin('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->leftJoin('congregacaos', 'congregacaos.id', '=', 'personal_informations_users.congregacao_id')
            ->leftJoin('setors', 'setors.id', '=', 'congregacaos.setor_id')
            ->findOrFail($userId);

        return $user;
    }

    public function selectUserSameCongregacao($userId) {
        $user = User::select('users.name', 'email', 'telephone', 'cep', 'street', 'district', 'city', 'state', 'number_home', 'birth', 'congregacaos.name as congregacao_name', 'setors.name as setor_name')
            ->leftJoin('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->leftJoin('congregacaos', 'congregacaos.id', '=', 'personal_informations_users.congregacao_id')
            ->leftJoin('setors', 'setors.id', '=', 'congregacaos.setor_id')
            ->findOrFail($userId);

        return $user;
    }

//    public function selectUserWithPersonalInfosToMaster($userId) {
//
//    }

    public function selectUserWithPersonalInfosToAuthUser($userId) {
        $user = User::select('users.name', 'email', 'telephone', 'cep', 'street', 'district', 'city', 'state', 'number_home', 'birth', 'congregacaos.name as congregacao_name', 'setors.name as setor_name')
            ->leftJoin('personal_informations_users', 'personal_informations_users.user_id', '=', 'users.id')
            ->leftJoin('congregacaos', 'congregacaos.id', '=', 'personal_informations_users.congregacao_id')
            ->leftJoin('setors', 'setors.id', '=', 'congregacaos.setor_id')
            ->findOrFail($userId);

        return $user;
    }

}

