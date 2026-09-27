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
                        <td> {{ $provincia->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $provincia->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Pais:</th>
                        <td> {{ $provincia->pais->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $provincia->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $provincia->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <x-back-button class="my-2"></x-back-button>
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Ciudades de {{ $provincia->nombre }}
                    <a href="{{ route('provincias.ciudades.create', [$provincia]) }}" class="btn btn-outline-secondary">Nueva
                        Ciudad</a>
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th class="col-2">Id</th>
                            <td class="col-8">Ciudad</td>
                            <td class="col-2"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($provincia->ciudades as $ciudad)
                            <tr>
                                <td> {{ $ciudad->id }} </td>
                                <td> {{ $ciudad->nombre }} </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <x-show-button :route="route('provincias.ciudades.show', [$ciudad])"></x-show-button>
                                    <x-edit-button :route="route('provincias.ciudades.edit', [$ciudad])"></x-edit-button>
                                    <form action="{{ route('provincias.ciudades.destroy', [$ciudad]) }}" method="post"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta ciudad?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
