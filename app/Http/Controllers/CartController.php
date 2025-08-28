<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
class CartController extends Controller
{

    public function index()
    {
        $total = 0;
        $cart = DB::table('shopping_cart')->where('user_id', Auth::user()->id)->get();
        $products = $cart->map(function ($item) {
            return Product::find($item->product_id);
        });

        $quantity = $cart->map(function ($item) {
            return $item->quantity;
        });

        // Calculate the total price of single product in table products
        $TotalOfProduct = $cart->map(function ($item) {
            return $item->total;
        });

        // Calculate the total price of the all products in the cart
        foreach ($products as $key => $product) {
            $total += $product->price * $quantity[$key];
        }

        return view('pages.shopping-cart', compact('cart', 'products', 'quantity', 'total', 'TotalOfProduct'));
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
        $DProduct = ShoppingCart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
        if ($DProduct) {
            $DProduct->delete();
            session()->flash('Deleted', 'تم حذف المنتج بنجاح!');
        } else {
            session()->flash('Error', 'المنتج غير موجود في السلة!');
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
                'user_id' => Auth::user()->id,
                'total' => Product::find($productId)->price * $request->input('quantity')
            ]);
        }

        return response()->json(['success' => true, 'message' => 'تمت إضافة المنتج بنجاح']);
    }


    public function checkOut()
    {
        $cart = ShoppingCart::where('user_id', Auth::id())->get();

        if ($cart->isEmpty()) {
            session()->flash('cartEmpty', 'لا توجد منتجات في السلة!');
            return redirect()->route('Cart.index');
        }

        // حساب السعر الإجمالي بناءً على الكمية والسعر
        $total = 0;
        foreach ($cart as $item) {
            // dd($item);
            $product = Product::find($item->product_id);
            $total += $product->price * $item->quantity;

        }

        DB::beginTransaction();
        try {
            // إنشاء الطلب
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total + 12, // إضافة رسوم الشحن أو أي رسوم إضافية  
                'status' => 'pending', // أو أي حالة افتراضية
            ]);

            // إدخال المنتجات ضمن order_items
            foreach ($cart as $item) {
                $product = Product::find($item->product_id);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'price' => $product->price, // السعر وقت الطلب
                ]);
            }

            // حذف محتوى السلة
            ShoppingCart::where('user_id', Auth::id())->delete();

            DB::commit();

            session()->flash('success', 'تم تأكيد الطلب بنجاح');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'حدث خطأ أثناء تنفيذ الطلب');
            return redirect()->route('Cart.index');
        }
    }


}