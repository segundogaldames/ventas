<div class="row">
    @if ($action == 'create')
        <div class="col-md-4 mb-3">
            <label for="producto_id" class="form-label">Productos</label>
            <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror">
                <option value="">Seleccione...</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" {{ old('producto_id', $compraDetalle->producto_id ?? '') == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                @endforeach
            </select>
            @error('producto_id')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>

    @endif
    <div class="col-md-4 mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="text" name="cantidad" class="form-control @error('cantidad') is-invalid @else '' @enderror" id="cantidad"
            value="{{ old('cantidad', $compraDetalle->cantidad ?? '') }}" placeholder="Cantidad">
        @error('cantidad')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="precio_unitario" class="form-label">Precio Unitario $</label>
        <input type="text" name="precio_unitario" class="form-control @error('precio_unitario') is-invalid @else '' @enderror" id="precio_unitario"
            value="{{ old('precio_unitario', $compraDetalle->precio_unitario ?? '') }}" placeholder="Precio unitario">
        @error('precio_unitario')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<x-save-button></x-save-button>
