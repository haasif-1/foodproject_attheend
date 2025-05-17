@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Shopping /</span> My Cart
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Selected Products</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('buyingprocess') }}">
                @csrf
                
                @if(count($cartProducts) > 0)
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4 mb-5">
                        @foreach($cartProducts as $product)
                            <div class="col">
                                <div class="card h-100 position-relative">
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="products[]" value="{{ $product->id }}" id="product-{{ $product->id }}">
                                        </div>
                                    </div>
                                    <img class="card-img-top" src="{{ asset('storage/products/'.$product->image) }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-primary fw-semibold">Rs. {{ $product->price }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-shopping-bag me-1"></i> Checkout Selected Items
                            </button>
                            <a href="{{ route('user_dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bx bx-info-circle me-1"></i>
                        Your cart is empty. Please add some products to your cart.
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('user_dashboard') }}" class="btn btn-primary">
                            <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
