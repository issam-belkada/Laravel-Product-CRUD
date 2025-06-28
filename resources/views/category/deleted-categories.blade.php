@extends('layouts.layout')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-2 mb-md-0">Deleted Categories</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <form class="d-flex" role="search" action="{{ route('show-deleted-categories') }}" method="GET">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                aria-label="Search" />
                            <button class="btn btn-light" type="submit">Search</button>
                        </form>
                        <a href="/show-deleted-categories" class="btn btn-success px-2 py-1"> Product List
                        </a>
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
                            <th class="text-center">Deleting date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($deletedCategories->count())
                            @foreach ($deletedCategories as $category)
                                <tr>
                                    <th class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center fw-semibold">{{ $category->name }}</td>

                                    <td class="text-center">
                                        <span class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        {{ $category->deleted_at ? $category->deleted_at->format('d-m-Y') : 'N/A' }}
                                    </td>


                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('show-category-products', $category->id) }}"
                                                class="btn btn-info btn-sm">👁️ Products </a>
                                            <a href="{{ route('edit-category', $category->id) }}" class="btn btn-primary btn-sm">✏️
                                                Restore</a>
                                            <form action="{{ route('delete-category', $category->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">🗑️
                                                    Destroy Category</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No Categoryies founded!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $deletedCategories->links() }}
            </div>
        </div>
    </div>
@endsection