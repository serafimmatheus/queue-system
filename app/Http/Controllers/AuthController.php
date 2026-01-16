<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login_frm');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate(
            [
            'username' => ['required', 'email'],
            'password' => ['required'],
            ],
            [
                'username.required' => 'O campo usuário é obrigatório.',
                'username.email' => 'O campo usuário deve ser um email válido.',
                'password.required' => 'O campo senha é obrigatório.',
            ]
        );

        echo 'Formulario de Login enviado';
    }

    public function logout()
    {
        echo 'Logout';
    }
}
