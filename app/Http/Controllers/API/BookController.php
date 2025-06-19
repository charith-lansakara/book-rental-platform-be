<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(protected BookService $service) {}

    // GET /api/books
    public function index(Request $request)
    {
        return BookResource::collection(
            $this->service->getAll($request->all())
        );
    }

    // GET /api/books/{id}
    public function show($id)
    {
        $book = $this->service->find($id);
        return new BookResource($book);
    }

    // POST /api/books
    public function store(StoreBookRequest $request)
    {
        $book = $this->service->create($request->validated());
        return new BookResource($book);
    }

    // POST /api/books/{id}/rent
    public function rent($id)
    {
        $book = $this->service->rent($id);

        if (!$book) {
            return response()->json(['message' => 'Book is already rented.'], 400);
        }

        return response()->json([
            'message' => 'Book rented successfully.',
            'book' => new BookResource($book)
        ]);
    }

    // POST /api/books/{id}/return
    public function return($id)
    {
        $book = $this->service->return($id);

        if (!$book) {
            return response()->json(['message' => 'Book is already available.'], 400);
        }

        return response()->json([
            'message' => 'Book returned successfully.',
            'book' => new BookResource($book)
        ]);
    }
}
