@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Tipo Empresa')

@section('content_header')
    <h1>
        Detalle Tipo Empresa
    </h1>
@stop

@section('content')

    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Id:</th>
                        <td> {{ $empresaTipo->id }} </td>
                    </tr>
                    <tr>
                        <th>Nombre:</th>
                        <td> {{ $empresaTipo->nombre }} </td>
                    </tr>
                    <tr>
                        <th>Creado:</th>
                        <td> {{ $empresaTipo->created_at->format('d/m/Y H:i') }} </td>
                    </tr>
                    <tr>
                        <th>Actualizado:</th>
                        <td> {{ $empresaTipo->updated_at->format('d/m/Y H:i') }} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('empresaTipos.index')" class="my-2"></x-back-button>
            <x-edit-button :route="route('empresaTipos.edit', $empresaTipo)" class="my-2"></x-edit-button>
            <form action="{{ route('empresaTipos.destroy', $empresaTipo) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este tipo de empresa?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger my-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
        <div class="card">
            <div class="card-title">
                <h1 class="fs-3 m-3">
                    Empresas {{ $empresaTipo->nombre }}
                </h1>
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
