@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-gradient bg-danger text-black rounded-top-4 px-4 py-3"
                style="background: linear-gradient(90deg, #0d6efd, #3a86ff);">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="mb-2 mb-md-0 fw-bold">🗑️ Deleted Products</h3>
                    <div class="d-flex flex-wrap gap-2">
                        <form class="d-flex" action="{{ route('show-deleted-product') }}" method="GET">
                            <input class="form-control me-2 rounded-pill" type="search" name="search"
                                placeholder="Search deleted..." />
                            <button class="btn btn-light rounded-pill" type="submit">🔍</button>
                        </form>
                        <a href="/products" class="btn btn-success rounded-pill">📦 Back to Products</a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
                    <div class="toast align-items-center text-bg-success border-0 show fade" role="alert">
                        <div class="d-flex">
                            <div class="toast-body">
                                ✅ {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast"></button>
                        </div>
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        document.querySelector('.toast')?.classList.remove('show');
                    }, 4000);
                </script>
            @endif

            <div class="table-responsive p-3">
                @if ($deletedProducts->count())
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
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
                            @foreach ($deletedProducts as $product)
                                <tr class="text-center">
                                    <td class="text-center text-muted fw-bold align-middle">{{ $loop->iteration }}</td>
                                    <td class="text-center fw-semibold text-primary align-middle">{{ $product->name }}</td>
                                    <td class="text-center text-capitalize align-middle">{{ $product->category->name }}</td>
                                    <td class="text-center fw-bold text-dark align-middle">{{ $product->Quantity }}</td>
                                    <td class="text-center fw-semibold text-success align-middle">{{ $product->price }} DA</td>
                                    <td class="text-center align-middle">
                                        <span class="badge px-3 py-2 rounded-pill {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td class="text-start text-muted text-truncate align-middle" style="max-width: 220px;">
                                        {{ $product->description }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('show-product', $product->id) }}"
                                                class="btn btn-outline-info btn-sm rounded-pill">👁️ Show</a>
                                            <a href="{{ route('restore-product', $product->id) }}"
                                                class="btn btn-outline-primary btn-sm rounded-pill">♻️ Restore</a>
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" data-bs-toggle="modal"
                                                data-bs-target="#destroyModal{{ $product->id }}">
                                                🗑️ Destroy
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="destroyModal{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="destroyModalLabel{{ $product->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="destroyModalLabel{{ $product->id }}">Delete
                                                                Confirmation</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            Are you sure you want to permanently delete
                                                            <strong>{{ $product->name }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('destroy-product', $product->id) }}"
                                                                method="POST" class="w-100 text-end">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Yes, delete</button>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center text-muted py-5">
                        <h5>No deleted products found!</h5>
                    </div>
                @endif

                <div class="mt-3">
                    {{ $deletedProducts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection