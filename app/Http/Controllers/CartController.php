<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    public function index()
    {
        $total = 0;
        $cart = DB::table('shopping_cart')->get();
        $products = $cart->map(function ($item) {
            return Product::find($item->product_id);
        });

        $quantity = $cart->map(function ($item) {
            return $item->quantity;
        }); 

        // Calculate the total price of single product in table products
        $TotalOfProduct = $cart->map(function($item) {
            return $item->total;
        });

        // Calculate the total price of the all products in the cart
        foreach ($products as $key => $product) {
            $total += $product->price * $quantity[$key];
        }

        return view('pages.shopping-cart', compact('cart', 'products','quantity','total','TotalOfProduct'));
    }

    public function updateCart(Request $request)
    {
        $productIds = $request->input('product_id'); // مصفوفة
        $quantities = $request->input('quantity'); // مصفوفة

        if (!$productIds) {
            return response()->json(['success' => false, 'message' => 'لم يتم إرسال معرفات المنتجات'], 400);
        }
    
        foreach ($productIds as $index => $productId) {
            $cartItem = ShoppingCart::where('product_id', $productId)->first();
    
            if ($cartItem) {
                $cartItem->update([
                    'quantity' => $quantities[$index],
                    'total' => Product::find($productId)->price * $quantities[$index]
                ]);
            }
        }

    
        return redirect()->back();
    }
    

    public function destroy($id)
    {
        $cartItem = ShoppingCart::find($id);

        dd($cartItem);
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->back();
    }


    public function addToCart(Request $request)
{
    $productId = $request->input('product_id');

    if (!$productId) {
        return response()->json(['success' => false, 'message' => 'لم يتم إرسال معرف المنتج'], 400);
    }

    $cartItem = ShoppingCart::where('product_id', $productId)->first();

    if ($cartItem) {
        // المنتج موجود، قم بتحديث الكمية
        $quantity = $cartItem->quantity + $request->input('quantity');
        $cartItem->update([
            'quantity' => $quantity,
            'total' => Product::find($productId)->price * $quantity
        ]);
    } else {
        // المنتج غير موجود، قم بإضافته إلى السلة
        ShoppingCart::create([
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'product_id' => $productId,
            'quantity' => $request->input('quantity'),
            'total' => Product::find($productId)->price * $request->input('quantity')
        ]);
    }

    return response()->json(['success' => true, 'message' => 'تمت إضافة المنتج بنجاح']);
}

public function checkOut(Request $request){

    CheckOut::create([
        'country' => $request->country,
        'address' => $request->address,
        'phone'   => $request->phone,
        'userId'  => Auth::user()->id
    ]);

    session()->flash('Ok', 'تم ارسال طلبك بنجاح!');

    DB::table('shopping_cart')->delete();

    return redirect()->back();
}

}
