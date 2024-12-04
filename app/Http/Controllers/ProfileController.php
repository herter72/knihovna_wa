<?php

// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
// Zobrazí formulář pro úpravu profilu
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

// Aktualizuje profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('profile.edit')->with('status', 'Profil byl úspěšně aktualizován.');
    }

// Smaže uživatelský profil
    public function destroy()
    {
        Auth::user()->delete();

        return redirect()->route('welcome')->with('status', 'Váš účet byl smazán.');
    }
}
