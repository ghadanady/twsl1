<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function getIndex()
    {
        // $rows = Faq::latest()->get()->filter(function ($row)
        // {
        //     return $row->active;
        // });
        return view('site.pages.faq');
    }
}
