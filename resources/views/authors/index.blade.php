@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-semibold">🖋️ Authors</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">+ Add Author</a>
</div>

{{-- Success message --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Validation errors --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@forelse($authors as $author)
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h4 class="card-title text-primary">{{ $author->name }}</h4>
            <p><strong>Books:</strong></p>

            @if ($author->books->count())
                <div class="d-flex flex-wrap gap-2 mb-3">
                    @foreach($author->books as $book)
                        <span class="badge bg-secondary">{{ $book->title }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No books yet.</p>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-info">No authors found. Add your first author above.</div>
@endforelse
<div class="text-center mt-4">
    <div class="d-flex justify-content-center">
        {{ $authors->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
