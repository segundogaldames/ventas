<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Empresa $empresa)
    {
        return view('categorias.create', compact('empresa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'unique:categorias,nombre', 'min:3', 'max:255'],
            'descripcion' => ['required', 'string', 'min:3']
        ]);

        $empresa->categorias()->create($validated);

        return redirect()->route('categorias.categoriasEmpresa', $empresa)->with('success', 'La categoría se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'unique:categorias,nombre,' . $categoria->id, 'min:3', 'max:255'],
            'descripcion' => ['required', 'string', 'min:3']
        ]);

        $categoria->update($validated);

        return redirect()->route('empresas.categorias.show', $categoria)->with('success', 'La categoría se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        if ($categoria->productos()->exists()) {
            return redirect()->route('empresas.categorias.show', $categoria)->with('error', 'Esta categoría no se puede eliminar. Tiene productos asociados');
        }

        $categoria->delete();

        return redirect()->route('categorias.categoriasEmpresa', $categoria->empresa)->with('success', 'La categoría se ha eliminado correctamente');
    }

    public function categoriasEmpresa(Empresa $empresa)
    {
        $categorias = $empresa->categorias;

        return view('categorias.categoriasEmpresa', compact('categorias', 'empresa'));
    }
}
