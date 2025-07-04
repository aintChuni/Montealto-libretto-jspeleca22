<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('books')->paginate(5);
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255'],
    ['name.required'=> 'Genre name must not be Empty']
    );
        Genre::create($request->all());
        return redirect()->route('genres.index')
        ->with('success','Genre successfully Created');;
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $request->validate(['name' => 'required|string|max:255'],
        ['name.required'=> 'Genre name must not be Empty']
    );
        $genre->update($request->all());
        return redirect()->route('genres.index')
        ->with('success','Genre successfully updated');
        ;
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genres.index')
        ->with('success','Genre successfully deleted');
    }
}

