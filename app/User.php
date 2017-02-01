<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        "password",
        "address",
        "phone" ,
        "national_id" ,
        "role_id",
        "gender",
        "age",
        "image_id",
        "recover_hash",
        "job",
    ];

    public function isAdmin(){
        return  $this->role->name === 'admin';
    }

    public function isNormal(){
        return  $this->role->name === 'normal';
    }

}
