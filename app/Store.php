<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Store_account;
use App\Store_area;

class Store extends Model
{
    //
    protected $table ='store';

    public function accountRef(){
        return $this->HasOne(Store_account::class,'account_id','account_id');
    }
    public function areaRef(){
        return $this->HasOne(Store_area::class,'area_id','area_id');
    }
}
