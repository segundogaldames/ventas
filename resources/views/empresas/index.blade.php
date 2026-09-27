@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Empresas')

@section('content_header')
    <h1>
        Empresas
    </h1>
    <p class="fs-5 text-info">Para crear empresas debe seleccionar una ciudad</p>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-1">Id</th>
                        <td class="col-2">Logo</td>
                        <td class="col-2">RUT/NIT</td>
                        <td class="col-2">Nombre</td>
                        <td class="col-2">Sitio Web</td>
                        <td class="col-2">Email</td>
                        <td class="col-1"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td> {{ $empresa->id }} </td>
                            <td>
                                @if ($empresa->logo)
                                    <!-- Muestra la imagen si existe -->
                                    <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo" width="30"
                                        height="30" class="rounded-circle object-fit-cover w-10">
                                @else
                                    <!-- Imagen por defecto si no tiene logo -->
                                    <span class="badge bg-secondary">Sin logo</span>
                                @endif
                            </td>
                            <td> {{ $empresa->nit }} </td>
                            <td> {{ $empresa->nombre }} </td>
                            <td> <a href="{{ $empresa->sitio_web }}" target="_blank">{{ $empresa->sitio_web }} </a> </td>
                            <td> {{ $empresa->email }} </td>
                            <td class="d-flex justify-content-center gap-2">
                                <x-show-button :route="route('ciudades.empresas.show', $empresa)" class="btn-sm"></i></x-show-button>

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
