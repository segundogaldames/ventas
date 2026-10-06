@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>
        Nuevo Rol
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    @include('roles.form')
                    <x-back-button :route="route('roles.index')"></x-back-button>
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
