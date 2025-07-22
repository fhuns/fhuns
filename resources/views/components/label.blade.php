@props(['for' => null, 'value' => null])

<label 
    for="{{ $for }}" 
    {{ $attributes->merge(['class' => 'block text-sm font-medium text-gray-700 dark:text-gray-300']) }}
>
    {{ $value ?? $slot }}
    
    @if($attributes->has('required'))
        <span class="text-red-500">*</span>
    @endif
</label>