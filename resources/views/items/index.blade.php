
<x-layouts.app>

    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

    <h1 class="text-3xl font-bold text-blue-900">
        Objets trouvés à la gare de Wavre
    </h1>

    <a href="{{ route('items.create') }}"
       class="rounded-lg bg-orange-500 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-orange-600">
        + Ajouter un objet
    </a>

</div>

    <p class="mb-6 text-lg text-slate-600">
        {{ $items->count() }} objets en attente
    </p>

    {{-- Formulaire des filtres --}}
    <form method="GET" action="{{ route('items.index') }}"
        class="mb-8 flex flex-wrap items-end gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

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

            <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition hover:shadow-lg">

                {{-- En-tête de la carte --}}
                <div class="bg-blue-50 p-4">
                    <p class="text-sm font-semibold text-blue-800">
                        {{ $item->place->name }}
                    </p>
                </div>

                {{-- Contenu de la carte --}}
                <div class="space-y-3 p-5">

                    <p class="text-xs text-slate-500">
                        N° {{ $item->id }} · Trouvé le
                        {{ $item->found_on->format('d/m/Y') }}
                    </p>

                    <h2 class="text-lg font-bold text-slate-900">
    <a href="{{ route('items.show', $item) }}"
       class="transition hover:text-blue-700 hover:underline focus-visible:outline-2 focus-visible:outline-blue-700">
        {{ $item->name }}
    </a>
</h2>

                    {{-- Couleur dynamique selon l'enum --}}
                    <div>
                        <x-badge :color="$item->color->badgeClasses()">
                            {{ $item->color->label() }}
                        </x-badge>
                    </div>

                    {{-- Étiquettes --}}
                    <div class="flex flex-wrap gap-2">
                        @foreach ($item->tags as $tag)
                            <x-badge>
                                {{ $tag->name }}
                            </x-badge>
                        @endforeach
                    </div>

                </div>

            </article>

        @empty

            <p class="text-slate-600">
                Aucun objet ne correspond à votre recherche.
            </p>

        @endforelse

    </div>

</x-layouts.app>
