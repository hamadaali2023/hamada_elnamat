<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;
use App\Category;
use App\Video;
use App\SubCategory;
use App\Instructor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories=Category::orderBy('id', 'DESC')->get();
        $courses=Course::orderBy('id', 'DESC')->get();
        foreach ($courses as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        // dd($courses);
        return view('admin.courses.all',compact('courses','categories'));
    }
    public function updateStatus(Request $request)
    {
        $course = Course::findOrFail($request->id);
        $course->status = $request->status;
        $course->save();
        return back()->with("message", 'تم تغيير الحالة '); 
        // return response()->json(['message' => 'User status updated successfully.']);
    }

    
    public function courseFilter(Request $request)
    {
        $categories=Category::orderBy('id', 'DESC')->get();
        $courses = Course::where('status',$request->filter)->orderBy('id', 'DESC')->get();
        foreach ($courses as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        return view('admin.courses.all',compact('courses','categories'));
    }
     public function getSubCategory($id){
         echo json_encode(SubCategory::where('categoryId', $id)->get());
    }
    public function courseEdit($id)
    {
        $course=Course::findOrFail($id);
        $categories=Category::all();
        $subcategory=SubCategory::where('categoryId', $course->categoryId)->get();
        return view('admin.courses.edit',compact('course','categories','subcategory'));
    }
    
    public function courseUpdate(Request $request)

    {
        $this->validate( $request,[          
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                'title'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                'requirement'=>'required',
                'meta_key'=>'required',
            ],
            [
                'categoryId.required'=>'يرجي اختيار التخصص',
                'subCategoryId.required'=>' التخصص الفرعي مطلوب ',
                'title.required'=>' العنوان مطلوب ',
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
                'meta_key.required'=>' ادخل بعض الكلامات الدلالية ',
            ]
        );
       
        $date = date('Y-m-d');
        $edit = Course::findOrFail($request->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/courses';
            $request-> file('image') ->move($path,$file_name);
            File::delete(public_path("assets_admin/img/courses/". $edit->image));
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->categoryId    = $request->categoryId;
        $edit->subCategoryId    = $request->subCategoryId;
        $edit->title    = $request->title;
        $edit->title_ar    = $request->title_ar;
        $edit->short_detail    = $request->short_detail;
        $edit->detail    = $request->detail;
        $edit->requirement    = $request->requirement;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->meta_key    = $request->meta_key;
        $edit->meta_desc    = $request->meta_desc;
        $edit->save();
        return back()->with("message", 'تم التعديل بنجاح'); 
    }
    
    
    
}
