@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-2 mb-md-0">Categories List</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <form class="d-flex" role="search" action="{{ route('categories.index') }}" method="GET">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                aria-label="Search" />
                            <button class="btn btn-light" type="submit">Search</button>
                        </form>
                        <a href="/show-deleted-categories" class="btn btn-warning px-2 py-1"> 🗑️Trash
                        </a>
                        <a href="/create-category" class="btn btn-success">➕ Add Category</a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success text-center mb-0">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Date de creation</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count())
                            @foreach ($categories as $category)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center fw-semibold">{{ $category->name }}</td>

                                    <td class="text-center">
                                        <span class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        {{ $category->created_at ? $category->created_at->format('d-m-Y') : 'N/A' }}
                                    </td>


                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('show-category-products', $category->id) }}"
                                                class="btn btn-info btn-sm">👁️ Products </a>
                                            <a href="{{ route('edit-category', $category->id) }}" class="btn btn-primary btn-sm">✏️
                                                Edit</a>
                                            <form action="{{ route('delete-category', $category->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">🗑️
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No categories founded!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection