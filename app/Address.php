<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'addresses';
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name',
        'phone',
        'address1',
        'address2',
        'country',
        'city',
        'postal_code',
    ];
    /**
    * Get the Order(s) attached to the Address.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
