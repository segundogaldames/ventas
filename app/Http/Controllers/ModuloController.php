<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulos = Modulo::all();

        return view('modulos.index', compact('modulos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modulos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3', 'max:255', 'unique:modulos,codigo'],
            'nombre' => ['required', 'min:3', 'max:255']
        ]);

        Modulo::create($validated);

        return redirect()->route('modulos.index')->with('success', 'El módulo se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modulo $modulo)
    {
        return view('modulos.show', compact('modulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modulo $modulo)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3', 'max:255', 'unique:modulos,codigo,' . $modulo->id],
            'nombre' => ['required', 'min:3', 'max:255']
        ]);

        $modulo->update($validated);

        return redirect()->route('modulos.show', $modulo)->with('success', 'El módulo se modificado registrado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modulo $modulo)
    {
        //verificar si el modulo tiene estados asociados
        if ($modulo->estados()->exists()) {
            return redirect()->route('modulos.show', $modulo)->with('error', 'Este módulo no se puede eliminar. Tiene estados asociados');
        }

        $modulo->delete();

        return redirect()->route('modulos.index')->with('success', 'El módulo se eliminado correctamente');
    }
}
