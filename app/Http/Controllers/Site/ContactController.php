<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\ContactContent;
use Illuminate\Http\Request;
use App\Contact;
use App\Subscribtion;

class ContactController extends Controller
{
    public function getIndex()
    {
        // $contact = ContactContent::first();
        return view('site.pages.contact');
    }

    /**
    * Process the contact form.
    *
    * @param  Request $request [description]
    * @return redirect           [description]
    */


    public function postSend(Request $request)
    {
        // Validating the request
        $v =  $this->validateContactForm($request);

        if($v->fails()){
            return ['status' => 'error' , 'title' => 'فشل عمليه الارسال','msg' => implode('<br>',$v->errors()->all())];
        }

        $contact = new Contact;

        $contact->fullname = $request->fullname;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->subject = $request->subject;
        $contact->save();

        return ['status' => 'success' , 'title' => 'نجاح عمليه الارسال','msg' => 'تم ارسال الرسالة بنجاح.'];
    }
    /**
    * Validating the request for the contact form
    * @param Request $request [description]
    */
    protected function validateContactForm($request) {
        $v = validator($request->all(), [
            "fullname" => "min:2",
            "subject" => "required|min:2",
            "email" => "required|email",
            "message" => "required|min:2",
        ],[
            "fullname.min" => "الاسم لا يمكن ان يقل عن حرفين.",
            "subject.required" => "موضوع الرساله لا يمكن ان يكون فارغ.",
            "subject.min" => "موضوع الرسالة لا يمكن ان يقل عن حرفين.",
            "email.email" => "الايميل غير صالح للاتصال",
            "email.required" => "البريد الالكتروني لا يمكن ان يكون فارغا.",
            "message.required" => "محتوي الرسالة لا يمكن ان يكون فارغ",
            "message.min" =>  "محتوي الرسالة لا يمكن ان يقل عن حرفين.",
        ]);
        return $v;
    }
    /**
    * Process the subscribe form.
    *
    * @param  Request $request [description]
    * @return redirect           [description]
    */


    public function postSubscribe(Request $request)
    {
        // Validating the request
        $v =  $this->validateSubscribeForm($request);

        if($v->fails()){
            return ['status' => 'warning' , 'title' => 'فشل عمليه الاشتراك','msg' => implode('<br>',$v->errors()->all())];
        }

        $subscribtion = new Subscribtion;

        $subscribtion->email = $request->email;
        $subscribtion->save();

        return ['status' => 'success' , 'title' => 'نجاح عمليه الاشتراك','msg' => 'تم الاشتراك بنجاح سوف يتم تنبيهك بكل ما هو جديد.'];
    }
    /**
    * Validating the request for the $subscribtion form
    * @param Request $request [description]
    */
    protected function validateSubscribeForm($request) {
        $v = validator($request->all(), [
            "email" => "required|email|unique:subscribtions",
        ],[
            "email.email" => "البريد الالكتروني غير صالح للاتصال",
            "email.unique" => "هذا البريد الالكتروني مشترك بالفعل.",
            "email.required" => "البريد الالكتروني لا يمكن ان يكون فارغا.",
        ]);
        return $v;
    }

}
