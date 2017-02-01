<?php

/**
* Locale Route
*/
Route::get('/lang/{locale}', 'LocaleController@getIndex')->name('lang');

/**
* Admin Panel Routes
*/
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    /**
    * Authentication routes
    */
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::get('/', 'AuthController@getIndex');
        Route::get('/login', 'AuthController@getIndex');
        Route::get('/logout', 'AuthController@getLogout');
        Route::get('/recover-password', 'AuthController@getRecoverPassword');
        Route::get('/change-password/{hash}', 'AuthController@getChangePassword');
        Route::post('/recover-password', 'AuthController@postRecoverPassword');
        Route::post('/change-password', 'AuthController@postChangePassword');
        Route::post('/login', 'AuthController@postLogin');
    });

    /**
    * Private Routes
    */
    Route::group(['middleware' => 'auth.admin'], function() {

        /**
        * Users Routes
        */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@getIndex');
            Route::get('/profile', 'UsersController@getProfile');
            Route::get('/delete/{id?}', 'UsersController@getDelete');
            Route::post('/profile', 'UsersController@postProfile');
            Route::post('/add', 'UsersController@postAdd');
            Route::post('/info/{id}', 'UsersController@postInfo');
            Route::post('/edit', 'UsersController@postEdit');
        });

         /**
        * Users Routes
        */
        Route::group(['prefix' => 'drivers'], function () {
            Route::get('/', 'DriverContoller@getIndex');
            // Route::get('/profile', 'DriverContoller@getProfile');
             Route::get('/delete/{id?}', 'DriverContoller@getDelete');
             Route::get('/active/{id}/{active}', 'DriverContoller@getActive');
            // Route::post('/profile', 'DriverContoller@postProfile');
             Route::post('/add', 'DriverContoller@postAdd');
             Route::post('/info/{id}', 'DriverContoller@postInfo');
             Route::post('/edit', 'DriverContoller@postEdit');
        });

        /**
        * Public Admin Panel Settings
        */
        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', 'SettingsController@getIndex');
            Route::post('/edit', 'SettingsController@postEdit');
        });

        /**
        * Home Routes
        */
        Route::get('/', function() {
            return view('admin.pages.dashboard');
        });

        /**
        * faqs routes
        */
        Route::group(['prefix' => 'faqs'], function () {
            Route::get('/', 'FaqController@getIndex')->name('admin.faqs.index');
            Route::get('add', 'FaqController@getAdd')->name('admin.faqs.add');
            Route::post('add', 'FaqController@postAdd');
            Route::get('edit/{id}', 'FaqController@getEdit')->name('admin.faqs.edit');
            Route::post('edit/{id}', 'FaqController@postEdit');
            Route::post('/action/{action}', 'FaqController@postAction');
            Route::get('/delete/{id}', 'FaqController@getDelete')->name('admin.faqs.delete');
            Route::get('/filter/{filter}', 'FaqController@getFilter');
            Route::get('/search/{q?}', 'FaqController@getSearch');
        });

        /**
        * contacts routes
        */
        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', 'ContactController@getIndex')->name('admin.contacts.index');
            Route::get('view/{id}', 'ContactController@getView')->name('admin.contacts.view');
            Route::get('/main', 'ContactController@getMain')->name('admin.contacts.main');
            Route::post('/main', 'ContactController@postMain');
            Route::post('/send', 'ContactController@postSend')->name('admin.contacts.send');
            Route::post('/action/{action}', 'ContactController@postAction');
            Route::get('/delete/{id}', 'ContactController@getDelete')->name('admin.contacts.delete');
            Route::get('/filter/{filter}', 'ContactController@getFilter');
            Route::get('/search/{q?}', 'ContactController@getSearch');
        });

        /**
        * subscribtions routes
        */
        Route::group(['prefix' => 'subscribtions'], function () {
            Route::get('/', 'SubscribtionController@getIndex')->name('admin.subscribtions.index');
            Route::get('view/{id}', 'SubscribtionController@getView')->name('admin.subscribtions.view');
            Route::post('/send', 'SubscribtionController@postSend')->name('admin.subscribtions.send');
            Route::post('/action/{action}', 'SubscribtionController@postAction');
            Route::get('/delete/{id}', 'SubscribtionController@getDelete')->name('admin.subscribtions.delete');
            Route::get('/filter/{filter}', 'SubscribtionController@getFilter');
            Route::get('/search/{q?}', 'SubscribtionController@getSearch');
        });

        /**
        * slider route
        */
        Route::group(['prefix' => 'slider'], function () {
            Route::get('/', 'SliderController@getIndex')->name('admin.slider.index');
            Route::get('edit/{id}', 'SliderController@getEdit')->name('admin.slider.edit');
            Route::post('edit', 'SliderController@postEdit');
            Route::get('add', 'SliderController@getAdd')->name('admin.slider.add');
            Route::post('add', 'SliderController@postAdd');
            Route::post('info/{id}', 'SliderController@postInfo')->name('admin.slider.info');
            Route::get('/delete/{id}','SliderController@getDelete')->name('admin.slider.delete');
        });

        /**
        * ads route
        */
        Route::group(['prefix' => 'ads'], function () {
            Route::get('/', 'AdsController@getIndex')->name('admin.ads.index');
            Route::get('edit/{id}', 'AdsController@getEdit')->name('admin.ads.edit');
            Route::post('edit/{id}', 'AdsController@postEdit');
        });

        /**
        * articles routes
        */
        Route::group(['prefix' => 'products'], function () {
            Route::get('/','ProductController@getIndex')->name('admin.products.index');
            Route::get('add','ProductController@getAdd')->name('admin.products.add');
            Route::post('add','ProductController@postAdd');
            Route::get('edit/{id}','ProductController@getEdit')->name('admin.products.edit');
            Route::post('edit/{id}','ProductController@postEdit');
            Route::post('/action/{action}', 'ProductController@postAction');
            Route::post('/delete-image/{product_id}/{image_id}','ProductController@postDeleteImage')->name('admin.products.images.delete');
            Route::get('/delete/{id}','ProductController@getDelete')->name('admin.products.delete');
            Route::get('/filter/{filter}', 'ProductController@getFilter');
            Route::get('/search/{q?}', 'ProductController@getSearch');
        });

        /**
        * Info routes
        */
        Route::group(['prefix' => 'info'], function () {
            Route::get('/','InfoController@getIndex')->name('admin.infos.index');
            Route::get('add','InfoController@getAdd')->name('admin.infos.add');
            Route::post('add','InfoController@postAdd');
            Route::get('edit/{id}','InfoController@getEdit')->name('admin.infos.edit');
            Route::post('edit/{id}','InfoController@postEdit');
            Route::post('/action/{action}', 'InfoController@postAction');
            Route::get('/delete/{id}','InfoController@getDelete')->name('admin.infos.delete');
            Route::get('/filter/{filter}', 'InfoController@getFilter');
            Route::get('/search/{q?}', 'InfoController@getSearch');
        });

        /**
        * Category route
        */
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/{type}', 'CategoryController@getIndex')->name('admin.categories.index');
            Route::post('info/{id}', 'CategoryController@postInfo')->name('admin.categories.info');
            Route::post('/edit/{type}/{id}', 'CategoryController@postEdit')->name('admin.categories.edit');
            Route::post('/change/{type}/{id}', 'CategoryController@postChange')->name('admin.categories.change');
            Route::post('/add/{type}', 'CategoryController@postAdd')->name('admin.categories.add');
            Route::get('/delete/{id}','CategoryController@getDelete')->name('admin.categories.delete');
        });

        /**
        * menus route
        */
        Route::group(['prefix' => 'menus'], function () {
            Route::get('/', 'MenuController@getIndex')->name('admin.menus.index');
            Route::get('info/{id}', 'MenuController@getInfo')->name('admin.menus.info');
            Route::post('/edit/{id}', 'MenuController@postEdit')->name('admin.menus.edit');
            Route::post('/add', 'MenuController@postAdd')->name('admin.menus.add');
            Route::get('/delete/{id}','MenuController@getDelete')->name('admin.menus.delete');
        });

        // ghada strat
        /**
        * ads routes
        */
        Route::group(['prefix' => 'ads'], function () {
            Route::get('/', 'AdsController@getIndex')->name('admin.ads.index');
            Route::get('add', 'AdsController@getAdd')->name('admin.ads.add');
            Route::post('add', 'AdsController@postAdd');
            Route::get('edit/{id}', 'AdsController@getEdit')->name('admin.ads.edit');
            Route::post('/edit', 'AdsController@postEdit');
            Route::post('/action/{action}', 'AdsController@postAction');
            Route::post('info/{id}', 'AdsController@postInfo')->name('admin.ads.info');
            Route::get('/delete/{id}', 'AdsController@getDelete')
            ->name('admin.ads.delete');
            Route::get('/filter/{filter}', 'AdsController@getFilter');
            Route::get('/search/{q?}', 'AdsController@getSearch');
        });
        /**
        * tradmark routes
        */
        Route::group(['prefix' => 'trademark'], function () {
            Route::get('/', 'TrademarksController@getIndex')->name('admin.trademark.index');
            Route::get('add', 'TrademarksController@getAdd')->name('admin.trademark.add');
            Route::post('add', 'TrademarksController@postAdd');
            Route::get('edit/{id}', 'TrademarksController@getEdit')->name('admin.trademark.edit');
            Route::post('/edit', 'TrademarksController@postEdit');
            Route::post('/action/{action}', 'TrademarksController@postAction');
            Route::post('info/{id}', 'TrademarksController@postInfo')->name('admin.trademark.info');
            Route::get('/delete/{id}', 'TrademarksController@getDelete')
            ->name('admin.ads.delete');
            Route::get('/filter/{filter}', 'TrademarksController@getFilter');
            Route::get('/search/{q?}', 'TrademarksController@getSearch');
        });

    });
});
