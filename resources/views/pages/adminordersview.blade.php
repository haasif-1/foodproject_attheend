@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Orders /</span> All Orders
    </h4>

    @if($orders->isEmpty())
        <div class="alert alert-warning" role="alert">
            <strong>No Orders Found</strong> - You have not received any orders yet.
        </div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                        <span class="badge bg-label-success me-1">Total: Rs. {{ number_format($order->amount) }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Side: Order Details -->
                        <div class="col-md-5">
                            <h6 class="fw-semibold mb-3">Customer Information</h6>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <span class="fw-medium">Name:</span> {{ $order->user_name }}
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium">Email:</span> {{ $order->email }}
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium">Phone:</span> {{ $order->phone }}
                                </li>
                                <li class="mb-2">
                                    <span class="fw-medium">Address:</span> 
                                    {{ $order->street }}, {{ $order->city }}, {{ $order->province }}, {{ $order->country }}
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Right Side: Product Images -->
                        <div class="col-md-7">
                            <h6 class="fw-semibold mb-3">Ordered Products</h6>
                            <div class="row g-3">
                                @foreach($order->product_items as $product)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card h-100">
                                            <img class="card-img-top" src="{{ asset('/storage/products/'.$product->image) }}" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $product->name }}</h6>
                                                <p class="card-text">Rs. {{ number_format($product->price) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="mt-4">
        <a href="{{ route('admin_dashboard') }}" class="btn btn-primary">
            <i class="bx bx-left-arrow-alt me-1"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
