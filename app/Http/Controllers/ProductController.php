<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // public static $s = 0;
    public function index($sectionId = null)
    {
        $count = 0;

        $sections = Cache::remember('sections.all', 3600, function () {
            return Section::all(['id', 'name']);
        });

        $query = Product::query();
        if ($sectionId !== null) {
            $query->where('section_id', $sectionId);
            $count++;
        }

        $products = $query->orderByDesc('id')->paginate(12);

        // Keep these variables for view compatibility
        $product = Product::where('id', $sectionId)->get();
        $details = DB::table('product_details')->where('pro_id', $sectionId)->get();

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
        $productModel = Product::findOrFail($id);
        $SecrionOfNumber = $productModel->section_id;
        $SectionProduct  = Product::where('section_id', $SecrionOfNumber)->latest('id')->take(12)->get();

        $products = Product::latest('id')->take(20)->get();
        $sections = Cache::remember('sections.all', 3600, function () {
            return Section::all(['id', 'name']);
        });

        $product = Product::where('id', $id)->get();
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
