@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> Product List
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Available Products</h5>
            <a href="{{ route('adding') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add New Product
            </a>
        </div>
        <div class="card-body">
            @if ($products->isEmpty())
                <div class="alert alert-info" role="alert">
                    <i class="bx bx-info-circle me-1"></i>
                    No products available. Start by adding your first product.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($products as $pro)
                        <div class="col">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('storage/products/'.$pro->image) }}" alt="{{ $pro->name }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pro->name }}</h5>
                                    <p class="card-text text-primary fw-semibold">Rs. {{ $pro->price }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('updateproduct', ['id' => $pro->id]) }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a href="{{ route('deleteproduct', ['id' => $pro->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            <div class="mt-4 text-end">
                <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
