<?php

namespace App\Http\Controllers;

use App\Models\Equipament;
use Illuminate\Http\Request;

class EquipamentController extends Controller
{
    public function getEquipamentosPorMarca($marca_id)
    {
        // 1. Busca os equipamentos no DB onde marca_id corresponde ao valor passado
        $equipaments = Equipament::where('marca_id', $marca_id)->get();

        // 2. Retorna a lista de equipamentos em formato JSON
        return response()->json($equipaments);
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
    public function show(Equipament $equipament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipament $equipament)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipament $equipament)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipament $equipament)
    {
        //
    }
}
