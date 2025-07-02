@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">📝 All Reviews</h2>
    <a href="{{ route('reviews.create') }}" class="btn btn-primary">+ Add Review</a>
</div>

{{-- Flash success message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@forelse($reviews as $review)
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-2">
                <span class="text-warning">{{ $review->rating }}/5</span> — <span class="text-muted">{{ $review->book->title }}</span>
            </h5>
            <p class="mb-3">{{ $review->content }}</p>

            <div class="d-flex gap-2">
                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>

                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">There are no reviews yet.</div>
@endforelse
<div class="text-center mt-4">
    <div class="d-flex justify-content-center">
        {{ $reviews->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
