@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-blue-500 font-bold relative group transition-all duration-300 ease-in-out'
            : 'text-blue-400 hover:text-blue-300 relative group transition-all duration-300 ease-in-out';
@endphp

<li class="cursor-pointer px-4 py-2">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <span class="bg-left-bottom bg-gradient-to-r from-blue-500 to-blue-500 bg-[length:0%_2px] bg-no-repeat group-hover:bg-[length:100%_2px] transition-all duration-500 ease-out">
            {{ $slot }}
        </span>
    </a>
</li>
