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
        $cart = ShoppingCart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $products = $cart->map(function ($cartItem) {
            return $cartItem->product;
        });

        $quantity = $cart->map(function ($cartItem) {
            return $cartItem->quantity;
        });

        $TotalOfProduct = $cart->map(function ($cartItem) {
            $price = optional($cartItem->product)->price ?? 0;
            return $price * $cartItem->quantity;
        });

        $total = $cart->reduce(function ($carry, $cartItem) {
            $price = optional($cartItem->product)->price ?? 0;
            return $carry + ($price * $cartItem->quantity);
        }, 0);

        return view('pages.shopping-cart', compact('cart', 'products', 'quantity', 'total', 'TotalOfProduct'));
    }

    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ]);

        $productIds = $validated['product_id'];
        $quantities = $validated['quantity'];

        // Preload product prices to avoid per-item queries
        $products = Product::whereIn('id', $productIds)->get(['id', 'price'])
            ->keyBy('id');

        foreach ($productIds as $index => $productId) {
            $cartItem = ShoppingCart::where('product_id', $productId)
                ->where('user_id', Auth::id())
                ->first();

            if ($cartItem) {
                $qty = $quantities[$index];
                $price = optional($products->get($productId))->price ?? 0;
                $cartItem->update([
                    'quantity' => $qty,
                    'total' => $price * $qty,
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
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
        ]);

        $productId = $validated['product_id'];
        $qty = $validated['quantity'];

        $product = Product::find($productId);
        $price = $product ? $product->price : 0;

        $cartItem = ShoppingCart::where('product_id', $productId)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            $newQty = $cartItem->quantity + $qty;
            $cartItem->update([
                'quantity' => $newQty,
                'total' => $price * $newQty,
            ]);
        } else {
            ShoppingCart::create([
                'size' => $request->input('size'),
                'color' => $request->input('color'),
                'product_id' => $productId,
                'quantity' => $qty,
                'user_id' => Auth::id(),
                'total' => $price * $qty,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'تمت إضافة المنتج بنجاح']);
    }


    public function checkOut()
    {
        $cart = ShoppingCart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cart->isEmpty()) {
            session()->flash('cartEmpty', 'لا توجد منتجات في السلة!');
            return redirect()->route('Cart.index');
        }

        // حساب السعر الإجمالي بناءً على الكمية والسعر
        $total = $cart->reduce(function ($carry, $item) {
            $price = optional($item->product)->price ?? 0;
            return $carry + ($price * $item->quantity);
        }, 0);

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
                $price = optional($item->product)->price ?? 0;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'price' => $price,
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