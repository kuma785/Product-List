<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::all();

        return view('pdlist.pd_read',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('pdlist.pd_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'company_id' => 'required',
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'required',
        ]);

        $product = new Product();
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');       
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->save();

        return redirect()->route('pdlist.pd_create')->with('flash_massage','登録が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        return view('pdlist.pd_detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        return view('pdlist.pd_edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');       
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->save();
        
        return redirect()->route('pdlist.pd_detail', $product)->with('flash_massage','商品の情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        $product->delete();

        return redirect()->route('pdlist.pd_read')->with('flash_massage','商品を削除しました。');
    }
}
