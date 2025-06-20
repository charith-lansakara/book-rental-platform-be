<?php
namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all($filters)
    {
        $query = Book::query();

        // Filter by author if provided
        if (!empty($filters['author'])) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }
        if (!empty($filters['availability'])) {
            $query->where('is_available', $filters['availability'] === 'available');
        }

        return $query->paginate(3);
    }

    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function create($data)
    {
        return Book::create($data);
    }

    public function rent($id)
    {
        $book = $this->find($id);

        if (!$book->is_available) {
            return null;
        }

        $book->update(['is_available' => false]);
        return $book;
    }

    public function return($id)
    {
        $book = $this->find($id);

        if ($book->is_available) {
            return null;
        }

        $book->update(['is_available' => true]);
        return $book;
    }
}
