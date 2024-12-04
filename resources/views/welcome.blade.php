<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Knihovna</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-black dark:text-white">

<div class="min-h-screen flex flex-col justify-center items-center">
    <div class="w-full max-w-2xl px-6 py-12">
        <header class="flex justify-between items-center py-6">
            <h1 class="text-3xl font-semibold text-black dark:text-white">Knihovna</h1>
            <nav class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-black dark:text-white hover:text-[#FF2D20]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-black dark:text-white hover:text-[#FF2D20]">Přihlásit se</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-black dark:text-white hover:text-[#FF2D20]">Registrovat se</a>
                    @endif
                @endauth
            </nav>
        </header>

        <!-- Hlavní obsah -->
        <main class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-zinc-900">
                <h2 class="text-xl font-semibold text-black dark:text-white">Vyhledávání knih</h2>
                <form action="{{ route('books.index') }}" method="GET" class="mt-4">
                    <input type="text" name="query" placeholder="Hledejte knihu..." class="w-full p-2 border rounded-md dark:bg-zinc-800 dark:text-white" value="{{ request('query') }}">
                    <button type="submit" class="w-full mt-2 py-2 bg-[#FF2D20] text-white rounded-md">Vyhledat</button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md dark:bg-zinc-900">
                <h2 class="text-xl font-semibold text-black dark:text-white">Pro administrátory</h2>
                <p class="mt-4 text-gray-600 dark:text-white/70">Pokud jste administrátor, můžete spravovat knihy, autory a uživatele.</p>
                <a href="{{ route('admin.books.index') }}" class="mt-4 block text-[#FF2D20] hover:underline">Správa knih</a>
            </div>
        </main>
    </div>

    <footer class="py-6 text-center text-sm text-black dark:text-white/70 w-full">
        Laravel Knihovna | Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</div>

</body>
</html>
