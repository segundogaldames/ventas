<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:roles', 'min:3', 'max:255']
        ]);

        Role::create($validated);

        return redirect()->route('roles.index')->with('success', 'El rol se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:roles,name,' . $role->id, 'min:3', 'max:255']
        ]);

        $role->update($validated);

        return redirect()->route('roles.show', $role)->with('success', 'El rol se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
