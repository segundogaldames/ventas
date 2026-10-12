@use('Cassandra\Index')
{{-- resources/views/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>

@stop

@section('content')
    <p class="text-info">Bienvenido/a al Panel de Administración</p>
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('roles.index') }}" class="text-decoration-none text-secondary">
                <div class="info-box">
                    <span class="info-box-icon text-bg-secondary shadow-sm">
                    <i class="bi bi-person-check-fill"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Roles</span>
                        <span class="info-box-number">
                               {{$total_roles}}
                        </span>
                    </div>
                        <!-- /.info-box-content -->
                </div>

            </a>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('roles.index') }}" class="text-decoration-none text-secondary">
                <div class="info-box">
                    <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-people-fill"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios</span>
                        <span class="info-box-number">
                               {{$total_users}}
                        </span>
                    </div>
                        <!-- /.info-box-content -->
                </div>
            </a>
            <!-- /.info-box -->
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
