<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->paginate(5);
        return response()->json($authors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'The author name is required.',
        ]);

        $author = Author::create($request->all());

        return response()->json([
            'message' => 'Author created successfully.',
            'author' => $author,
        ], 201);
    }

    public function show(Author $author)
    {
        $author->load('books');
        return response()->json($author);
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'The author name is required.',
        ]);

        $author->update($request->all());

        return response()->json([
            'message' => 'Author updated successfully.',
            'author' => $author,
        ]);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully.',
        ]);
    }
}

