<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if ($request->new_password != $request->password_confirmation) {
                return back()->withErrors('A nova senha e a confirmação não coincidem');
            }

            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Logic to update the password //
            return back()->withErrors('Senha atualizada com sucesso!');
        }

        return back()->withErrors('A senha atual está incorreta');
    }
}
