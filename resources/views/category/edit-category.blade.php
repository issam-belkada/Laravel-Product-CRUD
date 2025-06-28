@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h2>Edite Category</h2>
            </div>
            <div class="card-body">
                @include('category.form', [
                    'action' => route('update-category', $category->id),
                    'method' => 'PUT',
                    'buttonText' => 'Update',
                    'category' => $category,
                ])
                    </div>
                </div>
            </div>
@endsection