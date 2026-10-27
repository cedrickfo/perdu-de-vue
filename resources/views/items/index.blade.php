
<x-layouts.app>

    {{-- Présentation de la page --}}
<section class="mb-8 flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        {{-- Titre et description --}}
        <div class="min-w-0 flex-1">

            <p class="mb-2 text-sm font-bold uppercase tracking-widest text-orange-700">
                Bureau des objets trouvés
            </p>

            <h1 class="mb-3 text-3xl font-extrabold tracking-tight text-[#07558e] sm:text-4xl lg:text-5xl">Ils attendent leur propriétaire</h1>

            <p class="text-base text-slate-600">
                Les objets ramassés dans le hall, sur les quais et dans les trains.
                Retrouvez-les grâce aux filtres et à la recherche.
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

    {{-- Formulaire de recherche, filtres et tri --}}
    <form method="GET"
          action="{{ route('items.index') }}"
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

        {{-- Filtre par lieu --}}
        <div class="min-w-44 flex-1">

            <label for="lieu" class="mb-2 block font-semibold">
                Lieu
            </label>

            <select name="lieu"
                    id="lieu"
                    class="w-full rounded-lg border border-slate-300 bg-white p-3">

                <option value="">Tous les lieux</option>

                @foreach ($places as $place)
                    <option value="{{ $place->id }}"
                        @selected(request('lieu') == $place->id)>
                        {{ $place->name }}
                    </option>
                @endforeach

            </select>

        </div>

        {{-- Filtre par couleur --}}
        <div class="min-w-44 flex-1">

            <label for="couleur" class="mb-2 block font-semibold">
                Couleur
            </label>

            <select name="couleur"
                    id="couleur"
                    class="w-full rounded-lg border border-slate-300 bg-white p-3">

                <option value="">Toutes les couleurs</option>

                @foreach (\App\Enums\Color::cases() as $color)
                    <option value="{{ $color->value }}"
                        @selected(request('couleur') === $color->value)>
                        {{ $color->label() }}
                    </option>
                @endforeach

            </select>

        </div>

        {{-- Tri des objets --}}
        <div class="min-w-44 flex-1">

            <label for="tri" class="mb-2 block font-semibold">
                Trier par
            </label>

            <select name="tri"
                    id="tri"
                    class="w-full rounded-lg border border-slate-300 bg-white p-3">

                <option value="date"
                    @selected(request('tri', 'date') === 'date')>
                    Date (plus récent)
                </option>

                <option value="nom"
                    @selected(request('tri') === 'nom')>
                    Nom (A à Z)
                </option>

            </select>

        </div>

        {{-- Bouton de filtrage --}}
        <x-button type="submit" variant="primary">
            Filtrer
        </x-button>

    </form>

    {{-- Liste des objets avec le composant réutilisable --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        @forelse ($items as $item)

            <x-item-card :item="$item" />

        @empty

            <p class="col-span-full rounded-xl border border-stone-200 bg-white p-6 text-center text-slate-600">
                Aucun objet ne correspond à votre recherche.
            </p>

        @endforelse

    </div>

</x-layouts.app>
