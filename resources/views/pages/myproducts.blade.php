<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Products</title>
</head>
<body>


    @if($products->isEmpty())
    <p>No products assigned to you.</p>
@else
    <ul>
        @foreach($products as $product)
            <li> {{ $product->name }} - {{ $product->price }} </li>
        @endforeach
    </ul>
@endif

<br>
<br>

<h1>Add to Cart </h1>

<form action=" {{ route('addtocarttable') }}" method="POST">
    @csrf

    <label for="product_name">Select Product:</label>
    <select name="product_name" required>
        @foreach($products as $product)
            <option value="{{ $product->name }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" min="1" required>

    <button type="submit">Add to Cart</button>
</form>




</body>
</html>