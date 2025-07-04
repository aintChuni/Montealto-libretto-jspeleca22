<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Libretto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 400px;">
    <div class="card p-4 shadow rounded-4">
        <h2 class="text-center mb-4">Login</h2>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ url('/web-login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="form-control rounded-pill">
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input name="password" type="password" class="form-control rounded-pill">
            </div>
            <button type="submit" class="btn btn-danger rounded-pill w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ url('/register') }}" class="btn btn-outline-secondary rounded-pill w-100">Go to Register</a>
        </div>
    </div>
</div>
</body>
</html>
