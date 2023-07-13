<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    //
    public function index(Request $request){
        $data = $request->input('id');
        
        $stock = DB::table('products')->where('id','=',$data)->get('stock');
        $stockstr = json_decode($stock,true);
        
        if($stockstr[0]['stock']==0){
            echo '在庫がないため購入できませんでした。';
        }else{
            DB::beginTransaction();
            try{
                $sales = new Sale();
                $stock = $sales->buy($data);
                DB::commit();
                echo '購入しました';
                
            }catch(ValidationException $e){
                DB::rollback();
                return back();
            }

        }
        
        return false;
    
    }
}
