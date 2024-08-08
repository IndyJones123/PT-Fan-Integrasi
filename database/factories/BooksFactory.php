<?php

namespace Database\Factories;

use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\Factory;

class BooksFactory extends Factory
{
    protected $model = Books::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'author_id' => \App\Models\User::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'thumbnail' => 'path/to/thumbnail.jpg', // Adjust as needed
        ];
    }
}
