<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $products = Product::all();
        $companys = Company::all();

        $search_name = $request->input('product_name');
        $search_id = $request->input('company_id');

        $query = Product::query();

        if($search_id == NULL){
            $query->where('product_name','LiKE',"%$search_name%");
        }else{
            $query->where('product_name','LiKE',"%$search_name%")
            ->where('company_id','=',$search_id);
        };
        

        $products = $query->get();

        return view('pdlist.index',compact('products','companys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $reques){
        $companys = Company::all();

        return view('pdlist.pd_create',compact('companys'));
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
            'image' => 'required|image',
        ]);

        $product = new Product();
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');       
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->image = $request->file('image')->store('images','public');
        
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
        $companys = Company::all();
        return view('pdlist.pd_edit',compact('product','companys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product){
        $request->validate([
            'company_id' => 'required',
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'comment' => 'required',
            'image' => 'image',
        ]);
        
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');       
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        
        
        $image = $request->file('image');
        if(isset($image)){
            
            \Storage::disk('public')->delete($product->image);
            $product->image = $request->file('image')->store('images','public');
           
        }else{
           
        };
        
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
        \Storage::disk('public')->delete($product->image);

        return redirect()->route('pdlist.index')->with('flash_massage','商品を削除しました。');
    }
}
