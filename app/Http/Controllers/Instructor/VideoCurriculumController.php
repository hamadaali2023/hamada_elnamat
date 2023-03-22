<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Curriculum;
use App\Curricul_Video;
use App\Branch;
use App\Curricul_Branch;
class VideoCurriculumController extends Controller
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
        
        $videos=Curricul_Video::orderBy('order','ASC')->get();
        foreach ($videos as $item) {
            $item->course= Curriculum::where('id',$item->courseId)->first();
        }
        return view('instructor.curriculums.videos.all',compact('videos'));
    }

    public function allvideoss($id)
    {
        // dd('wefrwf');
        $course= Curriculum::where('id',$id)->first();
        $videos = Curricul_Video::where('curricul_id',$id)->orderBy('order','asc')->get();
        foreach ($videos as $item) {
            $item->course= Curriculum::where('id',$item->curricul_id)->first();
        }
        return view('instructor.curriculums.videos.all',compact('videos','course'));
    }

    public function addvideos($id)
    {
        $courses = Curriculum::where('id',$id)->first();     
        return view('instructor.curriculums.videos.create',compact('id','courses'));
    }

    // public function create()
    // {
    //     $chapter=Chapter::all();  
    //     $courses=Course::all();      
    //     return view('instructor.courses.videos.create',compact('chapter','courses'));
    // }
    
    public function store(Request $request)
    {
        $this->validate( $request,[          
                'curricul_id'=>'required',
                // 'chapterId'=>'required',
                'name'=>'required',
                // 'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'curricul_id.required'=>'يجب اختيار الكورس التابع له',
                // 'chapterId.required'=>' التخصص الفرعي مطلوب ',
                'name.required'=>' عنوان الفيديو مطلوب ',              
                // 'url.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        // $file_extension = $request -> file('url') -> getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $file_nameone = $file_name;
        // $path = 'assets_admin/img/courses/videos';
        // $request-> file('url') ->move($path,$file_name);
        
        $vorder = Curricul_Video::where('curricul_id',$request->curricul_id)->max('order');
        $add = new Curricul_Video;
        
        if($vorder){
            $add->order    = $vorder + 1;
        }else{
            $add->order    = 1;
        }
        $add->curricul_id    = $request->curricul_id;
        
        $add->name    = $request->name;
        $add->instructor_id    = $userid->id;
        $add->url    = $request->videovalue;
        $add->videotime    = $request->videotime;
        $add->videosize    = $request->videosize;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Curricul_Video $curricul_video)
    {
        // dd($curricul_video);
        // $chapter=Chapter::all();  
        $curriculums=Curriculum::all();  
        return view('instructor.curriculums.videos.edit',compact('curricul_video','curriculums'));
    }

    public function update(Request $request, Curricul_Video $curricul_video)
    {
        // dd($curricul_video);
        $this->validate( $request,[          
                
                'name'=>'required',
            ],
            [
                
                'name.required'=>' عنوان الفيديو مطلوب ',              
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        
        $edit = Curricul_Video::findOrFail($curricul_video->id);
        if($request->videovalue)
        {
            $edit->url  = $request->videovalue;
            $edit->videotime    = $request->videotime;
            $edit->videosize    = $request->videosize;
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/" . $edit->url);
        }else{
            $edit->url  =$edit->url;
            $edit->videotime    = $edit->videotime;
            $edit->videosize    = $edit->videosize;
        }
        
        
        
        $edit->name    = $request->name;
        $edit->save();
        
        
    ////////////////////////////////////////////
        // $edit = Video::findOrFail($video->id);
        // if($file=$request->file('url'))
        // {
        //     $file_extension = $request -> file('url') -> getClientOriginalExtension();
        //     $file_name = time().'.'.$file_extension;
        //     $file_nameone = $file_name;
        //     $path = 'assets_admin/img/courses/videos';
        //     $request-> file('url') ->move($path,$file_name);

        //     File::delete(public_path("assets_admin/img/courses/videos/". $edit->url));

        //     $edit->url  = $file_nameone;
        // }else{
        //     $edit->url  =$edit->url;
        // }

        // $edit->courseId    = $request->courseId;
        // $edit->name    = $request->name;
        // $edit->save();
        
        
        
        
        return back()->with("message", 'تم التعديل بنجاح'); 
    }
    
   
    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Curricul_Video::findOrFail($request->id);
            
            $delete->delete();
            
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/" . $delete->url);
            return back()->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}
