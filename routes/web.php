<?php

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
