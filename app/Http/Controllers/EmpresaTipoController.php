<?php

namespace App\Http\Controllers;

use App\Models\EmpresaTipo;
use Illuminate\Http\Request;

class EmpresaTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = EmpresaTipo::all();
        return view('empresaTipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresaTipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:empresa_tipos', 'min:3', 'max:255']
        ]);

        EmpresaTipo::create($validated);

        return redirect()->route('empresaTipos.index')->with('success', 'El tipo de empresa se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmpresaTipo $empresaTipo)
    {
        return view('empresaTipos.show', compact('empresaTipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmpresaTipo $empresaTipo)
    {
        return view('empresaTipos.edit', compact('empresaTipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmpresaTipo $empresaTipo)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:empresa_tipos,nombre,' . $empresaTipo->id, 'min:3', 'max:255']
        ]);

        $empresaTipo->update($validated);

        return redirect()->route('empresaTipos.show', $empresaTipo)->with('success', 'El tipo de empresa se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmpresaTipo $empresaTipo)
    {
        if ($empresaTipo->empresas()->exists()) {
            return redirect()->route('empresaTipos.index')->with('error', 'No se puede eliminar este tipo de empresa. Tiene empresas asociadas');
        }

        $empresaTipo->delete();

        return redirect()->route('empresaTipos.index')->with('success', 'El tipo de empresa se ha eliminado correctamente');
    }
}
