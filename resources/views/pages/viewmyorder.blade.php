@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account /</span> My Orders
    </h4>

    @forelse ($orders as $order)
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                    <small class="text-muted">Placed on: {{ $order->created_at->format('d M Y, h:i A') }}</small>
                </div>
                <span class="badge bg-label-success">Total: Rs. {{ number_format($order->amount) }}</span>
            </div>

            {{-- 🟢 Status Message --}}
            @if ($order->status === 'confirmed')
                <div class="alert alert-success m-3 mb-0">
                    ✅ Your order has been <strong>confirmed</strong> by the admin.
                </div>
            @elseif ($order->status === 'cancelled')
                <div class="alert alert-danger m-3 mb-0">
                    ❌ Your order was <strong>cancelled</strong> by the admin.
                </div>
            @endif

            <div class="card-body">
                <div class="row g-4">
                    @foreach ($order->products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Rs. {{ number_format($product->price) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-3">
                    <i class="bx bx-package bx-lg text-primary"></i>
                </div>
                <h5>You have no orders yet</h5>
                <p class="mb-4">Browse our products and place your first order!</p>
                <a href="{{ route('showallproducts') }}" class="btn btn-primary">Browse Products</a>
            </div>
        </div>
    @endforelse

    <div class="mt-4 text-end">
        <a href="{{ route('user_dashboard') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
        </a>
    </div>
</div>
@endsection
