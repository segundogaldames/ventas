@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>
        Detalle Producto
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        @if ($producto->imagen)
                            <!-- Muestra la imagen si existe -->
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" class="object-fit-cover w-100">
                        @else
                            <!-- Imagen por defecto si no tiene logo -->
                            <span class="badge bg-secondary">Sin imagen</span>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <table class="table table-hover">
                            <tr>
                                <th>Id:</th>
                                <td> {{$producto->id}} </td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td> {{$producto->nombre}} </td>
                            </tr>
                            <tr>
                                <th>Código:</th>
                                <td> {{$producto->codigo}} </td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td> {{$producto->descripcion}} </td>
                            </tr>
                            <tr>
                                <th>Stock disponible:</th>
                                <td class="
                                    @if($producto->stock_disponible < $producto->stock_minimo)
                                                table-danger fw-bold text-danger
                                    @elseif($producto->stock_disponible > $producto->stock_maximo)
                                                table-warning fw-bold text-dark
                                    @endif">
                                        {{$producto->stock_disponible}}
                                        @if($producto->stock_disponible < $producto->stock_minimo)
                                            <small class="d-block text-danger">⚠️ Stock bajo</small>
                                        @elseif($producto->stock_disponible > $producto->stock_maximo)
                                            <small class="d-block text-warning text-dark">⚠️ Sobre stock</small>
                                        @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Stock mínimo:</th>
                                <td> {{$producto->stock_minimo}} </td>
                            </tr>
                            <tr>
                                <th>Stock máximo:</th>
                                <td> {{$producto->stock_maximo}} </td>
                            </tr>
                            <tr>
                                <th>Precio de compra:</th>
                                <td>$ {{$producto->precio_compra}} </td>
                            </tr>
                            <tr>
                                <th>Precio de venta:</th>
                                <td>$ {{$producto->precio_venta}} </td>
                            </tr>
                            <tr>
                                <th>Creado:</th>
                                <td> {{ $producto->created_at->format('d/m/Y H:i') }} </td>
                            </tr>
                            <tr>
                                <th>Actualizado:</th>
                                <td> {{ $producto->updated_at->format('d/m/Y H:i') }} </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('empresas.categorias.show', $producto->categoria)" class="my-2"></x-back-button>
            <x-edit-button :route="route('categorias.productos.edit', $producto)" class="my-2"></x-edit-button>
            <form action="{{ route('categorias.productos.destroy', $producto) }}" method="post"
                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                <button type="submit" class="btn btn-danger my-2"><i class="bi bi-trash"></i></button>
            </form>
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
@stop
