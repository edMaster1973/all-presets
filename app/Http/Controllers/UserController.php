<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('registrar_se');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors('As senhas não coincidem, tente novamente.');
        }

        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors('E-mail já cadastrado, tente outro e-mail.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user) {
            return back()->withErrors('Cadastro realizado com sucesso!');
        } else {
            return back()->withErrors('Erro ao cadastrar, tente novamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function foto(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            if (!empty(Auth::user()->foto_perfil)) {
                // Delete old profile picture //
                unlink(Auth::user()->foto_perfil);
            }

            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
            $requestImage->move(public_path('profiles'), $imageName);

            $user = User::findOrFail(Auth::user()->id);
            $user->foto_perfil = 'profiles/' . $imageName;
            $update = $user->save();

            if ($update) {
                return back()->withErrors('Foto de perfil alterada com sucesso!');
            } else {
                return back()->withErros('Erro ao alterar a foto de perfil, tente novamente.');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
