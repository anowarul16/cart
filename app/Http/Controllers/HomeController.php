<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $status = "";
        $products = DB::table('products')->orderBy('created_at','desc')->get();
        $carts = DB::table('carts')->orderBy('created_at','desc')->get();
        $cartTotal = DB::table('carts')->sum('price');

        return view('home',compact('products','carts','cartTotal'));
    }
}
