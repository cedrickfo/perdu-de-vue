
<x-layouts.app>

    <a href="{{ route('items.index') }}"
       class="text-blue-700 hover:underline">
        ← Retour à la liste
    </a>

    <h1 class="mb-6 mt-6 text-3xl font-bold text-blue-900">
        Ajouter un objet trouvé
    </h1>

    <form method="POST" action="{{ route('items.store') }}"
          class="space-y-6 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        @csrf

        {{-- Nom de l'objet --}}
        <div>
            <x-label for="name">Nom de l'objet</x-label>
            <x-input id="name" name="name" type="text"
                     :value="old('name')" />

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <x-label for="description">Description</x-label>
            <x-textarea id="description" name="description">{{ old('description') }}</x-textarea>

            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lieu --}}
        <div>
            <x-label for="place_id">Lieu de découverte</x-label>

            <select id="place_id" name="place_id"
                    class="w-full rounded-lg border border-slate-300 p-3">
                <option value="">Choisir un lieu</option>

                @foreach ($places as $place)
                    <option value="{{ $place->id }}"
                        @selected(old('place_id') == $place->id)>
                        {{ $place->name }}
                    </option>
                @endforeach
            </select>

            @error('place_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Couleur --}}
        <div>
            <x-label for="color">Couleur</x-label>

            <select id="color" name="color"
                    class="w-full rounded-lg border border-slate-300 p-3">
                <option value="">Choisir une couleur</option>

                @foreach ($colors as $color)
                    <option value="{{ $color->value }}"
                        @selected(old('color') === $color->value)>
                        {{ $color->label() }}
                    </option>
                @endforeach
            </select>

            @error('color')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Date de découverte --}}
        <div>
            <x-label for="found_on">Date de découverte</x-label>

            <x-input id="found_on" name="found_on" type="date"
                     :value="old('found_on')" />

            @error('found_on')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Étiquettes --}}
        <fieldset>
            <legend class="mb-3 font-semibold">Étiquettes</legend>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                @foreach ($tags as $tag)
                    <label class="flex items-center gap-2">
                        <input type="checkbox"
                               name="tags[]"
                               value="{{ $tag->id }}"
                               @checked(in_array($tag->id, old('tags', [])))>
                        {{ $tag->name }}
                    </label>
                @endforeach
            </div>

            @error('tags')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </fieldset>

        <button type="submit"
                class="rounded-lg bg-blue-700 px-6 py-3 font-semibold text-white transition hover:bg-blue-900">
            Enregistrer l'objet
        </button>

    </form>

</x-layouts.app>
