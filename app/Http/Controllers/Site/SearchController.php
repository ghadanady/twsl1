<?php

namespace App\Http\Controllers\Site;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;


class SearchController extends Controller
{
    public function getIndex(Request $r)
    {
        $category = Category::where('slug', $r->category)->first();

        if(!$category){
            return back()->withWaring('لا يوجد قسم بهذا المعرف "'.$r->category.'"');
        }

        $ids = collect([$category->id]);
        if(!$category->subCategories->isEmpty()){
            $category->subCategories->map(function($c) use (&$ids){
                $ids->push($c->id);
            });
        }

        $products = Product::latest();

        if(!empty($r->q)){
            $products->where(function ($query) use($r)
            {
                $once = true;
                $cols = (new Product)->getTableColumns();
                foreach ($cols as $col) {
                    if (in_array($col, ['id', 'created_at', 'updated_at', 'category_id','stock','sold','discount_date','discount'])) {
                        continue;
                    }

                    if($once){
                        $query->where($col, 'LIKE', "%$r->q%");
                        $once = false;
                    }else{
                        $query->orWhere($col, 'LIKE', "%$r->q%");
                    }

                }
            });
            $products = $products->where('active',1)->whereIn('category_id',$ids->toArray())->paginate(20);
        }else{
            $products = paginate([],20);
        }

        return view('site.pages.results', compact('products'));
    }

    public function getLatestOffers()
    {

        $products = paginate(Product::latest()->get()->filter(function($product){
            return $product->hasOffer() && $product->isActive();
        }),20);

        return view('site.pages.results', compact('products'));
    }
}
