<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        return redirect()->back()->with('ReviewedSuccessfully', 'تم إضافة التقييم بنجاح');
    }

    public function deleteReview($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return redirect()->back()->with('DeletedReview','deleted successfully');
        } else {
            return redirect()->back()->with('ErrorDeleteReview','Review Not Found!');
        }
        
    }
}
