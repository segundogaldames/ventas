<?php

use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresaTipoController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TelefonoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('provincias', [ProvinciaController::class, 'index'])->name('provincias.index');
Route::get('ciudades', [CiudadController::class, 'index'])->name('ciudades.index');
Route::get('empresas', [EmpresaController::class, 'index'])->name('empresas.index');

Route::resource('paises', PaisController::class)->names('paises')->parameters(['paises' => 'pais']);
Route::resource('paises.provincias', ProvinciaController::class)->names('paises.provincias')->except(['index'])->shallow()->parameters(['paises' => 'pais', 'provincias' => 'provincia']);
Route::resource('provincias.ciudades', CiudadController::class)->names('provincias.ciudades')->except(['index'])->shallow()->parameters(['provincias' => 'provincia', 'ciudades' => 'ciudad']);
Route::resource('empresaTipos', EmpresaTipoController::class)->names('empresaTipos')->parameters(['empresaTipos' => 'empresaTipo']);
Route::resource('ciudades.empresas', EmpresaController::class)->names('ciudades.empresas')->except(['index'])->shallow()->parameters(['ciudades' => 'ciudad', 'empresas' => 'empresa']);
Route::resource('empresas.telefonos', TelefonoController::class)->names('empresas.telefonos')->except(['index'])->shallow()->parameters(['empresas' => 'empresa', 'telefonos' => 'telefono']);
Route::resource('empresas.impuestos', ImpuestoController::class)->names('empresas.impuestos')->except(['index'])->shallow()->parameters(['empresas' => 'empresa', 'impuestos' => 'impuesto']);
