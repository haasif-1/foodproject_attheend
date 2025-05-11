<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Grid</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 90%;
            margin: auto;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-name {
            margin-top: 10px;
            font-size: 16px;
            color: #333;
        }

        .product-price {
            margin-top: 5px;
            font-size: 18px;
            color: #e74c3c;
            font-weight: bold;
        }

        .product-checkbox {
            margin-top: 10px;
        }

        .product-actions {
            position: absolute;
            bottom: 15px;
            right: 15px;
        }

        .product-actions button {
            padding: 8px 14px;
            background-color: #ff6f00;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .product-actions button:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('saveafterselect') }}">
    @csrf

    <div class="product-grid">
        @foreach ($products as $pro)
            <div class="product-card">
                <img src="{{ asset('storage/products/'.$pro->image) }}" alt="Product Image">
                <div class="product-price">Rs. {{ $pro->price }}</div>
                <div class="product-name">{{ $pro->name }}</div>

                <div class="product-checkbox">
                    <input type="checkbox" name="products[]" value="{{ $pro->id }}"> Select
                </div>
            </div>
        @endforeach
    </div>

    <div class="product-actions">
        <button type="submit">Add to Cart</button>
    </div>
</form>
   <form action="{{ route('user_dashboard') }}"  class="back-button-form">
           
            <button type="submit">Back to Dashboard</button>
        </form>
</body>
</html>
