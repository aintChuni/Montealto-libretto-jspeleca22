<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Libretto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card shadow rounded-4 p-4">
        <h2 class="text-center mb-4">Register</h2>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ url('/web-register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input name="name" value="{{ old('name') }}" class="form-control rounded-pill" placeholder="Enter Name">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="form-control rounded-pill" placeholder="Enter Email">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control rounded-pill" placeholder="Enter password">
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control rounded-pill" placeholder="Confirm password">
            </div>

            <button type="submit" class="btn btn-danger w-100 rounded-pill mt-2">Register</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ url('/login') }}" class="btn btn-outline-secondary rounded-pill w-100">Back to Login</a>
        </div>
    </div>
</div>
</body>
</html>
