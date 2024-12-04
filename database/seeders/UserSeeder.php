<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Vytvoření instance Faker pro generování náhodných dat
        $faker = Faker::create();

        // Generování hesla pro uživatele
        $plainPassword = 'Password123'; // Vaše heslo v plaintextu

        // Vytvoření jednoho uživatele s heslem v plaintextu
        $user = User::create([
            'name' => 'Jan Chvojka', // Nastavení jména uživatele
            'email' => 'jan@example.com', // Nastavení e-mailu
            'password' => bcrypt($plainPassword), // Heslo zašifrováno pomocí bcrypt
        ]);
    }
}
