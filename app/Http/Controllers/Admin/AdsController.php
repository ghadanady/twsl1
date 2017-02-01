<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ad;
use App\User;
use Hash;
use Auth;
use App\Image;
use App\AdsPosition;

class AdsController extends Controller {


    /**
     * render and paginate the users page.
     *
     * @return string
     */
    public function getIndex() {
        if(auth()->user()->isNormal()){
            return redirect('admin')->withWarning(trans('admin_global.denied_page'));
        }
        $ads = Ad::paginate(15);
        return view('admin.pages.ads.all', compact('ads'));
    }



    /**
     * validate and create new user.
     *
     * @param  Request $r
     * @return json
     */
    public function postAdd(Request $r) {
    }

     public function postInfo($id)
    {
        $ad = Ad::find($id);

        if(!$ad){
            return  ['status' => false, 'data' => 'لا يوجد اعلان '];
        }
      $ad->img = $ad->image ? $ad->image->name : 'default.jpg';

        return  ['status' => true, 'data' => $ad];
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

        $ad = Ad::find($r->id);

        if(!$ad){
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
        $ad->place = $r->place;
        $ad->link = $r->link;

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/banners');
        if($r->avatar){

            $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();

            if($ad->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $ad->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $r->avatar->move($destination,$avatar);
        }

        // update the ad data in the database.
        if ($ad->save()) {
            return msg('success.edit',['msg' => 'تم التعديل بنجاح']);
        }
        return msg('error.edit',['msg' => 'حدث خطأ اثناء التعديل']);
    }

    /**
     * delete a ad account if its id is passed
     * if not it will delete the current user
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null) {

        if(!$id){
            $id = Auth::id();
            Auth::logout();
        }

        $ad = Ad::find($id);

        if(!$ad){
            return redirect()->back()->with('m', 'Ads with id #'.$id.' not found');
        }

        if(!empty($ad->imageName)){
            @unlink(storage_path('uploads/images/avatars' . $ad->image->name));
        }

        $ad->delete();
        return redirect()->back()->with('m', 'ad has been deleted successfully');
    }


}
