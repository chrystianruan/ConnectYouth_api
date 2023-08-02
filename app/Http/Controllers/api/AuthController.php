<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authentication(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'admin' => 1])) {
            return redirect('/admin/dashboard');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'master' => 1])) {
            return redirect('/master/dashboard');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'master' => 0, 'admin' => 0])) {
            return redirect('/dashboard');
        }

        return redirect()->back()->with('message', 'Seu usuário ou senha estão errados');
    }
}
