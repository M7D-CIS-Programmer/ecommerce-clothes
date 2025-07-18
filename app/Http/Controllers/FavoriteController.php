<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function index()
    {
        $favorites = Favorite::with('product')->where('user_id', Auth::id())->get();
        return view('pages.favorites', compact('favorites'));
    }


    public function toggle($id = null)
    {
        $user = auth()->user();
        $productId = $id;
        if (!$user) {
            return response()->json(['status' => 'unauthorized', 'message' => 'Unauthorized'], 401);
        }

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed', 'message' => 'Product removed from favorites']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['status' => 'added', 'message' => 'Product added to favorites']);
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['status' => 'unauthorized', 'message' => 'Unauthorized'], 401);
        }
        Favorite::find($id)->delete();
        return redirect()->back();
    }
}