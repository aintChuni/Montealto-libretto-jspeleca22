<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('book')->paginate(5);
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'book_id.required' => 'The book is required.',
            'content.required' => 'The review content must not be empty.',
            'rating.required' => 'There must be a rating.',
        ]);

        $review = Review::create($request->only('book_id', 'content', 'rating'));

        return response()->json([
            'message' => 'Review added successfully.',
            'review' => $review,
        ], 201);
    }

    public function show(Review $review)
    {
        $review->load('book');
        return response()->json($review);
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ], [
            'content.required' => 'The review content must not be empty.',
            'rating.required' => 'There must be a rating.',
        ]);

        $review->update($request->only('content', 'rating'));

        return response()->json([
            'message' => 'Review updated successfully.',
            'review' => $review,
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully.',
        ]);
    }
}
