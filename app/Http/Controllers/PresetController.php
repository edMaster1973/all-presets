<?php

namespace App\Http\Controllers;

use App\Models\Preset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presets = Auth::user()->presets()->latest()->get();
        return view('presets.index', compact('presets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'pedal_brand' => 'required|string|max:255',
            'pedal_model' => 'required|string|max:255',
            'description' => 'nullable|string',
            'settings' => 'nullable|string',
        ]);

        Auth::user()->presets()->create($validated);

        return redirect()->route('presets.index')
            ->with('success', 'Preset criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Preset $preset)
    {
        $this->authorize('view', $preset);
        return view('presets.show', compact('preset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Preset $preset)
    {
        $this->authorize('update', $preset);
        return view('presets.edit', compact('preset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Preset $preset)
    {
        $this->authorize('update', $preset);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'pedal_brand' => 'required|string|max:255',
            'pedal_model' => 'required|string|max:255',
            'description' => 'nullable|string',
            'settings' => 'nullable|string',
        ]);

        $preset->update($validated);

        return redirect()->route('presets.index')
            ->with('success', 'Preset atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Preset $preset)
    {
        $this->authorize('delete', $preset);
        $preset->delete();

        return redirect()->route('presets.index')
            ->with('success', 'Preset excluído com sucesso!');
    }
}
