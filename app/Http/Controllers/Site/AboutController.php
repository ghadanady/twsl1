<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ad;
use App\About;
use App\SocialLinks;

class AboutController extends Controller
{
    /**
     * Render the index page.
     *
     * @return View
     */
    public function getIndex()
    {
        $about = About::first();
        return view('site.pages.about.index',compact('about','ads','links'));
    }


}
