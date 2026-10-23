<div class="mb-3">
    <label for="fecha" class="form-label">Fecha de Compra</label>
    <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @else '' @enderror" id="fecha"
        value="{{ old('fecha', $compra->fecha ?? '') }}" placeholder="Fecha de la compra">
    @error('fecha')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="num_factura" class="form-label">N° Factura o Boleta</label>
    <input type="text" name="num_factura" class="form-control @error('num_factura') is-invalid @else '' @enderror" id="num_factura"
        value="{{ old('num_factura', $compra->num_factura ?? '') }}" placeholder="N° Factura o Boleta">
    @error('num_factura')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="proveedor_id" class="form-label">Proveedor</label>
    <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror">
        <option value="">Seleccione...</option>
        @foreach ($proveedores as $proveedor)
            <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $compra->proveedor_id ?? '') == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->rut }} {{ $proveedor->nombre }}</option>
        @endforeach
    </select>
</div>
@if ($action == 'edit')
    <div class="mb-3">
        <label for="estado_id" class="form-label">Estado</label>
        <select name="estado_id" id="estado_id" class="form-control @error('estado_id') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach ($estados as $estado)
                <option value="{{ $estado->id }}" {{ old('estado_id', $compra->estado_id ?? '') == $estado->id ? 'selected' : '' }}>{{ $estado->nombre }}</option>
            @endforeach
        </select>
    </div>

@endif
<x-save-button></x-save-button>
