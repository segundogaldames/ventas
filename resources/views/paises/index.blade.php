@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Paises')

@section('content_header')
    <h1>
        Países
        <a href="{{ route('paises.create') }}" class="btn btn-outline-secondary">Nuevo País</a>
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
                        <td class="col-8">País</td>
                        <td class="col-2"></td>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($paises as $pais)
                        <tr>
                            <td> {{ $pais->id }} </td>
                            <td> {{ $pais->nombre }} </td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('paises.show', $pais) }}" class="btn btn-success btn-sm"><i
                                        class="bi bi-eye"></i></a>
                                <a href="{{ route('paises.edit', $pais) }}" class="btn btn-warning btn-sm"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('paises.destroy', $pais) }}" method="post"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este país?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-info"> No hay paises registrados </td>
                        </tr>
                    @endforelse
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
