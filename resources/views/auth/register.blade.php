@extends('layout.auth')

@section('content')
    <!-- Paste the above Register form code here -->
    <div class="container">
    <h1>Register</h1>
    <form action="{{ route('registercontroller') }}" method="post">
        @csrf

        <input type="text" name="name" placeholder="Enter name">
        <br>

        <input type="email" name="email" placeholder="Enter email">
        <br>

        <input type="password" name="password" placeholder="Enter password">
        <br>

        <button type="submit">Register</button>
    </form>

    <div class="footer-text">
        <p>Already have an account? 
            <a href="{{ route('login') }}" style="color: #007bff;">Login</a>
        </p>
    </div>
</div>

@endsection
