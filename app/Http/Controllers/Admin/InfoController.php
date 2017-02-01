<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Info;
use DB;
use App\Category;
use Carbon\Carbon;

class InfoController extends Controller {


    /**
    * Render the all infos pages.
    *
    * @return View
    */
    public function getIndex() {
        $infos = Info::latest()->paginate(15);
        if(request()->ajax()){
            return view('admin.pages.infos.templates.infos-table',compact('infos'))->render();
        }
        return view('admin.pages.infos.index',compact('infos'));
    }

    /**
    * render the add info page.
    *
    * @return View
    */
    public function getAdd()
    {
        return view('admin.pages.infos.add-info');
    }

    /**
    * render the edit info page.
    *
    * @return View
    */
    public function getEdit($id)
    {
        $info = Info::find($id);

        if(!$info){
            return back()->withWarning('لا يوجد صفحه تطابق هذا العنوان.');
        }

        return view('admin.pages.infos.edit-info',compact('info'));
    }

    /**
    * Add new info into database
    * @param  Request $r
    * @return json
    */
    public function postAdd(Request $r)
    {
        // validate data and return errors
        $v = validator($r->all(),[
            'name' => 'required|min:2',
            'editor1' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            'name' => 'اسم الصفحة',
            'editor1' => 'وصف الصفحة',
            'active' => 'حالة الصفحة',
        ]);
        // return error msgs if validation is failed
        if($v->fails()){
            return msg('error.save',[
                'msg' => implode('<br>', $v->errors()->all()),
            ]);
        }

        // instanciate new info and save its data
        $info = new Info;
        $info->name = $r->name;
        $info->content = $r->editor1;
        $info->slug= $this->generateSlug($r->name);
        $info->active = $r->active;

        if($info->save()){
            return msg('success.save');
        }

    }

    /**
    * Edit info into database
    * @param  Request $r
    * @return json
    */
    public function postEdit($id,Request $r)
    {
        $info = Info::find($id);

        // if no info found
        if(!$info){
            return msg('error.edit',[
                'msg' => 'لا يوجد صفحه تطابق هذا العنوان.',
            ]);
        }

        // validate data and return errors
        $v = validator($r->all(),[
            'name' => 'required|min:2',
            'editor1' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ]);

        // setting custom attribute names
        $v->setAttributeNames([
            'name' => 'اسم الصفحة',
            'editor1' => 'وصف الصفحة',
            'active' => 'حالة الصفحة',
        ]);
        // return error msgs if validation is failed
        if($v->fails()){
            return msg('error.save',[
                'msg' => implode('<br>', $v->errors()->all()),
            ]);
        }

        // instanciate new info and save its data
        $info->name = $r->name;
        $info->content = $r->editor1;
        $info->active = $r->active;

        if($info->save()){
            return msg('success.edit');
        }

    }

    public function getSearch($q = null) {
        $infos = Info::latest();
        if (!empty($q)) {
            $once = true;
            $cols = (new Info)->getTableColumns();
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at','active'])) {
                    continue;
                }

                if($once){
                    $infos->where($col, 'LIKE', "%$q%");
                    $once = false;
                }else{
                    $infos->orWhere($col, 'LIKE', "%$q%");
                }

            }
        }

        $infos = $infos->paginate(15);

        return view('admin.pages.infos.templates.infos-table',compact('infos'))->render();
    }

    public function postAction($action, Request $r) {
        $state = 0;
        switch ($action) {
            case 'active':
            $state = 1;
            break;
            case 'rejected':
            $action = 'active';
            $state = 0;
            break;
            case 'deleted':
            $action = 'deleted';
            break;
            default :
            $data = [
                'status' => 'warning',
                'title' => trans('msgs.error.edit.title'),
                'msg' => trans('admin_global.msg_action_not_supported'),
            ];
            return $data;
        }

        if ($r->has('ids')) {
            $ids = $r->input('ids');
            foreach ($ids as $id) {
                $this->_action($id, $action, $state);
            }
            $data = msg('success.edit');
        } else {
            $data = [
                'status' => 'warning',
                'title' => trans('msgs.error.edit.title'),
                'msg' => trans('admin_global.msg_mark_at_least'),
            ];
        }

        return $data;
    }

    protected function _action($id, $action, $state) {
        $info = Info::find($id);
        if ($action === 'deleted') {
            $info->delete();
            return;
        }

        $info->$action = $state;
        $info->save();
    }

    public function getFilter($filter) {
        $infos = Info::latest();
        $infos = $this->_filter($infos, $filter)->paginate(15);
        return view('admin.pages.infos.templates.infos-table',compact('infos'))->render();
    }

    protected function _filter(&$infos, $filter) {
        switch ($filter) {
            case 'all':
            return $infos;
            case 'active':
            return $infos->where('active', 1);
            case 'rejected':
            return $infos->where('active', 0);
            case 'today':
            return $infos->where('created_at', '>=', Carbon::today()->toDateString());
        }
    }

    protected function generateSlug($title)
    {
        $slug = $temp = slugify($title);
        while(Info::where('slug',$slug)->first()){
            $slug = $temp ."-". rand(1,1000);
        }
        return $slug;
    }

    public function getDelete($id) {
        $info = Info::find($id);

        if(!$info){
            return back()->withWarning('لا يوجد صفحه تطابق هذا العنوان.');
        }

        $info->delete();

        return back()->withSuccess(msg('تم الحذف بنجاح '));
    }


}
