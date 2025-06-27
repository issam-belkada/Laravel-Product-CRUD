<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">{{ $buttonText ?? 'Save Product' }}</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ $action }}">
                @csrf
                @if($method !== 'POST')
                    @method($method)
                @endif

                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $product->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" rows="3">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="form-label fw-bold">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                        name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="Quantity" class="form-label fw-bold">Quantity</label>
                    <input type="number" class="form-control @error('Quantity') is-invalid @enderror" id="Quantity"
                        name="Quantity" value="{{ old('Quantity', $product->Quantity ?? '') }}">
                    @error('Quantity')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="form-label fw-bold">Price (DA)</label>
                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                        id="price" name="price" value="{{ old('price', $product->price ?? '') }}">
                    @error('price')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="form-label fw-bold">Product Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    @if (!empty($product?->image))
                        <div class="mt-3">
                            <p class="mb-2">Current Image:</p>
                            <img src="{{ asset('images/' . $product->image) }}" alt="product image" width="120"
                                class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="active" {{ old('status', $product->status ?? '') === 'active' ? 'selected' : '' }}>
                            Active</option>
                        <option value="in-active" {{ old('status', $product->status ?? '') === 'in-active' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                @if ($product->deleted_at)
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('show-deleted-product') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            {{ $buttonText ?? 'Save' }}
                        </button>
                    </div>
                @else
                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">
                        {{ $buttonText ?? 'Save' }}
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>