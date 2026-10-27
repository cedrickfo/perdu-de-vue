
@props(['title' => null])

<article {{ $attributes->class([
    'overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:shadow-lg',
]) }}>

    @if ($title)
        <div class="border-b border-stone-200 bg-[#f5f0e7] px-5 py-4">
            <h2 class="text-lg font-bold text-[#07558e]">
                {{ $title }}
            </h2>
        </div>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

</article>
