<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Product_brand;

class Product extends Model
{
    //
    protected $table ='product';

    public function brandRef(){
        return $this->HasOne(Product_brand::class,'store_id','store_id');
    }
}
