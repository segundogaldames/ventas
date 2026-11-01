<?php

namespace App\Http\Controllers;

use App\Models\DocumentoTipo;
use Illuminate\Http\Request;

class DocumentoTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipos = DocumentoTipo::all();

        return view('documentoTipos.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documentoTipos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:documento_tipos,nombre', 'min:3', 'max:255']
        ]);

        DocumentoTipo::create($validated);

        return redirect()->route('documentoTipos.index')->with('success', 'El tipo de documento se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentoTipo $documentoTipo)
    {
        return view('documentoTipos.show', compact('documentoTipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentoTipo $documentoTipo)
    {
        return view('documentoTipos.edit', compact('documentoTipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentoTipo $documentoTipo)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'unique:documento_tipos,nombre,' . $documentoTipo->id, 'min:3', 'max:255']
        ]);

        $documentoTipo->update($validated);

        return redirect()->route('documentoTipos.show', $documentoTipo)->with('success', 'El tipo de documento se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentoTipo $documentoTipo)
    {
        if ($documentoTipo->compras()->exists()) {
            return redirect()->route('documentoTipos.show', $documentoTipo)->with('error', 'El tipo de documento no se puede eliminar. Tiene compras asociadas');
        }

        $documentoTipo->delete();

        return redirect()->route('documentoTipos.index')->with('success', 'El tipo de documento se ha eliminado correctamente');
    }
}
