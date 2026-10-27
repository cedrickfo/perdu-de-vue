
@props(['variant' => 'primary', 'type' => 'button'])

@php
    $classes = match ($variant) {
        'primary' => 'bg-[#07558e] text-white hover:bg-blue-900 focus-visible:outline-blue-700',
        'secondary' => 'bg-orange-500 text-white hover:bg-orange-600 focus-visible:outline-orange-500',
        'success' => 'bg-green-700 text-white hover:bg-green-800 focus-visible:outline-green-700',
        'danger' => 'bg-red-700 text-white hover:bg-red-800 focus-visible:outline-red-700',
        default => 'bg-[#07558e] text-white hover:bg-blue-900 focus-visible:outline-blue-700',
    };
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->class([
        'inline-flex items-center justify-center rounded-xl px-6 py-3 font-semibold shadow-sm transition',
        'focus-visible:outline-2 focus-visible:outline-offset-2',
        $classes,
    ]) }}
>
    {{ $slot }}
</button>
