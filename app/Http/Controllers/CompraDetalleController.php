<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Http\Request;

class CompraDetalleController extends Controller
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
    public function create(Compra $compra)
    {
        $productos = $compra->proveedor->productos;

        return view('compraDetalles.create', compact('productos', 'compra'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'producto_id' => ['required', 'exists:productos,id'],
            'cantidad' => ['required', 'numeric', 'min:1'],
            'precio_unitario' => ['required', 'numeric', 'min:0']
        ]);

        $compra->compraDetalles()->create($validated);

        $compra->calcularTotal();

        return redirect()->route('empresas.compras.show', $compra->empresa)->with('success', 'El detalle de la compra se ha ingresado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(CompraDetalle $compraDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompraDetalle $compraDetalle)
    {
        return view('detalleCompras.edit', compact('compraDetalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompraDetalle $compraDetalle)
    {
        $validated = $request->validate([
            'cantidad' => ['required', 'numeric', 'min:1'],
            'precio_unitario' => ['required', 'numeric', 'min:0']
        ]);

        if ($compraDetalle->compra->estado->nombre != 'En Proceso') {
            return redirect()->route('empresas.compras.show', $compraDetalle->compra->empresa)->with('error', 'No se puede modificar este detalle de compra, ya que no está en proceso');
        }

        $compraDetalle->create($validated);

        $compraDetalle->compra->calcularTotal();

        return redirect()->route('empresas.compras.show', $compraDetalle->compra->empresa)->with('success', 'El detalle de la compra se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompraDetalle $compraDetalle)
    {
        //
    }
}
