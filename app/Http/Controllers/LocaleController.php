<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locale;

class LocaleController extends Controller
{
    /**
     * Toggle The Current Locale
     * @param  string $locale [description]
     * @return redirect        [description]
     */
    public function getIndex($locale)
    {
        if(Locale::where('name',$locale)->first()){
            session(['locale'=>$locale]);
        }
        return back();
    }
}
