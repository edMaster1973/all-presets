<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
     * Adicionar ou remover o usuário autenticaddo da lista de seguidores do Perfil.
     */
    public function toggleFollow(User $user)
    {
        // Garantir que o usu[ario não está tentando seguiir a si mesmo.
        if (auth()->id() === $user->id) {
            return response()->json([
                'message' => 'Você não pode seguir a si mesmo.',
            ], 400);
        }

        // 1. Executa o toggle (retorna um array [detached, attached])
        auth()->user()->followings()->toggle($user->id);

        // 2. VERIFICA O NOVO ESTADO FINAL
        // Se o registro AGORA existir no banco (após o toggle), então está seguindo.
        $isFollowing = auth()->user()->followings()->where('user_id', $user->id)->exists();

        return response()->json([
            'message' => $isFollowing ? 'Seguindo.' : 'Parou de seguir.',
            'status' => $isFollowing ? 'following' : 'not_following',
            'followers_count' => $user->followers()->count() // <-- ESSA É A CHAVE
        ]);
    }
}
