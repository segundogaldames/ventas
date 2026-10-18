@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Proveedores')

@section('content_header')
    <h1>
        Proveedores
    </h1>
    <p class="fs-5 text-info">Para crear o editar proveedores debe seleccionar una ciudad</p>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-1">Id</th>
                        <td class="col-2">RUT</td>
                        <td class="col-3">Nombre</td>
                        <td class="col-2">Email</td>
                        <td class="col-2">Ciudad</td>
                        <td class="col-2">Estado</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                        <tr>
                            <td> {{ $proveedor->id }} </td>
                            <td> {{ $proveedor->rut }} </td>
                            <td> {{ $proveedor->nombre }} </td>
                            <td> {{ $proveedor->email }} </td>
                            <td> {{ $proveedor->ciudad->nombre }} </td>
                            <td>
                                @if ($proveedor->trashed())
                                    <span class="badge bg-danger">Inactivo (Eliminado)</span>
                                @else
                                    <span class="badge bg-success">Activo</span>
                                @endif

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
