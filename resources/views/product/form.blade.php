<form method="POST" enctype="multipart/form-data" action="{{ $action }}">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <!-- Nom du produit -->
    <div class="mb-3">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}"
            required>
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description"
            rows="3">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <!-- Catégorie -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Quantité -->
    <div class="mb-3">
        <label for="Quantity" class="form-label">Quantity</label>
        <input type="number" class="form-control" id="Quantity" name="Quantity"
            value="{{ old('Quantity', $product->Quantity ?? '') }}" required>
    </div>

    <!-- Prix -->
    <div class="mb-3">
        <label for="price" class="form-label">Price (DA)</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price"
            value="{{ old('price', $product->price ?? '') }}" required>
    </div>

    <!-- Image -->
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if(!empty($product?->image))
            <p class="mt-2">Current image: <br>
                <img src="{{ asset('uploads/' . $product->image) }}" alt="product current img" width="100">
            </p>
        @endif
    </div>

    <!-- Statut -->
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="active" {{ old('status', $product->status ?? '') === 'active' ? 'selected' : '' }}>Active
            </option>
            <option value="in-active" {{ old('status', $product->status ?? '') === 'in-active' ? 'selected' : '' }}>
                Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        {{ $buttonText ?? 'Save' }}
    </button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
</form>