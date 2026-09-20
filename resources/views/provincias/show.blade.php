@extends('adminlte::page')


@section('title', 'Provincias')

@section('content_header')
    <h1>
        Detalle Provincia
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
                        <td> {{ $pais->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $pais->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $pais->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $pais->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <a href="{{ route('paises.show', $pais) }}" class="btn btn-primary my-2">Volver</a>
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Ciudades de {{ $provincia->nombre }}
                    <a href="#" class="btn btn-outline-secondary">Nueva Ciudad</a>
                </h1>
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
