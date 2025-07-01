@extends('layouts.layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card shadow-lg border-0 p-4" style="max-width: 450px; width: 100%; border-radius: 1rem;">
            <h3 class="text-center mb-4 fw-bold">🚀 Create Your Account</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('signup') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">👤 Name</label>
                    <input type="text" name="name" id="name" class="form-control rounded-3" value="{{ old('name') }}"
                        required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">📧 Email Address</label>
                    <input type="email" name="email" id="email" class="form-control rounded-3" value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">🔒 Password</label>
                    <input type="password" name="password" id="password" class="form-control rounded-3" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">🔒 Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control rounded-3" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">
                    Create Account
                </button>
            </form>

            <p class="text-center mt-3 mb-0">
                <span class="text-muted">Already have an account?</span>
                <a href="{{ route('show-login') }}" class="fw-semibold text-decoration-none">Sign In</a>
            </p>
        </div>
    </div>
@endsection