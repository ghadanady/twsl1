<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Product;
use App\Comment;
use App\Category;
use App\Rate;
use App\Review;
use Session;

class ProductController extends Controller
{


    public function show($slug)
    {
        $rate=null;

        $product =Product::where('slug' , $slug)->where('active',1)->first();
        if (!$product) {
            abort(404);
        }

        $product->img = $product->image ? $product->image->name : 'default.jpg';
        $comments=Comment::where('product_id',$product->id)->get();
        $user=\Auth::guard('members')->user();
        
        if($user){
        	 $rate=Rate::where('user_id',$user->id)
        	->where('product_id',$product->id)->pluck('rating');
        }else{
        	$rate=$product->getRating();
        }
       
        $related_products=Product::where('category_id',$product->category_id)->get();

        if(!Session::has('seen.'.$product->id)){
            Session::put('seen.'.$product->id, $product->id);
        }
        
        return view('site.pages.product' , compact('product','comments','related_products','rate'));

    }

    public function postAddComment(request $r)
    {
        $v = validator($r->all(),[
            'name' => 'min:3',
            'email' => 'required|email',
            'comment' => 'required|min:3',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            'name' => "الاسم الشخصي",
            'email'=> "البريد الالكتروني",
            'comment' => "التعليق"
        ]);
        // return error msgs if validation is failed
        if($v->fails()){


            //return redirect()->back()->with('m', implode('<br>', $v->errors()->all()));
            return redirect()->back()->withErrors(['خطأ', implode('<br>', $v->errors()->all())]);
        }


        // instanciate new product and save its data
        $comment = new Comment;
        $comment->name = $r->name;
        $comment->email = $r->email;
        $comment->comment = $r->comment;
        $comment->product_id = $r->product_id;


        if($comment->save()){

            // return redirect()->back()->with('m','تم اضافه تعليقك بنجاح . ');
            return redirect()->back()->withSuccess(['تم ', 'تم اضافه تعليقك بنجاح .']);
        }

        // return redirect()->back()->with('m',"حدث خطأ اثناء الاضافة");
        return redirect()->back()->withErrors(['خطأ', 'The Message']);


    }

    public function getAddRate($product_id,$rateValue)
    {
        //ckeck if login user
        if(!\Auth::guard('members')->check())
        {
            return ['status' => 'login', 'msg' => 'قم بتسجيل الدخول اولا '];
        }
        // add rate
        $user_id=\Auth::guard('members')->user()->id;
        $rate=Rate::where('user_id',$user_id)
        ->where('product_id',$product_id)->get();
        if(count($rate)>0)
        {
            return ['status' => 'notallowed', 'msg' => 'لقد قمت بالتقييم سابقا '];
        }

        $Addrate=new Rate();
        $Addrate->user_id=$user_id;
        $Addrate->product_id=$product_id;
        $Addrate->rating=$rateValue;


        if($Addrate->save())

        return ['status' => 'success', 'msg' => 'تم  اضافه التقييم بنجاح'];

        return  ['status' => 'error', 'msg' => 'حدث خطأ اثناء اضافه التققيم '];

    }
    public function getRate($product_id)
    {
        $user_id=\Auth::guard('members')->user()->id;
        $rate=Rate::where('user_id',$user_id)
        ->where('product_id',$product_id)->pluck('rating');

        if($rate)
        {
            return ['status' => 'success', 'value' => $rate ];
        }

        return  ['status' => 'error', 'value' => null];

    }
    //    public function getCategory($slug , Request $request)
    // {

    // 	$category = _Category::where('slug', $slug)->first();

    // 	if(!$category){

    // 		abort(404);

    // 	}

    //        $category = $category->master;

    // 	if(!$category->isActive()){

    // 		abort(404);

    // 	}

    // 	$products = $category->getProducts();

    // 	if(empty($products)){

    // 		abort(404);

    // 	}

    //        // if the request is ajax request
    //        if ($request->ajax()) {
    //            return $this->filterCategoryProducts($products, $request);
    //        }

    //        $max_price = $products->max('price');
    //        $min_price=  $products->min('price');
    //        $base_url = $category->getUrl();
    //        $products = new LengthAwarePaginator($products, $products->count(), 9);

    // 	return view('site.pages.products.index' , compact('products' , 'max_price' , 'min_price' , 'base_url'));
    // }


    protected function postFilter(Request $request)
    {

        $per_page = $request->per_page;
        $order = $request->order;
        $first_limit = floatval(str_replace('$', '',$request->first_limit));
        $last_limit = floatval(str_replace('$', '',$request->last_limit));
        $products = Product::whereBetween('price' ,[$first_limit , $last_limit]);

        switch ($order) {
            case 'old':
            $products->orderBy('created_at','desc');
            break;
            case 'new':
            $products->orderBy('created_at');
            break;

        }

        $products = $products->paginate(6);

        return view('site.pages.products.templates.products' , compact('products'))->render();
    }

    //    protected function filterCategoryProducts(Collection $products, Request $request)
    //    {
    //        $per_page = $request->per_page;
    //        $order = $request->order;
    //        $first_limit = floatval(str_replace('$', '',$request->first_limit));
    //        $last_limit = floatval(str_replace('$', '',$request->last_limit));
    //        $products = $products->filter(function($product) use ($first_limit ,$last_limit){
    //            $price = $product->getDiscount();
    //            return ($price >= $first_limit && $price <= $last_limit);
    //        });

    //        switch ($order) {
    //            case 'price':
    //            $products = $products->sortBy('price');
    //            break;
    //            case 'date':
    //            $products = $products->sortBy('created_at');
    //            break;
    //            case 'name':
    //            $products = $products->sort(function($first , $last){
    //                return strcmp($first->translated()->name, $last->translated()->name);
    //            });
    //            break;
    //        }

    //        $products = paginate($products,$per_page);


    //        return view('site.pages.products.templates.products' , compact('products'))->render();
    //    }

    //      public function postReview(Request $r)
    //    {
    //        $v = validator($r->all(), [
    //            "review" => 'required|min:2',

    //        ]);
    //        // if the validation has been failed return the error msgs
    //        if ($v->fails()) {
    //            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
    //        }

    //        $review = new Review();
    //        // save review master
    //        $review->member_id = Auth()->guard('members')->user()->id;
    //        $review->product_id = $r->product_id;
    //        $rate = $r->rate;
    //        if(is_array($rate)){
    //            foreach($rate as $value){
    //                if($value == 'rate1')
    //                {
    //                    $review->rate = '1';
    //                }
    //                elseif($value == 'rate2')
    //                {
    //                    $review->rate = '2';
    //                }
    //                elseif($value == 'rate3')
    //                {
    //                    $review->rate = '3';
    //                }
    //                elseif($value == 'rate4')
    //                {
    //                    $review->rate = '4';
    //                }
    //                elseif($value == 'rate5')
    //                {
    //                    $review->rate = '5';
    //                }
    //            }
    //        }

    //        if($review->save()){
    //        // save the review details
    //            $review->details()->create([
    //                'review' => $r->review,
    //                'locale_id'=> 1
    //            ]);

    //            return ['status' => 'success', 'msg' => 'review added successfully.'];
    //        }

    //        return ['status' => 'error', 'msg' => 'There\'re some errors, please try again later.'];
    //    }

}
