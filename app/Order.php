<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'hash',
        'paid',
        'address_id',
        'subtotal',
        'total',
    ];
    /**
    * Get the address(es) that belongs to the order.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function address()
    {
        return $this->belongsTo('App\Address');
    }
    /**
    * Get the customer who made the Order.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function member()
    {
        return $this->belongsTo('App\Member');
    }
    /**
    * Get the product(s) that the order contains.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function products()
    {
        return $this->belongsToMany('App\Product', 'order_product')->withPivot('quantity');
    }
    /**
    * Get the Payment that the Order has.
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
    /**
    * Get the total quantity of the ordered products.
    *
    * @return Integer
    */
    public function totalQuantity()
    {
        $total = 0;
        foreach($this->products() as $product) {
            $total += $product->pivot->quantity;
        }
        return $total;
    }
}
