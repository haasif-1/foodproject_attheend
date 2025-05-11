<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .cart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            width: 90%;
            margin: auto;
        }

        .cart-card {
            background: white;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }

        .cart-card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-name {
            margin-top: 10px;
            font-size: 16px;
        }

        .product-price {
            color: #e74c3c;
            font-weight: bold;
            margin-top: 5px;
        }

        .product-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>

    <h1>Your Cart</h1>

    <form method="POST" action="{{ route('buyingprocess') }}">
        @csrf

        <div class="cart-grid">
            @forelse ($cartProducts as $product)
                <div class="cart-card">
                    <img src="{{ asset('storage/products/'.$product->image) }}" alt="Product Image">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">Rs. {{ $product->price }}</div>
                       <div class="product-checkbox">
                        <input type="checkbox" name="products[]" value="{{ $product->id }}">
                    </div>
                </div>
            @empty
                <p style="text-align: center; width: 100%;">No products in your cart.</p>
            @endforelse
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit" style="padding: 10px 20px; background-color: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer;">
               Buy Products
            </button>
        </div>
    </form>
       <form action="{{ route('user_dashboard') }}"  class="back-button-form">
           
            <button type="submit">Back to Dashboard</button>
        </form>

</body>
</html>
