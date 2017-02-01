<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	protected $table ='slider';

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
}
