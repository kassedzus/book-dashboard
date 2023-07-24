<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $authors = Author::factory(12)->create();

        $books = Book::factory(60)->create();
        $books->each(function ($book) use ($authors) {
            $book->authors()->attach($authors->random(fake()->numberBetween(0, 2)));
        });

        Order::factory(1000)->state(new Sequence(
            fn (Sequence $sequence) => [
                'book_id' => $books->random(),
                'date' => fake()->dateTimeThisYear
            ]
        ))->create();
    }
}
