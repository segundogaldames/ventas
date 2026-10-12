<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Categoria $categoria)
    {
        return view('productos.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'descripcion' => ['required', 'string', 'min:3'],
            'codigo' => ['required', 'unique:productos,codigo', 'min:3'],
            'imagen' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'stock_disponible' => ['required', 'numeric', 'min:0'],
            'stock_minimo' => ['required', 'numeric', 'min:0'],
            'stock_maximo' => ['required', 'numeric', 'min:0'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
        ]);

        $categoria->productos()->create($validated);

        return redirect()->route('empresas.categorias.show', $categoria)->with('success', 'El producto se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:255'],
            'descripcion' => ['required', 'string', 'min:3'],
            'codigo' => ['required', 'unique:productos,codigo,' . $producto->id, 'min:3'],
            'imagen' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'stock_disponible' => ['required', 'numeric', 'min:0'],
            'stock_minimo' => ['required', 'numeric', 'min:0'],
            'stock_maximo' => ['required', 'numeric', 'min:0'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
        ]);

        $producto->update($validated);

        return redirect()->route('categorias.productos.show', $producto)->with('success', 'El producto se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //validar si el producto aparece en alguna compra
    }
}
