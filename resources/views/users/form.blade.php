<div class="mb-3">
    <label for="name" class="form-label">Rol</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @else '' @enderror" id="name"
        value="{{ old('name', $role->name ?? '') }}" placeholder="Nombre del rol">

    @error('name')
        <span class="invalid-feedback">
            {{ $message }}
        </span>
    @enderror
</div>
<x-save-button></x-save-button>
