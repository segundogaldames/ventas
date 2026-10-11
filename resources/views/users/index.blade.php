@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Usuarios')

@section('content_header')
    <h1>
        Usuarios
        <a href="{{ route('users.create') }}" class="btn btn-outline-secondary">Nuevo Usuario</a>
    </h1>
@stop

@section('content')
    @include('partials.messages')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th class="col-2">Id</th>
                        <td class="col-2">Nombre</td>
                        <td class="col-2">Email</td>
                        <td class="col-2">Rol</td>
                        <td class="col-2">Estado</td>
                        <td class="col-2"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->id }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->roles->pluck('name')->first() ?? 'Sin rol' }} </td>
                            <td>
                                @if ($user->trashed())
                                    <span class="badge bg-danger">Inactivo (Eliminado)</span>
                                @else
                                    <span class="badge bg-success">Activo</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-center gap-2">
                                @if ($user->trashed())
                                    {{-- Si está inactivo, mostramos botón para RESTAURAR --}}
                                    <form action="{{ route('users.restore', $user) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-arrow-clockwise"></i></button>
                                    </form>
                                @else
                                    <x-show-button :route="route('users.show', $user)" class="btn-sm"></x-show-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.0/i18n/es-ES.json'
                }
            });
        });
    </script>
@stop
