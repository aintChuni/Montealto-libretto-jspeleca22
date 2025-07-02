@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">📚 Book List</h2>
    <a href="{{ route('books.create') }}" class="btn btn-primary">+ Add Book</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@forelse($books as $book)
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title text-primary">{{ $book->title }}</h4>
            <p class="mb-1"><strong>Author:</strong> {{ $book->author->name }}</p>
            <p class="mb-2">
                <strong>Genres:</strong>
                @forelse($book->genres as $genre)
                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                @empty
                    <span class="text-muted">None</span>
                @endforelse
            </p>

            <p class="mb-2">
                <strong>Reviews:</strong> {{ $book->reviews->count() }} 
                @if($book->reviews->count())
                    | Avg Rating: <span class="text-success fw-bold">{{ number_format($book->reviews->avg('rating'), 1) }}/5</span>
                @endif
            </p>

            @if($book->reviews->count())
                <div class="mb-3">
                    <ul class="list-group list-group-flush">
                        @foreach($book->reviews as $review)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    <strong class="text-warning">{{ $review->rating }}/5</strong> — {{ $review->content }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-success btn-sm">View</a>
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">No books found. Add one to get started.</div>
@endforelse
<div class="text-center mt-4">
    <div class="d-flex justify-content-center">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
