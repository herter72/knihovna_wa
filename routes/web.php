<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Trasa pro welcome stránku (public page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Trasa pro zobrazení přihlašovacího formuláře
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Trasa pro zpracování přihlášení
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Routa pro odhlášení uživatele
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// Trasa pro zobrazení registračního formuláře
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

// Trasa pro zpracování registrace
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Trasa pro zobrazení profilu
Route::middleware('auth')->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

// Trasa pro aktualizaci profilu
Route::middleware('auth')->patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Trasa pro smazání profilu
Route::middleware('auth')->delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Trasy pro knihy
Route::get('/api/books', [BookController::class, 'index'])->name('books.index'); // Seznam knih
Route::get('/api/books/{id}', [BookController::class, 'show'])->name('books.show'); // Detaily knihy
Route::post('/api/books/{id}/reserve', [ReservationController::class, 'reserve'])->name('books.reserve'); // Rezervace knihy


// Trasy pro knihy (ne-API verze)
Route::get('/books', [BookController::class, 'index'])->name('books.index'); // Seznam knih
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show'); // Detaily knihy
Route::post('/books/{id}/reserve', [ReservationController::class, 'reserve'])->name('books.reserve'); // Rezervace knihy


// Skupina rout pro rezervace, chráněná middlewarem 'auth'
Route::middleware(['auth'])->group(function () {

    // Rezervace knihy
    Route::post('/books/{id}/reserve', [ReservationController::class, 'reserve'])->name('books.reserve');

    // Vrácení knihy
    Route::post('/reservations/{reservationId}/return', [ReservationController::class, 'returnBook'])->name('reservations.return');

    // Zobrazení všech rezervací uživatele
    Route::get('/reservations', [ReservationController::class, 'myReservations'])->name('reservations.index');

});


// Trasy pro administraci knih pro adminy
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/books', [AdminBookController::class, 'index'])->name('admin.books.index'); // Zobrazit všechny knihy
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('admin.books.create'); // Zobrazit formulář pro přidání knihy
    Route::post('/books', [AdminBookController::class, 'store'])->name('admin.books.store'); // Přidat novou knihu
    Route::get('/books/{id}/edit', [AdminBookController::class, 'edit'])->name('admin.books.edit'); // Editovat knihu
    Route::put('/books/{id}', [AdminBookController::class, 'update'])->name('admin.books.update'); // Aktualizovat knihu
    Route::delete('/books/{id}', [AdminBookController::class, 'destroy'])->name('admin.books.destroy'); // Smazat knihu
});


// Trasy pro administraci autorů pro adminy
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/api/authors', [AdminAuthorController::class, 'index'])->name('authors.index'); // Seznam autorů
    Route::post('/api/authors', [AdminAuthorController::class, 'store'])->name('authors.store'); // Přidat autora
    Route::get('/api/authors/{id}/edit', [AdminAuthorController::class, 'edit'])->name('authors.edit'); // Upravit autora
    Route::put('/api/authors/{id}', [AdminAuthorController::class, 'update'])->name('authors.update'); // Aktualizovat autora
    Route::delete('/api/authors/{id}', [AdminAuthorController::class, 'destroy'])->name('authors.destroy'); // Smazat autora
});


