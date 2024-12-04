<!-- resources/views/admin/books/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold">Přidat novou knihu</h1>

        <form method="POST" action="{{ route('admin.books.store') }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="block">Název knihy</label>
                <input type="text" name="title" id="title" class="w-full p-2 border rounded" required />
            </div>

            <div class="mb-4">
                <label for="author_id" class="block">Autor</label>
                <select name="author_id" id="author_id" class="w-full p-2 border rounded" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block">Popis knihy</label>
                <textarea name="description" id="description" class="w-full p-2 border rounded"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Uložit knihu</button>
        </form>
    </div>
@endsection
