<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Faq;
use Carbon\Carbon;

class FaqController extends Controller {

    /**
    * Render the all faqs pages.
    *
    * @return View
    */
    public function getIndex() {
        $faqs = Faq::latest()->paginate(15);
        if(request()->ajax()){
            return view('admin.pages.faqs.templates.faqs-table',compact('faqs'))->render();
        }
        return view('admin.pages.faqs.index',compact('faqs'));
    }

    /**
    * render the add faq page.
    *
    * @return View
    */
    public function getAdd()
    {
        return view('admin.pages.faqs.add-faq');
    }

    /**
    * render the edit faq page.
    *
    * @return View
    */
    public function getEdit($id)
    {
        $faq = Faq::find($id);

        if(!$faq){
            return back()->withWarning("لا يوجد هناك سؤال يطابق هذا الرقم لكي يتم تعديله #$id.");
        }

        return view('admin.pages.faqs.edit-faq',compact('faq'));
    }

    /**
    * Add new faq into database
    * @param  Request $r
    * @return json
    */
    public function postAdd(Request $r)
    {
        // validate data and return errors
        $v = validator($r->all(),[
            'question' => 'required|min:2',
            'editor1' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ],
        [
            'question.required' => 'عنوان السؤال مطلويه.',
            'editor1.required' => 'اجابة السؤال مطلوبه',
            'question.min' => 'عنوان السؤال لا يمكن ان تقل عن حرفين.',
            'editor1.min' => 'اجابة السؤال لا يمكن ان تقل عن حرفين.',
            'active.required' => 'حالة السؤال مطلوبه',
            'active.digits_between' => 'حالة السؤال لا يمكن ان تكون قيمه غير فعال او غير فعال.',
        ]);

        // return error msgs if validation is failed
        if($v->fails()){
            return [
                'status' => 'error',
                'title' => 'فشل في الاضافة',
                'msg' => implode('<br>', $v->errors()->all()),
            ];
        }

        // instanciate new faq and save its data
        $faq = new Faq;
        $faq->question = $r->question;
        $faq->answer = $r->editor1;
        $faq->active = $r->active;

        $faq->save();

        return [
            'status' => 'success',
            'title' => 'نجاح في الاضافة',
            'msg' => 'تمت عمليه الاضافه بنجاح',
        ];
    }

    /**
    * Edit new faq into database
    * @param  Request $r
    * @return json
    */
    public function postEdit($id,Request $r)
    {
        $faq = Faq::find($id);

        if(!$faq){
            return [
                'status' => 'error',
                'title' => 'فشل في التعديل',
                'msg' => "لا يوجد هناك سؤال يطابق هذا الرقم لكي يتم تعديله #$id.",
            ];
        }

        // validate data and return errors
        $v = validator($r->all(),[
            'question' => 'required|min:2',
            'editor1' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ],
        [
            'question.required' => 'عنوان السؤال مطلويه.',
            'editor1.required' => 'اجابة السؤال مطلوبه',
            'question.min' => 'عنوان السؤال لا يمكن ان تقل عن حرفين.',
            'editor1.min' => 'اجابة السؤال لا يمكن ان تقل عن حرفين.',
            'active.required' => 'حالة السؤال مطلوبه',
            'active.digits_between' => 'حالة السؤال لا يمكن ان تكون قيمه غير فعال او غير فعال.',
        ]);

        // return error msgs if validation is failed
        if($v->fails()){
            return [
                'status' => 'error',
                'title' => 'فشل في التعديل',
                'msg' => implode('<br>', $v->errors()->all()),
            ];
        }

        // update faq data
        $faq->question = $r->question;
        $faq->answer = $r->editor1;
        $faq->active = $r->active;

        $faq->save();

        return [
            'status' => 'success',
            'title' => 'نجاح في التعديل',
            'msg' => 'تمت عمليه التعديل بنجاح',
        ];
    }

    public function getSearch($q = null) {
        if (!empty($q)) {
            $cols = (new Faq)->getTableColumns();
            $faqs = Faq::latest();
            $faqs->where('id', 'LIKE', "%$q%");
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at'])) {
                    continue;
                }
                $faqs->orWhere($col, 'LIKE', "%$q%");
            }
        }else{
            $faqs = Faq::latest();
        }
        $faqs = $faqs->paginate(15);

        return view('admin.pages.faqs.templates.faqs-table',compact('faqs'))->render();
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
            $data = ['status' => 'error','title' => 'فشل في التنفيذ', 'msg' =>'هذة العمليه غير مدعومه'];
            return $data;
        }

        if ($r->has('ids')) {
            $ids = $r->input('ids');
            foreach ($ids as $id) {
                $this->_action($id, $action, $state);
            }
            $data = ['status' => 'success','title' => 'نجاح في التنفيذ', 'msg' => 'تم تنفيذ العمليه بنجاح.'];
        } else {
            $data = ['status' => 'warning', 'title' => 'فشل في التنفيذ','msg' => 'قم باختيار علي الاقل صف واحد.'];
        }

        return $data;
    }

    protected function _action($id, $action, $state) {
        $faq = Faq::find($id);
        if ($action === 'deleted') {
            $faq->delete();
            return;
        }
        $faq->$action = $state;
        $faq->save();
    }

    public function getFilter($filter) {
        $faqs = Faq::latest();
        $faqs = $this->_filter($faqs, $filter)->paginate(15);
        return view('admin.pages.faqs.templates.faqs-table',compact('faqs'))->render();
    }

    protected function _filter(&$faqs, $filter) {
        switch ($filter) {
            case 'all':
            return $faqs;
            case 'active':
            return $faqs->where('active', 1);
            case 'rejected':
            return $faqs->where('active', 0);
            case 'today':
            return $faqs->where('created_at', '>=', Carbon::today()->toDateString());
        }
    }

    public function getDelete($id) {
        $faq = Faq::find($id);
        if (!$faq) {
            return back()->withError('لا يوجد سؤال يطابق هذه البيانات ليتم حذفه.');
        }
        $faq->delete();
        return back()->withSuccess('تمت عمليه الحذف بنجاح.');
    }

}
