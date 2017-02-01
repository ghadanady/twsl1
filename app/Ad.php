<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
  

   
    public function getPosition($value)
    {
        return $this->place == $value;
    }

     public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
}
