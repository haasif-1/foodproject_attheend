<?php

namespace App\Http\Controllers;
 use App\Models\cart;
 use App\Models\product;


use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class addtocartcontroller extends Controller
{

    public function storeToCart(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $userId = Auth::id();
    
        $cartItem = cart::where('user_id', $userId)
                        ->where('product_name', $request->product_name)
                        ->first();
    
        if ($cartItem) {
            // If the product is already in the cart, increment the quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            cart::create([
                'user_id' => $userId,
                'product_name' => $request->product_name,
                'quantity' => $request->quantity,
            ]);
        }
    
        return redirect()->route('showmyproducts')->with('success', 'Product added to cart successfully');
    }

public function showUserCart()
{
    $userId = Auth::id(); 

    $carts = cart::where('user_id', $userId)->get();

    return view('pages.usercart', compact('carts'));
}

    public function processCart($id)
    {
       
        $cart = cart::findOrFail($id);

        $product = product::where('name', $cart->product_name)->first();

        if ($product && $product->qunatity >= $cart->quantity) {
            $product->qunatity -= $cart->quantity;
            $product->save();
            $cart->delete();

        }

        return redirect()->route('viewordertoadmin')->with('success', 'Order processed successfully');
    }

    
}
