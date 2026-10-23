<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perdu de vue</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

    <header class="bg-blue-800 p-5 text-white">
        <nav>
            <a href="{{ route('items.index') }}"
               class="text-xl font-bold">
                Perdu de vue
            </a>
        </nav>
    </header>

   <main class="mx-auto max-w-6xl p-6">

    @if (session('success'))
        <div role="status"
             class="mb-6 rounded-lg border border-green-300 bg-green-100 p-4 font-semibold text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{ $slot }}

</main>

</body>
</html>
