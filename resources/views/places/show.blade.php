
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

        <x-item-card :item="$item" />

    @empty

        <p class="col-span-full rounded-xl border border-stone-200 bg-white p-6 text-center text-slate-600">
            Aucun objet trouvé dans ce lieu.
        </p>

    @endforelse

</div>

</x-layouts.app>
