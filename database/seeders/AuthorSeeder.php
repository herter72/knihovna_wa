<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Vytvoření instance Faker pro generování náhodných dat
        $faker = Faker::create();

        // Vytvoření několika autorů s náhodnými jmény a biografiemi
        foreach (range(1, 10) as $index) {
            Author::create([
                'name' => $faker->name, // Generuje náhodné jméno autora
                'biography' => $faker->paragraph, // Generuje náhodnou biografii autora
            ]);
        }
    }
}
