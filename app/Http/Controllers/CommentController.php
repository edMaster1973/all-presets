<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LikeComment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            
            $request->validate([
                'file_id' => 'required|integer|exists:files,id',
                'content' => 'required|string|max:1000',
            ]);

            $comment = new Comment();
            $comment->user_id = auth()->id();
            $comment->file_id = $request->input('file_id');
            $comment->content = $request->input('content');
            $comment->save();

            // faz inserção na tabela likes_comments para o novo comentário //
            $likeComment = new LikeComment();
            $likeComment->comment_id = $comment->id;
            $likeComment->user_id = auth()->id();
            $likeComment->like = 0;
            $likeComment->dislike = 0;
            $likeComment->save();
            // fim da inserção //

            return back()->withErrors('Comentário adicionado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}