<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('books')->paginate(5);
        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Genre name must not be empty.',
        ]);

        $genre = Genre::create($request->all());

        return response()->json([
            'message' => 'Genre created successfully.',
            'genre' => $genre,
        ], 201);
    }

    public function show(Genre $genre)
    {
        $genre->load('books');
        return response()->json($genre);
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Genre name must not be empty.',
        ]);

        $genre->update($request->all());

        return response()->json([
            'message' => 'Genre updated successfully.',
            'genre' => $genre,
        ]);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json([
            'message' => 'Genre deleted successfully.',
        ]);
    }
}


