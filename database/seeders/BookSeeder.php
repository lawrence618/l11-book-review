<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::factory(50)->create()->each(function ($book) {
                $numReviews = random_int(5, 30);

                Review::factory()->count($numReviews)
                    ->good()
                    ->for($book)
                    ->create();
        });
        
        Book::factory(50)->create()->each(function ($book) {
                $numReviews = random_int(5, 30);

                Review::factory()->count($numReviews)
                    ->average()
                    ->for($book)
                    ->create();
        });
        
        Book::factory(50)->create()->each(function ($book) {
                $numReviews = random_int(5, 30);

                Review::factory()->count($numReviews)
                    ->bad()
                    ->for($book)
                    ->create();
        });

    }
}