@extends('adminlte::page')

@push('styles')
    <!-- CSS de DataTables con Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Empresas')

@section('content_header')
    <h1>
        Detalle Empresa
    </h1>
@stop

@section('content')

    <div class="col-md-8 offset-md-2">
        @include('partials.messages')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        @if ($empresa->logo)
                            <!-- Muestra la imagen si existe -->
                            <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo" class="object-fit-cover w-100">
                        @else
                            <!-- Imagen por defecto si no tiene logo -->
                            <span class="badge bg-secondary">Sin logo</span>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <table class="table table-hover">
                            <tr>
                                <th>Id:</th>
                                <td> {{ $empresa->id }} </td>
                            </tr>
                            <tr>
                                <th>RUT/NIT:</th>
                                <td> {{ $empresa->nit }} </td>
                            </tr>
                            <tr>
                                <th>Nombre:</th>
                                <td> {{ $empresa->nombre }} </td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td> {{ $empresa->nombre }} </td>
                            </tr>
                            <tr>
                                <th>Sitio Web:</th>
                                <td>
                                    <a href="{{ $empresa->sitio_web }}" target="_blank"> {{ $empresa->sitio_web }} </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Dirección:</th>
                                <td>
                                    {{ $empresa->direccion }}
                                </td>
                            </tr>
                            <tr>
                                <th>Ciudad:</th>
                                <td>
                                    {{ $empresa->ciudad->nombre }} - {{ $empresa->ciudad->provincia->nombre }} -
                                    {{ $empresa->ciudad->provincia->pais->nombre }}
                                </td>
                            </tr>
                            <tr>
                                <th>Código Postal:</th>
                                <td>
                                    {{ $empresa->codigo_postal }}
                                </td>
                            </tr>
                            <tr>
                                <th>Tipo Empresa:</th>
                                <td>
                                    {{ $empresa->empresaTipo->nombre }}
                                </td>
                            </tr>
                            <tr>
                                <th>Creado:</th>
                                <td> {{ $empresa->created_at->format('d/m/Y H:i') }} </td>
                            </tr>
                            <tr>
                                <th>Actualizado:</th>
                                <td> {{ $empresa->updated_at->format('d/m/Y H:i') }} </td>
                            </tr>
                            <tr>
                                <th>Teléfonos:</th>
                                <td>
                                    @if ($empresa->telefonos)
                                        <ul class="list-unstyled">
                                            @forelse ($empresa->telefonos as $telefono)
                                                <li>
                                                    <a href="{{ route('empresas.telefonos.show', $telefono) }}"><i
                                                            class="bi bi-telephone-forward"></i> {{ $telefono->codigo }} -
                                                        {{ $telefono->numero }}</a>
                                                </li>
                                            @empty
                                                <li class="text-info">No hay teléfonos registrados para esta empresa.</li>
                                            @endforelse
                                    @endforelse
                                    </ul>
                                    <a href="{{ route('empresas.telefonos.create', $empresa) }}"
                                        class="btn btn-primary btn-sm">Agregar Teléfono</a>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex gap-2">
            <x-back-button :route="route('empresas.index')" class="my-2"></x-back-button>
            <x-edit-button :route="route('ciudades.empresas.edit', $empresa)" class="my-2"></x-edit-button>
            <form action="{{ route('ciudades.empresas.destroy', $empresa) }}" method="post"
                onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger my-2"><i class="bi bi-trash"></i></button>
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
