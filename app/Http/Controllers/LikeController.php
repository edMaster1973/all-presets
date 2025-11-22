<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
        if ($request->has('file_id')) {
            $like = new Like();
            $like->user_id = auth()->id();
            $like->file_id = $request->input('file_id');
            $like->save();
            return back()->withErrors('Você curtiu este arquivo!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        if ($like->user_id === auth()->id()) {
            $like->delete();
            return back()->withErrors('Você descurtiu este arquivo!');
        }
        return back()->withErrors('Você não pode descurtir este arquivo.');
    }
}
