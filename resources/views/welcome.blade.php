@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@section('content')
    <div class="container my-5">
        <div class="p-5 text-center bg-body-tertiary rounded-3">
            <h1 class="text-body-emphasis">Bienvenido a mi Sistema de Ventas</h1>
            <p class="col-lg-8 mx-auto fs-5 text-muted">
                Proyecto desarrollado con Laravel y Bootstrap.
            </p>
            <div class="d-inline-flex gap-2 mb-5">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary btn-lg px-4 rounded-pill">Ir al Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 rounded-pill">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn btn-outline-secondary btn-lg px-4 rounded-pill">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
@endsection
