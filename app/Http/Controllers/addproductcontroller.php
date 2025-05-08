<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class addproductcontroller extends Controller
{

function addProduct(Request $req){

        $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);


            $add = Product::firstOrCreate([
                'name' => $validatedData['name'],
            ], [
                'price' => $validatedData['price'],
            ]);

           if($add){
            return redirect()->route('showitem');
           }
           else{
            return back()->withErrors('Failed to add product.');
           }
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

function addStock(Request $req){
    $product = Product::find($req->product_id);
     $product->qunatity += $req->quantity;
     $product->save();

     return redirect()->back()->with('success', 'Stock added successfully!');


}

// public function addStock(Request $request)
// {
//     // $request->validate([
//     //     'product_id' => 'required|exists:product,id',
//     //     'quantity' => 'required|integer|min:1',
//     // ]);

//     $product = Product::find($request->product_id);
//     $product->qunatity += $request->quantity;
//     $product->save();

//     // return redirect()->back()->with('success', 'Stock added successfully!');
// }




}
