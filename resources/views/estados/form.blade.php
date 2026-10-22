<div class="mb-3">
    <label for="codigo" class="form-label">Código</label>
    <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @else '' @enderror" id="codigo"
        value="{{ old('codigo', $estado->codigo ?? '') }}" placeholder="Código del estado">

    @error('codigo')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $estado->nombre ?? '') }}" placeholder="Nombre del estado">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
