@props(['route' => url()->previous()])

<a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-primary']) }} title="Volver">
    <i class="bi bi-arrow-left"></i> {{ $slot->isEmpty() ? '' : $slot }}
</a>
