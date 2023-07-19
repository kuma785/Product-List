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
    

    public function search(Request $request){
        $p_name = $_POST['p_name'];
        $s_name = $_POST['s_name'];
        $price_min = $_POST['price_min'];
        $price_max = $_POST['price_max'];
        $stock_min = $_POST['stock_min'];
        $stock_max = $_POST['stock_max'];
        $sortkey = $_POST['sortkey'];
        $sortby = $_POST['sortby'];
        
        DB::beginTransaction();
        try{
            $companies = Company::all();
            $products = new Product();
            $productList = $products->productDbList($p_name,$s_name,$price_min,$price_max,$stock_min,$stock_max,$sortkey,$sortby);
            $data = json_encode([$productList,$companies]);
            echo $data;
            
            
        }catch(ValidationException $e){
            return back();
        }
    }    
    

    public function index(Request $request){
        $companys = Company::all();
        $products = Product::all();    

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
        
        try{
            $companies = DB::table('companies')
            ->where('id','=',$product->company_id)
            ->get();
            $company = $companies[0];
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }
        return view('pdlist.pd_detail',compact('product','company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product){
        try{
            $companys =  DB::table('companies')->get();
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }
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
            $test = $product->productDbUpdate($request,$product);
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
    
    public function delete(Product $product){
        $num = $_POST['delnum'];
        $img = $_POST['imgpass'];

        DB::beginTransaction();
        try{
            $product = new Product();
            $productLists = $product->productDbDel($num);
            \Storage::disk('public')->delete($img); 
            DB::commit();

            return;
            
        }catch(ValidationException $e){
            DB::rollback();
            return back();
        }
        

    }

}
