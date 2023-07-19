<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsto(Company::class);
    }

    public function productDbList($p_name,$s_name,$price_min,$price_max,$stock_min,$stock_max,$sortkey,$sortby){
    //public function productDbList($search_val){
        
        //print_r($id->id) ;
        //echo $s_name;

        $where = [
            ['product_name','LiKE',"%".$p_name."%"]
        ];

        if($s_name!==''){
            $s_id = DB::table('companies')
            ->where('company_name','=',$s_name)
            ->get();   
            $id = $s_id[0];
            array_push($where,['company_id','=',$id->id] );
        };
        if($price_min!==''){
            array_push($where,['price','>=',$price_min] );
        };
        if($price_max!==''){
            array_push($where,['price','<=',$price_max] );
        };
        if($stock_min!==''){
            array_push($where,['stock','>=',$stock_min] );
        };
        if($stock_max!==''){
            array_push($where,['stock','<=',$stock_max] );
        };  

        $productList = DB::table('products')
            ->where($where)
            ->orderBy($sortkey,$sortby)
            ->get();
        
       return $productList;
    }

    public function productDbCreate($data){
        $company_name = DB::table('companies')
            ->where('company_name','=',$data->input('company_name'))
            ->get();

        DB::table('products')->insert([
            'company_id' => $company_name[0]->id,
            'product_name' => $data->input('product_name'),       
            'price' => $data->input('price'),
            'stock' => $data->input('stock'),
            'comment' => $data->input('comment'),
            'image' => $data->file('image')->store('images','public'),                                                                   
            'created_at' => now(),
            'updated_at' => now()
        ]);       
    }

    public function productDbUpdate($data,$data2){
        $company_name = DB::table('companies')
            ->where('company_name','=',$data->input('company_name'))
            ->get();

        $product = ['id' => $data2->id];
        DB::table('products')->where($product)->update([
            'company_id' => $company_name[0]->id,
            'product_name' => $data->input('product_name'),       
            'price' => $data->input('price'),
            'stock' => $data->input('stock'),
            'comment' => $data->input('comment'),                                                                  
            'updated_at' => now()
        ]);
    }

    public function imgDbUpdate($data,$data2){
        $product = ['id' => $data2->id];
        DB::table('products')->where($product)->update([
            'image' => $data->file('image')->store('images','public'),  
        ]); 
    }

    public function productDbDel($data){
        $productList = DB::table('products')
            ->where('id',$data)->delete(); 
        return ; 
    }
    
}

