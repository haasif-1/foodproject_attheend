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



public function buy_function(Request $request)
{

    $productIds = $request->input('products');

    if (!$productIds) {
        return redirect()->back()->with('error', 'Please select at least one product.');
    }

    $products = Product::whereIn('id', $productIds)->get();

    return view('pages.ordercheckout', compact('products', 'productIds'));
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


    return redirect()->route('cartedproduct')->with('success', 'Order placed successfully!');
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

    if (is_array($productIds) && count($productIds) > 0) {
        $products = Product::whereIn('id', $productIds)->get();
    } else {
        $products = collect();
    }
    $order->product_items = $products;
}


    return view('pages.adminordersview', compact('orders'));
}




  
    
}
