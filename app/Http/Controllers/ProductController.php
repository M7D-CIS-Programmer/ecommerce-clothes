<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // public static $s = 0;
    public function index($sectionId = null)
    {
        $count      = 0;
        $product    = DB::table('products')->where('id', $sectionId)->get();
        $sections   = DB::table('sections')->get();
        $details    = DB::table('product_details')->where('pro_id', $sectionId)->get();

        if ($sectionId != null) {
            $products = DB::table('products')->where('section_id', $sectionId)->get();
            $count++;
        } else {
            $products = DB::table('products')->get();
        }

        return view('pages.product', compact('products', 'sections', 'count', 'product', 'details'));
    }

    public function getId($id)
    {
        // $product = DB::table('products')->where('id',$id)->get();
        // $sections = DB::table('sections')->get();
        $details = DB::table('product_details')->where('pro_id', $id)->get();
        return $details;
    }

    public function detail($id)
    {
        $SecrionOfNumber = DB::table('products')->where('id', $id)->value('section_id');
        $SectionProduct  = DB::table('products')->where('section_id', $SecrionOfNumber)->get();

        $products = DB::table('products')->get();
        $sections = DB::table('sections')->get();

        $product = DB::table('products')->where('id', $id)->get();
        $details = DB::table('product_details')->where('pro_id', $id)->get();

        return view('pages.product-detail', compact('product', 'details', 'SectionProduct', 'products', 'sections'));
    }


    public function getSectionProducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->get();
        return redirect()->route('product.index', $id)->with('products', $products);
    }
    // public function addToCart($id = null,Request $request) {
    //     ShoppingCart::create([
    //         'size'       => $request->size,
    //         'color'      => $request->color,
    //         'quantity'   => $request->quantity,
    //         'product_id' => $id == null ? $request->product_id : $id, 
    //     ]);
    //     return response()->json(['success' => true]);
    // }   


    
}
