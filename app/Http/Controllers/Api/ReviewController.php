<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->paginate(5);
        return view('reviews.index', compact('reviews'));
    }

    public function create()
    {
        $books = Book::all();
        return view('reviews.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ],
             ['book_id.required' => 'The title Must not be Empty.',
            'content.required' => 'The Review Content Must not be Empty.',
            'rating.required' => 'There Must be Rating.'
            ]
    );

        Review::create($request->only('book_id', 'content', 'rating'));
        return redirect()->route('reviews.index')->with('success', 'Review added successfully.');
    }

    public function edit(Review $review)
    {
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ],
        ['content.required' => 'The Review Content Must not be Empty.',
            'rating.required' => 'There Must be Rating.'
            ]
    );

        $review->update($request->only('content', 'rating'));

        return redirect()
            ->route('reviews.edit', $review->id)
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
