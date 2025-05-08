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
Route::post('adduser',[usercontroller::class,'addnewuser'])->name('adduser');

Route::post('logincontroller',[logincontroller::class,'login'])->name('logincontroller');

Route::post('addproducts',[addproductcontroller::class,'addProduct'])->name('addproducts');

Route::get('showitem',[addproductcontroller::class,'showProducts'])->name('showitem');

Route::get('deleteproduct/{id}',[addproductcontroller::class,'deleteproduct'])->name("deleteproduct");

Route::get('updateproduct/{id}',[addproductcontroller::class,'updateproduct'])->name("updateproduct");

Route::put('editproduct/{id}',[addproductcontroller::class,'editproduct'])->name('editproduct');

Route::get('userlist',[projectuserscontroller::class,'userlist'])->name('userlist');

Route::get('deleteuser/{id}',[projectuserscontroller::class,'deleteuser'])->name("deleteuser");

Route::get('updateuser/{id}',[projectuserscontroller::class,'updateuser'])->name("updateuser");

Route::put('edituser/{id}',[projectuserscontroller::class,'edituser'])->name('edituser');

Route::post('userdatacheck',[projectuserscontroller::class,'datauser'])->name('userdatacheck');

Route::post('changeuserpassword',[projectuserscontroller::class,'changepassword'])->name('changeuserpassword');

Route::post('changedone/{id}',[projectuserscontroller::class,'savenewpass'])->name('changedone');

Route::get('updateuserdata',[projectuserscontroller::class,'updatauserinfo'])->name('updateuserdata');

Route::put('editmyselfdata/{id}',[projectuserscontroller::class,'edituserinfo'])->name('editmyselfdata');


Route::get('selectuser',[assignproduct::class,'showUserSelectForm'])->name('selectuser');

Route::post('selectedone',[assignproduct::class,'handleSelectedUser'])->name('selectedone');

Route::get( 'showmyproducts',[assignproduct::class,'showassignproduct'])->name('showmyproducts');

Route::get( 'viewordertoadmin',[assignproduct::class,'showCartData'])->name('viewordertoadmin');

Route::get('done/{id}', [addtocartcontroller::class, 'processCart'])->name('donebyadmin');

Route::post('addtocarttable',[addtocartcontroller::class,'storeToCart'])->name('addtocarttable');

Route::post('/admin/add-stock', [addproductcontroller::class, 'addStock'])->name('admin.addstock');

Route::get('/my-cart', [addtocartcontroller::class, 'showUserCart'])->name('user.cart');


Route::get('adding', function () {
    return view('pages.addproduct');
})->name("adding");

Route::get('admin', function () {
    return view('pages.adminpage');
})->name("admin_dashboard");

Route::get('register', function () {
    return view('pages.addnewuser');
})->name("register");









