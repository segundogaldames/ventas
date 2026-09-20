<?php

use App\Http\Controllers\PaisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('paises', PaisController::class)->names('paises')->parameters(['paises' => 'pais']);
