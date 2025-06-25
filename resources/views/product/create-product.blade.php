@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Create Product</h2>
            </div>
            <div class="card-body">
                @include('product.form', [
                    'action' => route('store-product'),
                    'method' => 'POST',
                    'buttonText' => 'Create',
                    'product' => null,
                    'categories' => $categories
                ])
            </div>
        </div>
    </div>
@endsection
