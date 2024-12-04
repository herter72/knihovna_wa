<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author_id' => Author::inRandomOrder()->first()->id, // Náhodně přiřazení autora
            'description' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(1, 20),
        ];
    }
}
