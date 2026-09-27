@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Provincias')

@section('content_header')
    <h1>
        Provincias
    </h1>
    <p class="fs-5 text-info">Para agregar una provincia debe seleccionar un país</p>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-2">Id</th>
                        <th class="col-4">Provincia</th>
                        <td class="col-4">País</td>
                        <td class="col-2"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($provincias as $provincia)
                        <tr>
                            <td> {{ $provincia->id }} </td>
                            <td> {{ $provincia->nombre }} </td>
                            <td> <a href="{{ route('paises.show', $provincia->pais) }}">{{ $provincia->pais->nombre }}</a>
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                <x-show-button :route="route('paises.provincias.show', $provincia)" class="btn-sm"></x-show-button>
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
