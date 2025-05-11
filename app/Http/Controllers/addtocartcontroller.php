<?php

namespace App\Http\Controllers;
 use App\Models\cart;
 use App\Models\product;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class addtocartcontroller extends Controller
{

function addtocart(Request $request){
        $user = Auth::user();

        $productIds = $request->input('products', []);

        $user->cartProducts()->syncWithoutDetaching($productIds);

        return back()->with('success', 'Products added to cart successfully!');
}


public function showcart()
{
    $user = Auth::user();
    
    $cartProducts = $user->cartProducts; 

    return view('pages.mycart', compact('cartProducts'));
}

  

    
}
