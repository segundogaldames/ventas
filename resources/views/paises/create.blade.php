@extends('adminlte::page')

@section('title', 'Paises')

@section('content_header')
    <h1>
        Nuevo País
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('paises.store') }}" method="post">
                    @csrf
                    @include('paises.form')
                    <a href="{{ route('paises.index') }}" class="btn btn-primary">Volver</a>
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
