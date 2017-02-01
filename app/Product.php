<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{

    public $quantity = null;

    protected $dates = ['discount_date'];

    /**
    * Check if a product has a low stock.
    *
    * @return boolean
    */


    public function hasLowStock()
    {
        return ($this->outOfStock() ? false : ($this->stock <= 5));
    }

    /**
    * Check if a product is out of stock.
    *
    * @return boolean
    */
    public function outOfStock()
    {
        return $this->stock === 0;
    }

    /**
    * Check if a product is in stock.
    *
    * @return boolean
    */
    public function inStock()
    {
        return $this->stock >= 1;
    }

    /**
    * Check if a product has an x amount of stock.
    *
    * @param  Integer  $quantity The amount of stock to check.
    * @return boolean
    */
    public function hasStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    /**
    * Get the Order(s) containing the Product.
    *
    * @return \Illuminate\Database\Eloquent\Relations::belongsToMany
    */
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    public function hasOffer()
    {
        return !empty($this->discount) && $this->discount > 0 && !empty($this->discount_date) &&
        $this->discount_date->gte(Carbon::today());
    }

    public function getDiscount()
    {
        return $this->hasOffer()? ($this->price - (($this->discount * $this->price) / 100)) :  $this->price;
    }

    public function getPrice()
    {
        return (number_format($this->price));
    }

    public function getUrl()
    {
        return route('product.show',['product'=> $this->slug]);
    }

    public function getWishlistUrl()
    {
        return route('site.wishlist.update',['slug'=> $this->slug]);
    }

    public function getCartUrl($type)
    {
        return route('site.cart.'.$type,['slug'=> $this->slug]);
    }

    public function isActive()
    {

        return (bool) $this->active;

    }

    public function category()
    {
        return $this->belongsTo('App\Category' ,'category_id');
    }

    public function getRating()
    {
        try {
            return $this->rates->sum('rating') / $this->rates->count();
        } catch (\Exception $e) {
            return 5;
        }
    }
    public function rates()
    {
        return $this->hasMany('App\Rate' ,'product_id');
    }

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    public function getImages()
    {
        $imgs = $this->images->map(function ($image)
        {
            $image->url = url('storage/uploads/images/products/'.$image->name);

            return $image;
        });

        return collect($imgs);
    }

    public function getDate()
    {
        return $this->discount_date->format('m/d/Y');
    }

    public function getDescription($limit = 320)
    {
        return str_limit(strip_tags($this->translated()->description) ,$limit);
    }

    public function getDiscountDate()
    {
        return $this->discount_date->format('Y/m/d');
    }

    public function wishlistMembers()
    {
        return $this->belongsToMany('App\Member','wishlist_user_product');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function total_reviews()
    {
        try{
            return round($this->reviews->sum('rate')/ $this->reviews->count());
        }catch(\Exception $e){
            return 0;
        }

    }

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function trash()
    {
        // trash images
        $this->trashImages();

        // trash reviews
        $this->trashReviews();

        // trash original products
        $this->trashSelf();
    }

    /**
    * Trash product images from the upload destination and the [images] table.
    *
    * @return void
    */
    protected function trashImages()
    {
        $this->images->map(function ($image)
        {
            $file_path = storage_path('uploads/images/products/'.$image->name);
            if(is_file($file_path)){
                @unlink($file_path);
            }
        });

        $this->images()->delete();
    }

    protected function trashReviews()
    {
        # code...
    }

    /**
    * Trash the self product.
    *
    * @return void
    */
    protected function trashSelf()
    {
        $this->delete();
        $this->rates()->delete();
    }

}
