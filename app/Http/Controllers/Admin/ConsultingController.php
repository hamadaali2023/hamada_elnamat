<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
// use App\Live;
use App\Consulting;
use Illuminate\Http\Request;
use Auth;
use App\Instructor;
use Illuminate\Support\Str;
use App\ConsultingJoined;
use App\Country;

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
        $straights=Consulting::orderBy('id', 'DESC')->get();
        foreach ($straights as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        return view('admin.consultings.all',compact('straights','categories'));
    }
    
     public function updateStatus(Request $request)
    {
        $straight = Consulting::findOrFail($request->id);
        $straight->status = $request->status;
        $straight->save();
        return back()->with("message", 'تم تغيير الحالة '); 
        // return response()->json(['message' => 'User status updated successfully.']);
    }
    public function courseFilter(Request $request)
    {
        // $categories=Category::orderBy('id', 'DESC')->get();
        $straights = Consulting::where('status',$request->filter)->orderBy('id', 'DESC')->get();
        foreach ($straights as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        return view('admin.consultings.all',compact('straights'));
    }
    
    public function create()
    {
        $categories=Category::all();    
        return view('instructor.consultings.create',compact('categories'));
    }
    
    
    
    // public function store(Request $request)
    // { 
    //     $userid = Auth::guard('instructors')->user();
    //     $file_extension = $request -> file('image') -> getClientOriginalExtension();
    //     $file_name = time().'.'.$file_extension;
    //     $file_nameone = $file_name;
    //     $path = 'assets_admin/img/livecourses';
    //     $request-> file('image') ->move($path,$file_name);

    //     $add = new Straight;
        
    //     $add->userId    = $userid->id;
    //     $add->title    = $request->title;
    //     $add->short_detail    = $request->short_detail;
    //     $add->detail    = $request->detail;
    //     $add->image    = $file_name;
    //     $add->save();
    //     $length = count($request->sessiontitle);
    //     if($length > 0)
    //     {
    //         for($i=0; $i<$length; $i++)
    //         {
    //             $add_lecture = new Lecture;
    //             $add_lecture->liveId    = $add->id;
    //             $add_lecture->title    = $request->sessiontitle[$i];
    //             $add_lecture->date    = $request->sessiondate[$i];
    //             $add_lecture->time    = $request->time[$i];
    //             $add_lecture->duration    = $request->sessionduration[$i];
    //             $add_lecture->url    = $request->url[$i];
    //             $add_lecture->meeting_password    = $request->meeting_password[$i];
    //             $add_lecture->meeting_id    = $request->meeting_id[$i];
    //             $add_lecture->save();
    //         }
             
    //     }
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    // }
    public function consultingsEdit($id)
    {
        $edit = Consulting::findOrFail($id);
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $childcategory=ChildCategory::all();
        return view('admin.consultings.edit',compact('edit','categories','subcategory','childcategory'));
    }

    public function update(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        // dd($course->id);
        $edit = Consulting::findOrFail($request->id);
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

        return back()->with("message", 'تم التعديل بنجاح'); 
    }



    public function destroy(Request $request )
    {
        $delete = Consulting::findOrFail($request->id);
        if($delete){
            $consulting_joined= ConsultingJoined::where('consulting_id',$delete->id)->get();
            foreach ($consulting_joined as $item) {         
                $delete_course = ConsultingJoined::findOrFail($item->id);
                $delete_course->delete();
            }
        }
        $delete->delete();
        return back()->with("message",'تم الحذف بنجاح'); 
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
        return view('admin.consultings.consulting-joined',compact('subscriptions'));
    }
    
}