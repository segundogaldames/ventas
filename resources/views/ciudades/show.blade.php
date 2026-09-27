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
        <div class="d-flex gap-2">
            <x-back-button :route="route('ciudades.index')" class="my-2"></x-back-button>
            <x-edit-button :route="route('provincias.ciudades.edit', $ciudad)" class="my-2"></x-edit-button>
            <form action="{{ route('provincias.ciudades.destroy', $ciudad) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta ciudad?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
        {{-- lista de empresas --}}
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Empresas de {{ $ciudad->nombre }}
                    <a href="{{ route('ciudades.empresas.create', $ciudad) }}" class="btn btn-outline-secondary">Nueva
                        Empresa</a>
                </h1>
            </div>
            <div class="card-body"></div>
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
