<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
// Metoda pro zobrazení seznamu knih
    public function index(Request $request)
    {
// Získání hodnoty vyhledávacího dotazu
        $query = $request->input('query');

// Získání knih podle názvu nebo autora
        $books = Book::with('author')
            ->where('title', 'like', "%$query%")
            ->orWhereHas('author', function ($query) use ($request) {
// Opravený dotaz pro hledání autora
                $authorQuery = $request->input('query');
                $query->where('name', 'like', "%$authorQuery%");
            })
            ->paginate(10); // Stránkování výsledků

        return view('books.index', compact('books'));
    }

// Metoda pro zobrazení detailů konkrétní knihy
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return view('books.show', compact('book'));
    }

// Metoda pro vytvoření nové knihy (pro admina)
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Kniha byla úspěšně přidána.');
    }

// Metoda pro aktualizaci existující knihy (pro admina)
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Kniha byla úspěšně aktualizována.');
    }

// Metoda pro smazání knihy (pro admina)
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Kniha byla úspěšně smazána.');
    }
}
