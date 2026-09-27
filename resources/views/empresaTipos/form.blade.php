<div class="mb-3">
    <label for="nombre" class="form-label">Tipo Empresa</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $empresaTipo->nombre ?? '') }}" placeholder="Nombre del tipo de empresa">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
