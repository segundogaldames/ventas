<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Provincia;
use Illuminate\Http\Request;

class CiudadController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Provincia $provincia)
    {
        return view('ciudades.create', compact('provincia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Provincia $provincia)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:ciudades', 'min:3', 'max:255']
        ]);

        $provincia->ciudades()->create($validated);

        return redirect()->route('paises.provincias.show', [$provincia->pais, $provincia])->with('success', 'La ciudad se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia, Ciudad $ciudad)
    {
        return view('ciudades.show', compact('provincia', 'ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia, Ciudad $ciudad)
    {
        return view('ciudades.edit', compact('provincia', 'ciudad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provincia $provincia, Ciudad $ciudad)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:ciudades,nombre,' . $ciudad->id, 'min:3', 'max:255']
        ]);

        $ciudad->update($validated);

        return redirect()->route('provincias.ciudades.show', [$provincia, $ciudad])->with('success', 'La ciudad se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provincia $provincia, Ciudad $ciudad)
    {
        if ($ciudad->empresas()->exists()) {
            return redirect()->route('paises.provincias.show', [$provincia->pais, $provincia])->with('error', 'Esta ciudad no se puede eliminar. Tiene empresas asociadas');
        }

        $ciudad->delete();

        return redirect()->route('paises.provincias.show', [$provincia->pais, $provincia])->with('success', 'La ciudad se ha eliminado correctamente');
    }
}
