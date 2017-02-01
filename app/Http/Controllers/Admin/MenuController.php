<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Menu;
//use App\_Menu;

class MenuController extends Controller
{
    /**
    * Render The Main or Sub Categories Page
    * @return View
    */
    public function getIndex(){
        $menus = Menu::paginate(15);
        return view('admin.pages.menus.index' , compact('menus'));
    }

    /**
    * Fetch Information about some menu
    * @param  number $id [description]
    * @return json     [description]
    */
    public function getInfo($id) {

        $menu = Menu::find($id);

        if(!$menu){
            return [
                'status' => 'error',
                'title' => 'فشل',
                'msg' => 'لا يوجد بيانات لهذا القسم',
                'content' => '',
            ];
        }

        // compile the edit modal view
        return view('admin.pages.menus.templates.edit-menu',compact('menu'))->render();
    }

    /**
    * Edit Sub or Main Menu.
    *
    * @param  string  $type    [description]
    * @param  number  $id      [description]
    * @param  Request $request [description]
    * @return json           [description]
    */
    public function postEdit($id,Request $request) {
        //get the data for the id
        $menu = Menu::find($id);

        if(!$menu){
            return msg('error.edit');
        }

        $v = validator($request->all(), [
            'en_name' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'categories' => 'required|array',
            'active' => 'required|digits_between:0,1',
            'shape_id' => 'required|digits_between:1,2',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            'en_name' => trans('menus.en_name_header'),
            'ar_name' => trans('menus.ar_name_header'),
            'categories' => trans('menus.categories_choose_header'),
            'active' => trans('menus.status_header'),
            'shape_id' => trans('menus.shapes_header'),
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.edit', ['msg' => implode('<br>', $v->errors()->all())]);
        }

        $menu->active = $request->active;
        $menu->shape_id = $request->shape_id;

        if($menu->save()){
            $menu->translated('en')->update([
                'name' => $request->en_name,
            ]);

            $menu->translated('ar')->update([
                'name' => $request->ar_name,
            ]);

            $menu->categories()->sync($request->categories);
        }

        return msg('success.edit');
    }

    /**
    * Add new Sub or Main Menu.
    *
    * @param  string  $type    [description]
    * @param  number  $id      [description]
    * @param  Request $request [description]
    * @return json           [description]
    */
    public function postAdd(Request $request) {

        $v = validator($request->all(), [
            'en_name' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'categories' => 'required|array',
            'active' => 'required|digits_between:0,1',
            'shape_id' => 'required|digits_between:1,2',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            'en_name' => trans('menus.en_name_header'),
            'ar_name' => trans('menus.ar_name_header'),
            'categories' => trans('menus.categories_choose_header'),
            'active' => trans('menus.status_header'),
            'shape_id' => trans('menus.shapes_header'),
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return msg('error.save',[
                'msg' => implode('<br>', $v->errors()->all()),
            ]);
        }

        //create new menu
        $menu = new Menu;
        $menu->active = $request->active;
        $menu->shape_id = $request->shape_id;

        if($menu->save()){
            $menu->details()->create([
                'name' => $request->en_name,
                'locale_id'=> 1
            ]);

            $menu->details()->create([
                'name' => $request->ar_name,
                'locale_id'=> 2
            ]);

            $menu->categories()->attach($request->categories);
        }


        return msg('success.save');
    }

    public function getDelete($id) {
        $menu = Menu::find($id);
        if (!$menu) {
            return back()->withError(trans('msgs.error.delete.msg'));
        }

        $menu->categories()->detach();
        $menu->details()->delete();
        $menu->delete();

        return back()->withSuccess(trans('msgs.success.delete.msg'));
    }
}
