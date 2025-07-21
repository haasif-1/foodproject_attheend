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

public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['status' => 'error', 'message' => 'Product not found.']);
    }

    $product->delete();

    return response()->json(['status' => 'success', 'message' => 'Product deleted successfully.']);
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
