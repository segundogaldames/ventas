<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompraController extends Controller
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
    public function create(Empresa $empresa)
    {
        $proveedores = $empresa->proveedores;

        return view('compras.create', compact('proveedores', 'empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'num_factura' => ['required', 'min:3'],
            'proveedor_id' => ['required', Rule::exists('empresa_proveedor', 'proveedor_id')->where(function ($query) use ($empresa) {
                return $query->where('empresa_id', $empresa->id);
            }),]
        ]);

        $empresa->compras()->create($validated);

        return redirect()->route('ciudades.empresas', $empresa)->with('success', 'La compra se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        return view('compras.edit', compact('compra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
