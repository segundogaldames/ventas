@props(['route' => url()->previous()])

<a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-warning btn-sm']) }}><i
        class="bi bi-pencil"></i></a>
