@props(['route' => url()->previous()])

<a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-success']) }}><i class="bi bi-eye"></i></a>
