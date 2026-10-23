<x-layouts.app>

    <h1 class="mb-6 text-3xl font-bold text-blue-900">
        Bibliothèque des composants
    </h1>

    <p class="mb-8 text-slate-600">
        Présentation des composants Blade réutilisables du projet Perdu de vue.
    </p>

    <div class="space-y-8 rounded-xl bg-white p-6 shadow-sm">

        {{-- Composant Label --}}
        <section>
            <h2 class="mb-3 text-xl font-bold">1. Label</h2>
            <x-label for="exemple">Nom de l'objet</x-label>
        </section>

        {{-- Composant Input --}}
        <section>
            <h2 class="mb-3 text-xl font-bold">2. Input</h2>
            <x-input id="exemple" name="exemple" type="text"
                     placeholder="Exemple de saisie" />
        </section>

        {{-- Composant Textarea --}}
        <section>
            <h2 class="mb-3 text-xl font-bold">3. Textarea</h2>
            <x-textarea id="description" name="description"
                        placeholder="Description de l'objet"></x-textarea>
        </section>

        {{-- Composant Badge --}}
        <section>
            <h2 class="mb-3 text-xl font-bold">4. Badge</h2>

            <div class="flex flex-wrap gap-3">
                <x-badge>Électronique</x-badge>
                <x-badge color="bg-red-100 text-red-800">Rouge</x-badge>
                <x-badge color="bg-green-100 text-green-800">Vert</x-badge>
                <x-badge color="bg-blue-100 text-blue-800">Bleu</x-badge>
            </div>
        </section>

        {{-- Composant Select --}}
        <section>
            <h2 class="mb-3 text-xl font-bold">5. Select</h2>

            <x-select id="choix" name="choix">
                <option value="">Choisir une option</option>
                <option value="1">Hall</option>
                <option value="2">Quai</option>
                <option value="3">Train</option>
            </x-select>
        </section>

    </div>

</x-layouts.app>
