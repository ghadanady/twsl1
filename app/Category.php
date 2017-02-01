<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {



  public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }
    public function isMain()
    {
        return $this->parent_id == 0 && !$this->subCategories->isEmpty();

    }

    public function getUrl()
    {

        return route('site.category.index',['slug'=> $this->slug]);

    }

    public function getProducts()
    {
        $products = $this->products;

        if(!$this->subCategories->isEmpty()){
            $this->subCategories->map(function($c) use (&$products){
                if(!$c->products->isEmpty()){
                    foreach ($c->products as $product) {
                        $products->push($product);
                    }
                }
            });
        }

        return $products;
    }

    public function isActive()
    {
        return (bool) $this->active;
    }

    public function isSub()
    {
        return !$this->isMain();
    }

    public function products() {
        return $this->hasMany('App\Product', 'category_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo('App\Category' ,'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany('App\Category' ,'parent_id');
    }

}
