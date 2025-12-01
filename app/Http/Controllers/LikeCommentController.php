<?php

namespace App\Http\Controllers;

use App\Models\LikeComment;
use Illuminate\Http\Request;

class LikeCommentController extends Controller
{
    public function toggleLike(Request $request)
    {
        $commentId = $request->comment_id;
        $userId = auth()->id();

        $like = LikeComment::where('comment_id', $commentId)
        ->where('user_id', $userId)
        ->first();

        if ($like) {
            // Se já deu LIKE, remove
            if ($like->like == 1) {
                $like->delete();
            } else {
                // Troca de DISLIKE para LIKE
                $like->update(['like' => 1, 'dislike' => 0]);
            }
        } else {
            LikeComment::create([
                'comment_id' => $commentId,
                'user_id' => $userId,
                'like' => 1,
                'dislike' => 0
            ]);
        }

        return $this->returnCounts($commentId, $userId);
    }

    public function toggleDislike(Request $request)
    {
        $commentId = $request->comment_id;
        $userId = auth()->id();

        $like = LikeComment::where('comment_id', $commentId)
        ->where('user_id', $userId)
        ->first();

        if ($like) {
            // Se já deu DISLIKE, remove
            if ($like->dislike == 1) {
                $like->delete();
            } else {
                // Troca de LIKE para DISLIKE
                $like->update(['like' => 0, 'dislike' => 1]);
            }
        } else {
            LikeComment::create([
                'comment_id' => $commentId,
                'user_id' => $userId,
                'like' => 0,
                'dislike' => 1
            ]);
        }

        return $this->returnCounts($commentId, $userId);
    }

    private function returnCounts($commentId, $userId)
    {
        $likes = LikeComment::where('comment_id', $commentId)->where('like', 1)->count();
        $dislikes = LikeComment::where('comment_id', $commentId)->where('dislike', 1)->count();

        $userReaction = LikeComment::where('comment_id', $commentId)
        ->where('user_id', $userId)
        ->first();

        return response()->json([
            'likes' => $likes,
            'dislikes' => $dislikes,
            'user_like' => $userReaction?->like == 1,
            'user_dislike' => $userReaction?->dislike == 1,
        ]);
    }
}
