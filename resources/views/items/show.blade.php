
<x-layouts.app>

    {{-- Retour à la liste --}}
    <a href="{{ route('items.index') }}"
       class="mb-6 inline-flex items-center gap-2 font-semibold text-[#07558e] hover:underline">
        ← Retour à la liste des objets
    </a>

    {{-- En-tête de la fiche --}}
    <section class="mb-8">

        <p class="mb-2 text-sm font-bold uppercase tracking-widest text-orange-700">
            Fiche de l'objet trouvé
        </p>

        <h1 class="mb-3 text-4xl font-extrabold text-[#07558e]">
            {{ $item->name }}
        </h1>

        <p class="text-slate-600">
            Objet n° {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
            · Trouvé le {{ $item->found_on->locale('fr')->isoFormat('D MMMM YYYY') }}
        </p>

    </section>

    {{-- Carte principale --}}
    <article class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">

        {{-- Bandeau supérieur --}}
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-stone-200 bg-[#f5f0e7] px-6 py-5">

            <div>
                <p class="mb-1 text-xs font-bold uppercase tracking-wide text-stone-500">
                    Lieu de découverte
                </p>

                <a href="{{ route('places.show', $item->place) }}"
                   class="text-lg font-bold text-[#07558e] hover:underline">
                    {{ $item->place->name }}
                </a>
            </div>

            {{-- Statut de l'objet --}}
            @if ($item->isReturned())

                <span class="rounded-full bg-green-100 px-4 py-2 text-sm font-bold text-green-800">
                    ✓ Objet restitué
                </span>

            @else

                <span class="rounded-full bg-orange-100 px-4 py-2 text-sm font-bold text-orange-800">
                    En attente de restitution
                </span>

            @endif

        </div>

        {{-- Informations détaillées --}}
        <div class="grid grid-cols-1 gap-8 p-6 md:grid-cols-2">

            {{-- Colonne gauche --}}
            <div class="space-y-6">

                <div>
                    <h2 class="mb-2 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Couleur
                    </h2>

                    <x-badge :color="$item->color->badgeClasses()">
                        {{ $item->color->label() }}
                    </x-badge>
                </div>

                <div>
                    <h2 class="mb-2 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Date de découverte
                    </h2>

                    <p class="font-semibold text-slate-900">
                        {{ $item->found_on->locale('fr')->isoFormat('D MMMM YYYY') }}
                    </p>

                    <p class="mt-1 text-sm text-orange-700">
                        {{ $item->found_on->locale('fr')->diffForHumans() }}
                    </p>
                </div>

                <div>
                    <h2 class="mb-2 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Étiquettes
                    </h2>

                    <div class="flex flex-wrap gap-2">
                        @forelse ($item->tags as $tag)
                            <x-badge>
                                {{ $tag->name }}
                            </x-badge>
                        @empty
                            <p class="text-slate-500">
                                Aucune étiquette.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>

            {{-- Colonne droite --}}
            <div class="space-y-6">

                <div>
                    <h2 class="mb-2 text-sm font-bold uppercase tracking-wide text-slate-500">
                        Description
                    </h2>

                    <p class="whitespace-pre-line leading-relaxed text-slate-700">{{ $item->description ?: 'Aucune description disponible.' }}</p>
                </div>

                <div>
                    <h2 class="mb-2 text-sm font-bold uppercase tracking-wide text-slate-500">
                        État de restitution
                    </h2>

                    @if ($item->isReturned())

                        <p class="font-semibold text-green-700">
                            Restitué le
                            {{ $item->returned_at->locale('fr')->isoFormat('D MMMM YYYY') }}
                        </p>

                    @else

                        <p class="font-semibold text-orange-700">
                            Cet objet attend toujours son propriétaire.
                        </p>

                    @endif
                </div>

            </div>

        </div>

    </article>

    {{-- Actions --}}
    <div class="mt-8 flex flex-wrap items-center gap-4">

        {{-- Modifier --}}
        <a href="{{ route('items.edit', $item) }}"
           class="inline-block rounded-xl bg-orange-500 px-6 py-3 font-semibold text-white shadow-sm transition hover:bg-orange-600">
            Modifier cet objet
        </a>

        {{-- Restituer --}}
        @if (! $item->isReturned())

            <form method="POST" action="{{ route('items.return', $item) }}">
                @csrf
                @method('PATCH')

                <button type="submit"
                        class="rounded-xl bg-green-700 px-6 py-3 font-semibold text-white transition hover:bg-green-800">
                    Marquer comme restitué
                </button>
            </form>

        @endif

        {{-- Supprimer --}}
        <form method="POST"
              action="{{ route('items.destroy', $item) }}"
              onsubmit="return confirm('Voulez-vous vraiment supprimer cet objet ?')">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="rounded-xl bg-red-700 px-6 py-3 font-semibold text-white transition hover:bg-red-800">
                Supprimer cet objet
            </button>

        </form>

    </div>

</x-layouts.app>
