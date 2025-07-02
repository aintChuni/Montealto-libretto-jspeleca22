<form method="POST" action="{{ url('/web-login') }}">
    @csrf
    <input name="email" placeholder="Email">
    <input name="password" type="password" placeholder="Password">
    <button type="submit">Login</button>
</form>

<a href="{{ url('/register') }}">
    <button type="button">Go to Register</button>
</a>
