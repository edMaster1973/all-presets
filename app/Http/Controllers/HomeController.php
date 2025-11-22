<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use App\Http\Controllers\FileStyleController;
use App\Http\Controllers\UserController;
use App\MasterClass\Consultas;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $file;
    protected $fileStyle;
    protected $user;
    protected $equipament;
    protected $download;

    public function __construct(FileController $file, FileStyleController $fileStyle, UserController $user, Download $download)
    {
        $this->file = $file;
        $this->fileStyle = $fileStyle;
        $this->user = $user;
        $this->download = $download;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presets = Consultas::preset();

        return view('home', [
            'presets' => $presets,
        ]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
