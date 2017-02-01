<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SMKFontAwesome\SMKFontAwesome;
use App\ContactDetails;
use App\ContactMaster;
use App\Language;
use Config;

class ContactUsController extends Controller {

    //
    public function getIndex() {
        $details = ContactDetails::where('lang', '=', Config::get('app.locale'))->get();
        $lang = Language::get();
        // Prepare fontawesome select
        $icons = SMKFontAwesome::getArray();

        return view('admin.pages.contactus.contact')->with('details', $details)
                        ->with('icons', $icons)
                        ->with('lang', $lang);
    }

    /**
     * 
     * @param Request $request
     */
    public function postEdit(Request $request) {

        $lang = $request->get('lang');
        $master_id = $request->get('master_id');

        $contact = ContactDetails::where('master_id', $master_id)->where('lang', $lang)->first();

        return view('admin.pages.contactus.contact_edit')->with('contact', $contact);
    }

    public function postIndex(Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'icon' => 'required|min:2',
            'name' => 'required|min:2',
            'value' => 'required|min:1'
        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        $details = new ContactDetails();
        $master = new ContactMaster();

        $master->icon = $request->input('icon');
        // add the data to the master table
        if ($master->save()) {
            //get the last insert id in the master table
            $id = $master->id;
            $details->master_id = $id;
            //get other data 
            $details->name = $request->input('name');
            $details->value = $request->input('value');
            $details->lang = $request->input('lang');

            //save the details of the master
            $details->save();
            //success message
            return ['status' => true, 'data' => ' Contact added is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    /**
     * Insert new Item.
     * 
     * @param Request $request
     * @return json
     */
    public function postNew(Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'value' => 'required|min:1',
            'lang' => 'required|min:1',
        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        //get the master_id and language
        $master_id = $request->master_id;
        $lang = $request->lang;

        $details = new ContactDetails();

        $details->name = $request->input('name');
        $details->value = $request->input('value');
        $details->lang = $lang;
        $details->master_id = $master_id;

        //add the new data
        if ($details->save()) {
            //success message
            return ['status' => true, 'data' => ' ' . $lang . 'Data is added successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function postSave(Request $request) {

        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'value' => 'required|min:1'
        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }
        $id = $request->input('master_id');

        $details = ContactDetails::find($id);

        $details->name = $request->input('name');
        $details->value = $request->input('value');

        if ($details->save()) {

            return ['status' => true, 'data' => 'Contact Data is updated successfully.'];
        }
        // return an error if there's un expected action occured
        return ['status' => false, 'data' => 'Something went wrong. please try again'];
    }

    public function getDelete($id = null) {
        $admin = ContactMaster::find($id);
        $admin2 = ContactDetails::where('master_id', $id)->delete();
        if (!$admin) {
            return redirect()->back()->with('m', 'data with id #' . $id . ' not found');
        }
        $admin->delete();
        return redirect()->back()->with('m', 'data has been deleted successfully');
    }

}
