
<x-layouts.app>


{{-- Présentation de la page --}}
<section class="mb-8 flex flex-wrap items-center justify-between gap-6">

    {{-- Titre et description --}}
    <div class="flex-1">

        <p class="mb-2 text-sm font-bold uppercase tracking-widest text-orange-700">
            Bureau des objets trouvés
        </p>

        <h1 class="mb-3 text-4xl font-extrabold tracking-tight text-[#07558e] md:text-5xl">
            Ils attendent leur propriétaire
        </h1>

        <p class="text-base text-slate-600">
            Les objets ramassés dans le hall, sur les quais et dans les trains,
            du plus récent au plus ancien.
        </p>

    </div>

    {{-- Compteur et bouton d'ajout --}}
    <div class="flex flex-wrap items-center gap-4">

        <div class="min-w-36 rounded-xl bg-[#003b64] px-6 py-4 text-center text-white shadow-sm">

            <p class="text-3xl font-extrabold">
                {{ $items->count() }}
            </p>

            <p class="text-xs font-bold uppercase tracking-wide text-blue-100">
                Objets en attente
            </p>

        </div>

        <a href="{{ route('items.create') }}"
           class="rounded-xl bg-orange-500 px-6 py-4 font-semibold text-white shadow-sm transition hover:bg-orange-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500">
            + Ajouter un objet
        </a>

    </div>

</section>


    {{-- Formulaire des filtres --}}
    <form method="GET" action="{{ route('items.index') }}"

        class="mb-8 flex flex-wrap items-end gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

{{-- Recherche par nom --}}
<div class="w-full">
    <label for="q" class="mb-2 block font-semibold">
        Rechercher un objet
    </label>

    <input
        type="search"
        id="q"
        name="q"
        value="{{ request('q') }}"
        placeholder="Ex. : sac, clés, parapluie..."
        class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-600 focus:outline-none"
    >
</div>



        <div class="flex-1">
            <label for="lieu" class="mb-2 block font-semibold">
                Lieu
            </label>

            <select name="lieu" id="lieu"
                class="w-full rounded-lg border border-slate-300 p-3">
                <option value="">Tous les lieux</option>

                @foreach ($places as $place)
                    <option value="{{ $place->id }}"
                        @selected(request('lieu') == $place->id)>
                        {{ $place->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1">
            <label for="couleur" class="mb-2 block font-semibold">
                Couleur
            </label>

            <select name="couleur" id="couleur"
                class="w-full rounded-lg border border-slate-300 p-3">
                <option value="">Toutes les couleurs</option>

                @foreach (\App\Enums\Color::cases() as $color)
                    <option value="{{ $color->value }}"
                        @selected(request('couleur') === $color->value)>
                        {{ $color->label() }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="rounded-lg bg-blue-700 px-6 py-3 font-semibold text-white transition hover:bg-blue-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700">
            Filtrer
        </button>

    </form>


{{-- Liste des objets sous forme de cartes --}}
<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

    @forelse ($items as $item)

        @php
            // Déterminer le type de lieu
            $placeKind = $item->place->kind->value;

            // Définir la couleur du cercle
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
        @endphp

        <article class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

            {{-- En-tête de la carte --}}
            <div class="flex items-center justify-between gap-3 border-b border-stone-200 bg-[#f5f0e7] p-4">

                <div class="flex items-center gap-3">



{{-- Icône du lieu --}}
<div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-stone-200 bg-white text-[#07558e]">

    @if ($placeKind === 'train')

        {{-- Icône Train --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             width="26" height="26" viewBox="0 0 24 24"
             fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round"
             stroke-linejoin="round" aria-hidden="true">

            <rect x="5" y="2" width="14" height="16" rx="4"/>
            <path d="M5 10h14"/>
            <path d="M8 6h.01M16 6h.01"/>
            <path d="m8 18-2 4M16 18l2 4M6 22h12"/>
            <path d="M8 14h.01M16 14h.01"/>

        </svg>

    @elseif ($placeKind === 'platform')

        {{-- Icône Quai --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             width="26" height="26" viewBox="0 0 24 24"
             fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round"
             stroke-linejoin="round" aria-hidden="true">

            <rect x="3" y="4" width="18" height="13" rx="2"/>
            <path d="M3 9h18"/>
            <path d="M7 13h.01M17 13h.01"/>
            <path d="M7 17l-2 4M17 17l2 4"/>
            <path d="M3 21h18"/>

        </svg>

    @else

        {{-- Icône Hall --}}
        <svg xmlns="http://www.w3.org/2000/svg"
             width="26" height="26" viewBox="0 0 24 24"
             fill="none" stroke="currentColor"
             stroke-width="1.8" stroke-linecap="round"
             stroke-linejoin="round" aria-hidden="true">

            <path d="m3 10 9-7 9 7"/>
            <path d="M5 9v12h14V9"/>
            <path d="M9 21v-8h6v8"/>
            <path d="M3 21h18"/>

        </svg>

    @endif

</div>


                    {{-- Nom et type du lieu --}}
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-stone-500">
                            {{ $item->place->kind->label() }}
                        </p>

                        <a href="{{ route('places.show', $item->place) }}"
                           class="text-sm font-bold text-[#07558e] hover:underline">
                            {{ $item->place->name }}
                        </a>
                    </div>

                </div>

                {{-- Cercle représentant la couleur --}}
                <div class="h-9 w-9 shrink-0 rounded-full border-4 border-white shadow-sm ring-1 ring-stone-200 {{ $circleColor }}"
                     title="{{ $item->color->label() }}">
                </div>

            </div>

            {{-- Contenu de la carte --}}
            <div class="space-y-3 p-5">

                <p class="text-xs text-slate-500">
                    N° {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                    · Trouvé le {{ $item->found_on->format('d/m/Y') }}
                </p>

                <h2 class="min-h-12 text-lg font-bold text-slate-900">

                    <a href="{{ route('items.show', $item) }}"
                       class="hover:text-[#07558e] hover:underline">
                        {{ $item->name }}
                    </a>

                </h2>

                {{-- Couleur et étiquettes --}}
                <div class="flex flex-wrap items-center gap-2">

                    <x-badge :color="$item->color->badgeClasses()">
                        {{ $item->color->label() }}
                    </x-badge>

                    @foreach ($item->tags as $tag)
                        <x-badge>
                            {{ $tag->name }}
                        </x-badge>
                    @endforeach

                </div>

            </div>

        </article>

    @empty

        <p class="col-span-full rounded-xl bg-white p-6 text-center text-slate-600">
            Aucun objet ne correspond à votre recherche.
        </p>

    @endforelse

</div>

</x-layouts.app>
