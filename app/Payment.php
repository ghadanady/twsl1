<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'failed', 'transaction_id',
    ];
    /**
     * Get the Order that belongs to the Payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }
}
