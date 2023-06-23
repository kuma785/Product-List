<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;

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
    public function store(ProductRequest $request){
        
        DB::beginTransaction();
        try{
            $product = new Product();
            $product->productDbCreate($request);
            DB::commit();
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }

        return redirect()->route('pdlist.pd_create')->with('flash_massage',config('message.status.create'));
        
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
    public function update(ProductRequest $request, Product $product){
        DB::beginTransaction();
        try{
            if($request->contact==1){
                \Storage::disk('public')->delete($product->image); 
                $product->imgDbUpdate($request,$product);
            };
            $product->productDbUpdate($request,$product);
            DB::commit();
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }
        
        return redirect()->route('pdlist.pd_detail', $product)->with('flash_massage',config('message.status.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product){
        DB::beginTransaction();
        try{
            $product->productDbDelete($product);
            \Storage::disk('public')->delete($product->image); 
            DB::commit();
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }

        return redirect()->route('pdlist.index')->with('flash_massage',config('message.status.delete'));
    }
}
