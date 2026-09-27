<?php

use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EmpresaTipoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ProvinciaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('paises', PaisController::class)->names('paises')->parameters(['paises' => 'pais']);
Route::resource('paises.provincias', ProvinciaController::class)->names('paises.provincias')->except(['index'])->parameters(['paises' => 'pais', 'provincias' => 'provincia']);
Route::resource('provincias.ciudades', CiudadController::class)->names('provincias.ciudades')->except(['index'])->parameters(['provincias' => 'provincia', 'ciudades' => 'ciudad']);
Route::resource('empresaTipos', EmpresaTipoController::class)->names('empresaTipos')->parameters(['empresaTipos' => 'empresaTipo']);
Route::resource('ciudades.empresas', EmpresaController::class)->names('ciudades.empresas')->except(['index'])->shallow()->parameters(['ciudades' => 'ciudad', 'empresas' => 'empresa']);
