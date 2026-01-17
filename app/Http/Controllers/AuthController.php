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
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }

    public function changePassword()
    {
        return view('auth.change_password_frm');
    }

    public function changePasswordSubmit(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/'],
            'new_password_confirmation' => ['required'],
        ], [
            'current_password.required' => 'O campo senha atual é obrigatório.',
            'new_password.required' => 'O campo nova senha é obrigatório.',
            'new_password.confirmed' => 'As senhas não conferem.',
            'new_password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            'new_password.max' => 'A senha deve ter no máximo 16 caracteres.',
            'new_password_confirmation.required' => 'O campo repetir senha é obrigatório.',
            'new_password.regex' => 'A senha deve ter pelo menos uma letra maiúscula, uma letra minúscula e um dígito.',
        ]);

        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->back()->withErrors(['new_password' => 'A nova senha não pode ser igual à senha atual.']);
        }


        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['new_password_confirmation' => 'As senhas não conferem.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('home')->with('success', 'Senha alterada com sucesso.');
    }
}
