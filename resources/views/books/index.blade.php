@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-100">Seznam knih</h1>

        <!-- Vyhledávací formulář -->
        <form method="GET" action="{{ route('books.index') }}" class="mb-8 flex justify-center">
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Hledat knihy nebo autory..."
                   class="px-4 py-2 rounded-lg border border-gray-500 bg-gray-700 text-white w-full sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-200">
                Hledat
            </button>
        </form>

        <!-- Seznam knih -->
        @foreach($books as $book)
            <div class="book-card p-6 bg-gray-700 mb-6 rounded-lg shadow-lg hover:shadow-xl transition duration-200">
                <h3 class="text-2xl font-semibold text-gray-200">{{ $book->title }}</h3>
                <p class="text-lg text-gray-400">Autor: {{ $book->author->name }}</p>
                <p class="text-gray-300 mt-2">{{ $book->description }}</p>

                <!-- Kontrola, zda je uživatel přihlášený a zda je kniha dostupná pro rezervaci -->
                @auth
                    @if($book->stock > 0)
                        <form action="{{ route('books.reserve', $book->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-500 transition duration-200">Rezervovat knihu</button>
                        </form>
                    @else
                        <p class="text-red-500 mt-4">Tato kniha není dostupná pro rezervaci.</p>
                    @endif
                @endauth

                @guest
                    <p class="text-yellow-400 mt-4">Pro rezervaci knihy se musíte přihlásit.</p>
                @endguest
            </div>
        @endforeach

        <!-- Stránkování výsledků vyhledávání -->
        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
@endsection
