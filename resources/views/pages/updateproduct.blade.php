@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> Update Product
    </h4>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Edit Product Information</h5>
                <div class="card-body">
                    <form action="{{ route('editproduct', $edit->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-package"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $edit->name }}" placeholder="Enter product name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rs.</span>
                                <input type="text" class="form-control" id="price" name="price" value="{{ $edit->price }}" placeholder="Enter product price" required>
                            </div>
                            <div class="form-text">Enter the price without currency symbol</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                    <i class="bx bx-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('showitem') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-x me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
