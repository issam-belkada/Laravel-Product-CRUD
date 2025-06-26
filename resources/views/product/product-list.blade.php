@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col"><h2>Product List</h2></div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                            <div class="col-md-4"><a href="/create-product" class="float-end btn btn-success">Add Product</a></div>
                        </div>

                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Product Name</th>
                        <th scope="col" class="text-center">Category</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>             
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $product->name }}</td>
                                <td class="text-center">{{ $product->category->name }}</td>
                                <td class="text-center">{{ $product->Quantity }}</td>
                                <td class="text-center">{{ $product->price }} DA</td>
                                <td class="text-center">{{ $product->status}}</td>
                                <td class="text-center">{{ $product->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('show-product', $product->id) }}" class="btn btn-info btn-sm">Show</a>
                                    <a href="{{ route('edit-product', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('delete-product', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="7" class="text-center">No products founded!</td>
                        </tr>
                    @endif
                </tbody>      </table>
        </div>
    </div>
@endsection