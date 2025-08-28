<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
});


Auth::routes();

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('roles:admin')
    ->name('admin.dashboard');

Route::get('/editor/dashboard', [EditorController::class, 'dashboard'])
    ->middleware('roles:editor')
    ->name('editor.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('product/{id?}', [ProductController::class, 'index'])->name('product.index');
    Route::get('product-detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('shopping-cart', [CartController::class, 'index'])->name('Cart.index');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('Cart.update');
    Route::delete('delete-cart/{id}', [CartController::class, 'destroy'])->name('Cart.delete');
    Route::get('check-out', [CartController::class, 'checkOut'])->name('Cart.Check');
    Route::get('add-to-cart', [CartController::class, 'addToCart'])->name('shopping.cart');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::get('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');
    Route::post('/contact', [HomeController::class, 'contact'])->name('contact.send');
    Route::get('/favorite/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
    Route::get('section-products/{id}', [ProductController::class, 'getSectionProducts'])->name('section.products');
    Route::get('blog', [HomeController::class, 'getBlog'])->name('blog');
    Route::get('contact', [HomeController::class, 'getContact'])->name('contact');
    Route::get('about', [HomeController::class, 'getAbout'])->name('about');
    Route::get('cart', [HomeController::class, 'getCart'])->name('cart');


    Route::get('/{page?}', [HomeController::class, 'testing'])->name('home.testing');
});
















// Route::get('home',[HomeController::class,'index'])->name('home')->middleware('auth');

// Route::get('product/{id?}', [ProductController::class, 'index'])->name('product.index')->middleware('auth');

// Route::get('product-detail/{id}', [ProductController::class, 'detail'])->name('product.detail')->middleware('auth');

// Route::get('shopping-cart', [CartController::class, 'index'])->name('Cart.index')->middleware('auth');

// Route::post('update-cart', [CartController::class, 'updateCart'])->name('Cart.update');

// Route::get('delete-cart/{id}', [CartController::class, 'destroy'])->name('Cart.delete');

// Route::get('check-out', [CartController::class, 'checkOut'])->name('Cart.Check');

// Route::get('add-to-cart', [CartController::class, 'addToCart'])->name('shopping.cart')->middleware('auth');

// Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index')->middleware('auth');

// Route::get('/{page?}', [App\Http\Controllers\HomeController::class, 'testing'])->name('home.testing')->middleware('auth');

// Route::get('/cart/data',[CartController::class,'getCartData'])->name('cart.data');

// Route::post('/contact', [HomeController::class, 'contact'])->name('contact.send');

// Route::get('/favorite/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

// Route::get('/favorite/destroy/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');
