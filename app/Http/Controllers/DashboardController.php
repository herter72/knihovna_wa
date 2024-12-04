<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
// Získání statistik
        $totalBooks = Book::count();
        $totalReservations = Reservation::count();
        $totalUsers = User::count();

// Vrácení pohledu s těmito daty
        return view('dashboard', compact('totalBooks', 'totalReservations', 'totalUsers'));
    }
}
