<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

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
        $sections = DB::table('sections')->get();
        $products = DB::table('products')->get();
        return view('pages.home', compact('sections', 'products'));
    }

    // const PAGES = 'pages';
    public function testing($page = null)
    {
        if ($page) {
            return view('pages.' . $page);
        } else {
            return view('404');
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
}