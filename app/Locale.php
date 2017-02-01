<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'name',
        'is_ltr',
    ];
    
    public function isLtr()
    {
        return (bool) $this->is_ltr;
    }

    public function isRtl()
    {
        return ! $this->isLtr();
    }
}
