<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Modulo;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Mod;

class EstadoController extends Controller
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
    public function create(Modulo $modulo)
    {
        return view('estados.create', compact('modulo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Modulo $modulo)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3', 'max:255'],
            'nombre' => ['required', 'unique:estados,nombre', 'min:3', 'max:255']
        ]);

        $modulo->estados()->create($validated);

        return redirect()->route('modulos.show', $modulo)->with('success', 'El estado se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        return view('estados.show', compact('estado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $estado)
    {
        return view('estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estado $estado)
    {
        $validated = $request->validate([
            'codigo' => ['required', 'min:3', 'max:255'],
            'nombre' => ['required', 'unique:estados,nombre,' . $estado->id, 'min:3', 'max:255']
        ]);

        $estado->update($validated);

        return redirect()->route('modulos.estados.show', $estado)->with('success', 'El estado se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $estado)
    {
        //validar que no haya compras asociadas

        $estado->delete();

        return redirect()->route('modulos.estados.show' . $estado->modulo)->with('El estado se ha eliminado correctamente');
    }
}
