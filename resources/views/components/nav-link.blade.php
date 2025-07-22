@props(['href', 'active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-2 py-2 text-sm font-medium text-white bg-purple-800 rounded-md group'
            : 'flex items-center px-2 py-2 text-sm font-medium text-white hover:bg-purple-800 rounded-md group';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>