<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;



    public function buy($product_id){
        DB::table('sales')->insert([
            'product_id' => $product_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $col = ['id' => $product_id];
        DB::table('products')->where($col)->decrement('stock',1);

        return;
    }
}
