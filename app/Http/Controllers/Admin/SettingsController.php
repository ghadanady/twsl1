<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting;
use App\User;
use Auth;

class SettingsController extends Controller {

    public function getIndex() {
        if (auth()->user()->isNormal()) {
            return redirect('admin')->withWarning(trans('admin_global.denied_page'));
        }
        return view('admin.pages.settings.index');
    }

    public function postEdit(Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'default_locale'     => 'required|numeric',
            'map_lat'     => 'required|numeric',
            'map_lng'     => 'required|numeric',
            'site_name'     => 'required|min:2',
            'site_phone1'        => 'required|min:7',
            'site_phone2'        => 'min:7|phone',
            'site_email'         => 'required|email',
            'site_address'       => 'min:2',
            'facebook'      => 'min:2',
            'twitter'       => 'min:2',
            'instagram'     => 'min:2',
            'google'     => 'min:2',
            'youtube'     => 'min:2',
            'linkedin'     => 'min:2',
            'meta_keywords'      => 'min:2',
            'meta_author'    => 'min:2',
            'meta_description'     => 'min:2',
            'site_logo'         => 'image|mimes:jpeg,jpg,png,gif|max:20000',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.edit',['msg' => implode('<br>', $v->errors()->all())]);
        }

        $settings=Setting::first();
        $settings->site_name=$request->input('site_name');
        $settings->default_locale=$request->input('default_locale');
        $settings->map_lat=$request->input('map_lat');
        $settings->map_lng=$request->input('map_lng');
        $settings->site_phone1=$request->input('site_phone1');
        $settings->site_phone2=$request->input('site_phone2');
        $settings->site_email=$request->input('site_email');
        $settings->site_address=$request->input('site_address');
        $settings->twitter=$request->input('twitter');
        $settings->facebook=$request->input('facebook');
        $settings->instagram=$request->input('instagram');
        $settings->google=$request->input('google');
        $settings->youtube=$request->input('youtube');
        $settings->linkedin=$request->input('linkedin');
        $settings->meta_keywords=$request->input('meta_keywords');
        $settings->meta_author=$request->input('meta_author');
        $settings->meta_description=$request->input('meta_description');


        $destination = storage_path('uploads/images/logo');
        if ($request->site_logo) {
            if (is_file($destination . "/{$settings->site_logo}")) {
                @unlink($destination . "/{$settings->site_logo}");
            }
            $settings->site_logo = $request->site_logo->getClientOriginalName();
            $request->site_logo->move($destination, $settings->site_logo);
        }

        if ($settings->save()) {
            return msg('success.edit');
        }
        // return an error if there's un expected action occured
        return msg('error.edit');
    }

}
