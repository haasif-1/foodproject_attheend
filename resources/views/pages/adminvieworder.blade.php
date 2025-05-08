<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Cart Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Cart Data</h1>

    <!-- Check if there are any carts -->
    @if(count($carts) > 0)
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Add  </th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{ $cart->user_name }}</td>
                        <td>{{ $cart->product_name }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td><a href="{{ route('donebyadmin', ['id' => $cart->id]) }}">DONE</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

      
    @else
        <p>No cart data found.</p>
    @endif

    <form action="{{route('admin_dashboard')}}" class="back-button-form">
        <button type="submit">Back to Dashboard</button>
    </form>

</body>
</html>
