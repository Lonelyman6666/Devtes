<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Store;
use App\Product;


class Report_product extends Model
{
    //
    protected $table ='report_product';
    
    public function storeRef(){
        return $this->HasOne(Store::class,'store_id','store_id');
    }
    public function productRef(){
        return $this->HasOne(Product::class,'product_id','product_id');
    }
}