<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Empresa;
use App\Models\Estado;
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
        $action = 'create';

        return view('compras.create', compact('proveedores', 'empresa', 'action'));
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

        $validated['total'] = 0;
        $estado = Estado::where('nombre', 'En Proceso')->firstOrFail();
        $validated['estado_id'] = $estado->id;

        $empresa->compras()->create($validated);

        return redirect()->route('compras.comprasEmpresa', $empresa)->with('success', 'La compra se ha registrado correctamente');
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
        $proveedores = $compra->empresa->proveedores;

        //validamos que haya detalle de compra antes de mostrar los estados
        $estados = Estado::whereHas('modulo', function ($query) {
            $query->where('nombre', 'Compras'); // O 'slug' => 'compras'
        })->get();
        $action = 'edit';

        return view('compras.edit', compact('compra', 'proveedores', 'estados', 'action'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date_format:Y-m-d', 'before_or_equal:today'],
            'num_factura' => ['required', 'min:3'],
            'proveedor_id' => ['required', Rule::exists('empresa_proveedor', 'proveedor_id')->where(function ($query) use ($compra) {
                return $query->where('empresa_id', $compra->empresa->id);
            }),],
            'estado_id' => ['required', 'exists:estados,id']
        ]);

        $compra->update($validated);

        return redirect()->route('empresas.compras.show', $compra)->with('success', 'La compra se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //validar que no haya detalles de compras asociados
        if ($compra->estado->nombre != 'En Proceso') {
            return redirect()->route('empresas.compras.show', $compra)->with('error', 'Esta compra no se puede eliminar, ya que ha sido confirmada');
        }

        $compra->compraDetalles()->delete();
        $compra->delete();

        return redirect()->route('compras.comprasEmpresa', $compra->empresa)->with('success', 'La compra se ha eliminado correctamente');
    }

    public function comprasEmpresa(Empresa $empresa)
    {
        $compras = $empresa->compras;

        return view('compras.comprasEmpresa', compact('empresa', 'compras'));
    }
}
