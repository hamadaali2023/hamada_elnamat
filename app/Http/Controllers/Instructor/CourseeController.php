<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
use App\Straight;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Courses_joined;
use App\Chapter;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }

    public function index()
    {
        $categories=Category::all();
        $courses=Course::all();
        return view('instructor.courses.all',compact('courses','categories'));
    }

    public function create()
    {
        $categories=Category::all();    
        return view('instructor.courses.create',compact('categories'));
    }
    

    
    public function store(Request $request)
    {
        
        $this->validate( $request,[          
                'categoryId'=>'required',
                // 'subCategoryId'=>'required',
                // 'childCategoryId'=>'required',
                'title'=>'required',
                'level'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                'requirement'=>'required',
                'price'=>'required',
                
                'duration'=>'required',
                'meta_key'=>'required',
                // 'meta_desc'=>'required',
                
                // 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'categoryId.required'=>'يرجي اختيار التخصص',
                // 'subCategoryId.required'=>' التخصص الفرعي مطلوب ',
                // 'childCategoryId.required'=>' التخصص الفرعي مطلوي  ',
                
                'title.required'=>' العنوان مطلوب ',
                'level.required'=>' المستوى مطلوب ',
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
                'price.required'=>' سعر الكورس مطلوب ',
                
                'duration.required'=>' مدة الكورس مطلوبة ',
                'meta_key.required'=>' ادخل بعض الكلامات الدلالية ',
                // 'meta_desc.required'=>' ادخل الميتا دسك ',
                // 'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
       
        $file_extension = $request ->file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/courses';
        $request-> file('image') ->move($path,$file_name);

        $add = new Course;
        $add->categoryId    = $request->categoryId;
        // $add->subCategoryId    = $request->subCategoryId;
        // $add->childCategoryId    = $request->childCategoryId;
        $add->userId    = $userid->id;
        $add->title    = $request->title;
        $add->level    = $request->level;
        $add->short_detail    = $request->short_detail;
        $add->detail    = $request->detail;
        $add->requirement    = $request->requirement;
        

        $add->date    = $date;
        $add->duration    = $request->duration;
        $add->slug =Str::slug($request->title, '-', Null);
        $add->meta_key    = $request->meta_key;
        // $add->meta_desc    = $request->meta_desc;
        $add->image    = $file_name;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   

    public function edit(Course $course)
    {
        // dd($straight);
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $childcategory=ChildCategory::all();
        return view('instructor.courses.edit',compact('course','categories','subcategory','childcategory'));
    }

    public function update(Request $request, Course $course)

    {
        $this->validate( $request,[          
                'categoryId'=>'required',
                // 'subCategoryId'=>'required',
                // 'childCategoryId'=>'required',
                'title'=>'required',
                'level'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                'requirement'=>'required',
                'price'=>'required',
                
                'duration'=>'required',
                'meta_key'=>'required',
                // 'meta_desc'=>'required',
                
            ],
            [
                'categoryId.required'=>'يرجي اختيار التخصص',
                // 'subCategoryId.required'=>' التخصص الفرعي مطلوب ',
                // 'childCategoryId.required'=>' التخصص الفرعي مطلوي  ',
                
                'title.required'=>' العنوان مطلوب ',
                'level.required'=>' المستوى مطلوب ',
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
                'price.required'=>' سعر الكورس مطلوب ',
                
                'duration.required'=>' مدة الكورس مطلوبة ',
                'meta_key.required'=>' ادخل بعض الكلامات الدلالية ',
                // 'meta_desc.required'=>' ادخل الميتا دسك ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        // dd($course->id);
        $edit = Course::findOrFail($course->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/courses';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = "books1.jpeg";
        }
        $edit->categoryId    = $request->categoryId;
        $edit->subCategoryId    = $request->subCategoryId;
        $edit->childCategoryId    = $request->childCategoryId;
        $edit->userId    = $userid->id;
        $edit->title    = $request->title;
        $edit->level    = $request->level;
        $edit->short_detail    = $request->short_detail;
        $edit->detail    = $request->detail;
        $edit->requirement    = $request->requirement;
        $edit->price    = $request->price;
        $edit->date    = $date;
        $edit->duration    = $request->duration;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->meta_key    = $request->meta_key;
        // $edit->meta_desc    = $request->meta_desc;
        $edit->save();


        
         
        return redirect()->route('courses.index')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request )
    {
            $delete = Course::findOrFail($request->id);
            if($delete){
                $courses_joined= Courses_joined::where('courseId',$delete->id)->get();
                foreach ($courses_joined as $item) {         
                    $delete_course = Courses_joined::findOrFail($item->id);
                    $delete_course->delete();
                }
                $chapters= Chapter::where('Chapter',$delete->id)->get();
                foreach ($chapters as $item) {         
                    $delete_course = Courses_joined::findOrFail($item->id);
                    $delete_course->delete();
                }
            }
            $delete->delete();
            return redirect()->route('courses.index')->with("message",'تم الحذف بنجاح'); 
    } 
    // public function destroy(Request $request )
    // {
    //     // $appointment=Doctor::where('specialityId',$request->id)->get(); 
    //     // if(count($appointment) == 0){
    //         $delete = Course::findOrFail($request->id);
    //         $delete->delete();
    //         return redirect()->route('courses.index')->with("message",'تم الحذف بنجاح'); 
    //     // }else{
    //     //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
    //     // }        
    // } 
}