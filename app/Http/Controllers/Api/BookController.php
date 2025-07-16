<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'genres', 'reviews')->paginate(5);
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ], [
            'title.required' => 'The title must not be empty.',
            'author_id.required' => 'The author must not be empty.',
            'genres.required' => 'The genre must not be empty.',
        ]);

        $book = Book::create($request->only('title', 'author_id'));
        $book->genres()->sync($request->genres);

        return response()->json([
            'message' => 'Book created successfully.',
            'book' => $book->load('author', 'genres', 'reviews')
        ], 201);
    }

    public function show(Book $book)
    {
        $book->load('author', 'genres', 'reviews');
        return response()->json($book);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'genres' => 'required|array',
        ], [
            'title.required' => 'The title must not be empty.',
            'author_id.required' => 'The author must not be empty.',
            'genres.required' => 'The genre must not be empty.',
        ]);

        $book->update($request->only('title', 'author_id'));
        $book->genres()->sync($request->genres);

        return response()->json([
            'message' => 'Book updated successfully.',
            'book' => $book->load('author', 'genres', 'reviews')
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully.'
        ]);
    }
}
