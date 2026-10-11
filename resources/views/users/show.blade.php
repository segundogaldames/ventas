
@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Usuarios')

@section('content_header')
    <h1>
        Detalle Usuario
    </h1>
@stop

@section('content')

    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        {{-- detalle del pais --}}
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $user->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $user->name }} </td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td> {{ $user->email }} </td>
                    </tr>
                    <tr>
                        <th>Rol:</th>
                        <td> {{ $user->roles->pluck('name')->first() ?? 'Sin rol' }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $user->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $user->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Empresas:</th>
                        <td>
                            <ul class="list-unstyled mb-2">
                                @forelse ($user->empresas as $empresa)
                                    <li
                                        class="d-flex align-items-center justify-content-between py-1 border-bottom">
                                        <!-- Información del usuario en línea -->
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-building"></i>
                                            <span class="fw-semibold">{{ $empresa->nombre }}</span>
                                            <span class="text-muted small">({{ $empresa->email }})</span>
                                        </div>

                                        <!-- Botón de eliminar alineado a la derecha -->
                                    </li>
                                @empty
                                    <li class="text-info">No hay empresas registradas para este usuario.</li>
                                @endforelse
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('users.index')" class="my-2"></x-back-button>
            <x-edit-button :route="route('users.edit', $user)" class="my-2"></x-edit-button>
            <form action="{{ route('users.destroy', $user) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-2"><i class="bi bi-trash"></i></button>
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
