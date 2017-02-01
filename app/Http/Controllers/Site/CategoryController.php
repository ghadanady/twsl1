<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Category;
use App\Product;
use DB;

class CategoryController extends Controller
{
    /**
    * Render The Main or Sub Categories Page
    * @return View
    */
    public function getIndex($slug , Request $request)
    {

        $category = Category::where('slug', $slug)->first();

        if(!$category){

            abort(404);

        }

        if(!$category->isActive()){

            abort(404);

        }

        $products = $category->getProducts();

        if(empty($products)){

            abort(404);

        }

        // if the request is ajax request
        if ($request->ajax()) {
            return $this->filterCategoryProducts($products, $request);
        }

        $max_price = $products->reduce(function ($carry, $item){
            $discount = $item->getDiscount();
            return ($carry < $discount)? $discount : $carry;
        });
        $min_price=  $products->reduce(function ($carry, $item) use ($max_price){
            $discount = $item->getDiscount();
            $carry = $carry != 0 ? $carry : $max_price;
            return ($carry > $discount)? $discount : $carry;
        });
        $base_url = $category->getUrl();
        $products = paginate($products, 9);

        return view('site.pages.category' , compact('category','products' , 'max_price' , 'min_price' , 'base_url'));
    }

    protected function filterCategoryProducts(Collection $products, Request $request)
    {
        $per_page = $request->per_page;
        $order = $request->order;
        $rates = $request->rates;
        $min_price = floatval($request->min_price);
        $max_price = floatval($request->max_price);
        $products = $products->filter(function($product) use ($min_price , $max_price , $rates){
            $discount = $product->getDiscount();
            $rate = $product->getRating();

            return ($discount <= $max_price && $discount >= $min_price) &&
            in_array($rate, $rates);
        });

        switch ($order) {
            case 'sheepest':
            $products = $products->sort(function($first, $second){
                $first_discount = $first->getDiscount();
                $second_discount = $second->getDiscount();

                return ($first_discount == $second_discount)? 0 :
                (($first_discount > $second_discount) ? 1 : -1);
            });
            break;
            case 'expensive':
            $products = $products->sort(function($first, $second){
                $first_discount = $first->getDiscount();
                $second_discount = $second->getDiscount();

                return ($first_discount == $second_discount)? 0 :
                (($first_discount < $second_discount) ? 1 : -1);
            });
            break;
            case 'oldest':
            $products = $products->sortBy('created_at');
            break;
            case 'latest':
            $products = $products->sortByDesc('created_at');
            break;
            case 'name':
            $products = $products->sort(function($first , $last){
                return strcmp($first->name, $last->name);
            });
            break;
        }

        $products = paginate($products,$per_page);


        return view('site.pages.templates.category-products' , compact('products'))->render();
    }

}
