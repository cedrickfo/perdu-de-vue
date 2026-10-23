@props([
    'color' => 'bg-gray-100 text-gray-800',
])

<span {{ $attributes->class([
    'inline-block rounded-full px-3 py-1 text-xs font-semibold',
    $color,
]) }}>
    {{ $slot }}
</span>
