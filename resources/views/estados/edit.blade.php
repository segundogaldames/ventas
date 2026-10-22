@extends('adminlte::page')

@section('title', 'Estados')

@section('content_header')
    <h1>
        Editar Estado
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('modulos.estados.update', $estado) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('estados.form')
                    <x-back-button :route="route('modulos.estados.show', $estado)"></x-back-button>
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
