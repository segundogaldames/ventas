@extends('adminlte::page')

@section('title', 'Tipo Empresas')

@section('content_header')
    <h1>
        Editar Tipo Empresa
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('empresaTipos.update', $empresaTipo) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('empresaTipos.form')
                    <a href="{{ route('empresaTipos.index') }}" class="btn btn-primary">Volver</a>
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
