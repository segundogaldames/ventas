<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Provincia;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
{
    public function index()
    {
        $provincias = Provincia::orderBy('nombre')->get();

        return view('provincias.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pais $pais)
    {
        return view('provincias.create', compact('pais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Pais $pais)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:provincias', 'min:3', 'max:255']
        ]);

        $pais->provincias()->create($validated);

        return redirect()->route('paises.show', $pais)->with('success', 'La provincia se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia)
    {
        return view('provincias.show', compact('provincia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        return view('provincias.edit', compact('provincia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia)
    {
        $validated = $validated = $request->validate([
            'nombre' => ['required', 'unique:provincias,nombre,' . $provincia->id, 'min:3', 'max:255']
        ]);

        $provincia->update($validated);

        return redirect()->route('paises.provincias.show', [$provincia])->with('success', 'La provincia se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia)
    {
        if ($provincia->ciudades()->exists()) {
            return redirect()->route('paises.provincias.show', $provincia)->with('error', 'Esta provincia no se puede eliminar. Tiene ciudades asociadas');
        }

        $provincia->delete();

        return redirect()->route('provincias.index')->with('success', 'La provincia se ha eliminado correctamente');
    }
}
