<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\EmpresaTipo;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::with('ciudad.provincia.pais')->get();

        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ciudad $ciudad)
    {
        $empresaTipos = EmpresaTipo::orderBy('nombre')->get();

        return view('empresas.create', compact('ciudad', 'empresaTipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ciudad $ciudad)
    {
        $validated = $request->validate([
            'nit' => ['required', 'unique:empresas', 'min:3', 'max:255'],
            'nombre' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'sitio_web' => ['required', 'url', 'max:255'],
            'direccion' => ['required', 'min:3'],
            'codigo_postal' => ['required', 'min:3', 'max:255'],
            'logo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'empresa_tipo' => ['required', 'numeric']
        ]);

        $ciudad->empresas()->create($validated);

        return view('provincias.ciudades.show', [$ciudad->provincia, $ciudad]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $ciudades = Ciudad::with('provincia.pais')->orderBy('nombre')->get();
        return view('empresas.show', compact('empresa', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
