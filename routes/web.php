<?php

use App\Http\Controllers\addproductcontroller;
use App\Http\Controllers\addtocartcontroller;
use App\Http\Controllers\assignproduct;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\projectuserscontroller;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;



Route::view('/','auth.register');

Route::get('/login', function () {
    return view('auth.login');
})->name("login");


Route::post('registercontroller',[usercontroller::class,'register'])->name('registercontroller');
// Route::post('adduser',[usercontroller::class,'addnewuser'])->name('adduser');

Route::post('logincontroller',[logincontroller::class,'login'])->name('logincontroller');

Route::post('addproducts',[addproductcontroller::class,'addProduct'])->name('addproducts');

Route::get('showitem',[addproductcontroller::class,'showProducts'])->name('showitem');

Route::delete('/deleteproduct/{id}', [addproductcontroller::class, 'destroy'])->name('deleteproduct');;

Route::get('editproduct/{id}',[addproductcontroller::class,'editproduct'])->name("editproduct");

Route::post('/updateproduct', [addproductcontroller::class, 'update'])->name('updateproduct');

Route::get('/products/search', [addproductcontroller::class, 'searchProducts'])->name('search.products');


Route::get('userlist',[projectuserscontroller::class,'userlist'])->name('userlist');

Route::get('deleteuser/{id}', [projectuserscontroller::class, 'deleteuser'])->name("deleteuser");


Route::get('edituser/{id}',[projectuserscontroller::class,'edituser'])->name("edituser");

Route::put('updateuser/{id}',[projectuserscontroller::class,'updateuser'])->name('updateuser');

Route::post('userdatacheck',[projectuserscontroller::class,'datauser'])->name('userdatacheck');

Route::put('/user/change-password/{id}', [projectuserscontroller::class, 'changePassword'])->name('user.changePassword');

Route::get('/user/edit/{id}', [projectuserscontroller::class, 'showEditForm'])->name('user.edit.form');

Route::put('/user/update/{id}', [projectuserscontroller::class, 'updateUserInfo'])->name('user.update');

Route::get('showallproducts',[assignproduct::class,'showproducts'])->name('showallproducts');

Route::post('saveafterselect', [addtocartcontroller::class, 'addtocart'])->name('saveafterselect');

Route::post('placeorder',[assignproduct::class,'placeorder_function'])->name('placeorder');

Route::get('cartedproduct',[addtocartcontroller::class,'showcart'])->name('cartedproduct');

Route::delete('/orders/{id}', [assignproduct::class, 'destroy'])->name('orders.destroy');

Route::get('orderedproduct',[assignproduct::class,'myOrders'])->name('orderedproduct');

Route::get('orderslist',[assignproduct::class,'adminview_orders'])->name('orderslist');

Route::get('adding', function () {
    return view('pages.addproduct');
})->name("adding");

Route::get('admin', function () {
    return view('pages.adminpage');
})->name("admin_dashboard");


Route::get('user_dashboard',[logincontroller::class,'userHome'])->name('user_dashboard');


Route::get('register', function () {
    return view('pages.addnewuser');
})->name("register");









