<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create($request->only('book_id', 'content', 'rating'));
        return redirect()->back()->with('success', 'Review added.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}

