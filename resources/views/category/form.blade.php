<div class="container my-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">{{ $buttonText ?? 'Save Category' }}</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" enctype="multipart/form-data" action="{{ $action }}">
                @csrf
                @if($method !== 'POST')
                    @method($method)
                @endif

                <!-- Category Name -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Category Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $category->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="active" {{ old('status', $category->status ?? '') === 'active' ? 'selected' : '' }}>
                            Active</option>
                        <option value="in-active" {{ old('status', $category->status ?? '') === 'in-active' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Buttons -->
                @if (optional($category)->deleted_at)
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('show-deleted-categories') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            {{ $buttonText ?? 'Save' }}
                        </button>
                    </div>
                @else
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success">
                            {{ $buttonText ?? 'Save' }}
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>