@extends('layouts.layout')

@section('content')
    <div class="container py-4">
        <div class="mb-4">
            <h2 class="text-center text-primary">Product Details</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $product->name }}</h5>
                <span class="badge bg-{{ $product->status === 'active' ? 'success' : 'secondary' }}">
                    {{ ucfirst($product->status) }}
                </span>
            </div>
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-4 text-center">
                        @if($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image"
                                class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        @else
                            <div class="text-muted">No image available</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <p class="mb-2"><strong>Category:</strong> {{ $product->category->name }}</p>
                        <p class="mb-2"><strong>Quantity:</strong> {{ $product->Quantity }}</p>
                        <p class="mb-2"><strong>Price:</strong> {{ number_format($product->price, 2) }} DA</p>
                        <p class="mb-0"><strong>Description:</strong>
                            {{ $product->description ?? 'No description provided' }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="{{ route('edit-product', $product->id) }}" class="btn btn-outline-primary">Edit</a>

                <form action="{{ route('delete-product', $product->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>

                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to List</a>
            </div>
        </div>
    </div>
@endsection