<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
      public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
}
