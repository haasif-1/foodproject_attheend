<?php

namespace App\Http\Controllers;

use App\Models\product;  
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class assignproduct extends Controller
{
    function showUserSelectForm()
    {
        $users = User::role('user')->get(); 

       
        $products = product::all(); 

        // $nullproducts = product::whereDoesntHave('users')->get();

        return view('pages.selectuser', compact('users', 'products'));
    }

    public function handleSelectedUser(Request $request)
    {
        $user = User::find($request->user_id);
    
        if ($user && $user->hasRole('user')) {
            $productIds = $request->input('product_ids', []);
    
            if (!empty($productIds)) {
                $user->products()->syncWithoutDetaching($productIds);
    
                return redirect()->back()->with('success', 'Products assigned successfully.');
            }
        }
      
        return redirect()->back()->with('error', 'Invalid User or No Products Selected.');
    }


    function showassignproduct(){
        $user = Auth::user();

        if ($user->hasRole('user')) {
            
            $products = $user->products;
            return view('pages.myproducts', compact('products'));
        }


    }
    public function showCartData()
    {
       
        $carts = \App\Models\cart::join('users', 'carts.user_id', '=', 'users.id')
        ->select('carts.id', 'carts.product_name', 'carts.quantity', 'users.name as user_name', 'users.id as user_id')
        ->get();
    
    
        // Pass the cart data to the view
        return view('pages.adminvieworder', compact('carts'));
       
    }

  
    
}
