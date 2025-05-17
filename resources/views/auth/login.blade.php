@extends('layout.auth')

@section('content')
    <!-- Paste the div code here -->
    <div class="container">
    <h1>Login</h1>
    <form action="{{ route('logincontroller') }}" method="post">
        @csrf

        <input type="email" name="email" placeholder="Enter email" required>
        <br>

        <input type="password" name="password" placeholder="Enter password" required>
        <br>

        <button type="submit">Login</button>
    </form>
</div>

@endsection
