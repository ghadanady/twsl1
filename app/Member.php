<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password',
        'phone',
        'address',
        'image',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlistProducts()
    {
        return $this->belongsToMany('App\Product','wishlist_user_product');
    }

    public function social()
    {
        return $this->hasOne('App\Social' , 'member_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * Get the Order(s) from the User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
    	return $this->hasMany('App\Order');
    }
}
