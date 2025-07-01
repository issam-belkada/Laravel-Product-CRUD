@extends('layouts.layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card shadow-lg border-0 p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
            <h3 class="text-center mb-4 fw-bold">🔐 Sign In</h3>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">📧 Email Address</label>
                    <input type="email" name="email" id="email" class="form-control rounded-3" value="{{ old('email') }}"
                        required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">🔒 Password</label>
                    <input type="password" name="password" id="password" class="form-control rounded-3" required>
                </div>

                <button type="submit" class="btn btn-success w-100 py-2 rounded-3 fw-bold">Log In</button>
            </form>

            <p class="text-center mt-3 mb-0">
                <span class="text-muted">Don't have an account?</span>
                <a href="{{ route('show-signup') }}" class="fw-semibold text-decoration-none">Sign up</a>
            </p>
        </div>
    </div>
@endsection