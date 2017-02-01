<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function getIndex($slug)
    {
        $info = Info::where('slug',$slug)->where('active',1)->first();

        if(!$info){
            abort(404);
        }

        return view('site.pages.info', compact('info'));
    }
}
