@props(['route' => url()->previous()])

<a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-warning']) }}><i class="bi bi-pencil"></i></a>
