<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    //
    protected $table = "type_products";
    public function product(){
        return $this->hasMany('app\Product', 'id_type', 'id');
       }
}
