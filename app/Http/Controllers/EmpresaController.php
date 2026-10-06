<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\EmpresaTipo;
use App\Models\User;
use App\Rules\ValidateRut;
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
        $task = 'create';
        $empresaTipos = EmpresaTipo::orderBy('nombre')->get();

        return view('empresas.create', compact('ciudad', 'empresaTipos', 'task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ciudad $ciudad)
    {
        $validated = $request->validate([
            'nit' => ['required', 'unique:empresas,nit', new ValidateRut],
            'nombre' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'sitio_web' => ['required', 'url'],
            'direccion' => ['required', 'min:3'],
            'codigo_postal' => ['required', 'min:3', 'max:255'],
            'logo' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'empresa_tipo_id' => ['required', 'numeric']
        ]);

        if ($request->hasFile('logo')) {
            // Esto lo guarda en storage/app/public/logos y devuelve la ruta relativa (ej: logos/xyz.png)
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $ciudad->empresas()->create($validated);

        return redirect()->route('empresas.index')->with('success', 'La empresa se ha registrado correctamente');
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
        $task = 'edit';
        $ciudades = Ciudad::with('provincia.pais')->orderBy('nombre')->get();
        $empresaTipos = EmpresaTipo::orderBy('nombre')->get();
        return view('empresas.edit', compact('empresa', 'ciudades', 'empresaTipos', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email'],
            'sitio_web' => ['required', 'url'],
            'direccion' => ['required', 'min:3'],
            'codigo_postal' => ['required', 'min:3', 'max:255'],
            'logo' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'empresa_tipo_id' => ['required', 'numeric']
        ]);

        if ($request->hasFile('logo')) {
            if ($empresa->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($empresa->logo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($empresa->logo);
            }
            // Esto lo guarda en storage/app/public/logos y devuelve la ruta relativa (ej: logos/xyz.png)
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $empresa->update($validated);

        return redirect()->route('ciudades.empresas.show', $empresa)->with('success', 'La empresa se ha modificado correctamente');
    }

    public function asignarUsuario(Empresa $empresa)
    {
        $usuarios = User::all();

        return view('empresas.asignar', compact('usuarios', 'empresa'));
    }

    public function registrarUsuario(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id']
        ]);

        $empresa->usuarios()->syncWithoutDetaching($validated['user_id']);

        return redirect()->route('ciudades.empresas.show', $empresa)->with('success', 'El usuario se ha asociado a la empresa correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        if ($empresa->logo && \Illuminate\Support\Facades\Storage::disk('public')->exists($empresa->logo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($empresa->logo);
        }

        $empresa->telefonos()->delete();

        $empresa->usuarios()->detach();

        $empresa->delete();

        return redirect()->route('empresas.index', $empresa)->with('success', 'La empresa y sus registros asociados se han eliminado con éxito.');
    }

    public function eliminarUsuario(Empresa $empresa, User $user)
    {
        $empresa->usuarios()->detach($user->id);

        return redirect()->route('ciudades.empresas.show', $empresa)->with('success', 'El usuario se ha eliminado de la empresa correctamente');
    }
}
