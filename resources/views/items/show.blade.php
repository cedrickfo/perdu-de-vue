<x-layouts.app>

    <a href="{{ route('items.index') }}"
       class="text-blue-700 hover:underline">
        ← Retour à la liste
    </a>

    <article class="mt-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <h1 class="mb-4 text-3xl font-bold text-blue-900">
            {{ $item->name }}
        </h1>

        <div class="space-y-4">

            <p>
                <strong>Numéro :</strong> {{ $item->id }}
            </p>

           <p>
    <strong>Lieu :</strong>

    <a href="{{ route('places.show', $item->place) }}"
       class="font-semibold text-blue-700 hover:underline">
        {{ $item->place->name }}
    </a>
</p>

            <p>
                <strong>Couleur :</strong>
                <x-badge :color="$item->color->badgeClasses()">
                    {{ $item->color->label() }}
                </x-badge>
            </p>

            <p>
                <strong>Date de découverte :</strong>
                {{ $item->found_on->format('d/m/Y') }}
            </p>

            <p>
                <strong>Description :</strong>
                {{ $item->description ?? 'Aucune description.' }}
            </p>

            <div>
                <strong>Étiquettes :</strong>

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

        </div>

    </article>

    <div class="mt-6 flex flex-wrap items-center gap-4">

    <a href="{{ route('items.edit', $item) }}"
       class="inline-block rounded-lg bg-orange-500 px-6 py-3 font-semibold text-white transition hover:bg-orange-600">
        Modifier cet objet
    </a>

    @if (! $item->isReturned())

        <form method="POST" action="{{ route('items.return', $item) }}">
            @csrf
            @method('PATCH')

            <button type="submit"
                    class="rounded-lg bg-green-700 px-6 py-3 font-semibold text-white transition hover:bg-green-800">
                Marquer comme restitué
            </button>
        </form>

    @endif

    <form method="POST"
      action="{{ route('items.destroy', $item) }}"
      onsubmit="return confirm('Voulez-vous vraiment supprimer cet objet ?')">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="rounded-lg bg-red-700 px-6 py-3 font-semibold text-white transition hover:bg-red-800">
        Supprimer cet objet
    </button>

</form>

</div>

</x-layouts.app>
