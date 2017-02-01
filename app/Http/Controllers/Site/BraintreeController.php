<?php

namespace App\Http\Controllers\Site;

use Braintree_ClientToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BraintreeController extends Controller
{
    /**
	 * Generate a new BrainTree ClientToken.
	 */
    public function getToken()
    {
    	return response()->json([
    		'token' => Braintree_ClientToken::generate(),
		]);
    }
}
