<?php

namespace App\Http\Controllers\Site;
// use PDF;
use App\Order;
use App\Address;
use App\Customer;
use App\Basket\Basket;
use Braintree_Transaction;
use Illuminate\Http\Request;
use App\Events\OrderWasCreated;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    /**
    * Instance of Basket.
    *
    * @var Basket
    */
    protected $basket;
    /**
    * Create a new OrderController instance.
    *
    * @param Basket $basket
    */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }
    /**
    * Return the Order page.
    *
    */
    public function getCheckout()
    {
        $this->basket->refresh();
        if (! $this->basket->subTotal()) {
        	return redirect(route('site.cart.index'));
        }
        return view('site.pages.order.checkout');
    }
    /**
    * Show the order.
    *
    * @param $hash
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
    */
    public function getSummary($hash)
    {
        $order = Order::with('address', 'products')->where('hash', $hash)->first();
        if(! $order) {
            // notify order not found
            return redirect(route('site.index'));
        }
        return view('site.pages.order.summary', compact('order'));
    }
    /**
    * Create the order.
    *
    * @param CartFormRequest $request
    *
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
    public function postCreate(Request $request)
    {
        $v = validator($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|phone',
            'address1' => 'required|min:5',
            'address2' => 'min:5',
            'country' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
        ]);

        $v->setAttributeNames([
            'name' => 'الاسم الشخصي',
            'address1' => 'العنوان الاول',
            'address2' => 'العنوان الثاني',
            'country' => 'الدولة',
            'city' => 'المدينه',
            'postal_code' => 'الرقم البريدي',
        ]);

        if($v->fails()){
            return back()->withErrors($v);
        }

        $this->basket->refresh();

        if (! $this->basket->subTotal()) {
            return redirect(route('site.cart.index'));
        }

        if (! $request->input('payment_method_nonce')) {
            return redirect(route('site.order.checkout'))->withWaring('هناك خطأ في اتمام عملية الدفع.');
        }

        $hash = bin2hex(random_bytes(32));
        $member = auth()->guard('members')->user();

        $address = Address::firstOrCreate([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address1' => $request->input('address1'),
            'address2' => $request->input('address2'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
        ]);

        $subtotal = $this->basket->subTotal();
        $order = $member->orders()->create([
            'hash' => $hash,
            'paid' => false,
            'address_id' => $address->id,
            'subtotal' => $subtotal,
            'total' => ($subtotal + 5),
        ]);

        $items = $this->basket->all();
        $order->products()->saveMany(
            $items,
            $this->getQuantities($items)
        );

        $result = Braintree_Transaction::sale([
            'amount' => ($subtotal + 5),
            'paymentMethodNonce' => $request->input('payment_method_nonce'),
            'options' => [
                'submitForSettlement' => true,
            ]
        ]);

        event(new OrderWasCreated($order, $this->basket));

        if (! $result->success) {
            // TODO: Find a way to attach listeners manually to the OrderWasCreated event.
            $order->payment()->created([
                'failed' => true,
            ]);
            return redirect(route('site.order.checkout'))->withError('هناك خطأ ما في اتمام عملية الدفع من فضلك حاول مجددا.');

        } else {

            $order->payment()->create([
                'failed' => false,
                'transaction_id' => $result->transaction->id,
            ]);
            $this->basket->clear();

            return redirect(route('site.order.summary', $order->hash))->withSuccess('لقد تم تاكيد طلبك بنجاح, و سوف نقوم بايصاله اليك في اقرب وقت ممكن.');
        }
    }
    /**
    * Get the quantity from each item inside the basket.
    *
    * @param  Array $items
    * @return Array
    */
    public function getQuantities($items)
    {
        $quantities = [];
        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }
        return $quantities;
    }
    /**
    * Generate and download the invoice as a PDF file.
    *
    * @param  String $hash
    */
    public function getDownload($hash)
    {
        $order = Order::where('hash', $hash)->first();
        PDF::setBinaryPath(resource_path('phantomjs'));
        PDF::useScript(resource_path('assets/js/generate-pdf.js'));
        return PDF::createFromView(view('pages.order.invoice', compact('order')), "order-{$order->id}.pdf");
    }
}
