@extends('layouts.app')

@section('content')
<a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary mt-2 mb-3">← Back</a>
<h2>Add Review</h2>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('reviews.store') }}">
    @csrf

    <div class="mb-3">
        <label>Book</label>
        <select name="book_id" class="form-control">
            @foreach($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
        @error('book_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Content</label>
        <textarea name="content" class="form-control"></textarea>
        @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <select name="rating" class="form-control">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
         @error('rating') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Submit</button>
</form>
@endsection
