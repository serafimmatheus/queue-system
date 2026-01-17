<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        $user = User::where('email', trim($request->username))
            ->where('active', true)
            ->whereNull('deleted_at')
            ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['username' => 'Usuário ou senha inválidos.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['username' => 'Usuário ou senha inválidos.']);
        }

        $this->loginUser($user);

        return redirect()->route('home');
    }

    private function loginUser($user)
    {
        $user->last_login = now();
        $user->code = null;
        $user->code_expiration = null;
        $user->save();

        auth()->login($user);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
