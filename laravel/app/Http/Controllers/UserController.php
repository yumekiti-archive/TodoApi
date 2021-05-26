<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            return ['message' => 'ログインしました。'];
        }

        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードが違います。'],
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return ['message' => 'ログアウトしました。'];
    }

}
