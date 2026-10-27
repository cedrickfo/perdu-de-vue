
<x-layouts.app>

    {{-- Retour à la liste principale --}}
    <a href="{{ route('items.index') }}"
       class="mb-6 inline-flex items-center gap-2 font-semibold text-[#07558e] hover:underline">
        ← Retour à la liste des objets
    </a>

    {{-- Présentation du lieu --}}
    <section class="mb-8">

        <p class="mb-2 text-sm font-bold uppercase tracking-widest text-orange-700">
            Bureau des objets trouvés
        </p>

        <h1 class="mb-3 text-4xl font-extrabold text-[#07558e]">
            {{ $place->name }}
        </h1>

        <p class="text-slate-600">
            Retrouvez les objets trouvés dans ce lieu,
            y compris ceux déjà restitués.
        </p>

        <div class="mt-5 inline-flex items-center gap-3 rounded-xl bg-[#003b64] px-6 py-4 text-white shadow-sm">

            <span class="text-3xl font-extrabold">
                {{ $place->items->count() }}
            </span>

            <span class="text-xs font-bold uppercase tracking-wide">
                Objets trouvés
            </span>

        </div>

    </section>

    {{-- Liste des objets du lieu --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        @forelse ($place->items as $item)

            <article class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                {{-- En-tête de la carte --}}
                <div class="flex items-center justify-between gap-3 border-b border-stone-200 bg-[#f5f0e7] p-4">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-wide text-stone-500">
                            Objet trouvé
                        </p>

                        <p class="text-sm font-bold text-[#07558e]">
                            N° {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>

                    {{-- Couleur --}}
                    <x-badge :color="$item->color->badgeClasses()">
                        {{ $item->color->label() }}
                    </x-badge>

                </div>

                {{-- Contenu --}}
                <div class="space-y-4 p-5">

                    <p class="text-xs text-slate-500">
                        Trouvé le
                        {{ $item->found_on->locale('fr')->isoFormat('D MMMM YYYY') }}
                    </p>

                    <h2 class="text-lg font-bold text-slate-900">
                        <a href="{{ route('items.show', $item) }}"
                           class="hover:text-[#07558e] hover:underline">
                            {{ $item->name }}
                        </a>
                    </h2>

                    {{-- Étiquettes --}}
                    <div class="flex flex-wrap gap-2">

                        @foreach ($item->tags as $tag)
                            <x-badge>{{ $tag->name }}</x-badge>
                        @endforeach

                    </div>

                    {{-- État de restitution --}}
                    @if ($item->isReturned())

                        <div class="rounded-lg bg-green-50 px-4 py-3 text-sm font-semibold text-green-800">
                            ✓ Restitué le
                            {{ $item->returned_at->locale('fr')->isoFormat('D MMMM YYYY') }}
                        </div>

                    @else

                        <div class="rounded-lg bg-orange-50 px-4 py-3 text-sm font-semibold text-orange-800">
                            En attente de restitution
                        </div>

                    @endif

                </div>

            </article>

        @empty

            <p class="col-span-full rounded-xl border border-stone-200 bg-white p-6 text-center text-slate-600">
                Aucun objet trouvé dans ce lieu.
            </p>

        @endforelse

    </div>

</x-layouts.app>
