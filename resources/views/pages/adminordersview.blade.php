<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>

<div class="container mx-auto p-6">
    <h2 class="text-3xl font-bold mb-6">Order List</h2>

    @if($orders->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
            <p class="font-bold">No Orders Found</p>
            <p>You have not received any orders yet.</p>
        </div>
    @else
        @foreach($orders as $order)
            <div class="bg-white shadow-md rounded-lg mb-6 p-6 border">
                <div class="flex flex-col lg:flex-row gap-6">

                    {{-- Left Side: Order Details --}}
                    <div class="lg:w-1/2">
                        <p class="text-sm text-gray-600">Order ID: <span class="font-semibold">{{ $order->id }}</span></p>
                        <p class="text-sm text-gray-600">User Name: <span class="font-semibold">{{ $order->user_name }}</span></p>
                        <p class="text-sm text-gray-600">User Email: <span class="font-semibold">{{ $order->email }}</span></p>
                        <p class="text-sm text-gray-600">Phone: <span class="font-semibold">{{ $order->phone }}</span></p>
                        <p class="text-sm text-gray-600">Address: 
                            <span class="font-semibold">
                                {{ $order->street }}, {{ $order->city }}, {{ $order->province }}, {{ $order->country }}
                            </span>
                        </p>
                        <p class="text-lg font-bold text-green-600 mt-4">Total Amount: Rs. {{ number_format($order->amount) }}</p>
                    </div>

                    {{-- Right Side: Product Images --}}
                    <div class="lg:w-1/2">
                        <h3 class="text-xl font-semibold mb-4">Ordered Products:</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($order->product_items as $product)
                                <div class="border rounded-lg overflow-hidden shadow hover:shadow-md transition">
                                    <img src="{{ asset('/storage/products/'.$product->image) }}" alt="{{ $product->name }}" class="h-48 w-full object-cover">
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                                        <p class="text-sm text-gray-500">Price: Rs. {{ number_format($product->price) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    @endif

</div>
     <form action="{{ route('admin_dashboard') }}" class="back-button-form">
            <button type="submit">Back to Dashboard</button>
        </form>

</body>
</html>
