{{-- @var \App\Models\User $user --}}
{{-- @var \Illuminate\Database\Eloquent\Collection $users --}}
@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>
        Editar Usuario
    </h1>
@stop

@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="post">
                    @csrf
                    @method('PUT')
                    @include('users.form')
                    <x-back-button :route="route('users.show', $user)"></x-back-button>
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
