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

    public function productDbList($name,$id,$price_min,$price_max,$stock_min,$stock_max,$sortkey,$sortby){
    //public function productDbList($search_val){
        
        
        $where = [
            ['product_name','LiKE',"%".$name."%"]
        ];

        if($id!==''){
            array_push($where,['company_id','LiKE',"%".$id."%"] );
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
        DB::table('products')->insert([
            'company_id' => $data->company_id,
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
        $product = ['id' => $data2->id];
        DB::table('products')->where($product)->update([
            'company_id' => $data->company_id,
            'product_name' => $data->input('product_name'),       
            'price' => $data->input('price'),
            'stock' => $data->input('stock'),
            'comment' => $data->input('comment'),                                                                  
            'created_at' => now(),
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

