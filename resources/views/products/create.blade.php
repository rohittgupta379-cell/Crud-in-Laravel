<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Crud Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark text-center text-white py-3">
        <h1 class="h2">Laravel CRUD</h1>
    </div>

    <div class="container mt-4">

        <!-- Create Button -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
        </div>

        <!-- Card -->
        <div class="card p-0 mt-3">

            <div class="card-header bg-dark text-white">
                <h4 class="h4 mb-0"> Create Products</h4>
            </div>

            <div class="card-body" shadow-lg>
                <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <!-- Product Name -->
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input value="{{ old('name') }}" type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKU -->
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input value="{{ old('sku') }}" type="text" name="sku"
                            class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}"
                            required>

                        @error('sku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input value="{{ old('price') }}" type="number" step="0.01" name="price"
                            class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                            required>

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>

                            <option value="">Select Status</option>
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">
                        Save Product
                    </button>

                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                </form>
            </div>
        </div>
    </div>



    </div>

    </div>

    </div>


















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
