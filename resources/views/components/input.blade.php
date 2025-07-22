@props([
    'type' => 'text',
    'name' => null,
    'id' => null,
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'description' => null
])

<div class="mb-4">
    @if($label)
        <x-label for="{{ $id ?? $name }}" :value="$label" />
    @endif
    
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300']) }}
    >
    
    @if($description)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $description }}</p>
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>