<!-- resources/views/admin/books/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold">Upravit knihu</h1>

        <form method="POST" action="{{ route('admin.books.update', $book->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block">Název knihy</label>
                <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}" class="w-full p-2 border rounded" required />
            </div>

            <div class="mb-4">
                <label for="author_id" class="block">Autor</label>
                <select name="author_id" id="author_id" class="w-full p-2 border rounded" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block">Popis knihy</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded">{{ old('description', $book->description) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Uložit změny</button>
        </form>
    </div>
@endsection
