<div class="row">
    <div class="col-md-3 mb-3">
        <label for="nit" class="form-label">RUT/NIT</label>
        <input type="text" name="nit" class="form-control @error('nit') is-invalid @else '' @enderror" id="nit"
            value="{{ old('nit', $empresa->nit ?? '') }}" placeholder="RUT o NIT de la Empresa">

        @error('nit')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror"
            id="nombre" value="{{ old('nombre', $empresa->nombre ?? '') }}" placeholder="Nombre de la Empresa">

        @error('nombre')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @else '' @enderror"
            id="email" value="{{ old('email', $empresa->email ?? '') }}" placeholder="Email de la Empresa">

        @error('email')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="sitio_web" class="form-label">Sitio Web (https://tuempresa.com)</label>
        <input type="text" name="sitio_web" class="form-control @error('sitio_web') is-invalid @else '' @enderror"
            id="sitio_web" value="{{ old('sitio_web', $empresa->sitio_web ?? '') }}"
            placeholder="Sitio web de la Empresa">

        @error('sitio_web')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <textarea name="direccion" class="form-control @error('direccion') is-invalid @else '' @enderror" id="direccion"
            placeholder="direccion de la Empresa" rows="4" style="resize: none">
        {{ old('direccion', $empresa->direccion ?? '') }}</textarea>

        @error('direccion')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="codigo_postal" class="form-label">Código Postal</label>
        <input type="text" name="codigo_postal"
            class="form-control @error('codigo_postal') is-invalid @else '' @enderror" id="codigo_postal"
            value="{{ old('codigo_postal', $empresa->codigo_postal ?? '') }}"
            placeholder="Código postal de la Empresa">

        @error('codigo_postal')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="empresa_tipo_id" class="form-label">Tipo Empresa</label>
        <select name="empresa_tipo_id" id="empresa_tipo_id"
            class="form-control @error('empresa_tipo_id') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach ($empresaTipos as $tipo)
                <option value="{{ $tipo->id }}"
                    {{ old('empresa_tipo_id', $empresa->empresa_tipo_id ?? '') == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->nombre }}
                </option>
            @endforeach
        </select>

        @error('empresa_tipo_id')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="logo" class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @else '' @enderror"
            id="logo" value="{{ old('logo', $empresa->logo ?? '') }}" placeholder="Logo de la Empresa">
        @if ($task == 'edit')
            <div class="col-md-6 py-2">
                @if ($empresa->logo)
                    <!-- Muestra la imagen si existe -->
                    <img src="{{ asset('storage/' . $empresa->logo) }}" alt="Logo" class="object-fit-cover w-100">
                @else
                    <!-- Imagen por defecto si no tiene logo -->
                    <span class="badge bg-secondary">Sin logo</span>
                @endif

            </div>
        @endif

        @error('logo')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<x-save-button></x-save-button>
