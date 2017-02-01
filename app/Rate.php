<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table="ratings";

    public function product()
    {
        return $this->belongsTo('App\Product' ,'id');
    }
}
