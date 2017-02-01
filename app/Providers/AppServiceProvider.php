<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Product;
use App\Ad;
use App\Category;
use App\AdsPosition;
use App\Trademark;
use App\Country;
 use Auth;
use App\Support\Storage\Contracts\StorageInterface;
use App\Support\Storage\SessionStorage;
class AppServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap any application services.
    *
    * @return void
    */
    public function boot()
    {
        $trademark=Trademark::get();
        view()->share([
            'trademark'=>$trademark,
        ]);

        Validator::extend('greater_than', function($attribute, $value, $parameters, $validator) {
            $min_value = $parameters[0];
            return $value >= $min_value;
        });

        Validator::replacer('greater_than', function($message, $attribute, $rule, $parameters) {
            return trans('validation.greater_than',['attribute' => $message, 'field' => $parameters[0]]);
        });

        Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$%i', $value) && strlen($value) >= 10;
        });

        Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return trans('validation.phone',['attribute' => $message]);
        });

        Validator::extend('password', function($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $value) && strlen($value) >= 8;
        });

        Validator::replacer('password', function($message, $attribute, $rule, $parameters) {
            return trans('validation.password',['attribute' => $message]);
        });

    }

    /**
    * Register any application services.
    *
    * @return void
    */
    public function register()
    {
        $this->app->bind(StorageInterface::class, function ($app) {
            return new SessionStorage('basket');
        });
    }
}
