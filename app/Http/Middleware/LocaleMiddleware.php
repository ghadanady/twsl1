<?php

namespace App\Http\Middleware;

use App;
use Closure;
use App\Setting;
use App\Locale;
class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $current_locale = 'ar';//session('locale');

        // if(empty($current_locale)){
        //     $current_locale = Locale::find(Setting::first()->default_locale)->name;
        // }
        App::setLocale($current_locale);
        session(['locale'=>$current_locale]);

        return $next($request);
    }
}
