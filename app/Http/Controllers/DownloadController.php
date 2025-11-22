<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    protected $download;
    protected $file;
    protected $user;

    public function __construct(Download $download, File $file, User $user)
    {
        $this->download = $download;
        $this->file = $file;
        $this->user = $user;
    }

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Download $download)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Download $download)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        //
    }
}
