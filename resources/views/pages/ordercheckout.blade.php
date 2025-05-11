<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h2>Enter Your Address and Phone Info</h2>

    <form action="{{ route('placeorder') }}" method="POST">
        @csrf

@foreach ($productIds as $id)
    <input type="hidden" name="products[]" value="{{ $id }}">
@endforeach


        <label>Phone:</label><br>
        <input type="text" name="phone" required><br><br>

        <label>Country:</label><br>
        <input type="text" name="country" required><br><br>

        <label>Province:</label><br>
        <input type="text" name="province" required><br><br>

        <label>City:</label><br>
        <input type="text" name="city" required><br><br>

        <label>Street:</label><br>
        <input type="text" name="street" required><br><br>

        <button type="submit">Place Order</button>
    </form>
</body>
</html>
