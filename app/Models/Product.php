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

    public function productDbDelete($data){
        $product = ['id'=> $data->id];
        DB::delete('DELETE from products where id =:id',$product);
           
    }
    
}

