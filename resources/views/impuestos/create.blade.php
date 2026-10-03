@extends('adminlte::page')

@section('title', 'Impuesto')

@section('content_header')
    <h1>
        Nuevo Impuesto
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('empresas.impuestos.store', $empresa) }}" method="post">
                    @csrf
                    @include('impuestos.form')
                    <x-back-button :route="route('ciudades.empresas.show', $empresa)"></x-back-button>
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
