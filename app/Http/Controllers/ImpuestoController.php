<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa)
    {
        return view('impuestos.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'min:3', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0']
        ]);

        $empresa->impuestos()->create($validated);

        return redirect()->route('ciudades.empresas.show', $empresa)->with('success', 'El impuesto se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Impuesto $impuesto)
    {
        return view('impuestos.show', compact('impuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Impuesto $impuesto)
    {
        return view('impuestos.edit', compact('impuesto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'min:3', 'max:255'],
            'valor' => ['required', 'numeric', 'min:0']
        ]);

        $impuesto->update($validated);

        return redirect()->route('empresas.impuestos.show', $impuesto)->with('success', 'El impuesto se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->delete();

        return redirect()->route('ciudades.empresas.show', $impuesto->empresa)->with('success', 'El impuesto se ha eliminado correctamente');
    }
}
