<?php

use App\Http\Controllers\addproductcontroller;
use App\Http\Controllers\addtocartcontroller;
use App\Http\Controllers\assignproduct;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\projectuserscontroller;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login'); // or redirect('/')
})->name('logout');


Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin_dashboard');
        } elseif ($user->hasRole('user')) {
            return redirect()->route('user_dashboard');
        }

        // Optional fallback
        Auth::logout();
        return redirect()->route('login')->with('error', 'Unauthorized role.');
    }

    // Guest user
    return redirect()->route('register');
});

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
});




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin', fn() => view('pages.adminpage'))->name('admin_dashboard');
    Route::get('showitem', [AddProductController::class, 'showProducts'])->name('showitem');
    Route::get('userlist', [ProjectUsersController::class, 'userlist'])->name('userlist');
    Route::get('orderslist', [AssignProduct::class, 'adminview_orders'])->name('orderslist');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('user_dashboard', [LoginController::class, 'userHome'])->name('user_dashboard');
    Route::get('userdatacheck', [ProjectUsersController::class, 'datauser'])->name('userdatacheck');
    Route::get('showallproducts', [AssignProduct::class, 'showproducts'])->name('showallproducts');
    Route::get('orderedproduct', [AssignProduct::class, 'myOrders'])->name('orderedproduct');
    Route::get('cartedproduct', [AddToCartController::class, 'showcart'])->name('cartedproduct');
});

Route::post('registercontroller',[usercontroller::class,'register'])->name('registercontroller');

Route::post('logincontroller',[logincontroller::class,'login'])->name('logincontroller');

Route::post('addproducts',[addproductcontroller::class,'addProduct'])->name('addproducts');

Route::delete('/deleteproduct/{id}', [addproductcontroller::class, 'destroy'])->name('deleteproduct');;

Route::get('editproduct/{id}',[addproductcontroller::class,'editproduct'])->name("editproduct");

Route::post('/updateproduct', [addproductcontroller::class, 'update'])->name('updateproduct');

Route::get('/products/search', [addproductcontroller::class, 'searchProducts'])->name('search.products');

Route::get('deleteuser/{id}', [projectuserscontroller::class, 'deleteuser'])->name("deleteuser");

Route::put('/user/change-password/{id}', [projectuserscontroller::class, 'changePassword'])->name('user.changePassword');

Route::get('/user/edit/{id}', [projectuserscontroller::class, 'showEditForm'])->name('user.edit.form');

Route::put('/user/update/{id}', [projectuserscontroller::class, 'updateUserInfo'])->name('user.update');

Route::post('saveafterselect', [addtocartcontroller::class, 'addtocart'])->name('saveafterselect');

Route::post('placeorder',[assignproduct::class,'placeorder_function'])->name('placeorder');

Route::delete('/orders/{id}', [assignproduct::class, 'destroy'])->name('orders.destroy');

Route::post('/order/{id}/confirm', [assignproduct::class, 'confirmOrder'])->name('order.confirm');
Route::post('/order/{id}/cancel', [assignproduct::class, 'cancelOrder'])->name('order.cancel');
Route::post('/orders/filter', [assignproduct::class, 'filterOrders'])->name('orders.filter');