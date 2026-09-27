<div class="row">
    <div class="col-md-6 mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @else '' @enderror"
            id="codigo" value="{{ old('codigo', $telefono->codigo ?? '') }}" placeholder="Código del teléfono">

        @error('codigo')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" name="numero" class="form-control @error('numero') is-invalid @else '' @enderror"
            id="numero" value="{{ old('numero', $telefono->numero ?? '') }}" placeholder="Número de teléfono">

        @error('numero')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<x-save-button></x-save-button>
