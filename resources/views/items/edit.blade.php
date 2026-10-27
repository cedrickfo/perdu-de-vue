
<x-layouts.app>

    {{-- Retour à la fiche --}}
    <a href="{{ route('items.show', $item) }}"
       class="mb-6 inline-block font-semibold text-[#07558e] hover:underline">
        ← Retour à la fiche de l'objet
    </a>

    {{-- Présentation --}}
    <section class="mb-8">

        <p class="mb-2 text-sm font-bold uppercase tracking-widest text-orange-700">
            Bureau des objets trouvés
        </p>

        <h1 class="mb-3 text-4xl font-extrabold text-[#07558e]">
            Modifier un objet trouvé
        </h1>

        <p class="text-slate-600">
            Modifiez les informations de l'objet
            « {{ $item->name }} ».
        </p>

    </section>

    {{-- Formulaire de modification --}}
    <form method="POST"
          action="{{ route('items.update', $item) }}"
          class="overflow-hidden rounded-2xl border border-stone-200 bg-white shadow-sm">

        @csrf
        @method('PUT')

        {{-- En-tête du formulaire --}}
        <div class="border-b border-stone-200 bg-[#f5f0e7] px-6 py-5">

            <h2 class="text-xl font-bold text-[#07558e]">
                Informations de l'objet
            </h2>

            <p class="mt-1 text-sm text-slate-600">
                Objet n° {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                · Les champs marqués d'un * sont obligatoires.
            </p>

        </div>

        <div class="space-y-7 p-6">

            {{-- Nom --}}
            <div>
                <x-label for="name">Nom de l'objet *</x-label>

                <x-input id="name"
                         name="name"
                         type="text"
                         :value="old('name', $item->name)" />

                @error('name')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <x-label for="description">Description</x-label>

                <x-textarea id="description"
                            name="description">{{ old('description', $item->description) }}</x-textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Lieu et couleur --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Lieu --}}
                <div>
                    <x-label for="place_id">Lieu de découverte *</x-label>

                    <select id="place_id"
                            name="place_id"
                            class="w-full rounded-lg border border-slate-300 bg-white p-3 focus:border-blue-600 focus:outline-none">

                        <option value="">Choisir un lieu</option>

                        @foreach ($places as $place)
                            <option value="{{ $place->id }}"
                                @selected(old('place_id', $item->place_id) == $place->id)>
                                {{ $place->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('place_id')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Couleur --}}
                <div>
                    <x-label for="color">Couleur *</x-label>

                    <select id="color"
                            name="color"
                            class="w-full rounded-lg border border-slate-300 bg-white p-3 focus:border-blue-600 focus:outline-none">

                        <option value="">Choisir une couleur</option>

                        @foreach ($colors as $color)
                            <option value="{{ $color->value }}"
                                @selected(old('color', $item->color->value) === $color->value)>
                                {{ $color->label() }}
                            </option>
                        @endforeach

                    </select>

                    @error('color')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            {{-- Date --}}
            <div class="md:w-1/2">
                <x-label for="found_on">Date de découverte *</x-label>

                <x-input id="found_on"
                         name="found_on"
                         type="date"
                         :value="old('found_on', $item->found_on->format('Y-m-d'))" />

                @error('found_on')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Étiquettes --}}
            <fieldset class="rounded-xl border border-stone-200 bg-[#faf7f1] p-5">

                <legend class="px-2 font-bold text-[#07558e]">
                    Étiquettes
                </legend>

                <p class="mb-4 text-sm text-slate-600">
                    Sélectionnez les étiquettes correspondant à l'objet.
                    Plusieurs choix sont possibles.
                </p>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($tags as $tag)

                        <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-stone-200 bg-white p-3 transition hover:border-blue-400">

                            <input type="checkbox"
                                   name="tags[]"
                                   value="{{ $tag->id }}"
                                   class="h-4 w-4 accent-blue-700"
                                   @checked(in_array($tag->id, old('tags', $item->tags->pluck('id')->all())))>

                            <span class="text-sm font-medium text-slate-800">
                                {{ $tag->name }}
                            </span>

                        </label>

                    @endforeach

                </div>

                @error('tags')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                @error('tags.*')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </fieldset>

        </div>

        {{-- Boutons --}}
        <div class="flex flex-wrap items-center gap-4 border-t border-stone-200 bg-[#f5f0e7] px-6 py-5">

            <x-button variant="secondary" type="submit">
    Enregistrer les modifications
</x-button>
            <a href="{{ route('items.show', $item) }}"
               class="rounded-xl border border-stone-300 bg-white px-7 py-3 font-semibold text-slate-700 transition hover:bg-stone-100">
                Annuler
            </a>

        </div>

    </form>

</x-layouts.app>
