
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perdu de vue</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#faf7f1] text-slate-900">

    {{-- En-tête du site --}}
    <header class="border-b-4 border-orange-500 bg-[#07558e] text-white">

        <nav class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-5 px-6 py-4">

            {{-- Logo et nom du site --}}
            <a href="{{ route('items.index') }}"
               class="flex items-center gap-3">

                <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-2xl text-blue-800 shadow-sm">
                    &#128188;
                </span>

                <span>
                    <span class="block text-xl font-bold">
                        Perdu de vue
                    </span>

                    <span class="block text-xs font-semibold uppercase tracking-wide text-blue-100">
                        Objets trouvés · Gare de Wavre
                    </span>
                </span>

            </a>

            {{-- Navigation principale --}}
            <div class="flex flex-wrap items-center gap-3 text-sm font-semibold">

                <a href="{{ route('items.index') }}"
                   class="rounded-lg px-4 py-2 transition hover:bg-white/15">
                    Objets
                </a>

                <a href="{{ route('items.create') }}"
                   class="rounded-lg px-4 py-2 transition hover:bg-white/15">
                    Ajouter un objet
                </a>

                <a href="{{ route('styleguide') }}"
                   class="rounded-lg px-4 py-2 transition hover:bg-white/15">
                    Composants
                </a>

            </div>

        </nav>

    </header>

    {{-- Contenu des pages --}}
    <main class="mx-auto max-w-7xl px-6 py-10">

        @if (session('success'))
            <div role="status"
                 class="mb-6 rounded-lg border border-green-300 bg-green-100 p-4 font-semibold text-green-800">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}

    </main>

    {{-- Pied de page --}}
    <footer class="mt-12 border-t border-stone-200 bg-[#f4efe6] px-6 py-6">

        <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 text-sm text-slate-600">

            <p>
                Perdu de vue · Bureau des objets trouvés de la gare de Wavre
            </p>

            <a href="{{ route('styleguide') }}"
               class="underline hover:text-blue-800">
                Les composants du site
            </a>

        </div>

    </footer>

</body>

</html>
