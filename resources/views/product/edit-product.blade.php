@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Edite Product</h2>
            </div>
            <div class="card-body">
                @include('product.form', [
                    'action' => route('update-product', $product->id),
                    'method' => 'PUT',
                    'buttonText' => 'Update',
                    'product' => $product,
                    'categories' => $categories
                ])
                </div>
            </div>
        </div>
@endsection