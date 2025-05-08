<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>

    <!-- CSS for the entire page -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        /* Specific CSS for the back button form */
        .back-button-form {
            text-align: center;
            margin: 30px auto;
            width: 80%;
        }

        .back-button-form button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .back-button-form button:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .back-button-form button:active {
            transform: translateY(0);
            box-shadow: none;
        }
        form[action="{{ route('admin.addstock') }}"] {
        width: 80%;
        margin: 30px auto;
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-size: 16px;
    }

    form[action="{{ route('admin.addstock') }}"] label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    form[action="{{ route('admin.addstock') }}"] select,
    form[action="{{ route('admin.addstock') }}"] input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    form[action="{{ route('admin.addstock') }}"] button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    form[action="{{ route('admin.addstock') }}"] button:hover {
        background-color: #45a049;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    form[action="{{ route('admin.addstock') }}"] button:active {
        transform: translateY(0);
        box-shadow: none;
    }
    </style>
</head>
<body>

    <h1>Available Products</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $pro)
                <tr>
                    <td>{{ $pro->name }}</td>
                    <td>{{ $pro->price }}</td>
                    <td>{{  $pro->qunatity }}</td>
                    <td>
                        <a href="{{ route('deleteproduct', ['id' => $pro->id]) }}">Delete</a>
                        <a href="{{ route('updateproduct', ['id' => $pro->id]) }}">Update</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Add Stock to Product</h2>


<form action="{{ route('admin.addstock') }}" method="POST">
    @csrf

    <label for="product_id">Select Product:</label>
    <select name="product_id" id="product_id" required>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <label for="quantity">Quantity to Add:</label>
    <input type="number" name="quantity" min="1" required>

    <button type="submit">Add Stock</button>
</form>

    <form action="{{route('admin_dashboard')}}" class="back-button-form">
        <button type="submit">Back to Dashboard</button>
    </form>

</body>
</html>
