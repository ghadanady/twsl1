<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{

    protected $fillable = [
        'member_id',
        'provider_id',
        'provider_type',
    ];

    
    public function user()
    {
        return $this->belongsTo('App\Member' , 'member_id');
    }
}
