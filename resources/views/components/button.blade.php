@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md'
])

@php
    // Variant classes
    $variantClasses = [
        'primary' => 'bg-purple-600 hover:bg-purple-700 text-white focus:ring-purple-500',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-800 focus:ring-gray-500',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white focus:ring-red-500',
        'outline' => 'border border-gray-300 hover:bg-gray-50 text-gray-700 focus:ring-gray-500',
    ];

    // Size classes
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];

    // Base classes
    $baseClasses = 'inline-flex items-center rounded-md font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200';
    
    // Merge all classes
    $classes = $baseClasses.' '.$variantClasses[$variant].' '.$sizeClasses[$size];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>