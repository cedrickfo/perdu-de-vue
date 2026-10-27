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

{{-- Présentation du composant Card --}}
<section class="mt-8">
    <h2 class="mb-4 text-xl font-bold text-[#07558e]">
        Composant Card
    </h2>

    <x-card title="Objet trouvé">
        <p class="text-slate-700">
            Un sac à dos a été trouvé à la gare de Wavre.
        </p>
    </x-card>
</section>



{{-- Palette de couleurs du projet --}}
<section class="mt-10">

    <h2 class="mb-3 text-2xl font-bold text-[#07558e]">
        Palette de couleurs
    </h2>

    <p class="mb-6 text-slate-600">
        Les couleurs utilisées dans l'interface Perdu de vue.
    </p>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">

        {{-- Bleu principal --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg bg-[#07558e]"></div>
            <h3 class="font-bold">Bleu principal</h3>
            <p class="text-sm text-slate-600">#07558e</p>
            <p class="mt-1 text-sm text-slate-500">
                En-tête, titres et boutons principaux.
            </p>
        </x-card>

        {{-- Orange --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg bg-orange-500"></div>
            <h3 class="font-bold">Orange</h3>
            <p class="text-sm text-slate-600">#f97316</p>
            <p class="mt-1 text-sm text-slate-500">
                Actions importantes et navigation active.
            </p>
        </x-card>

        {{-- Beige --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg border border-stone-200 bg-[#faf7f1]"></div>
            <h3 class="font-bold">Beige clair</h3>
            <p class="text-sm text-slate-600">#faf7f1</p>
            <p class="mt-1 text-sm text-slate-500">
                Arrière-plan général du site.
            </p>
        </x-card>

        {{-- Blanc --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg border border-stone-200 bg-white"></div>
            <h3 class="font-bold">Blanc</h3>
            <p class="text-sm text-slate-600">#ffffff</p>
            <p class="mt-1 text-sm text-slate-500">
                Cartes et formulaires.
            </p>
        </x-card>

        {{-- Vert --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg bg-green-700"></div>
            <h3 class="font-bold">Vert</h3>
            <p class="text-sm text-slate-600">green-700</p>
            <p class="mt-1 text-sm text-slate-500">
                Confirmation et restitution des objets.
            </p>
        </x-card>

        {{-- Rouge --}}
        <x-card>
            <div class="mb-3 h-20 rounded-lg bg-red-700"></div>
            <h3 class="font-bold">Rouge</h3>
            <p class="text-sm text-slate-600">red-700</p>
            <p class="mt-1 text-sm text-slate-500">
                Suppression et erreurs de validation.
            </p>
        </x-card>

    </div>

</section>


{{-- Présentation des variantes du composant Button --}}
<section class="mt-10">

    <h2 class="mb-3 text-2xl font-bold text-[#07558e]">
        Variantes des boutons
    </h2>

    <p class="mb-6 text-slate-600">
        Les boutons réutilisables utilisés dans l'application.
    </p>

    <x-card>
        <div class="flex flex-wrap items-center gap-4">

            <x-button variant="primary">
                Principal
            </x-button>

            <x-button variant="secondary">
                Secondaire
            </x-button>

            <x-button variant="success">
                Confirmation
            </x-button>

            <x-button variant="danger">
                Suppression
            </x-button>

        </div>
    </x-card>

</section>


</x-layouts.app>
