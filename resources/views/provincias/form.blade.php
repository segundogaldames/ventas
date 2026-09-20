<div class="mb-3">
    <label for="nombre" class="form-label">Provincia</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $provincia->nombre ?? '') }}" placeholder="Nombre de la provincia">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Guardar</button>
