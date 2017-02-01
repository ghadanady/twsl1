<?php
/**
* Sites routes
*/

Route::group(['namespace' => 'Site'], function () {

    /**
    * Braintree routes
    */
    Route::get('/braintree/token', 'BraintreeController@getToken')->name('site.braintree.token');

    /**
    *  Auth routes
    */
    Route::group(['prefix'=>'auth' , 'namespace' => 'Auth'],function(){
        Route::get('/','AuthController@getIndex')
        ->name('site.auth.index');
        Route::post('login','AuthController@postLogin')
        ->name('site.auth.login');
        Route::post('register', 'AuthController@postRegister')
        ->name('site.auth.register');
        Route::get('social/{provider}', 'AuthController@redirectToProvider')
        ->name('site.auth.social');
        Route::get('social/{provider}/callback', 'AuthController@handleProviderCallback');
        Route::get('logout', 'AuthController@getLogout')
        ->name('site.auth.logout');
        Route::get('forget-password','AuthController@getRecoverPassword')
        ->name('site.auth.forget-password');
    });

    Route::post('product/addComment', 'ProductController@postAddComment')
    ->name('site.product.addComment');

    Route::get('product/addrate/{product_id}/{rate}', 'ProductController@getAddRate')
    ->name('site.product.addrate');
    Route::get('product/rate/{product_id}', 'ProductController@getRate')
    ->name('site.product.rate');


    Route::post('product/filter', 'ProductController@postFilter')->name('site.products.filter');

    Route::resource('product', 'ProductController');

    /**
    *  Home routes
    */
    Route::get('/', 'HomeController@getIndex')->name('site.index');

    /**
    *  About routes
    */
    Route::group(['prefix'=>'about'],function(){
        Route::get('/', 'AboutController@getIndex')->name('site.about.index');
    });

    /**
    *  Info routes
    */
    Route::group(['prefix'=>'info'],function(){
        Route::get('/{slug}', 'InfoController@getIndex')->name('site.infos.index');
    });

    /**
    *  Search routes
    */
    Route::group(['prefix'=>'search'],function(){
        Route::get('/', 'SearchController@getIndex')->name('site.search.index');
        Route::get('/latest-offers', 'SearchController@getLatestOffers')->name('site.search.offers');
    });

    /**
    *  Faq routes
    */
    Route::group(['prefix'=>'faq'],function(){
        Route::get('/', 'FaqController@getIndex')->name('site.faq.index');
    });

    /**
    *  Contact routes
    */
    Route::group(['prefix'=>'contact'],function(){
        Route::get('/', 'ContactController@getIndex')->name('site.contact.index');
        Route::post('/subscribe', 'ContactController@postSubscribe')->name('site.contact.subscribe');
        Route::post('/send', 'ContactController@postSend')->name('site.contact.send');
    });


    /**
    *  Category routes
    */
    Route::group(['prefix'=>'category'],function(){
        Route::get('/{slug}', 'CategoryController@getIndex')->name('site.category.index');
    });

    /**
    *  Cart routes
    */
    Route::group(['prefix'=>'cart'],function(){
        Route::get('/', 'CartController@getIndex')->name('site.cart.index');
        Route::post('/add/{slug}', 'CartController@postAdd')->name('site.cart.add');
        Route::post('/update/{slug}', 'CartController@postUpdate')->name('site.cart.update');
        Route::post('/update-cart', 'CartController@postUpdateCart')->name('site.cart.update-cart');
    });


    Route::group(['middleware' => 'auth.site'], function(){

        /**
        *  Order routes
        */
        Route::group(['prefix'=>'order'],function(){
            Route::get('/checkout', 'OrderController@getCheckout')->name('site.order.checkout');
            Route::post('/create', 'OrderController@postCreate')->name('site.order.create');
            Route::get('/{hash}/summary', 'OrderController@getSummary')->name('site.order.summary');
            Route::get('/{hash}/download', 'OrderController@getDownload')->name('site.order.download');
        });


        /**
        *  profile routes
        */
        Route::group(['prefix'=>'profile'],function(){
            Route::get('/', 'ProfileController@getIndex')->name('site.profile.index');
            Route::post('/edit', 'ProfileController@postProfile')->name('site.profile.edit');
        });

    });


});
