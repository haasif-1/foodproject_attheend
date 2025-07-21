<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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

    // Delete the image using the 'public' disk
    if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
        Storage::disk('public')->delete('products/' . $product->image);
    }

    // Delete the product from DB
    $product->delete();

    return response()->json(['status' => 'success', 'message' => 'Product deleted successfully.']);
}


function editproduct($id){
    $product = product::find($id);
    return view('pages.updateproduct',['edit'=> $product ]);
}

public function updateproduct(Request $req, $id)
{
    // Validate the request
    $validated = $req->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
    ]);

    // Find product
    $product = Product::find($id);
    if (!$product) {
        return response()->json([
            'status' => 'error',
            'message' => 'Product not found.'
        ], 404);
    }

    // Update product
    $product->update([
        'name' => $validated['name'],
        'price' => $validated['price'],
    ]);

    // Return JSON response directly (no redirect)
    return response()->json([
        'status' => 'success',
        'message' => 'Product updated successfully.',
        'data' => $product
    ]);
}






}
