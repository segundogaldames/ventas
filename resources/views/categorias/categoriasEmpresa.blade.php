@extends('adminlte::page')

@section('title', 'Categorias - Productos')

@section('content_header')
<h1>
    Categorías de Productos
    <a href="{{ route('empresas.categorias.create', $empresa) }}" class="btn btn-outline-secondary">Nueva Categoría</a>
    <a href="{{route('ciudades.empresas.show', $empresa)}}" class="btn btn-outline-primary">Volver a Empresa</a>
</h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        <div class="card">
            <div class="card-body">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th class="col-2">Id</th>
                            <td class="col-8">Categoría</td>
                            <td class="col-2"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td> {{ $categoria->id }} </td>
                                <td> {{ $categoria->nombre }} </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <x-show-button :route="route('empresas.categorias.show', $categoria)" class="btn-sm"></x-show-button>
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
