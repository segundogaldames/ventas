@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>
        Nueva Empresa
    </h1>
@stop

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ciudades.empresas.store', $ciudad) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('empresas.form')
                    <x-back-button :route="route('provincias.ciudades.show', $ciudad)"></x-back-button>
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
