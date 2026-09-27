@props(['route' => url()->previous()])

<a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-success btn-sm']) }}><i
        class="bi bi-eye"></i></a>
