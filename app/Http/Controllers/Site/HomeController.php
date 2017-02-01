<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Slider;

class HomeController extends Controller
{
    /**
     * Render the index page.
     *
     * @return View
     */
    public function getIndex()
    {
    	// $best_seller = Product::orderBy('sold' , 'desc')->paginate(4);
    	// $new_arrival = Product::latest()->take(16)->get();
    	// $categories  = Category::latest()
    	// ->get()
    	// ->filter(function($category){
    	// 	return $category->isMain() && count($category->getProducts());
    	// })
    	// ->take(7)->all();
    	// $hot_deals   = Product::orderBy('discount' , 'desc')
    	// ->get()
    	// ->filter(function($product){
    	// 	return $product->hasOffer();
    	// })
    	// ->take(16)->all();
        $slider=Slider::get();
        
        return view('site.pages.index',compact('slider'));
    }


}
