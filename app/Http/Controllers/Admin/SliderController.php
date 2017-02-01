<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;

use App\Image;

class SliderController extends Controller
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
        $imgs = Slider::paginate(15);
        return view('admin.pages.slider.all', compact('imgs'));
    }


   /**
     * @param  Request $r
     * @return json
     */
    public function postAdd(Request $r) {

        $v = validator($r->all(), [
            "title" => 'required',
        ]);
        // setting custom attribute names
        $v->setAttributeNames([
            "title" => 'لابد من اضافه عنوان للصوره',


        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.save',['msg' => implode('<br>', $v->errors()->all())]);
        }

        $slider = new Slider;

        // set data for the new created data
        $slider->title = $r->title;
 

        // save the new Trademarkdata
        if ($slider->save()) {

            // validate if there's an image to save it
            $destination = storage_path('uploads/images/slider');
            if($r->avatar){

                $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();
                $image = $slider->image()->create([
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
        $slider = Slider::find($id);

        if(!$slider){
            return  ['status' => false, 'data' => 'لا يوجد اعلان '];
        }
      $slider->img = $slider->image ? $slider->image->name : 'default.jpg';

        return  ['status' => true, 'data' => $slider];
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

        $slider = Slider::find($r->id);

        if(!$slider){
            return msg('error.edit',['msg' => 'لا يوجد اعلات '.$r->id.'.']);
        }

        $v = validator($r->all(), [
            "title" => 'required'
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            "title" => 'لا بد من اضافع عنوان ' ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.edit',['msg' => implode('<br>', $v->errors()->all())]);
        }


        // set the new values for update
        $slider->title = $r->title;


        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/slider');
        if($r->avatar){

            $avatar = microtime(time()) . "_" . $r->avatar->getClientOriginalName();

            if($slider->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $slider->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $r->avatar->move($destination,$avatar);
        }

        // update the ad data in the database.
        if ($slider->save()) {
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

        $slider = Slider::find($id);

        if(!$slider){
            return redirect()->back()->with('m', 'لا يوجد  صورة');
        }

        if(!empty($slider->imageName)){
            @unlink(storage_path('uploads/images/slider' . $slider->image->name));
        }

        $slider->delete();
        return redirect()->back()->with('m', 'تم حذف الصورة بنجاح ');
    }
}
