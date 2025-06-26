@extends('layouts.app')

@section('content')
<a href="{{ route('books.index') }}" class="btn btn-outline-secondary mt-2 mb-3">← Back</a>
<h2>{{ $book->title }}</h2>
<p><strong>Author:</strong> {{ $book->author->name }}</p>

<p><strong>Genres:</strong>
    @foreach($book->genres as $genre)
        <span class="badge bg-info">{{ $genre->name }}</span>
    @endforeach
</p>

<hr>
<h4>Reviews</h4>
@forelse($book->reviews as $review)
    <div class="mb-2 p-2 border rounded">
        <strong>{{ $review->rating }}/5</strong> - {{ $review->content }}

        <div class="mt-1">
            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>

            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>
@empty
    <p>No reviews yet.</p>
@endforelse

<hr>
<h5>Add Review</h5>
<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <div class="mb-2">
        <textarea name="content" class="form-control" placeholder="Your review" required></textarea>
    </div>
    <div class="mb-2">
        <select name="rating" class="form-control" required>
            <option disabled selected>Rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <button class="btn btn-success">Submit</button>
</form>
@endsection
