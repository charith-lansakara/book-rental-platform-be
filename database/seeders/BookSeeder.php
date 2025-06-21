<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'author' => 'J.K. Rowling',
                'published_date' => '1997-06-26',
                'is_available' => 0,
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'published_date' => '1954-07-29',
                'is_available' => 1,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'published_date' => '1960-07-11',
                'is_available' => 1,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'published_date' => '1949-06-08',
                'is_available' => 0,
            ],
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'published_date' => '1925-04-10',
                'is_available' => 1,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'published_date' => '1813-01-28',
                'is_available' => 1,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'published_date' => '1937-09-21',
                'is_available' => 0,
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'published_date' => '1951-07-16',
                'is_available' => 1,
            ],
            [
                'title' => 'Animal Farm',
                'author' => 'George Orwell',
                'published_date' => '1945-08-17',
                'is_available' => 1,
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'published_date' => '2003-04-01',
                'is_available' => 0,
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'published_date' => '1988-05-01',
                'is_available' => 1,
            ],
            [
                'title' => 'The Hunger Games',
                'author' => 'Suzanne Collins',
                'published_date' => '2008-09-14',
                'is_available' => 0,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}

