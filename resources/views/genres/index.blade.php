@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">🏷️ Genres</h2>
    <a href="{{ route('genres.create') }}" class="btn btn-primary">+ Add Genre</a>
</div>

{{-- Flash success message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@forelse($genres as $genre)
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title text-primary">{{ $genre->name }}</h4>

            <p class="mb-1"><strong>Books:</strong></p>
            @if ($genre->books->count())
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($genre->books as $book)
                        <span class="badge bg-secondary">{{ $book->title }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No books assigned to this genre.</p>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this genre?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">No genres found. Add one to get started.</div>
@endforelse
@endsection
