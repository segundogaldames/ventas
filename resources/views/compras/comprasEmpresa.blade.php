@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Empresa - Compras')

@section('content_header')
    <h1>
        Empresa - Compras
        <a href="{{ route('empresas.compras.create', $empresa) }}" class="btn btn-outline-secondary">Nueva
            Compra</a>
        <a href="{{ route('ciudades.empresas.show', $empresa) }}" class="btn btn-outline-primary">Volver</a>
    </h1>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-1">Id</th>
                        <td class="col-2">Fecha</td>
                        <td class="col-2">N° de Factura o boleta</td>
                        <td class="col-2">Total</td>
                        <td class="col-2">Estado</td>
                        <td class="col-2">Proveedor</td>
                        <td class="col-1"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <td> {{ $compra->id }} </td>
                            <td> {{ $compra->fecha }} </td>
                            <td> {{ $compra->num_factura }} </td>
                            <td>$ {{ number_format($compra->total,0,',','.') }} </td>
                            <td>{{ $compra->estado->nombre }}</td>
                            <td>{{ $compra->proveedor->nombre }}</td>
                            <td><x-show-button :route="route('empresas.compras.show', $compra)" class="btn-sm"></i></x-show-button></td>
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
