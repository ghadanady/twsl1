<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Mail;
use App\Subscribtion;
use Carbon\Carbon;

class SubscribtionController extends Controller {

    /**
    * Render the all subscribtions pages.
    *
    * @return View
    */
    public function getIndex() {
        $subscribtions = Subscribtion::latest()->paginate(15);
        if(request()->ajax()){
            return view('admin.pages.subscribtions.templates.subscribtions-table',compact('subscribtions'))->render();
        }
        return view('admin.pages.subscribtions.index',compact('subscribtions'));
    }

    public function getSearch($q = null) {
        if (!empty($q)) {
            $cols = (new Subscribtion)->getTableColumns();
            $subscribtions = Subscribtion::latest();
            $subscribtions->where('id', 'LIKE', "%$q%");
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at'])) {
                    continue;
                }
                $subscribtions->orWhere($col, 'LIKE', "%$q%");
            }
        }else{
            $subscribtions = Subscribtion::latest();
        }
        $subscribtions = $subscribtions->paginate(15);

        return view('admin.pages.subscribtions.templates.subscribtions-table',compact('subscribtions'))->render();
    }

    /**
     * View Contant with given id.
     *
     * @param  int $id
     * @return View
     */
    public function getView($id) {
         $subscribtion = Subscribtion::find($id);
         $subscribtion->seen = 1;
         $subscribtion->save();
         return view('admin.pages.subscribtions.modals.subscribtion-modal-view',compact('subscribtion'))->render();
    }

    public function postSend(Request $request) {
        if (!$request->has('ids')) {
            return ['status' => 'warning', 'title' => 'فشل في  ارسال الرسالة', 'msg' => 'قم باختيار علي الاقل صف واحد.'];
        }

        if (!$request->has('editor1')) {
            return ['status' => 'warning', 'title' => 'فشل في  ارسال الرسالة', 'msg' => 'محتوي الرسالة لا يمكن ان يكون فارغ'];
        }

        if (!$request->has('subject')) {
            return ['status' => 'warning', 'title' => 'فشل في  ارسال الرسالة', 'msg' => 'عنوان الرسالة لا يمكن ان يكون فارغ'];
        }
        $ids = $request->input('ids');
        foreach ($ids as $id) {
            $this->sendMail($id, $request->subject ,$request->editor1);
        }
        return ['status' => 'success', 'title' => 'نحاج عمليه الارسال', 'msg' => 'لقد تم ارسال الرسالة بنجاح.'];
    }

    public function postAction($action, Request $r) {
        $state = 0;
        switch ($action) {
            case 'seen':
            $state = 1;
            break;
            case 'unseen':
            $action = 'seen';
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
        $faq = Subscribtion::find($id);
        if ($action === 'deleted') {
            $faq->delete();
            return;
        }
        $faq->$action = $state;
        $faq->save();
    }

    public function getFilter($filter) {
        $subscribtions = Subscribtion::latest();
        $subscribtions = $this->_filter($subscribtions, $filter)->paginate(15);
        return view('admin.pages.subscribtions.templates.subscribtions-table',compact('subscribtions'))->render();
    }

    protected function _filter(&$subscribtions, $filter) {
        switch ($filter) {
            case 'all':
            return $subscribtions;
            case 'seen':
            return $subscribtions->where('seen', 1);
            case 'unseen':
            return $subscribtions->where('seen', 0);
            case 'today':
            return $subscribtions->where('created_at', '>=', Carbon::today()->toDateString());
        }
    }

    protected function sendMail($id,$subject, $mail) {
        $user = Subscribtion::find($id);
        Mail::send('admin.mails.form-mail', compact('mail'), function ($m) use ($user, $subject) {
            $m->to($user->email, $user->email)->subject($subject);
        });
    }

    public function getDelete($id) {
        $faq = Subscribtion::find($id);
        if (!$faq) {
            return back()->withError('لا يوجد رساله يطابق هذه البيانات ليتم حذفه.');
        }
        $faq->delete();
        return back()->withSuccess('تمت عمليه الحذف بنجاح.');
    }

}
