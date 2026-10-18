@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>
        Detalle Proveedor
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
                        <td> {{$proveedor->id}} </td>
                    </tr>
                    <tr>
                        <th>RUT:</th>
                        <td> {{$proveedor->rut}} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{$proveedor->nombre}} </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td> {{$proveedor->email}} </td>
                    </tr>
                    <tr>
                        <th>Dirección:</th>
                        <td> {{$proveedor->direccion}} </td>
                    </tr>
                    <tr>
                        <th>Ciudad:</th>
                        <td> {{$proveedor->ciudad->nombre}} </td>
                    </tr>

                    <tr>
                        <th>Creado:</th>
                        <td> {{ $proveedor->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $proveedor->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('proveedores.proveedoresCiudad', $proveedor->ciudad)" class="my-2"></x-back-button>
            <x-edit-button :route="route('ciudades.proveedores.edit', $proveedor)" class="my-2"></x-edit-button>
            <form action="{{ route('ciudades.proveedores.destroy', $proveedor) }}" method="post"
                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">
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
