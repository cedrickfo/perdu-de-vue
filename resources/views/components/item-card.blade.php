
@props(['item'])

@php
    $circleColor = match ($item->color) {
        \App\Enums\Color::Black => 'bg-gray-950',
        \App\Enums\Color::White => 'bg-white',
        \App\Enums\Color::Grey => 'bg-gray-400',
        \App\Enums\Color::Red => 'bg-red-600',
        \App\Enums\Color::Blue => 'bg-blue-600',
        \App\Enums\Color::Green => 'bg-green-600',
        \App\Enums\Color::Yellow => 'bg-yellow-400',
        \App\Enums\Color::Orange => 'bg-orange-500',
        \App\Enums\Color::Brown => 'bg-amber-800',
        \App\Enums\Color::Pink => 'bg-pink-400',
        \App\Enums\Color::Purple => 'bg-purple-600',
        \App\Enums\Color::Multicolor => 'bg-gradient-to-r from-pink-400 via-yellow-400 to-blue-400',
    };

    $placeKind = $item->place->kind->value;
@endphp

<article class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

    {{-- En-tête de la carte --}}
    <div class="flex items-center justify-between gap-3 border-b border-stone-200 bg-[#f5f0e7] p-4">

        <div class="flex min-w-0 items-center gap-3">

            {{-- Icône du lieu --}}
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-stone-200 bg-white text-[#07558e]">

                @if ($placeKind === 'train')
                    <svg width="26" height="26" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <rect x="5" y="2" width="14" height="16" rx="4"/>
                        <path d="M5 10h14M8 6h.01M16 6h.01M8 18l-2 4M16 18l2 4M6 22h12"/>
                    </svg>

                @elseif ($placeKind === 'platform')
                    <svg width="26" height="26" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="4" width="18" height="13" rx="2"/>
                        <path d="M3 9h18M7 13h.01M17 13h.01M7 17l-2 4M17 17l2 4M3 21h18"/>
                    </svg>

                @else
                    <svg width="26" height="26" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor"
                         stroke-width="1.8" stroke-linecap="round"
                         stroke-linejoin="round" aria-hidden="true">
                        <path d="m3 10 9-7 9 7M5 9v12h14V9M9 21v-8h6v8M3 21h18"/>
                    </svg>
                @endif

            </div>

            {{-- Type et nom du lieu --}}
            <div class="flex min-w-0 flex-col items-start gap-1">

                <x-badge :color="$item->place->kind->badgeClasses()">
                    {{ $item->place->kind->label() }}
                </x-badge>

                <a href="{{ route('places.show', $item->place) }}"
                   class="text-sm font-bold text-[#07558e] hover:underline focus-visible:outline-2 focus-visible:outline-offset-2">
                    {{ $item->place->name }}
                </a>

            </div>

        </div>

        {{-- Cercle représentant la couleur --}}
        <div
            class="h-9 w-9 shrink-0 rounded-full border-4 border-white shadow-sm ring-1 ring-stone-200 {{ $circleColor }}"
            title="{{ $item->color->label() }}"
        ></div>

    </div>

    {{-- Informations de l'objet --}}
    <div class="space-y-3 p-5">

        {{-- Numéro et date --}}
        <p class="text-xs text-slate-500">
            N° {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
            · Trouvé le {{ $item->found_on->locale('fr')->isoFormat('D MMMM YYYY') }}

            <span class="block text-orange-700">
                {{ $item->found_on->locale('fr')->diffForHumans() }}
            </span>
        </p>

        {{-- Nom de l'objet --}}
        <h2 class="min-h-12 text-lg font-bold text-slate-900">

            <a href="{{ route('items.show', $item) }}"
               class="hover:text-[#07558e] hover:underline focus-visible:outline-2 focus-visible:outline-offset-2">
                {{ $item->name }}
            </a>

        </h2>

        {{-- Couleur et étiquettes --}}
        <div class="flex flex-wrap gap-2">

            <x-badge :color="$item->color->badgeClasses()">
                {{ $item->color->label() }}
            </x-badge>

            @foreach ($item->tags as $tag)
                <x-badge>
                    {{ $tag->name }}
                </x-badge>
            @endforeach

        </div>

        {{-- Statut de restitution --}}
        @if ($item->isReturned())
            <p class="rounded-lg bg-green-50 p-3 text-sm font-semibold text-green-800">
                ✓ Restitué le {{ $item->returned_at->locale('fr')->isoFormat('D MMMM YYYY') }}
            </p>
        @endif

    </div>

</article>
