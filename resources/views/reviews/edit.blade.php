@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('reviews.index') }}" class="btn btn-outline-secondary mt-2 mb-3">← Back</a>

<h2>Edit Review</h2>

<form method="POST" action="{{ route('reviews.update', $review->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Review Content</label>
        <textarea name="content" class="form-control">{{ $review->content }}</textarea>
        @error('content') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Rating</label>
        <select name="rating" class="form-control">
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
        @error('rating') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Review</button>

    <button type="reset" class="btn btn-secondary">Cancel</button>
</form>
@endsection
