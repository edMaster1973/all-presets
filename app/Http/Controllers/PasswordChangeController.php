<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class PasswordChangeController extends Controller
{
    /**
     * Exibe o formulário de alteração de senha.
     *
     * @return \Illuminate\View\View
     */
    public function showChangeForm()
    {
        return view('auth.change-password');
    }

    /**
     * Processa a alteração de senha.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()],
        ], [
            'current_password.required' => 'A senha atual é obrigatória.',
            'new_password.required' => 'A nova senha é obrigatória.',
            'new_password.confirmed' => 'A confirmação da nova senha não corresponde.',
            'new_password.min' => 'A nova senha deve ter pelo menos 8 caracteres.',
        ]);

        $user = Auth::user();

        // Verifica se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'A senha atual está incorreta.'
            ])->withInput();
        }

        // Verifica se a nova senha é diferente da atual
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors([
                'new_password' => 'A nova senha deve ser diferente da senha atual.'
            ])->withInput();
        }

        // Atualiza a senha
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('password.change.form')
            ->with('success', 'Senha alterada com sucesso!');
    }
}
