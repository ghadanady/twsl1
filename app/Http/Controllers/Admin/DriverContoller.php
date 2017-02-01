<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use DB;
class DriverContoller extends Controller
{
    protected $uploadDestination = 'images/driver';

    /**
    * Render the all products pages.
    *
    * @return View
    */
    public function getIndex() {
        $drivers = Driver::latest()->paginate(15);
        return view('admin.pages.drivers.all',compact('drivers'));
    }

        /**
     * validate and create new user.
     *
     * @param  Request $r
     * @return json
     */
    public function postAdd(Request $r) {

        $v = validator($r->all(), [
            "name" => 'required|min:2',
            "username" => 'required|min:2|unique:users,username',
            "address" => 'required|min:2',
            "phone" => 'required|min:10|numeric',
            "national_id" => 'required|min:14|numeric',
            "avatar" => 'image|mimes:png,gif,jpg,jpeg|max:20000',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|password|min:8',
            "repassword" => 'required|same:password',
        ]);
        // setting custom attribute names
        $v->setAttributeNames([
            "name" => trans('admin_global.users_name'),
            "username" => trans('admin_global.users_username'),
            "email" => trans('admin_global.users_email'),
            "national_id" => trans('admin_global.users_national'),
            "phone" => trans('admin_global.users_phone'),
            "address" => trans('admin_global.btn_attach'),
            "avatar" => trans('admin_global.btn_attach'),
            "password" => trans('admin_global.users_password'),
            "repassword" => trans('admin_global.users_repassword'),
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.save',['msg' => implode('<br>', $v->errors()->all())]);
        }

        $user = new Driver;

        // set data for the new created data
        $user->name = $r->name;
        $user->email = $r->email;
        $user->username = $r->username;
        $user->phone = $r->phone;
        $user->address = $r->address;
        $user->password = bcrypt($r->password);
        $user->national_id = $r->national_id;

        // save the new user data
        if ($user->save()) {

            // validate if there's an image to save it
            $destination = storage_path('uploads/images/drivers');
            if($r->avatar){

                $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();
                $image = $user->image()->create([
                    'name' => $avatar
                ]);

                $r->avatar->move($destination,$avatar);
            }

            return msg('success.save',['msg' => 'تم اضافه السائق بنجاح ']);
        }
        return msg('error.save',['msg' => 'حدث خطأ  اثناء الاضافه ']);
    }

        /**
     * Validate and update user that has the passed id.
     *
     * @param  Request $r
     * @return json
     */
    public function postEdit(Request $r) {

        if(!$r->id){
            return msg('error.edit',['msg' => 'رقم المستخدم غير موجود']);
        }

        $user = Driver::find($r->id);

        if(!$user){
            return msg('error.edit',['msg' => 'There is no user with id #'.$r->id.'.']);
        }

        $v = validator($r->all(), [
            "name" => 'required|min:2',
            "username" => 'required|min:2|unique:users,username,'.$user->id,
            "address" => 'required|min:2',
            "phone" => 'required|min:10|numeric',
            "national_id" => 'required|min:14|numeric',
            "avatar" => 'image|mimes:png,gif,jpg,jpeg|max:20000',
            "email" => 'required|email|unique:users,email,'.$user->id,
            "newpassword" => 'min:8',
            "repassword" => 'same:newpassword',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            "name" => trans('admin_global.users_name'),
            "username" => trans('admin_global.users_username'),
            "email" => trans('admin_global.users_email'),
            "national_id" => trans('admin_global.users_national'),
            "phone" => trans('admin_global.users_phone'),
            "address" => trans('admin_global.btn_attach'),
            "avatar" => trans('admin_global.btn_attach'),
            "password" => trans('admin_global.users_password'),
            "repassword" => trans('admin_global.users_repassword'),
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.edit',['msg' => implode('<br>', $v->errors()->all())]);
        }

        // if the new password isn't empty make sure that its confirmation not empty
        if(!empty($r->newpassword) && empty($r->repassword)){
            return msg('error.edit',['msg' => trans('admin_global.validation_repassword')]);
        }

        // if there's new password update it and if not keep the old one
        if(!empty($r->newpassword)){
            $r->password = bcrypt($r->newpassword);
        }else {
            $r->password = $user->password;
        }

        // set the new values for update
        $user->name = $r->name;
        $user->email = $r->email;
        $user->username = $r->username;
        $user->phone = $r->phone;
        $user->address = $r->address;
        $user->password = $r->password;
        $user->national_id = $r->national_id;

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/drivers');
        if($r->avatar){

            $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();

            if($user->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $user->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $r->avatar->move($destination,$avatar);
        }

        // update the user data in the database.
        if ($user->save()) {
            return msg('success.edit',['msg' => 'تم تعديل السائق بنجاح ']);
        }
        return msg('error.edit',['msg' => 'حدث خطأ اثناء التعديل ']);
    }

    public function postInfo($id)
    {
        $user = Driver::find($id);

        if(!$user){
            return  ['status' => false, 'data' => 'لا يوجد سائق بهذا الرقم '];
        }


        $user->avatar = $user->image ? $user->image->name : 'default.jpg';

        return  ['status' => true, 'data' => $user];
    }
    /**
     * delete a user account if its id is passed
     * if not it will delete the current user
     * @param  int $id
     * @return Redirect
     */
    public function getDelete($id = null) {

        if(!$id){
            $id = Auth::id();
            Auth::logout();
        }

        $user = Driver::find($id);

        if(!$user){
            return redirect()->back()->with('m', '  لا يوجد سائق بهذا الرقم ');
        }

        if(!empty($user->image)){
            @unlink(storage_path('uploads/images/driver' . $user->image->name));
        }

        $user->delete();
        return redirect()->back()->with('m', 'تم مسح السائق بنجاح ');
    }
}
