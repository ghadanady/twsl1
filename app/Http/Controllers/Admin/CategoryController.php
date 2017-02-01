<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    /**
    * Render The Main or Sub Categories Page
    * @return View
    */
    public function getIndex($type){
        switch ($type) {
            case 'main':
            $categories = Category::where('parent_id' , 0)->paginate(10);
            return view('admin.pages.categories.main-categories.index' , compact('categories'));
            case 'sub':
            $categories = Category::where('parent_id' ,'<>', 0)->paginate(10);
            return view('admin.pages.categories.sub-categories.index' , compact('categories'));
            default:
            abort(404);
        }

    }

    /**
    * Fetch Information about some category
    * @param  number $id [description]
    * @return json     [description]
    */
    public function postInfo($id) {

        $category = Category::find($id);

        if(!$category){
            return [
                'status' => 'error',
                'title' => 'فشل',
                'msg' => 'لا يوجد بيانات لهذا القسم',
                'content' => '',
            ];
        }
        $category->img = $category->image ? $category->image->name : 'default.jpg';

        // compile the edit modal view
        if($category->isMain()){
            $content = view('admin.pages.categories.main-categories.templates.edit-category',
                compact('category'))->render();
        }else{
            $content = view('admin.pages.categories.sub-categories.templates.edit-category',
                compact('category'))->render();
        }

        return [
            'status' => 'success',
            'title' => '',
            'msg' => '',
            'content' => $content,
        ];

    }

    /**
    * Edit Sub or Main Category.
    *
    * @param  string  $type    [description]
    * @param  number  $id      [description]
    * @param  Request $request [description]
    * @return json           [description]
    */
    public function postEdit($type,$id,Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ],
        [
            'name.required' => 'اسم القسم مطلوب.',
            'name.min' => 'لا يمكن ان يقل اسم القسم عن حرفين.',
            'active.required' => 'حالة القسم مطلوبه',
            'active.digits_between' => 'حالة القسم لا يمكن ان تكون قيمه غير فعال او غير فعال.',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => implode(PHP_EOL, $v->errors()->all()),
                'content' => '',
            ];
        }

        //get the data for the id
        $category = Category::find($id);

        if(!$category){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك قسم بهذا الاسم ليتم تعديله',
                'content' => '',
            ];
        }

        switch($type){
            case 'main':
            return $this->editMainCategory($request,$category);
            case 'sub':
            return $this->editSubCategory($request,$category);
            default :
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك تصنيف بهذا الاسم ليتم تعديله',
                'content' => '',
            ];
        }

    }

    /**
    * Edit main category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function editMainCategory(Request $request , Category $category)
    {
        if(!$category->isMain()){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك قسم رئيسي يطابق هذه البيانات',
                'content' => '',
            ];
        }

        $category->active = $request->active;
        $category->name = $request->name;

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/category');
        if($request->avatar){

            $avatar = microtime(time()) . "_" . $request->avatar->getClientOriginalName();

            if($category->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $category->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $request->avatar->move($destination,$avatar);
        }

        if($category->save()){


            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم تعديل القسم بنجاح.',
                'content' => '',
            ];
        }

        return [
            'status' => 'error',
            'title' => 'فشل',
            'msg' => 'تم فشل عمليه التعديل . حاول مره لاحقه.',
            'content' => '',
        ];
    }

    /**
    * Edit sub category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function editSubCategory(Request $request , Category $category)
    {
        if(!$category->isSub()){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك قسم فرعي يطابق هذه البيانات',
                'content' => '',
            ];
        }

        if(!$request->parent_id){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'التصنيف الرئيسي لا يمكن ان يكون فارغ',
                'content' => '',
            ];
        }


        $category->active = $request->active;
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;

        // validate if there's an image remove the old one and  save the new one.
        $destination = storage_path('uploads/images/category');
        if($request->avatar){

            $avatar = microtime(time()) . "_" . $request->avatar->getClientOriginalName();

            if($category->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $category->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $request->avatar->move($destination,$avatar);
        }

        if($category->save()){
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم تعديل القسم بنجاح.',
                'content' => '',
            ];
        }

        return [
            'status' => 'error',
            'title' => 'فشل',
            'msg' => 'تم فشل عمليه التعديل . حاول مره لاحقه.',
            'content' => '',
        ];
    }

    /**
    * Add new Sub or Main Category.
    *
    * @param  string  $type    [description]
    * @param  number  $id      [description]
    * @param  Request $request [description]
    * @return json           [description]
    */
    public function postAdd($type,Request $request) {
        // basic validation rules
        $v = validator($request->all(), [
            'name' => 'required|min:2',
            'active' => 'required|digits_between:0,1',
        ],
        [
            'name.required' => 'اسم القسم مطلوب.',
            'name.min' => 'لا يمكن ان يقل اسم القسم عن حرفين.',
            'active.required' => 'حالة القسم مطلوبه',
            'active.digits_between' => 'حالة القسم لا يمكن ان تكون قيمه غير فعال او غير فعال.',
        ]);

        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => implode(PHP_EOL, $v->errors()->all()),
                'content' => '',
            ];
        }

        //get new category
        $category = new Category;

        switch($type){
            case 'main':
            return $this->addMainCategory($request,$category);
            case 'sub':
            return $this->addSubCategory($request,$category);
            default :
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك تصنيف بهذا الاسم ليتم تعديله',
                'content' => '',
            ];
        }
    }

    /**
    * Add main category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function addMainCategory(Request $request , Category $category)
    {

        $category->name = $request->name;
        $category->parent_id = 0;
        $category->active = $request->active;
        $category->slug = $this->generateSlug($request->name);

        if($category->save()){

                // validate if there's an image to save it
            $destination = storage_path('uploads/images/category');
            if($request->avatar){

                $avatar = microtime(time()) . "_" . $request->avatar->getClientOriginalName();
                $image = $category->image()->create([
                    'name' => $avatar
                ]);

                $request->avatar->move($destination,$avatar);
            }

            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم اضافة القسم بنجاح.',
                'content' => '',
            ];
        }

        return [
            'status' => 'error',
            'title' => 'فشل',
            'msg' => 'تم فشل عمليه الاضافه . حاول مره لاحقه.',
            'content' => '',
        ];
    }

    /**
    * Add sub category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function addSubCategory(Request $request , Category $category)
    {



        if(!$request->parent_id){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'التصنيف الرئيسي لا يمكن ان يكون فارغ',
                'content' => '',
            ];
        }

        $category->name = $request->name;
        $category->slug = $this->generateSlug($request->name);
        $category->active = $request->active;
        $category->parent_id = $request->parent_id;



        if($category->save()){


        $destination = storage_path('uploads/images/category');
        
        if($request->avatar){

            $avatar = microtime(time()) . "_" . $request->avatar->getClientOriginalName();

            if($category->image){
                @unlink("{$destination}/{$user->image->name}");
            }

            $category->image()->updateOrCreate([],[
                'name' => $avatar
            ]);

            $request->avatar->move($destination,$avatar);
        }
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم اضافة القسم بنجاح.',
                'content' => '',
            ];
        }

        return [
            'status' => 'error',
            'title' => 'فشل',
            'msg' => 'تم فشل عمليه الاضافه . حاول مره لاحقه.',
            'content' => '',
        ];
    }


    public function postChange($type, $id , Request $request)
    {
        $category = Category::find($id);

        switch($type){
            case 'main':
            return $this->changeMainCategory($request,$category);
            case 'sub':
            return $this->changeSubCategory($request,$category);
        }

    }

    /**
    * Edit main category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function changeMainCategory(Request $request , $category)
    {
        if(!$category){
            return back()->withError('لا يوجد هناك قسم بهذا الاسم ليتم تعديله.');
        }

        if(!$category->isMain()){
            return back()->withError('لا يوجد هناك قسم رئيسي يطابق هذه البيانات.');
        }

        if(!$request->parent_id){
            return back()->withError('التصنيف الرئيسي لا يمكن ان يكون فارغ.');
        }

        if($category->id == $request->parent_id){
            return back()->withWarning('التصنيف لايمكن ان يكون فرعي من نفسه.');
        }

        $category->parent_id = $request->parent_id;

        if($category->save()){
            return back()->withSuccess('تم تعيين القسم بنجاح.');
        }

        return back()->withWarning('تم فشل عمليه التعيين . حاول مره لاحقه.');
    }

    /**
    * Edit sub category.
    *
    * @param  Request  $request  [description]
    * @param  Category $category [description]
    * @return [type]             [description]
    */
    protected function changeSubCategory(Request $request , $category)
    {
        if(!$category->isSub()){
            return [
                'status' => 'error',
                'title' => 'بيانات خاظئه',
                'msg' => 'لا يوجد هناك قسم فرعي يطابق هذه البيانات',
                'content' => '',
            ];
        }

        $category->parent_id = 0;

        if($category->save()){
            return [
                'status' => 'success',
                'title' => 'نجاح',
                'msg' => 'تم تعيين القسم بنجاح.',
                'content' => '',
            ];
        }

        return [
            'status' => 'warning',
            'title' => 'فشل',
            'msg' => 'تم فشل عمليه التعيين . حاول مره لاحقه.',
            'content' => '',
        ];
    }

    protected function generateSlug($title)
    {
        $slug = $temp = slugify($title);
        while(Category::where('slug',$slug)->first()){
            $slug = $temp ."-". rand(1,1000);
        }
        return $slug;
    }

    public function getDelete($id) {
        $category = Category::find($id);
        if (!$category) {
            return back()->withError('لا يوجد قسم يطابق هذه البيانات ليتم حذفه.');
        }
        $category->delete();
        return back()->withSuccess('تمت عمليه الحذف بنجاح.');
    }
}
