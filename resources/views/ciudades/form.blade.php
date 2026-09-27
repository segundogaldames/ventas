<div class="mb-3">
    <label for="nombre" class="form-label">Ciudad</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $ciudad->nombre ?? '') }}" placeholder="Nombre de la ciudad">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
