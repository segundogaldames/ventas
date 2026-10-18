@extends('adminlte::page')

@section('title', 'Empresas - Proveedores')

@section('content_header')
    <h1>
        Nuevo Usuario
    </h1>
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('empresas.proveedores.registrarProveedor', $empresa) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuario</label>
                        <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror">
                            <option value="">Seleccione...</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">
                                    {{ $proveedor->rut }} {{ $proveedor->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('proveedor_id')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <x-save-button></x-save-button>
                    <x-back-button :route="route('ciudades.empresas.show', $empresa)"></x-back-button>
                </form>
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
