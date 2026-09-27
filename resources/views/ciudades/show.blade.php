@extends('adminlte::page')


@section('title', 'Ciudades')

@section('content_header')
    <h1>
        Detalle Ciudad
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $ciudad->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $ciudad->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Provincia:</th>
                        <td> {{ $ciudad->provincia->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Pais:</th>
                        <td> {{ $ciudad->provincia->pais->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $ciudad->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $ciudad->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="{{ route('paises.provincias.show', [$provincia->pais, $provincia]) }}"
            class="btn btn-primary my-2">Volver</a>
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
