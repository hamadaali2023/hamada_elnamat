<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Video;
use App\Course;
use App\Category;
use App\SubCategory;
use App\Chapter;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
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
        
        $videos=Video::orderBy('order','ASC')->get();
        foreach ($videos as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
            $item->chapter= Chapter::where('id',$item->chapterId)->first();
        }
        return view('instructor.courses.videos.all',compact('videos'));
    }

    public function allvideoss($id)
    {
        // dd('wefrwf');
        $course= Course::where('id',$id)->first();
        $videos = Video::where('courseId',$id)->orderBy('order','asc')->get();
        foreach ($videos as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
        }
        return view('instructor.courses.videos.all',compact('videos','course'));
    }

    public function addvideos($id)
    {
        $courses = Course::where('id',$id)->first();     
        return view('instructor.courses.videos.create',compact('courses'));
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
                'courseId'=>'required',
                // 'chapterId'=>'required',
                'name'=>'required',
                // 'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'courseId.required'=>'يجب اختيار الكورس التابع له',
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
        
        $add = new Video;
        $vorder = Video::where('courseId',$request->courseId)->max('order');
        // dd($vorder);
        if($vorder){
            $add->order    = $vorder + 1;
        }else{
            $add->order    = 1;
        }
        $add->courseId    = $request->courseId;
        
        $add->name    = $request->name;
        // $add->url    = $file_nameone;
        $add->url    = $request->videovalue;
        $add->videotime    = $request->videotime;
        $add->videosize    = $request->videosize;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Video $video)
    {
        $chapter=Chapter::all();  
        $courses=Course::all();  
        return view('instructor.courses.videos.edit',compact('video','courses','chapter'));
    }

    public function update(Request $request, Video $video)
    {
        $this->validate( $request,[          
                'courseId'=>'required',
                'name'=>'required',
            ],
            [
                'courseId.required'=>'يجب اختيار الكورس التابع له',
                'name.required'=>' عنوان الفيديو مطلوب ',              
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        
        $edit = Video::findOrFail($video->id);
        if($request->videovalue)
        {
            $edit->url  = $request->videovalue;
            $edit->videotime    = $request->videotime;
            $edit->videosize    = $request->videosize;
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/videos/" . $edit->url);
        }else{
            $edit->url  =$edit->url;
            $edit->videotime    = $edit->videotime;
            $edit->videosize    = $edit->videosize;
        }
        
        
        $edit->courseId    = $request->courseId;
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
        
        
        
        
        return redirect()->route('courses.index')->with("message", 'تم التعديل بنجاح'); 
    }
    
   
    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Video::findOrFail($request->id);
            
            $delete->delete();
            // File::delete(public_path("assets_admin/img/courses/videos/". $delete->url));
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/videos/" . $delete->url);
            
            return back()->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}
