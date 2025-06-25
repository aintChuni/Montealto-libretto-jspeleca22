@extends('layouts.app')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-2 mb-3">← Back</a>
<h2>Add Review</h2>

<form method="POST" action="{{ route('reviews.store') }}">
    @csrf

    <div class="mb-3">
        <label>Book</label>
        <select name="book_id" class="form-control" required>
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <select name="rating" class="form-control" required>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <button class="btn btn-success">Submit</button>
</form>
@endsection
