@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Ciudades')

@section('content_header')
    <h1>
        Ciudades
    </h1>
    <p class="fs-5 text-info">Para registrar ciudades debe hacerlo seleccionando una provincia</p>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-2">Id</th>
                        <td class="col-3">Ciudad</td>
                        <td class="col-3">Provincia</td>
                        <td class="col-2">País</td>
                        <td class="col-2"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ciudades as $ciudad)
                        <tr>
                            <td> {{ $ciudad->id }} </td>
                            <td> {{ $ciudad->nombre }} </td>
                            <td> <a
                                    href="{{ route('paises.provincias.show', $ciudad->provincia) }}">{{ $ciudad->provincia->nombre }}</a>
                            </td>
                            <td> <a
                                    href="{{ route('paises.show', $ciudad->provincia->pais) }}">{{ $ciudad->provincia->pais->nombre }}</a>
                            </td>
                            <td>
                                <x-show-button :route="route('provincias.ciudades.show', $ciudad)" class="btn-sm"></x-show-button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
