<!-- resources/views/admin/books/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold">Seznam knih</h1>

        @if(session('success'))
            <div class="alert alert-success mt-4 p-4 bg-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.books.create') }}" class="bg-blue-500 text-white p-2 rounded mb-4 inline-block">Přidat novou knihu</a>

        <table class="min-w-full mt-4 border-collapse">
            <thead>
            <tr>
                <th class="border p-2">Název</th>
                <th class="border p-2">Autor</th>
                <th class="border p-2">Popis</th>
                <th class="border p-2">Akce</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td class="border p-2">{{ $book->title }}</td>
                    <td class="border p-2">{{ $book->author->name }}</td>
                    <td class="border p-2">{{ Str::limit($book->description, 50) }}</td>
                    <td class="border p-2">
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-500">Upravit</a>
                        <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Smazat</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
