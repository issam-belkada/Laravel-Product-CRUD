@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-gradient bg-primary text-white py-3 px-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <h2 class="mb-0">📦 Product List</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <form class="d-flex" role="search" action="{{ route('products.index') }}" method="GET">
                            <input class="form-control form-control-sm me-2 rounded-pill" type="search" name="search"
                                placeholder="Search..." aria-label="Search">
                            <button class="btn btn-light btn-sm rounded-pill">🔍</button>
                        </form>
                        <a href="/show-deleted-product" class="btn btn-outline-warning btn-sm rounded-pill">🗑️ Trash</a>
                        <a href="/create-product" class="btn btn-success btn-sm rounded-pill">➕ Add Product</a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                    <div class="toast align-items-center text-bg-success border-0 show fade" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✅ {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="table-responsive">
                @if ($products->count())
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="text-center">
                                    <!-- Index -->
                                    <td class="text-center text-muted fw-bold align-middle">{{ $loop->iteration }}</td>

                                    <!-- Product Name -->
                                    <td class="text-center fw-semibold text-primary align-middle">{{ $product->name }}</td>

                                    <!-- Category -->
                                    <td class="text-center text-capitalize align-middle">{{ $product->category->name }}</td>

                                    <!-- Quantity -->
                                    <td class="text-center fw-bold text-dark align-middle">{{ $product->Quantity }}</td>

                                    <!-- Price -->
                                    <td class="text-center fw-semibold text-success align-middle">{{ $product->price }} DA</td>

                                    <!-- Status -->
                                    <td class="text-center align-middle">
                                        <span class="badge px-3 py-2 rounded-pill {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>

                                    <!-- Description -->
                                    <td class="text-start text-muted text-truncate align-middle" style="max-width: 220px;">
                                        {{ $product->description }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap" role="group">
                                            <!-- View Button -->
                                            <a href="{{ route('show-product', $product->id) }}" class="btn btn-outline-info btn-sm rounded-pill">👁️ View</a>

                                            <!-- Edit Button -->
                                            <a href="{{ route('edit-product', $product->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">✏️
                                                Update</a>

                                            <!-- Delete Button (Triggers Modal) -->
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal-{{ $product->id }}">
                                                🗑️ Delete
                                            </button>
                                        </div>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="confirmDeleteModal-{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel-{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow rounded-4">
                                                    <div class="modal-header bg-danger text-white rounded-top-4">
                                                        <h5 class="modal-title" id="deleteModalLabel-{{ $product->id }}">Delete Confirmation</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        Are you sure you want to permanently delete <strong>{{ $product->name }}</strong>?
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary rounded-pill px-4"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('delete-product', $product->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4">Yes, Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-muted p-4">
                        <i class="fa-solid fa-box-open fa-2x mb-2"></i>
                        <p>No products found!</p>
                    </div>
                @endif
            </div>

            <div class="card-footer bg-white py-3 px-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toastEl = document.querySelector('.toast');
            const bsToast = bootstrap.Toast.getOrCreateInstance(toastEl);
            bsToast.hide();
        }, 4000);
    </script>

@endsection