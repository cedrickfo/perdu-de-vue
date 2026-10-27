
@props([
    'name' => null,
])

<select
    @if ($name) name="{{ $name }}" @endif
    {{ $attributes->class([
        'w-full rounded-lg border bg-white px-4 py-3 text-slate-900 transition',
        'focus:outline-none focus:ring-2 focus:ring-offset-1',
        'border-red-500 focus:border-red-600 focus:ring-red-300' => $name && $errors->has($name),
        'border-slate-300 focus:border-[#07558e] focus:ring-blue-200' => ! $name || ! $errors->has($name),
    ]) }}
    @if ($name && $errors->has($name)) aria-invalid="true" @endif
>
    {{ $slot }}
</select>
