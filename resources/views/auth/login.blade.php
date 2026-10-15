@extends('layout')

@section('content')

<div class="login-wrap">
    <div class="card">
        <h1 class="login-title">Welcome back</h1>
        <p class="login-sub">Sign in to manage your short URLs</p>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input"
                       value="{{ old('email') }}"
                       placeholder="you@example.com"
                       required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input"
                       placeholder="••••••••"
                       required>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">
                Login
            </button>
        </form>
    </div>
</div>

@endsection
