@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>
        Nueva Compra
    </h1>
@stop

@section('content')
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('empresas.compras.store', $empresa) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('compras.form')
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
