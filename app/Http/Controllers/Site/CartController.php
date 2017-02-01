<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Http\Requests;
use App\Basket\Basket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\QuantityExceededException;

class CartController extends Controller
{
    /**
     * Instance of Basket.
     *
     * @var Basket
     */
    protected $basket;

    /**
     * Create a new CartController instance.
     *
     * @param Basket  $basket
     * @param Product $product
     */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    /**
     * Show all items in the Basket.
     *
     */
    public function getIndex()
    {

         $this->basket->refresh();

        if (request()->ajax()) {
            return view('site.layouts.partials.shopping-cart')->render();
        }

    	return view('site.pages.cart');
    }

    /**
     * Add items to the Basket.
     *
     * @param $slug
     * @param $quantity
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postAdd($slug ,Request $request)
    {
        $product = Product::where('slug' , $slug)->first();

        if (!$product) {
            return [
                'status' => 'error',
                'title' => 'فشل عملية الاضافة',
                'msg' => 'انت تريد تحديث منتج غير موجود بالعربة "'.$slug.'"',
            ];
        }


        try {
            $this->basket->add($product, $request->quantity);
        } catch(QuantityExceededException $e) {
            return [
                'status' => 'warning',
                'title' => 'Oops!',
                'msg' => $e->message,
            ];
        }

        return [
            'status' => 'success',
            'title' => 'نجاح عملية الاضافة',
            'msg' => 'تم اضافة المنتج "'.$product->name.'" الي العربة بنجاح.',
        ];
    }

    /**
     * Update the Basket item with given slug.
     *
     * @param         $slug
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \App\Exceptions\QuantityExceededException
     */
    public function postUpdate($slug, Request $request)
    {
        $product = Product::where('slug' , $slug)->first();

        if (!$product) {
            return [
                'status' => 'error',
                'title' => 'فشل عملية التحديث',
                'msg' => 'انت تريد تحديث منتج غير موجود بالعربة "'.$slug.'"',
            ];
        }

        try {
            $this->basket->update($product, $request->quantity);
        } catch(QuantityExceededException $e) {
            return [
                'status' => 'warning',
                'title' => 'Oops!',
                'msg' => $e->message,
            ];
        }
        $name = $product->name;
        $status = 'success';
        $title = 'نجاح عمليه التحديث';
        $msg = 'تم تحديث المنتج"'.$name.'" في العربه بنجاح.';

        if(!$request->quantity){
            $status = 'information';
            $title = 'نجاح عمليه الحذف';
			$msg = 'تم حذف المنتج "'.$name.'" من العربة بنجاح.';
        }

        return [
            'status' => $status,
            'title' => $title,
            'msg' => $msg,
        ];
    }

    public function postUpdateCart(Request $r)
    {
        if(!$r->has('quantities') || !$this->basket->itemCount()){
            return [
                'status' => 'error',
                'title' => 'فشل عملية التحديث',
                'msg' => 'العربة فارغه من فضلك قم بالتسوق اولا .',
            ];
        }

        foreach ($this->basket->all() as $index => $item) {
            try {
                $this->basket->update($item, $r->quantities[$index]);
            } catch(QuantityExceededException $e) {
                return [
                    'status' => 'warning',
                    'title' => 'Oops!',
                    'msg' => $e->message,
                ];
            }
        }

        return [
            'status' => 'success',
            'title' => 'نجاح عملية التحديث',
            'msg' => 'لقد تم تحديث العربة بنجاح',
        ];

    }
}
