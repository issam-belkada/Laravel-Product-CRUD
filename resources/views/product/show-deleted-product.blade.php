@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-2 mb-md-0">🗑️ Deleted Products</h2>
                    <div class="d-flex flex-wrap gap-2">
                        <form class="d-flex" role="search" action="{{ route('show-deleted-product') }}" method="GET">
                            <input class="form-control me-2" type="search" name="search" placeholder="Search"
                                aria-label="Search" />
                            <button class="btn btn-light" type="submit">Search</button>
                        </form>
                        <a href="/products" class="btn btn-success"> Product List
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
                        @if ($deletedProducts->count())
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Product</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead> <tbody>
                                @foreach ($deletedProducts as $product)
                                    <tr>
                                        <th class="text-center">{{ $loop->iteration }}</th>
                                        <td class="text-center fw-semibold">{{ $product->name }}</td>
                                        <td class="text-center">{{ $product->category->name }}</td>
                                        <td class="text-center">{{ $product->Quantity }}</td>
                                        <td class="text-center">{{$product->price }} DA</td>
                                        <td class="text-center">
                                            <span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($product->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center text-truncate" style="max-width: 200px;">
                                            {{ $product->description }}
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('show-product', $product->id) }}" class="btn btn-info btn-sm">👁️
                                                    Show</a>
                                                <a href="{{ route('restore-product', $product->id) }}" class="btn btn-primary btn-sm">✏️
                                                    Restore</a>
                                                <form action="{{ route('destroy-product', $product->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this product permanently?')">🗑️
                                                        Destroy Product</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        @else
                               <table class="table align-middle mb-0">
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No products founded!</td>
                                    </tr>
                                </table>
                        @endif

                {{ $deletedProducts->links() }}
            </div>
        </div>
    </div>
@endsection