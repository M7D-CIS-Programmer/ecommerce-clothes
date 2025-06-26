<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::middleware('role:admin')->get('/admin/dashboard', function () {
//     return "Hello Admin!";
// });

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'], ['middleware' => 'roles:admin'])->name('admin.dashboard');
Route::get('/editor/dashboard', [EditorController::class, 'dashboard'], ['middleware' => 'roles:editor'])->name('editor.dashboard');

Route::get('home',[HomeController::class,'index'])->name('home');

Route::get('product/{id?}', [ProductController::class, 'index'])->name('product.index');

Route::get('product-detail/{id}', [ProductController::class, 'detail'])->name('product.detail');

Route::get('shopping-cart', [CartController::class, 'index'])->name('Cart.index');

Route::post('update-cart', [CartController::class, 'updateCart'])->name('Cart.update');

Route::get('delete-cart/{id}', [CartController::class, 'destroy'])->name('Cart.delete');

Route::get('check-out', [CartController::class, 'checkOut'])->name('Cart.Check');

Route::get('add-to-cart', [CartController::class, 'addToCart'])->name('shopping.cart');

Route::get('/{page?}', [App\Http\Controllers\HomeController::class, 'testing'])->name('home.testing');



