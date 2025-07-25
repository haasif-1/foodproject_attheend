@if(isset($orders) && $orders->isNotEmpty())
    @foreach($orders as $order)
        @php
            $badgeClass = match($order->status) {
                'confirmed' => 'bg-success',
                'cancelled' => 'bg-danger',
                default => 'bg-label-info'
            };
        @endphp

        <div class="card mb-4 order-card" data-id="{{ $order->id }}">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                    <div>
                        <span class="badge bg-label-success me-2">Total: Rs. {{ number_format($order->amount) }}</span>
                        <span class="badge {{ $badgeClass }} order-status-badge">
                            {{ ucfirst($order->status ?? 'Pending') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!-- Your product + user details as before -->
                <div class="row g-4">
                    <div class="col-md-5">
                        <h6 class="fw-semibold mb-3">Customer Information</h6>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><span class="fw-medium">Name:</span> {{ $order->user_name }}</li>
                            <li class="mb-2"><span class="fw-medium">Email:</span> {{ $order->email }}</li>
                            <li class="mb-2"><span class="fw-medium">Phone:</span> {{ $order->phone }}</li>
                            <li class="mb-2"><span class="fw-medium">Address:</span> 
                                {{ $order->street }}, {{ $order->city }}, {{ $order->province }}, {{ $order->country }}
                            </li>
                        </ul>
                    </div>

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

                <div class="order-status-message mt-3"></div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-outline-success me-2 confirm-order-btn" data-id="{{ $order->id }}">
                        <i class="bx bx-check-circle me-1"></i> Confirm Order
                    </button>
                    <button class="btn btn-outline-danger cancel-order-btn" data-id="{{ $order->id }}">
                        <i class="bx bx-x-circle me-1"></i> Cancel Order
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-warning" role="alert">
        <strong>No Orders Found</strong> - There are no orders for the selected status.
    </div>
@endif
