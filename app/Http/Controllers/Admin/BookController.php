<?php
// app/Http/Controllers/Admin/BookController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Jen pro adminy
    }

// Zobrazení seznamu knih pro administrátora
    public function index()
    {
// Získání všech knih, včetně jejich autorů
        $books = Book::with('author')->get();
        return view('admin.books.index', compact('books')); // Vrátí seznam knih do Blade šablony
    }

// Formulář pro vytvoření nové knihy
    public function create()
    {
        $authors = Author::all(); // Získání seznamu autorů pro výběr v dropdownu
        return view('admin.books.create', compact('authors'));
    }

// Uložení nové knihy
    public function store(Request $request)
    {
// Validace vstupu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
        ]);

// Uložení knihy
        $book = Book::create($validated);
        return redirect()->route('admin.books.index')->with('success', 'Kniha byla úspěšně přidána.');
    }

// Zobrazení formuláře pro editaci knihy
    public function edit($id)
    {
        $book = Book::findOrFail($id); // Získání knihy podle ID
        $authors = Author::all(); // Získání seznamu autorů pro výběr
        return view('admin.books.edit', compact('book', 'authors'));
    }

// Uložení změn při editaci knihy
    public function update(Request $request, $id)
    {
// Validace vstupu
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
        ]);

// Aktualizace knihy
        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Kniha byla úspěšně aktualizována.');
    }

// Smazání knihy
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Kniha byla úspěšně smazána.');
    }
}
