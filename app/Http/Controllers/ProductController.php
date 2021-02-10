<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product-create-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('products')
            ->insert([
               'product_name' => $request->product_name,
               'price' => $request->price,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
            ]);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addToCart($id){
        $products = DB::table('products')->where('id',$id)->first();
        DB::table('carts')->insert([
            'product_name' => $products->product_name,
            'price' => $products->price,
            'status' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect('home');
    }

    public function submitCart(Request $request){
        $check = 0;
        $paid = $request->paid;
        $carts = DB::table('carts')->orderBy('created_at','desc')->get();
        foreach ($carts as $item){
            $check = $check + $item->price;
            if ($check<=$paid){
                DB::table('carts')->where('id',$item->id)->update([
                   'status' => "Paid"
                ]);
            }else{
                DB::table('carts')->where('id',$item->id)->update([
                    'status' => "Due"
                ]);
            }
        }
        return redirect('home');
    }

    public function resetCart(){
        DB::table('carts')->delete();
        return redirect()->back();
    }
}
