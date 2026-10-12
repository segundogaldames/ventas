<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
        value="{{ old('nombre', $categoria->nombre ?? '') }}" placeholder="Nombre de la categoría">

    @error('nombre')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @else '' @enderror" id="descripcion"
        placeholder="Descripción de la categoría" style="resize: none" rows="4"> {{ old('descripcion', $categoria->descripcion ?? '') }} </textarea>

    @error('descripcion')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
