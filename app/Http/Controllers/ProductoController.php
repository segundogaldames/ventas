<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Categoria $categoria)
    {
        $task = 'create';
        return view('productos.create', compact('categoria', 'task'));
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
            'stock_maximo' => ['required', 'numeric', 'min:0', 'gte:stock_minimo'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0', 'gte:precio_compra'],
        ]);

        if ($request->hasFile('imagen')) {
            // Esto lo guarda en storage/app/public/logos y devuelve la ruta relativa (ej: logos/xyz.png)
            $validated['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

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
        $task = 'edit';
        return view('productos.edit', compact('producto', 'task'));
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
            'stock_maximo' => ['required', 'numeric', 'min:0', 'gte:stock_minimo'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0', 'gte:precio_compra'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && \Illuminate\Support\Facades\Storage::disk('public')->exists($producto->imagen)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($producto->imagen);
            }
            // Esto lo guarda en storage/app/public/logos y devuelve la ruta relativa (ej: logos/xyz.png)
            $validated['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($validated);

        return redirect()->route('categorias.productos.show', $producto)->with('success', 'El producto se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('empresas.categorias.show', $producto->categoria)
            ->with('success', 'El producto se ha enviado a la papelera correctamente.');
    }

    public function restore($id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);
        $producto->restore();

        return redirect()->route('empresas.categorias.show', $producto->categoria)->with('success', 'Producto reactivado exitosamente.');
    }

    public function productosEmpresa(Empresa $empresa)
    {
        $productos = $empresa->productos;

        return view('productos.productosEmpresa', compact('productos', 'empresa'));
    }
}
