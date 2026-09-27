@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <h1>
        Editar Empresa
    </h1>
@stop

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ciudades.empresas.update', $empresa) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('empresas.form')
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
