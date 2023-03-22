<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
// use App\Live;
use App\Straight;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Courses_joined;
use App\Lecture;
use App\Instructor;
use App\Country;
class LiveCourseController extends Controller
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
        $userid = Auth::guard('instructors')->user();

        $courses=Straight::where('userId',$userid->id)->get();
        return view('instructor.livecourses.all',compact('courses','categories'));
    }

    public function create()
    {
        $categories=Category::all();    
        return view('instructor.livecourses.create',compact('categories'));
    }
    

    
    public function store(Request $request)
    { 
        $this->validate( $request,[          
                'title'=>'required',
                'short_detail'=>'required',
                'target_group'=>'required',
                'mahawir'=>'required',
                'date'=>'required',
                'time'=>'required',
                'duration'=>'required',
                // 'payed'=>'required',
                // 'price'=>'required',
                // 'image' => 'required|jpeg,jpg,png,gif'
            ],
            [
                'title.required'=>' العنوان مطلوب ',   
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'target_group.required'=>' يرجي إدخال الفئة المستهدفة',
                'mahawir.required'=>'ادخل محاور الدورة',
                'date.required'=>'ادخل تاريخ بداية الكورس',
                'time.required'=>'يرجى اختيار وقت الدورة',
                'duration.required'=>' مدة الكورس مطلوبة ',
                // 'payed.required'=>' حدد الكورس مدفوع ام مجاني ',
               // 'price.required'=>' سعر الكورس مطلوب ',
                // 'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        // dd($request->all());
        $userid = Auth::guard('instructors')->user();
        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/livecourses';
        $request-> file('image') ->move($path,$file_name);

        $add = new Straight;
        
        $add->userId    = $userid->id;
        $add->title    = $request->title;
        $add->title_ar    = $request->title_ar;
        $add->short_detail    = $request->short_detail;
        $add->target_group    = $request->target_group;
        $add->mahawir    = $request->mahawir;
        
        $add->date    = $request->date;
        $add->time    = $request->time;
        $add->duration    = $request->duration;
        $add->slug =Str::slug($request->title, '-', Null);
        $add->payed    = $request->payed;
        if($request->price){
            $add->price    = $request->price;
        }
        $add->image    = $file_name;
        $add->save();


        // $length = count($request->sessiontitle);
        // if($length > 0)
        // {
        //     for($i=0; $i<$length; $i++)
        //     {
        //         $add_lecture = new Lecture;
        //         $add_lecture->liveId    = $add->id;
        //         $add_lecture->title    = $request->sessiontitle[$i];
        //         $add_lecture->date    = $request->sessiondate[$i];
        //         $add_lecture->time    = $request->time[$i];
        //         $add_lecture->duration    = $request->sessionduration[$i];
        //         $add_lecture->url    = $request->url[$i];
        //         $add_lecture->meeting_password    = $request->meeting_password[$i];
        //         $add_lecture->meeting_id    = $request->meeting_id[$i];
        //         $add_lecture->save();
        //     }
             
        // }
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   
    public function edit(Straight $straight)
    {
        // dd($straight->id);
        // dd($straight);
        // $dd=Course::where('id',$course->id)->first();
        // dd($course);
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $childcategory=ChildCategory::all();
        return view('instructor.livecourses.edit',compact('straight','categories','subcategory','childcategory'));
    }

    public function update(Request $request, Straight $straight)

    {
        // $this->validate( $request,[          
        //         'title'=>'required',
        //         'short_detail'=>'required',
        //         'detail'=>'required',
        //         'price'=>'required',
        //         'date'=>'required',
        //         'time'=>'required',
        //         'duration'=>'required',
        //         'payed'=>'required',
        //         'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        //     ],
        //     [
        //         'title.required'=>' العنوان مطلوب ',   
        //         'short_detail.required'=>' يرجى كتابة وصف قصير ',
        //         'detail.required'=>' يرجي كتابة تفاصيل الكورس',
        //         'price.required'=>' سعر الكورس مطلوب ',
        //         'date.required'=>' المستوى مطلوب ',
        //         'time.required'=>' يرجى كتابة متطلبات الكورس ',
        //         'duration.required'=>' مدة الكورس مطلوبة ',
        //         'payed.required'=>' ادخل بعض الكلامات الدلالية ',
        //         'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
        //     ]
        // );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        // dd($course->id);
        $edit = Straight::findOrFail($straight->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/livecourses';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->title    = $request->title;
        $edit->title_ar    = $request->title_ar;
        $edit->short_detail    = $request->short_detail;
        $edit->target_group    = $request->target_group;
        $edit->mahawir    = $request->mahawir;
        $edit->date    = $request->date;
        $edit->time    = $request->time;
        $edit->duration    = $request->duration;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->payed    = $request->payed;
        if($request->price){
            $edit->price    = $request->price;
        }else{
            $edit->price= 0;
        }
        $edit->save();


        
         
        return redirect()->route('straights.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Straight::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('straights.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }    
        
        $delete = Straight::findOrFail($request->id);
        if($delete){
            $courses_joined= Courses_joined::where('liveId',$delete->id)->get();
            foreach ($courses_joined as $item) {         
                $delete_course = Courses_joined::findOrFail($item->id);
                $delete_course->delete();
            }
            $sessionss= Session::where('liveId',$delete->id)->get();
            foreach ($sessionss as $item) {         
                $delete_course = Courses_joined::findOrFail($item->id);
                $delete_course->delete();
            }
        }
        $delete->delete();
        return redirect()->route('straights.index')->with("message",'تم الحذف بنجاح'); 
    } 
    
    
    public function liveJoined($id)
    {
        $subscriptions = Courses_joined::where("liveId" , $id)->get();
        foreach ($subscriptions as $_item) {
             $instructor= Instructor::where('id',$_item->student_id)->first();
             $_item->instructor=$instructor;
             $_item->country= Country::where('id',$instructor->countryId)->first();
        }
        // dd($subscriptions);
        return view('instructor.livecourses.live-joined',compact('subscriptions'));
    }
}