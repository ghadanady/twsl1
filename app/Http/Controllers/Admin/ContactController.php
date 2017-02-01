<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Mail;
use App\Link;
use App\ContactContent;
use App\Contact;
use Carbon\Carbon;

class ContactController extends Controller {

    /**
     * Render the all contacts pages.
     *
     * @return View
     */
    public function getIndex() {
        $contacts = Contact::latest()->paginate(15);
        if (request()->ajax()) {
            return view('admin.pages.contacts.templates.contacts-table', compact('contacts'))->render();
        }
        return view('admin.pages.contacts.index', compact('contacts'));
    }

    public function getSearch($q = null) {
        if (!empty($q)) {
            $cols = (new Contact)->getTableColumns();
            $contacts = Contact::latest();
            $contacts->where('id', 'LIKE', "%$q%");
            foreach ($cols as $col) {
                if (in_array($col, ['id', 'created_at', 'updated_at'])) {
                    continue;
                }
                $contacts->orWhere($col, 'LIKE', "%$q%");
            }
        } else {
            $contacts = Contact::latest();
        }
        $contacts = $contacts->paginate(15);

        return view('admin.pages.contacts.templates.contacts-table', compact('contacts'))->render();
    }

    /**
     * View Contant with given id.
     *
     * @param  int $id
     * @return View
     */
    public function getView($id) {
        $contact = Contact::find($id);
        $contact->seen = 1;
        $contact->save();
        return view('admin.pages.contacts.modals.contact-modal-view', compact('contact'))->render();
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
            $this->sendMail($id, $request->subject, $request->editor1);
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
                $data = ['status' => 'error', 'title' => 'فشل في التنفيذ', 'msg' => 'هذة العمليه غير مدعومه'];
                return $data;
        }

        if ($r->has('ids')) {
            $ids = $r->input('ids');
            foreach ($ids as $id) {
                $this->_action($id, $action, $state);
            }
            $data = ['status' => 'success', 'title' => 'نجاح في التنفيذ', 'msg' => 'تم تنفيذ العمليه بنجاح.'];
        } else {
            $data = ['status' => 'warning', 'title' => 'فشل في التنفيذ', 'msg' => 'قم باختيار علي الاقل صف واحد.'];
        }

        return $data;
    }

    protected function _action($id, $action, $state) {
        $faq = Contact::find($id);
        if ($action === 'deleted') {
            $faq->delete();
            return;
        }
        $faq->$action = $state;
        $faq->save();
    }

    public function getFilter($filter) {
        $contacts = Contact::latest();
        $contacts = $this->_filter($contacts, $filter)->paginate(15);
        return view('admin.pages.contacts.templates.contacts-table', compact('contacts'))->render();
    }

    protected function _filter(&$contacts, $filter) {
        switch ($filter) {
            case 'all':
                return $contacts;
            case 'seen':
                return $contacts->where('seen', 1);
            case 'unseen':
                return $contacts->where('seen', 0);
            case 'today':
                return $contacts->where('created_at', '>=', Carbon::today()->toDateString());
        }
    }

    protected function sendMail($id, $subject, $mail) {
        $user = Contact::find($id);
        Mail::send('admin.mails.form-mail', compact('mail'), function ($m) use ($user, $subject) {
            $m->to($user->email, $user->fullname)->subject($subject);
        });
    }

    public function getDelete($id) {
        $faq = Contact::find($id);
        if (!$faq) {
            return back()->withError('لا يوجد رساله يطابق هذه البيانات ليتم حذفه.');
        }
        $faq->delete();
        return back()->withSuccess('تمت عمليه الحذف بنجاح.');
    }

    /**
     * Render about page.
     * @return View
     */
    public function getMain() {
        $content = Link::first();

        $data['icons'] = $content? unserialize($content->icons) : [];
        $data['contents'] = $content? unserialize($content->contents) : [];

        return view('admin.pages.contacts.main', compact('data'));
    }

    /**
     * Edit About Page.
     * @param  Request $request
     * @return Json
     */
    public function postMain(Request $request) {

        // basic validation rules
        $v = validator($request->all(), [
            'icons.*' => 'required',
            'contents.*' => 'required|min:2',
        ]);

        $v->setAttributeNames([
            'icons.*' => 'الايقونات',
            'contents.*' => 'المحتويات'
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => 'error', 'title' => 'فشل في الحفظ', 'msg' => implode('<br>', $v->errors()->all())];
        }
        $content = Link::first();

        if(!$content){
            $content = new Link;
        }

        //get the data from request
        $content->icons = serialize($request->input('icons'));
        $content->contents = serialize($request->input('contents'));

        // save the data
        if ($content->save()) {
            return ['status' => 'success', 'title' => 'نجاح في الحفظ', 'msg' => 'تمت عملية الحفظ بنجاح.'];
        }

        // return an error if there's un expected action occured
        return ['status' => 'error', 'title' => 'فشل في الحفظ', 'msg' => 'فشل في اتمام عمليه الحفظ من فضلك حاول مجددا.'];
    }

}
