<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
// use App\Live;
use App\Consulting;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Courses_joined;
use App\Lecture;
use App\Instructor;
use App\Country;
use App\ConsultingJoined;
class ConsultingController extends Controller
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

        $courses=Consulting::where('userId',$userid->id)->get();
        return view('instructor.consultings.all',compact('courses','categories'));
    }

    public function create()
    {
        $categories=Category::all();    
        return view('instructor.consultings.create',compact('categories'));
    }
    

    
    public function store(Request $request)
    { 
        $this->validate( $request,[          
                'title'=>'required',
                'short_detail'=>'required',
                // 'target_group'=>'required',
                'mahawir'=>'required',
                // 'date'=>'required',
                // 'time'=>'required',
                'duration'=>'required',
                
                'price'=>'required',
                // 'image' => 'required|jpeg,jpg,png,gif'
            ],
            [
                'title.required'=>' العنوان مطلوب ',   
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                // 'target_group.required'=>' يرجي إدخال الفئة المستهدفة',
                'mahawir.required'=>'ادخل محاور الدورة',
                // 'date.required'=>'ادخل تاريخ بداية الكورس',
                // 'time.required'=>'يرجى اختيار وقت الدورة',
                'duration.required'=>' مدة الكورس مطلوبة ',
                // 'payed.required'=>' حدد الكورس مدفوع ام مجاني ',
                'price.required'=>' سعر الكورس مطلوب ',
                // 'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        // dd($request->all());
        $userid = Auth::guard('instructors')->user();
        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/consultings';
        $request-> file('image') ->move($path,$file_name);

        
        $check_consulting=Consulting::where('title',$request->title)->where('userId',$userid->id)->first();
        $count_consulting=Consulting::where('userId',$userid->id)->get();
        if($check_consulting){
            return redirect()->back()->with("errorss","لا يمكن إضافة إستشارة من نفس نوع استشارة قمت بإضافتها سابقا");
        }elseif(count($count_consulting) >=3){
            return redirect()->back()->with("errorss","لا يمكنك تقديم أكثر من ثلاث استشارات في نفس الوقت ");
        }else{
            $add = new Consulting;
            
            $add->userId    = $userid->id;
            $add->title    = $request->title;
            $add->mahawir    = $request->mahawir;
            $add->short_detail    = $request->short_detail;
            
            $add->duration    = $request->duration;
            $add->slug =Str::slug($request->title, '-', Null);
            $add->price    = $request->price;
            $add->image    = $file_name;
            $add->save();
        }
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   
    public function edit(Consulting $consulting)
    {
        
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $childcategory=ChildCategory::all();
        return view('instructor.consultings.edit',compact('consulting','categories','subcategory','childcategory'));
    }

    public function update(Request $request, Consulting $consulting)

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
        $edit = Consulting::findOrFail($consulting->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/consultings';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->title    = $request->title;
        $edit->short_detail    = $request->short_detail;
        $edit->mahawir    = $request->mahawir;
        $edit->duration    = $request->duration;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->price    = $request->price;
        $edit->save();

        return redirect()->route('consultings.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Consulting::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('consultings.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }    
        
        $delete = Consulting::findOrFail($request->id);
        if($delete){
            $courses_joined= Courses_joined::where('liveId',$delete->id)->get();
            foreach ($courses_joined as $item) {         
                $delete_course = Courses_joined::findOrFail($item->id);
                $delete_course->delete();
            }
           
        }
        $delete->delete();
        return redirect()->route('consultings.index')->with("message",'تم الحذف بنجاح'); 
    } 
    
    
    public function consultingJoined($id)
    {
        $subscriptions = ConsultingJoined::where("consulting_id" , $id)->get();
        foreach ($subscriptions as $_item) {
             $instructor= Instructor::where('id',$_item->student_id)->first();
             $_item->instructor=$instructor;
             $_item->country= Country::where('id',$instructor->countryId)->first();
        }
        // dd($subscriptions);
        return view('instructor.consultings.consulting-joined',compact('subscriptions'));
    }
    
     public function updateStatus(Request $request)
    {
        $straight = ConsultingJoined::findOrFail($request->id);
        $straight->status = $request->status;
        $straight->save();
        return back()->with("message", 'تم تغيير الحالة '); 
        // return response()->json(['message' => 'User status updated successfully.']);
    }
}