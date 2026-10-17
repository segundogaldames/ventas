@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>
        Nuevo Producto
    </h1>
@stop

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($productos as $producto)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title fs-2 font-bold"> {{$producto->nombre}} </h1>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                                @if ($producto->imagen)
                                                    <!-- Muestra la imagen si existe -->
                                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" class="object-fit-cover w-100">
                                                @else
                                                    <!-- Imagen por defecto si no tiene logo -->
                                                    <span class="badge bg-secondary">Sin imagen</span>
                                                @endif
                                        </div>
                                        <div class="col-md-7">
                                            <p class="card-subtitle fg-3">Categoría: {{$producto->categoria->nombre}} </p>
                                            <p class="card-text"> {{$producto->descripcion}} </p>
                                            <a href="{{route('categorias.productos.show', $producto)}}">Ver detalle</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach
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
@stop
