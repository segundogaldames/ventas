@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Compras')

@section('content_header')
    <h1>
        Detalle Compra
    </h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        @include('partials.messages')
        {{-- detalle del pais --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $compra->id }} </td>
                    </tr>
                    <tr>
                        <th>Fecha de Compra:</th>
                        <td> {{ $compra->fecha->format('d/m/Y') }} </td>
                    </tr>
                    <tr>
                        <th>N° Factura o Boleta:</th>
                        <td>{{ $compra->num_factura }}</td>
                    </tr>
                    <tr>
                        <th>Total $:</th>
                        <td>$ {{ number_format($compra->total,0,',','.') }}</td>
                    </tr>
                    <tr>
                        <th>Empresa:</th>
                        <td>{{ $compra->empresa->nombre }} | RUT: {{ $compra->empresa->nit }}</td>
                    </tr>
                    <tr>
                        <th>Proveedor:</th>
                        <td>{{ $compra->proveedor->nombre }} | RUT: {{ $compra->proveedor->rut }}</td>
                    </tr>
                    <tr>
                        <th>Estado:</th>
                        <td>{{ $compra->estado->nombre }}</td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $compra->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $compra->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('compras.comprasEmpresa', $compra->empresa)" class="my-2"></x-back-button>
            <x-edit-button :route="route('empresas.compras.edit', $compra)" class="my-2"></x-edit-button>
            <form action="{{ route('empresas.compras.destroy', $compra) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta compra?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    </div>
    <div class="col-md-6">

        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Detalles de la compra realizada el {{ $compra->fecha->format('d/m/Y') }}
                    <a href="{{ route('compras.detalles.create', $compra) }}" class="btn btn-outline-secondary">Agregar Productos</a>
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha Registro</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compra->compraDetalles as $detalle)
                            <tr>
                            <td> {{ $detalle->id }} </td>
                            <td> {{ $detalle->created_at->format('d/m/Y H:i') }} </td>
                            <td> {{ $detalle->producto->nombre }} </td>
                            <td>$ {{ number_format($detalle->precio_unitario,0,',','.') }} </td>
                            <td> {{ $detalle->cantidad }} </td>
                            <td>$ {{ number_format($detalle->subtotal,0,',','.') }} </td>
                            <td>
                                @if ($compra->estado->nombre == 'En Proceso')
                                    <x-edit-button :route="route('compras.detalles.edit', $detalle)" class="btn-sm"></i></x-edit-button>

                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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
