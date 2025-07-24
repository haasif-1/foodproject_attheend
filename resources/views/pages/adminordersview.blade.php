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
            <div class="card mb-4 order-card" data-id="{{ $order->id }}">
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

                    <!-- Cancel Button (Bottom Right) -->
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-outline-danger cancel-order-btn">
                            <i class="bx bx-x-circle me-1"></i> Cancel Order
                        </button>
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


@push('scripts')
<script>
    $(document).ready(function () {
        $('.cancel-order-btn').click(function () {
            let card = $(this).closest('.order-card');
            let orderId = card.data('id');

            showCustomConfirm("Are you sure you want to cancel this order?", function () {
                $.ajax({
                    url: `/orders/${orderId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        // Remove card from DOM
                        card.fadeOut(300, function () {
                            $(this).remove();
                        });

                        // Optional: show a message
                        showCustomAlert(response.message);
                    },
                    error: function (xhr) {
                        showCustomAlert(xhr.responseJSON.message || "Something went wrong.");
                    }
                });
            });
        });
    });
</script>

@endpush

@endsection


