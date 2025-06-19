<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'Harry Potter and the Philosopher\'s Stone',
            'author' => 'J.K. Rowling',
            'published_date' => '1997-06-26',
        ]);

        Book::create([
            'title' => 'The Lord of the Rings',
            'author' => 'J.R.R. Tolkien',
            'published_date' => '1954-07-29',
        ]);
    }
}
