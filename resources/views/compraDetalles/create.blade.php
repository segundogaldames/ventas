@extends('adminlte::page')

@section('title', 'Detalles Compra')

@section('content_header')
    <h1>
        Nuevo Detalle Compra
    </h1>
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('compras.detalles.store', $compra) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('compraDetalles.form')
                    <x-back-button :route="route('compras.comprasEmpresa', $compra->empresa)"></x-back-button>
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
