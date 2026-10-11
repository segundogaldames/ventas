<div class="row">
    <div class="col-md-4 mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @else '' @enderror"
            id="name" value="{{ old('name', $user->name ?? '') }}" placeholder="Nombre del usuario">

        @error('name')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @else '' @enderror"
            id="email" value="{{ old('email', $user->email ?? '') }}" placeholder="Email del usuario">

        @error('email')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label for="role" class="form-label">Rol</label>
        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
            <option value="">Seleccione...</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}"
                    {{ old('role', isset($user) && $user->hasRole($role->name) ? $role->name : '') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>

        @error('role')
            <span class="invalid-feedback">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
@if ($task == 'create')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                id="password" placeholder="Password del usuario">

            @error('password')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Password</label>
            <input type="password" name="password_confirmation" class="form-control"
                id="password_confirmation" placeholder="Reigresa Password del usuario">

        </div>

    </div>

@endif
<x-save-button></x-save-button>
