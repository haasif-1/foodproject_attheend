<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class addproductcontroller extends Controller
{

public function addProduct(Request $req)
{
    $validated = $req->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $req->file('image')->store('products', 'public');
    $filename = basename($imagePath);

    $product = Product::create([
        'name' => $validated['name'],
        'price' => $validated['price'],
        'image' => $filename,
    ]);

    return response()->json(['status' => 'success', 'message' => 'Product added successfully!']);
}




function showProducts(Request $req){
        $products = product::all();
        return view('pages.productlist',compact('products'));

}

function deleteproduct($id){
       $delete = product::destroy($id);

       if($delete){
        return  redirect()->route('showitem');
       }

}

function updateproduct($id){
    $product = product::find($id);
    return view('pages.updateproduct',['edit'=> $product ]);
}

public function editproduct(Request $req, $id)
{
    $validated = $req->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);
    $product = Product::findOrFail($id);
    $product->update([
        'name' => $validated['name'],
        'price' => $validated['price'],
    ]);
    return redirect()->route('showitem')
                     ->with('success', 'Product updated successfully');
}





}
