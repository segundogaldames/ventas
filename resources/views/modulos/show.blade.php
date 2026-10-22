@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Módulos')

@section('content_header')
    <h1>
        Detalle Módulo
    </h1>
@stop

@section('content')

    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        {{-- detalle del módulo --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $modulo->id }} </td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td> {{ $modulo->codigo }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $modulo->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $modulo->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $modulo->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('modulos.index')" class="my-2"></x-back-button>
            <x-edit-button :route="route('modulos.edit', $modulo)" class="my-2"></x-edit-button>
            <form action="{{ route('modulos.destroy', $modulo) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este módulo?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
        {{-- lista de provincias --}}
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Estados del módulo {{ $modulo->nombre }}
                    <a href="{{ route('modulos.estados.create', $modulo) }}" class="btn btn-outline-secondary">Nuevo
                        Estado</a>
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modulo->estados as $estado)
                            <tr>
                                <td>{{ $estado->codigo }}</td>
                                <td>{{ $estado->nombre }}</td>
                                <td><x-show-button :route="route('modulos.estados.show', $estado)" class="btn-sm"></x-show-button></td>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
                }
            });
        });
    </script>
@stop
