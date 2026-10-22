@extends('adminlte::page')

@section('title', 'Estados')

@section('content_header')
    <h1>
        Nuevo Estado
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('modulos.estados.store', $modulo) }}" method="post">
                    @csrf
                    @include('estados.form')
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
