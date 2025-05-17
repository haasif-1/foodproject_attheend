@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Shopping /</span> Checkout
    </h4>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Shipping Information</h5>
                <div class="card-body">
                    <form action="{{ route('placeorder') }}" method="POST">
                        @csrf
                        
                        @foreach ($productIds as $id)
                            <input type="hidden" name="products[]" value="{{ $id }}">
                        @endforeach
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-globe"></i></span>
                                <input type="text" class="form-control" id="country" name="country" placeholder="Enter your country" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="province" class="form-label">Province/State</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-map"></i></span>
                                    <input type="text" class="form-control" id="province" name="province" placeholder="Enter your province or state" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="street" class="form-label">Street Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-home"></i></span>
                                <input type="text" class="form-control" id="street" name="street" placeholder="Enter your street address" required>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <a href="{{ route('cartedproduct') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bx bx-arrow-back me-1"></i> Back to Cart
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-check me-1"></i> Place Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
