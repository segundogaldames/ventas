<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresaTipoController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TelefonoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('provincias', [ProvinciaController::class, 'index'])->name('provincias.index')->middleware('auth');
Route::get('ciudades', [CiudadController::class, 'index'])->name('ciudades.index')->middleware('auth');
Route::get('empresas', [EmpresaController::class, 'index'])->name('empresas.index')->middleware('auth');
Route::get('categorias/{empresa}/empresas', [CategoriaController::class, 'categoriasEmpresa'])->name('categorias.categoriasEmpresa')->middleware('auth');
Route::get('productos/{empresa}/empresas', [ProductoController::class, 'productosEmpresa'])->name('productos.productosEmpresa')->middleware('auth');

Route::get('empresas/{empresa}/usuarios', [EmpresaController::class, 'asignarUsuario'])->name('empresas.usuarios.asignar')->middleware('auth');
Route::post('empresas/{empresa}/usuarios', [EmpresaController::class, 'registrarUsuario'])->name('empresas.usuarios.registrar')->middleware('auth');
Route::delete('empresas/{empresa}/usuarios/{user}', [EmpresaController::class, 'eliminarUsuario'])->name('empresas.usuarios.destroy')->middleware('auth');
Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore')->middleware('auth');
Route::put('productos/{producto}/restore', [ProductoController::class, 'restore'])->name('productos.restore')->middleware('auth');

Route::resource('paises', PaisController::class)->names('paises')->parameters(['paises' => 'pais'])->middleware('auth');
Route::resource('paises.provincias', ProvinciaController::class)->names('paises.provincias')->except(['index'])->shallow()->parameters(['paises' => 'pais', 'provincias' => 'provincia'])->middleware('auth');
Route::resource('provincias.ciudades', CiudadController::class)->names('provincias.ciudades')->except(['index'])->shallow()->parameters(['provincias' => 'provincia', 'ciudades' => 'ciudad'])->middleware('auth');
Route::resource('empresaTipos', EmpresaTipoController::class)->names('empresaTipos')->parameters(['empresaTipos' => 'empresaTipo'])->middleware('auth');
Route::resource('ciudades.empresas', EmpresaController::class)->names('ciudades.empresas')->except(['index'])->shallow()->parameters(['ciudades' => 'ciudad', 'empresas' => 'empresa'])->middleware('auth');
Route::resource('empresas.telefonos', TelefonoController::class)->names('empresas.telefonos')->except(['index'])->shallow()->parameters(['empresas' => 'empresa', 'telefonos' => 'telefono'])->middleware('auth');
Route::resource('empresas.impuestos', ImpuestoController::class)->names('empresas.impuestos')->except(['index'])->shallow()->parameters(['empresas' => 'empresa', 'impuestos' => 'impuesto'])->middleware('auth');
Route::resource('empresas.categorias', CategoriaController::class)->names('empresas.categorias')->except(['index'])->shallow()->parameters(['empresas' => 'empresa', 'categorias' => 'categoria'])->middleware('auth');
Route::resource('categorias.productos', ProductoController::class)->names('categorias.productos')->except(['index'])->shallow()->parameters(['categorias' => 'categoria', 'productos' => 'producto'])->middleware('auth');

Route::resource('roles', RoleController::class)->names('roles')->middleware('auth');
Route::resource('users', UserController::class)->names('users')->middleware('auth');
