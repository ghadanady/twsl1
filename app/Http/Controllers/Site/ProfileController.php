<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    /**
    * Render the index page.
    *
    * @return View
    */


    public function getIndex(){
        return view('site.pages.profile');
    }

    public function postProfile(Request $r) {
        $v =  validator($r->all(), [
            "image" => 'image|mimes:png,gif,jpg,jpeg|max:20000',
            'f_name' => 'required|min:2',
            'l_name' => 'required|min:2',
            'email' => 'required|email|unique:members,email,'.auth()->guard('members')->id(),
            'country' => 'required',
            'city' => 'required',
            'address' => 'required|min:2',
            'phone' => 'required|phone|unique:members,phone,'.auth()->guard('members')->id(),
            'password' => 'min:2',
            'cpassword' => 'min:2|same:password',
        ],[
            'agree.required' => ' يجب الموافقه علي الشروط والاحكام',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            "image" => 'الصوره الشخصيه',
            'f_name' => "الاسم الاول (الشخصي)",
            'l_name' => "الاسم الاخير(العائلي)",
            'email' => "البريد الالكتروني",
            'country' => 'البلد',
            'city' => 'المدينه',
            'address' => 'العنوان',
            'phone' => 'رقم الجوال',
            'password' => "الرقم السري",
            'cpassword'=> "تاكيد الرقم السري",
        ]);

        if ($v->fails()) {
            return redirect()
            ->back()
            ->withErrors(['خطأ', implode('<br>', $v->errors()->all())]);
        }

        $member = auth()->guard('members')->user();
        // set the new values for update
        $member->f_name = $r->input('f_name');
        $member->l_name = $r->input('l_name');
        $member->email = $r->input('email');
        $member->phone = $r->input('phone');
        $member->job = $r->input('job');
        $member->country = $r->input('country');
        $member->city = $r->input('city');
        $member->address = $r->input('address');

        if($r->has('password') && $r->has('cpassword')){
            $member->password =  bcrypt($r->input('password'));
        }else if ($r->has('password') && !$r->has('cpassword')){
            return redirect()->back()->withErrors(['خطأ', 'الرقم السري و تاكيد الرقم السري غير متماثلين.']);
        }

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/avatars');
        if($r->hasFile('image')){
            @unlink("{$destination}/{$member->image}");
            $member->image = microtime(time()) . "_" . $r->image->getClientOriginalName();
            $r->image->move($destination,$member->image);
        }

        // update the member data in the database.
        if ($member->save()) {
            return redirect()->back()->withSuccess(['تم تعديل البيانات بنجاح.']);
        }

        return redirect()->back()->withErrors(['خطأ', 'حدث خطأ تناء التعديل']);

    }


}
