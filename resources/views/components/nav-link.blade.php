@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue-500 font-bold border-b-2 border-blue-500 transition-all duration-200'
            : 'text-blue-100 hover:text-blue-300 hover:border-b-2 hover:border-blue-300 transition-all duration-200';
@endphp

<li class="cursor-pointer px-4 py-2 {{ $classes }}">
    <a {{ $attributes }}>
        {{ $slot }}
    </a>
</li>
