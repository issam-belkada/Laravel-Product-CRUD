<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel CRUD Products</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d6efd;
        }

        .nav-link {
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0d6efd !important;
        }

        .btn {
            transition: all 0.3s ease-in-out;
        }

        footer {
            background-color: #f1f1f1;
            padding: 20px 0;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="/products">📦
                                Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('categories') ? 'active' : '' }}" href="/categories">🗂️
                                Categories</a>
                        </li>
                    </ul>
                @endauth

                <div class="d-flex align-items-center">
                    @auth
                        <span class="me-3 text-success fw-semibold">
                            👋 {{ Auth::user()->name }}
                        </span>
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm rounded-pill">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('show-login') }}" class="btn btn-outline-primary btn-sm me-2 rounded-pill">Sign
                            In</a>
                        <a href="{{ route('show-signup') }}" class="btn btn-primary btn-sm rounded-pill">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        @yield('content')
    </main>

    <footer class="text-center text-muted">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} Laravel CRUD Products. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>