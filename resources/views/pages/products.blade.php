@forelse($products as $pro)
    <div class="col">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/products/' . $pro->image) }}" class="card-img-top" alt="{{ $pro->name }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $pro->name }}</h5>
                <p class="card-text text-primary fw-bold">Rs. {{ $pro->price }}</p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ url('/updateproduct/' . $pro->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                <a href="{{ url('/deleteproduct/' . $pro->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-info">
            <i class="bx bx-info-circle me-1"></i> No products found.
        </div>
    </div>
@endforelse
