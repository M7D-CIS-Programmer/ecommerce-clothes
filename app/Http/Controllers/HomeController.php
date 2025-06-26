<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function index (){
        $products = DB::table('products')->get();
        $sections = DB::table('sections')->get();
        return view('pages.home', compact('products','sections'));
    }

    const FOLDER = "pages";
    public function testing($id)
    {
        $viewPage = self::FOLDER . '.' . $id;
        if (view()->exists($viewPage))
            return view($viewPage);
        else
            return view('404');
    }

}
