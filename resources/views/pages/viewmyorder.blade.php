<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ordered Products</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Order Card Styles */
        .order-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            padding: 20px;
            border: 1px solid #e1e1e1;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-header p {
            margin: 0;
            font-size: 0.9rem;
            color: #555;
        }

        .order-header .total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2d9b72;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .product-card:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
        }

        .product-info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .product-info p {
            font-size: 1rem;
            color: #777;
        }

        /* Empty Orders Message */
        .empty-message {
            color: #999;
            font-size: 1.1rem;
            text-align: center;
            margin-top: 40px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>My Orders</h2>

    <!-- Start of Orders Loop (Replace this with dynamic content in Laravel) -->
    @forelse ($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <div>
                    <p>Order ID: <span class="font-semibold">{{ $order->id }}</span></p>
                    <p>Placed on: <span class="font-semibold">{{ $order->created_at->format('d M Y, h:i A') }}</span></p>
                </div>
                <p class="total">Total: Rs. {{ number_format($order->amount) }}</p>
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                @foreach ($order->products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/products/' . $product->image) }}" class="h-48 w-full object-cover" alt="{{ $product->name }}">
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <p>Rs. {{ number_format($product->price) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p class="empty-message">You have no orders yet.</p>
    @endforelse
   
</div>
   <form action="{{ route('user_dashboard') }}"  class="back-button-form">
           
            <button type="submit">Back to Dashboard</button>
        </form>

</body>
</html>
