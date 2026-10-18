<div class="row">
    <div class="col-md-3 mb-3">
        <label for="rut" class="form-label">RUT</label>
        <input type="text" name="rut" class="form-control @error('rut') is-invalid @else '' @enderror" id="rut"
            value="{{ old('rut', $proveedor->rut ?? '') }}" placeholder="RUT del proveedor">

        @error('rut')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror"
            id="nombre" value="{{ old('nombre', $proveedor->nombre ?? '') }}" placeholder="Nombre del proveedor">

        @error('nombre')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control @error('email') is-invalid @else '' @enderror"
            id="email" value="{{ old('email', $proveedor->email ?? '') }}" placeholder="Email del proveedor">

        @error('email')
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
            placeholder="direccion del proveedor" rows="4" style="resize: none">
        {{ old('direccion', $proveedor->direccion ?? '') }}</textarea>

        @error('direccion')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

</div>
<x-save-button></x-save-button>
