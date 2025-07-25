<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;  
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class assignproduct extends Controller
{
   
function showproducts(){
    $products = Product::all();
    return view("pages.allproducts",compact("products"));
}

public function placeorder_function(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'country' => 'required',
        'province' => 'required',
        'city' => 'required',
        'street' => 'required',
        'products' => 'required|array',
    ]);

    $user = Auth::user();

    $flattened = [];

foreach ($request->products as $id) {
    if (str_contains($id, ',')) {
        $flattened = array_merge($flattened, explode(',', $id));
    } else {
        $flattened[] = $id;
    }
}

$uniqueProductIds = array_unique($flattened);

  $totalAmount = Product::whereIn('id', $uniqueProductIds)->sum('price');



order::create([
    'user_id'     => $user->id,
    'user_name'   => $user->name,
    'email'       => $user->email,
    'phone'       => $request->phone,
    'country'     => $request->country,
    'province'    => $request->province,
    'city'        => $request->city,
    'street'      => $request->street,
    'product_ids' => json_encode($uniqueProductIds),
     'amount'      => $totalAmount,
]);

return response()->json(['success' => true, 'message' => 'Order placed successfully!']);

}


public function myOrders()
{
    $user = Auth::user();

    $orders = order::where('user_id', $user->id)->get();

    foreach ($orders as $order) {
        $productIds = json_decode($order->product_ids, true);
        $products = product::whereIn('id', $productIds)->get();
        $order->products = $products;
    }

    return view('pages.viewmyorder', compact('orders'));
}

public function adminview_orders()
{
    $orders = Order::all();

    foreach ($orders as $order) {
        $productIds = json_decode($order->product_ids, true) ?? [];

        $products = is_array($productIds) && count($productIds) > 0
            ? Product::whereIn('id', $productIds)->get()
            : collect();

        $order->product_items = $products;
    }

    return view('pages.adminordersview', compact('orders'));
}

public function confirmOrder($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'confirmed';
    $order->save();

    return response()->json([
        'message' => 'Order confirmed successfully.',
        'status' => $order->status,
    ]);
}


// Cancel
public function cancelOrder($id)
{
    $order = Order::findOrFail($id);
    $order->status = 'cancelled';
    $order->cancelled_at = now();
    $order->save();

    return response()->json([
        'message' => 'Order cancelled. It will be deleted in 24 hours.',
        'status' => $order->status,
    ]);
}

public function filterOrders(Request $request)
{
    $status = $request->status;

    // Get orders with status
  $orders = Order::when($status, function ($query, $status) {
    return $query->where('status', $status);
})
->orderBy('created_at', 'desc')
->get();

   $html = '';

$html .= '<div id="ordersContainer">';

if ($orders->isEmpty()) {
    $html .= '<div class="alert alert-warning" role="alert">
                <strong>No Orders Found</strong> - You have not received any orders yet.
            </div>';
} else {
    foreach ($orders as $order) {
        $productIds = json_decode($order->product_ids);
        $products = Product::whereIn('id', $productIds)->get();

        $badgeClass = match ($order->status) {
            'confirmed' => 'bg-success',
            'cancelled' => 'bg-danger',
            default => 'bg-label-info'
        };

        $html .= '
        <div class="card mb-4 order-card" data-id="' . $order->id . '" id="order-' . $order->id . '">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Order #' . $order->id . '</h5>
                    <div>
                        <span class="badge bg-label-success me-2">Total: Rs. ' . number_format($order->amount) . '</span>
                        <span class="badge ' . $badgeClass . ' order-status-badge">' . ucfirst($order->status ?? 'Pending') . '</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-5">
                        <h6 class="fw-semibold mb-3">Customer Information</h6>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2"><span class="fw-medium">Name:</span> ' . $order->user_name . '</li>
                            <li class="mb-2"><span class="fw-medium">Email:</span> ' . $order->email . '</li>
                            <li class="mb-2"><span class="fw-medium">Phone:</span> ' . $order->phone . '</li>
                            <li class="mb-2"><span class="fw-medium">Address:</span> ' . $order->street . ', ' . $order->city . ', ' . $order->province . ', ' . $order->country . '</li>
                        </ul>
                    </div>

                    <div class="col-md-7">
                        <h6 class="fw-semibold mb-3">Ordered Products</h6>
                        <div class="row g-3">';
                        foreach ($products as $product) {
                            $html .= '
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="' . asset('storage/products/' . $product->image) . '" alt="' . $product->name . '" style="height: 150px; object-fit: cover;">
                                    <div class="card-body">
                                        <h6 class="card-title">' . $product->name . '</h6>
                                        <p class="card-text">Rs. ' . number_format($product->price) . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    $html .= '</div>
                    </div>
                </div>

                <div class="order-status-message mt-3"></div>

                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-outline-success me-2 confirm-order-btn" data-id="' . $order->id . '">
                        <i class="bx bx-check-circle me-1"></i> Confirm Order
                    </button>
                    <button class="btn btn-outline-danger cancel-order-btn" data-id="' . $order->id . '">
                        <i class="bx bx-x-circle me-1"></i> Cancel Order
                    </button>
                </div>
            </div>
        </div>';
    }
}

$html .= '</div>';

return response()->json(['html' => $html]);
}

public function destroy($id)
{
    $order = Order::find($id);

    if (!$order) {
        return response()->json(['message' => 'Order not found.'], 404);
    }

    $order->delete();

    return response()->json(['message' => 'Order cancelled successfully.']);
}

  
    
}
