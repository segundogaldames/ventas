@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Paises')

@section('content_header')
    <h1>
        Detalle País
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
        <a href="{{ route('paises.index') }}" class="btn btn-primary my-2">Volver</a>
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Provincias de {{ $pais->nombre }}
                    <a href="{{ route('paises.provincias.create', $pais) }}" class="btn btn-outline-secondary">Nueva
                        Provincia</a>
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th class="col-2">Id</th>
                            <td class="col-8">Provincia</td>
                            <td class="col-2"></td>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pais->provincias as $provincia)
                            <tr>
                                <td> {{ $provincia->id }} </td>
                                <td> {{ $provincia->nombre }} </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('paises.provincias.show', [$pais, $provincia]) }}"
                                        class="btn btn-success btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('paises.provincias.edit', [$pais, $provincia]) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('paises.provincias.destroy', [$pais, $provincia]) }}"
                                        method="post"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta provincia?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-info"> No hay provincias registradas </td>
                            </tr>
                        @endforelse
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
