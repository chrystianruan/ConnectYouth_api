<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authentication(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'master' => 0, 'admin' => 0])) {
            $user = Auth::user();
            $token = $user->createToken("Token");
            return response()->json([
                'response' => 'Usuário logado com sucesso',
                'token' => $token->plainTextToken,
                'admin' => false,
                'master' => false,
                'para_moises' => 'você é um otário'
            ], 200);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'admin' => 1, 'master' => 0])) {
            $user = Auth::user();
            $token = $user->createToken("Token");
            return response()->json([
                'response' => 'Usuário logado com sucesso',
                'admin' => true,
                'master' => false,
                'token' => $token->plainTextToken,
                'para_moises' => 'você é um otário'
            ], 200);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'master' => 1, 'admin' => 0])) {

        }

        return response()->json([
            'response' => 'Erro ao logar'
        ], 405);
    }
}
