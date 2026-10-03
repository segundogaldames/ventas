<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror"
            id="nombre" value="{{ old('nombre', $impuesto->nombre ?? '') }}" placeholder="Nombre del impuesto">

        @error('nombre')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="valor" class="form-label">Valor</label>
        <input type="text" name="valor" class="form-control @error('valor') is-invalid @else '' @enderror"
            id="valor" value="{{ old('valor', $impuesto->valor ?? '') }}" placeholder="Valor del impuesto">

        @error('valor')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<x-save-button></x-save-button>
