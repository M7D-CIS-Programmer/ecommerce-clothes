<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sections = Cache::remember('sections.all.v2', 3600, function () {
            return Section::all(['id', 'name', 'img']);
        });

        $products = Cache::remember('home.products.latest', 600, function () {
            return Product::latest('id')->take(24)->get(['id', 'name', 'price', 'img', 'section_id']);
        });
        return view('pages.home', compact('sections', 'products'));
    }

    public function testing($page = null)
    {
        if (\View()->exists('pages.' . $page)) {
            return view('pages.' . $page);
        } else {
            return view('404'); // Return a 404 view if the page does not exist
        }
    }

    public function contact(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'msg' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', '❌ Please fill in all fields correctly.');
        }
        return redirect()->back()->with('success', ' ✅ Your message has been sent successfully! Your inquiry will be answered via your email.');
    }

    public function getBlog()
    {
        return view('pages.blog');
    }

    public function getContact()
    {
        return view('pages.contact');
    }

    public function getAbout()
    {
        return view('pages.about');
    }

    public function getCart()
    {
        return view('pages.shopping-cart');
    }

}