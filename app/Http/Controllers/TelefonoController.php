<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Telefono;
use Illuminate\Http\Request;

class TelefonoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa)
    {
        return view('telefonos.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3'],
            'numero' => ['required', 'min:9', 'numeric', 'unique:telefonos'],
        ]);

        $empresa->telefonos()->create($validated);

        return redirect()->route('ciudades.empresas.show', $empresa)->with('success', 'El teléfono se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Telefono $telefono)
    {
        return view('telefonos.show', compact('telefono'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telefono $telefono)
    {
        return view('telefonos.edit', compact('telefono'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Telefono $telefono)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3'],
            'numero' => ['required', 'min:9', 'numeric', 'unique:telefonos,numero,' . $telefono->id],
        ]);

        $telefono->update($validated);

        return redirect()->route('empresas.telefonos.show', $telefono)->with('success', 'El teléfono se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telefono $telefono)
    {
        $telefono->delete();

        return redirect()->route('ciudades.empresas.show', $telefono->empresa)->with('success', 'El teléfono se ha eliminado correctamente');
    }
}
