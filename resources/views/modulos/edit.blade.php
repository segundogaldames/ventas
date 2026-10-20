@extends('adminlte::page')

@section('title', 'Módulos')

@section('content_header')
    <h1>
        Editar Módulo
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('modulos.update', $modulo) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('modulos.form')
                    <x-back-button :route="route('modulos.show', $modulo)"></x-back-button>
                </form>
            </div>
        </div>

    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
