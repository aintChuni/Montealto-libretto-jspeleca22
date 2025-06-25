@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-2 mb-3">← Back</a>

<h2>Edit Review</h2>

<form method="POST" action="{{ route('reviews.update', $review->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Review Content</label>
        <textarea name="content" class="form-control" required>{{ $review->content }}</textarea>
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <select name="rating" class="form-control" required>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Review</button>

    <button type="reset" class="btn btn-secondary">Cancel</button>
</form>
@endsection
