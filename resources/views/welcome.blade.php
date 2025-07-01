@extends('layouts.layout')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="text-center">
            <h1 class="display-4 fw-bold mb-4">📱 Welcome to ElectroStore</h1>
            <p class="lead text-muted mb-5">Manage your electronics products easily and securely.</p>

            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('show-login') }}" class="btn btn-primary btn-lg px-5 rounded-pill">🔐 Login</a>
                <a href="{{ route('show-signup') }}" class="btn btn-outline-dark btn-lg px-5 rounded-pill">📝 Sign Up</a>
            </div>
        </div>
    </div>
@endsection
