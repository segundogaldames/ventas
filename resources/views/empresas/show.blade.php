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

    <div class="row">
        <div class="col-md-6">
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

                                        </ul>
                                        <a href="{{ route('empresas.telefonos.create', $empresa) }}"
                                            class="btn btn-primary btn-sm">Agregar Teléfono</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Impuestos:</th>
                                    <td>
                                        <ul class="list-unstyled">
                                            @forelse ($empresa->impuestos as $impuesto)
                                                <li>
                                                    <a href="{{ route('empresas.impuestos.show', $impuesto) }}"><i
                                                            class="bi bi-calculator"></i> {{ $impuesto->nombre }} -
                                                        {{ $impuesto->valor }}</a>
                                                </li>
                                            @empty
                                                <li class="text-info">No hay impuestos registrados para esta empresa.</li>
                                            @endforelse

                                        </ul>
                                        <a href="{{ route('empresas.impuestos.create', $empresa) }}"
                                            class="btn btn-primary btn-sm">Agregar Impuesto</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Usuarios:</th>
                                    <td>
                                        <ul class="list-unstyled mb-2">
                                            @forelse ($empresa->usuarios as $usuario)
                                                <li
                                                    class="d-flex align-items-center justify-content-between py-1 border-bottom">
                                                    <!-- Información del usuario en línea -->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="bi bi-person text-primary"></i>
                                                        <span class="fw-semibold">{{ $usuario->name }}</span>
                                                        <span class="text-muted small">({{ $usuario->email }})</span>
                                                    </div>

                                                    <!-- Botón de eliminar alineado a la derecha -->
                                                    <div>
                                                        <form
                                                            action="{{ route('empresas.usuarios.destroy', [$empresa, $usuario]) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('¿Desvincular usuario?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm border-0"
                                                                title="Desvincular">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="text-info">No hay usuarios registrados para esta empresa.</li>
                                            @endforelse
                                        </ul>
                                        <a href="{{ route('empresas.usuarios.asignar', $empresa) }}"
                                            class="btn btn-primary btn-sm">Agregar Usuario</a>
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
        <div class="col-md-6">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="text-decoration-none text-secondary">
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
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('categorias.categoriasEmpresa', $empresa) }}" class="text-decoration-none text-secondary">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-list"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Categorías</span>
                                <span class="info-box-number">
                                       {{$total_categorias}}
                                </span>
                            </div>
                                <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('productos.productosEmpresa', $empresa) }}" class="text-decoration-none text-secondary">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-info shadow-sm">
                            <i class="bi bi-box-seam"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Productos</span>
                                <span class="info-box-number">
                                       {{$total_productos}}
                                </span>
                            </div>
                                <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('proveedores.proveedoresEmpresa', $empresa) }}" class="text-decoration-none text-secondary">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-building-add"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Proveedores</span>
                                <span class="info-box-number">
                                       {{$total_proveedores}}
                                </span>
                            </div>
                                <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ route('compras.comprasEmpresa', $empresa) }}" class="text-decoration-none text-secondary">
                        <div class="info-box">
                            <span class="info-box-icon text-bg-secondary shadow-sm">
                            <i class="bi bi-building-add"></i>
                            </span>

                            <div class="info-box-content">
                                <span class="info-box-text">Compras</span>
                                <span class="info-box-number">
                                       {{$total_compras}}
                                </span>
                            </div>
                                <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
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
