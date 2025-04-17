@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue-500 font-bold border-b-2 border-blue-500'
            : 'text-blue-400 hover:text-blue-300';
@endphp

<li class="cursor-pointer px-4 py-2 {{ $classes }}">
    <a {{ $attributes }}>
        {{ $slot }}
    </a>
</li>
