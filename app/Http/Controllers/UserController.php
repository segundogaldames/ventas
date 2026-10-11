<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->withTrashed()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $task = 'create';

        return view('users.create', compact('roles','task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','min:3','max:255'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
            'role' => ['required','exists:roles,name']
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('users.index')->with('success','El usuario se ha registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $task = 'edit';

        return view('users.edit', compact('user','roles','task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required','min:3','max:255'],
            'email' => ['required','email','unique:users,email,' . $user->id],
            'role' => ['required','exists:roles,name']
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()->route('users.show', $user)->with('success','El usuario se ha modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // Esto llenará 'deleted_at' con la fecha actual en lugar de borrar la fila.
        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente.');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'Usuario reactivado exitosamente.');
    }
}
