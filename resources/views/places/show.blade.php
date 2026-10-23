
<x-layouts.app>

    <a href="{{ route('items.index') }}"
       class="text-blue-700 hover:underline">
        ← Retour à la liste
    </a>

    <h1 class="mb-3 mt-6 text-3xl font-bold text-blue-900">
        {{ $place->name }}
    </h1>

    <p class="mb-6 text-slate-600">
        {{ $place->items->count() }} objet(s) trouvé(s) dans ce lieu
    </p>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        @forelse ($place->items as $item)

            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

                <p class="mb-2 text-sm text-slate-500">
                    Trouvé le {{ $item->found_on->format('d/m/Y') }}
                </p>

                <h2 class="mb-3 text-lg font-bold">
                    <a href="{{ route('items.show', $item) }}"
                       class="hover:text-blue-700 hover:underline">
                        {{ $item->name }}
                    </a>
                </h2>

                <div class="mb-3">
                    <x-badge :color="$item->color->badgeClasses()">
                        {{ $item->color->label() }}
                    </x-badge>
                </div>

                <div class="mb-4 flex flex-wrap gap-2">
                    @foreach ($item->tags as $tag)
                        <x-badge>{{ $tag->name }}</x-badge>
                    @endforeach
                </div>

                @if ($item->isReturned())
                    <p class="font-semibold text-green-700">
                        Restitué le {{ $item->returned_at->format('d/m/Y') }}
                    </p>
                @else
                    <p class="font-semibold text-orange-600">
                        En attente de restitution
                    </p>
                @endif

            </article>

        @empty

            <p class="text-slate-600">
                Aucun objet trouvé dans ce lieu.
            </p>

        @endforelse

    </div>

</x-layouts.app>
