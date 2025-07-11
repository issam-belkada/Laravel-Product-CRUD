@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Create Category</h2>
            </div>
            <div class="card-body">
                @include('category.form', [
                    'action' => route('store-category'),
                    'method' => 'POST',
                    'buttonText' => 'Create',
                    'category' => null,
                ])
                </div>
            </div>
        </div>
@endsection
