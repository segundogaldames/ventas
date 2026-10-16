<div class="row">
    <div class="col-md-4 mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @else '' @enderror" id="nombre"
            value="{{ old('nombre', $producto->nombre ?? '') }}" placeholder="Nombre del producto">

        @error('nombre')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @else '' @enderror" id="descripcion"
            placeholder="Descripción del producto" rows="4" style="resize: none">
        {{ old('descripcion', $producto->descripcion ?? '') }}</textarea>

        @error('descripcion')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @else '' @enderror"
            id="codigo" value="{{ old('codigo', $producto->codigo ?? '') }}" placeholder="Código del producto">

        @error('codigo')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @else '' @enderror"
            id="imagen" value="{{ old('imagen', $producto->imagen ?? '') }}" placeholder="Imagen del producto">
        @if ($task == 'edit')
            <div class="col-md-6 py-2">
                @if ($producto->imagen)
                    <!-- Muestra la imagen si existe -->
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen" class="object-fit-cover w-100">
                @else
                    <!-- Imagen por defecto si no tiene logo -->
                    <span class="badge bg-secondary">Sin imagen</span>
                @endif

            </div>
        @endif

        @error('imagen')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="stock_disponible" class="form-label">Stock disponible</label>
        <input type="text" name="stock_disponible"
            class="form-control @error('stock_disponible') is-invalid @else '' @enderror" id="stock_disponible"
            value="{{ old('stock_disponible', $producto->stock_disponible ?? '') }}"
            placeholder="Stock disponible">

        @error('stock_disponible')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="stock_minimo" class="form-label">Stock mínimo</label>
        <input type="text" name="stock_minimo"
            class="form-control @error('stock_minimo') is-invalid @else '' @enderror" id="stock_minimo"
            value="{{ old('stock_minimo', $producto->stock_minimo ?? '') }}"
            placeholder="Stock mínimo">

        @error('stock_minimo')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>

</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="stock_maximo" class="form-label">Stock máximo</label>
        <input type="text" name="stock_maximo"
            class="form-control @error('stock_maximo') is-invalid @else '' @enderror" id="stock_maximo"
            value="{{ old('stock_maximo', $producto->stock_maximo ?? '') }}"
            placeholder="Stock máximo">

        @error('stock_maximo')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="precio_compra" class="form-label">Precio de compra $</label>
        <input type="text" name="precio_compra"
            class="form-control @error('precio_compra') is-invalid @else '' @enderror" id="precio_compra"
            value="{{ old('precio_compra', $producto->precio_compra ?? '') }}"
            placeholder="Precio de compra">

        @error('precio_compra')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="precio_venta" class="form-label">Precio Venta $</label>
        <input type="text" name="precio_venta" class="form-control @error('precio_venta') is-invalid @else '' @enderror"
            id="precio_venta" value="{{ old('precio_venta', $producto->precio_venta ?? '') }}" placeholder="Precio de venta">

        @error('precio_venta')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
<x-save-button></x-save-button>
