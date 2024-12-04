<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
// Konstruktor pro middleware
    public function __construct()
    {
        $this->middleware('auth');  // Tento řádek zajistí, že všechny metody kontroléru budou chráněny middlewarem 'auth'
    }

// Zobrazení všech rezervací přihlášeného uživatele
    public function myReservations()
    {
// Získání všech rezervací přihlášeného uživatele
        $reservations = Reservation::where('user_id', Auth::id())
            ->with('book') // Načte knihy, které byly rezervovány
            ->orderBy('reserved_at', 'desc') // Seřadí rezervace podle data rezervace
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Rezervace knihy
     */
    public function reserve(Request $request, $id)
    {
// Zkontrolujeme, zda je kniha dostupná pro rezervaci
        $book = Book::findOrFail($id);

        if ($book->stock > 0) {
// Pokud je kniha dostupná, vytvoříme rezervaci
            $reservation = new Reservation();
            $reservation->book_id = $book->id;
            $reservation->user_id = Auth::id();
            $reservation->reserved_at = now();
            $reservation->save();

// Snížíme dostupnost knihy
            $book->decrement('stock');

// Přesměrování na stránku knih s potvrzením úspěšné rezervace
            return redirect()->route('books.index')->with('success', 'Kniha byla úspěšně rezervována.');
        } else {
// Přesměrování zpět na knihy s chybovou hláškou, pokud není dostupná
            return redirect()->route('books.index')->with('error', 'Tato kniha není dostupná pro rezervaci.');
        }
    }

    /**
     * Vrácení knihy
     */
    public function returnBook($reservationId)
    {
// Získání rezervace podle ID
        $reservation = Reservation::findOrFail($reservationId);

// Zkontrolujeme, zda je uživatel ten, kdo vytvořil rezervaci
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('reservations.index')->with('error', 'Nemůžete vrátit tuto knihu.');
        }

// Vrácení knihy
        $reservation->returned_at = now();
        $reservation->save();

// Zvýšení dostupnosti knihy
        $reservation->book->increment('stock');

// Přesměrování na seznam rezervací s potvrzením úspěšného vrácení
        return redirect()->route('reservations.index')->with('success', 'Kniha byla úspěšně vrácena.');
    }
}
