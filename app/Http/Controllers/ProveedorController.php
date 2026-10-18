<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Rules\ValidateRut;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::with('ciudad')->withTrashed()->get();

        return view('proveedores.index', compact('proveedores'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Ciudad $ciudad)
    {
        return view('proveedores.create', compact('ciudad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ciudad $ciudad)
    {
        $validated = $request->validate([
            'rut' => ['required', 'unique:proveedores,rut', new ValidateRut],
            'nombre' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'direccion' => ['required', 'string', 'min:3']
        ]);

        $ciudad->proveedores()->create($validated);

        return redirect()->route('proveedores.proveedoresCiudad', $ciudad)->with('success', 'El proveedor se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'direccion' => ['required', 'string', 'min:3']
        ]);

        $proveedor->update($validated);

        return redirect()->route('ciudades.proveedores.show', $proveedor)->with('success', 'El proveedor se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()->route('proveedores.proveedoresCiudad', $proveedor->ciudad)->with('success', 'El proveedor se ha enviado a la papelera correctamente');
    }

    public function proveedoresCiudad(Ciudad $ciudad)
    {
        $proveedores = $ciudad->proveedores()->withTrashed()->get();

        return view('proveedores.proveedoresCiudad', compact('proveedores', 'ciudad'));
    }

    public function proveedoresEmpresa(Empresa $empresa)
    {
        $proveedores = $empresa->proveedores()->withTrashed()->get();

        return view('proveedores.proveedoresEmpresa', compact('proveedores', 'empresa'));
    }

    public function restore($id)
    {
        $proveedor = Proveedor::withTrashed()->findOrFail($id);
        $proveedor->restore();

        return redirect()->route('proveedores.proveedoresCiudad', $proveedor->ciudad)->with('success', 'Proveedor reactivado exitosamente.');
    }
}
