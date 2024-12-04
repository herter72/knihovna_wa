<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Zkontrolujeme, jestli existují autoři
        $authorsCount = Author::count();
        if ($authorsCount == 0) {
            // Pokud nejsou žádní autoři, vypíše varování a přeruší se spuštění seedu
            $this->command->info('Není žádný autor v databázi. Nejprve musíte spustit AuthorSeeder.');
            return;
        }

        // Vytvoříme knihy
        for ($i = 0; $i < 10; $i++) {
            $author = Author::inRandomOrder()->first(); // Náhodně vybereme autora

            Book::create([
                'title' => $faker->sentence(3), // Generuje náhodný název knihy
                'author_id' => $author->id, // Přiřadí autora
                'description' => $faker->paragraph, // Generuje popis knihy
                'stock' => $faker->numberBetween(1, 20), // Generuje počet knih (sklad)
            ]);
        }
    }
}
