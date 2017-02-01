<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductMaster;

class Cart extends Model
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart) {
		if ($oldCart) {
            $this->items = $oldCart->items; //array of items in the cart session.
            $this->totalQty = $oldCart->totalQty; //total quantity count of the items in the shopping cart.
            $this->totalPrice = $oldCart->totlaPrice;
        }
    }

    /*
    * add item to cart
    */
    public function add($item, $id) {
    	$product = new ProductMaster;

    	$storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
    	if (!is_null($this->items)) {
    		if (array_key_exists($id, $this->items)) {
    			$storedItem = $this->items[$id];
    		}
    	}

    	if($product->hasStock()) {
    		$storedItem['qty'] ++;
    		$storedItem['price'] = $item->price * $storedItem['qty'];
    		$this->items[$id] = $storedItem;
    		$this->totalQty++;
    		$this->totalPrice +=$item->price;
    	} else {
        	//not enough stock
    	}

    }

    /*
	* remove item form cart
    */
	public function removeItem($id) {
		$this->totalQty-=$this->items[$id]['qty'];
		unset($this->items[$id]);
	}

    /*
	* reduce items from the cart
    */
	public function updateQuantity($id, $reduced_quantity) {
		if ($this->items[$id]['qty'] == 0) {
			unset($this->items[$id]);
			return;
		}

		if ($reduced_quantity == 0) {
			unset($this->items[$id]);
			return;
		}

		$this->items[$id]['qty'] = $reduced_quantity;
		$this->items[$id]['price'] = $this->items[$id]['item']['price'] * $reduced_quantity;
		$this->totalQty-=$reduced_quantity;


		if ($this->totalQty == 0) {
			Session::forget('cart');
		}
	}

}
