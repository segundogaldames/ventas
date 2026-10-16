@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Categorias')

@section('content_header')
    <h1>
        Detalle Categoría
    </h1>
@stop

@section('content')

    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        {{-- detalle del pais --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $categoria->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $categoria->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Descripción:</th>
                        <td> {{ $categoria->descripcion }} </td>
                    </tr>
                    <tr>
                        <th>Empresa:</th>
                        <td> {{ $categoria->empresa->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $categoria->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $categoria->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('categorias.categoriasEmpresa', $categoria->empresa)" class="my-2"></x-back-button>
            <x-edit-button :route="route('empresas.categorias.edit', $categoria)" class="my-2"></x-edit-button>
            <form action="{{ route('empresas.categorias.destroy', $categoria) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
        {{-- lista de productos --}}
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Productos de {{ $categoria->nombre }}
                    <a href="{{ route('categorias.productos.create', $categoria) }}" class="btn btn-outline-secondary">Nuevo
                        Producto</a>
                </h1>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-2">Imagen</th>
                            <th class="col-3">Producto</th>
                            <th class="col-3">Código</th>
                            <th class="col-3">Stock Disponible</th>
                            <th class="col-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categoria->productos()->withTrashed()->get() as $producto)
                            <tr>
                                <td>
                                    @if ($producto->imagen)
                                    <!-- Muestra la imagen si existe -->
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" width="30"
                                            height="30" class="rounded-circle object-fit-cover w-10">
                                    @else
                                        <!-- Imagen por defecto si no tiene logo -->
                                        <span class="badge bg-secondary">Sin imagen</span>
                                    @endif
                                </td>
                                <td> {{$producto->nombre}} </td>
                                <td> {{$producto->codigo}} </td>
                                <td>
                                    @if($producto->stock_disponible < $producto->stock_minimo)
                                        <small class="d-block text-danger">⚠️ Stock bajo</small>
                                    @elseif($producto->stock_disponible > $producto->stock_maximo)
                                        <small class="d-block text-warning text-dark">⚠️ Sobre stock</small>
                                    @else
                                        <small class="d-block text-success text-dark">✅ Stock OK</small>
                                    @endif
                                </td>
                                <td>
                                    @if ($producto->trashed())
                                        {{-- Si está inactivo, mostramos botón para RESTAURAR --}}
                                        <form action="{{ route('productos.restore', $producto) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-arrow-clockwise"></i></button>
                                        </form>
                                    @else
                                        <x-show-button :route="route('categorias.productos.show', $producto)" class="btn-sm"></x-show-button>
                                    @endif
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
