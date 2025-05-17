@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> Add New Product
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Food Product Management</h5>
                <div class="card-body">
                    <form action="{{ route('addproducts') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name" placeholder="Enter food product name" required />
                            </div>
                            
                            <div class="col-md-6">
                                <label for="productPrice" class="form-label">Product Price ($)</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="productPrice" name="price" placeholder="Enter product price" required />
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Product Image</label>
                            <input class="form-control" type="file" id="productImage" name="image" accept="image/*" required />
                            <div class="form-text">Upload a high-quality image of the food product</div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary me-2">Add Food Product</button>
                            <a href="{{ route('admin_dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
