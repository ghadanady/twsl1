<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Auth;
use App\Image;
use App\Trademark;

class TrademarksController extends Controller
{
  
    /**
     * render and paginate the users page.
     *
     * @return string
     */
    public function getIndex() {
        if(auth()->user()->isNormal()){
            return redirect('admin')->withWarning(trans('admin_global.denied_page'));
        }
        $trademarks = Trademark::paginate(15);
        return view('admin.pages.tradmark.all', compact('trademarks'));
    }



    /**
     * validate and create new user.
     *
     * @param  Request $r
     * @return json
     */
    public function postAdd(Request $r) {

        $v = validator($r->all(), [
            "name" => 'required',
            "link" => 'required',
        ]);
        // setting custom attribute names
        $v->setAttributeNames([
            "name" => trans('admin_global.name'),
            "link" => trans('admin_global.link'),

        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.save',['msg' => implode('<br>', $v->errors()->all())]);
        }

        $trademark = new Trademark;

        // set data for the new created data
        $trademark->name = $r->name;
        $trademark->link = $r->link;

        // save the new Trademarkdata
        if ($trademark->save()) {

            // validate if there's an image to save it
            $destination = storage_path('uploads/images/trademark');
            if($r->avatar){

                $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();
                $image = $trademark->image()->create([
                    'name' => $avatar
                ]);

                $r->avatar->move($destination,$avatar);
            }

            return msg('success.save',['msg' => 'تمت الاضافة بنجاح ']);
        }
        return msg('error.save',['msg' => 'حدث خطأ اثناء الاضافة']);
    }

     public function postInfo($id)
    {
        $trademark= Trademark::find($id);

        if(!$trademark){
            return  ['status' => false, 'data' => 'There is no user with id #'.$id.'.'];
        }
      $trademark->img = $trademark->image ? $trademark->image->name : 'default.jpg';

        return  ['status' => true, 'data' => $trademark];
    }

  

    /**
     * Validate and update user that has the passed id.
     *
     * @param  Request $r
     * @return json
     */
    public function postEdit(Request $r) {

        if(!$r->id){
            return msg('error.edit',['msg' => 'لا يوجد اعلان ']);
        }

        $trademark= Trademark::find($r->id);

        if(!$trademark){
            return msg('error.edit',['msg' => 'لا يوجد اعلات '.$r->id.'.']);
        }

        $v = validator($r->all(), [
            "link" => 'required'
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            "link" => trans('admin_global.link') ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.edit',['msg' => implode('<br>', $v->errors()->all())]);
        }


        // set the new values for update
        $trademark->name = $r->name;
        $trademark->link = $r->link;

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/trademark');
        if($r->avatar){

            $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();

            if($trademark->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $trademark->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $r->avatar->move($destination,$avatar);
        }

        // update the Trademarkdata in the database.
        if ($trademark->save()) {
            return msg('success.edit',['msg' => 'تم التعديل بنجاح']);
        }
        return msg('error.edit',['msg' => 'حدث خطأ اثناء التعديل']);
    }

    /**
     * delete a Trademarkaccount if its id is passed
     * if not it will delete the current user
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null) {

        if(!$id){
            $id = Auth::id();
            Auth::logout();
        }

        $trademark= Trademark::find($id);

        if(!$trademark){
            return redirect()->back()->with('m', 'لا يوجد اعلان ');
        }

        if(!empty($trademark->imageName)){
            @unlink(storage_path('uploads/images/trademark' . $ad->image->name));
        }

        $trademark->delete();
        return redirect()->back()->with('m', 'تم الحذف بنجاح ');
    }
}
