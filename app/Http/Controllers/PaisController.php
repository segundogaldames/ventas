<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paises = Pais::all();

        return view('paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:paises', 'min:3', 'max:255']
        ]);

        Pais::create($validated);

        return redirect()->route('paises.index')->with('success', 'El país se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pais $pais)
    {
        return view('paises.show', compact('pais'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pais $pais)
    {
        return view('paises.edit', compact('pais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pais $pais)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:paises,nombre,' . $pais->id, 'min:5', 'max:255']
        ]);

        $pais->update($validated);

        return redirect()->route('paises.show', $pais)->with('success', 'El país se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pais $pais)
    {
        if ($pais->provincias()->exists()) {
            return redirect()->route('paises.index')->with('error', 'No se puede eliminar este país. Tiene provincias asociadas');
        }

        $pais->delete();

        return redirect()->route('paises.index')->with('success', 'El país se ha eliminado correctamente');
    }
}
