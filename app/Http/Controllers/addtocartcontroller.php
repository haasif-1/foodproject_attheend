<?php

namespace App\Http\Controllers;
 use App\Models\cart;
 use App\Models\product;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class addtocartcontroller extends Controller
{

public function addtocart(Request $request)
{
    $productIds = $request->input('products'); // array

    if ($productIds) {
        $user = Auth::user();
        $user->cartProducts()->syncWithoutDetaching($productIds); // Many-to-many
        return response()->json(['message' => 'Products added']);
    }

    return response()->json(['message' => 'No products selected'], 400);
}


public function showcart()
{
    $user = Auth::user();
    
    $cartProducts = $user->cartProducts; 

    return view('pages.mycart', compact('cartProducts'));
}

  

    
}
