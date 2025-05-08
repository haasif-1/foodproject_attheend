<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User cart</title>
</head>
<body>
    <h1>Your Cart</h1>

@if(count($carts) > 0)
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
                <tr>
                    <td>{{ $cart->product_name }}</td>
                    <td>{{ $cart->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>You have no items in your cart.</p>
@endif



</body>
</html>