<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\product;

class addproductcontroller extends Controller
{

public function addProduct(Request $request)
{
  $validated = $request->validate([
    'name' => 'required|string|max:255',
    'price' => 'required|numeric',
    'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
]);

$imageName = time() . '.' . $request->image->extension();

// ✅ Save in storage/app/public/products
$request->image->storeAs('products', $imageName, 'public');

Product::create([
    'name' => $request->name,
    'price' => $request->price,
    'image' => $imageName,
]);

    $products = Product::latest()->get(); // or whatever your logic is

    $html = '';
    foreach ($products as $pro) {
        $html .= '
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top" src="' . asset("storage/products/" . $pro->image) . '" alt="' . $pro->name . '" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . $pro->name . '</h5>
                    <p class="card-text text-primary fw-semibold">Rs. ' . $pro->price . '</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="' . route('editproduct', ['id' => $pro->id]) . '" class="btn btn-sm btn-primary">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a href="javascript:void(0);" data-id="' . $pro->id . '" class="btn btn-sm btn-danger delete-btn">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>';
    }

    return response()->json(['status' => 'success', 'message' => 'Product added!', 'html' => $html]);
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

public function update(Request $request)
{
    $product = Product::find($request->id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->save();

    $products = Product::all();

    // Generate HTML for updated product list
    $html = '';
    foreach ($products as $pro) {
        $html .= '
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top" src="' . asset('storage/products/' . $pro->image) . '" alt="' . e($pro->name) . '" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . e($pro->name) . '</h5>
                    <p class="card-text text-primary fw-semibold">Rs. ' . e($pro->price) . '</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-primary edit-btn" data-id="' . $pro->id . '" data-name="' . e($pro->name) . '" data-price="' . e($pro->price) . '">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </button>
                        <a href="javascript:void(0);" data-id="' . $pro->id . '" class="btn btn-sm btn-danger delete-btn">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>';
    }

    return response()->json([
        'message' => 'Product updated successfully!',
        'html' => $html
    ]);
}



public function searchProducts(Request $request)
{
    $keyword = $request->keyword;

    $products = Product::where('name', 'like', "%$keyword%")
                ->orWhere('price', 'like', "%$keyword%")
                ->get();

    $html = '';
    foreach ($products as $pro) {
        $html .= '
        <div class="col">
            <div class="card h-100">
                <img class="card-img-top" src="' . asset("storage/products/" . $pro->image) . '" alt="' . $pro->name . '" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . $pro->name . '</h5>
                    <p class="card-text text-primary fw-semibold">Rs. ' . $pro->price . '</p>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="' . route('editproduct', ['id' => $pro->id]) . '" class="btn btn-sm btn-primary">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <a href="javascript:void(0);" data-id="' . $pro->id . '" class="btn btn-sm btn-danger delete-btn">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>';
    }

    return response($html);
}

}
