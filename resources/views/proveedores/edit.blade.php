@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>
        Editar Proveedor
    </h1>
@stop

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('ciudades.proveedores.update', $proveedor) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('proveedores.form')
                    <x-back-button :route="route('ciudades.proveedores.show', $proveedor)"></x-back-button>
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
