@extends('layouts.admin')

@section('content')
    <h2 class="mt-4">Seznam autorů</h2>

    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Přidat nového autora
    </a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Jméno autora</th>
            <th scope="col">Akce</th>
        </tr>
        </thead>
        <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>
                    <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editovat
                    </a>
                    <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Smazat
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
