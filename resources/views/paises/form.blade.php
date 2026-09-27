<div class="mb-3">
    <label for="nombre" class="form-label">País</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $pais->nombre ?? '') }}" placeholder="Nombre del país">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
