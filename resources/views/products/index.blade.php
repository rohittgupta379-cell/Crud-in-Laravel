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


        {{-- susssess message --}}
        @if (Session::has('success'))
            <div class="alert alert-success mt-3">
                {{ Session::get('success') }}
            </div>
        @endif


        @if (Session::has('error'))
            <div class="alert alert-danger mt-3">
                {{ Session::get('error') }}
            </div>
        @endif

        <!-- Card -->
        <div class="card p-0 mt-3">

            <div class="card-header bg-dark text-white">
                <h4 class="h4 mb-0">Products</h4>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th width="120">Status</th>
                            <th width="120" class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($products->isNotEmpty())

                            @foreach ($products as $product)
                                <tr class="text-center">

                                    <td>{{ $product->id }}</td>

                                    <td>
                                        @if (!empty($product->image))
                                            <img class="rounded"
                                                src="{{ asset('uploads/products/' . $product->image) }}" width="50">
                                        @else
                                            <img class="rounded" src="https://placehold.co/600x400" width="50">
                                        @endif
                                    </td>

                                    <td>{{ $product->name }}</td>

                                    <td>{{ $product->sku }}</td>

                                    <td>
                                        @if ($product->status == 'Active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>
                                        Avtive
                                    </td>

                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">No Products Found</td>
                            </tr>
                        @endif
                    </tbody>

                </table>

            </div>

        </div>

    </div>


















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
