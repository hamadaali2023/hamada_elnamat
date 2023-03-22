<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;
use App\Course;
use App\Category;
use App\SubCategory;
use App\Chapter;
use Auth;
use Illuminate\Support\Str;


use App\Curriculum;

use App\Curricul_Video;
class CurriculumVideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }


    public function curriculumVideos($id)
    {
        $curriculum= Curriculum::where('id',$id)->first();
        // dd('wefrwf');
        $videos = Curricul_Video::where('curricul_id',$id)->orderBy('order','ASC')->get();
        foreach ($videos as $item) {
            $item->curriculum= Curriculum::where('id',$item->curricul_id)->first();
        }
        return view('admin.curriculums.videos.all',compact('videos','curriculum'));
    }

    public function addvideos($id)
    {
        $courses = Curriculum::where('id',$id)->first();     
        return view('instructor.curriculums.videos.create',compact('courses'));
    }

    
    // public function store(Request $request)
    // {
    //     $this->validate( $request,[          
    //             'courseId'=>'required',
    //             // 'chapterId'=>'required',
    //             'name'=>'required',
    //             // 'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
    //         ],
    //         [
    //             'courseId.required'=>'يرجي اختيار التخصص',
    //             // 'chapterId.required'=>' التخصص الفرعي مطلوب ',
    //             'name.required'=>' التخصص الفرعي مطلوي  ',              
    //             // 'url.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
    //         ]
    //     );
    //     $userid = Auth::guard('instructors')->user();
    //     $date = date('Y-m-d');
    //     $file_extension = $request -> file('url') -> getClientOriginalExtension();
    //     $file_name = time().'.'.$file_extension;
    //     $file_nameone = $file_name;
    //     $path = 'assets_admin/img/courses/videos';
    //     $request-> file('url') ->move($path,$file_name);
        
         
    //     $add = new Video;
    //     $add->courseId    = $request->courseId;
    //     // $add->chapterId    = $request->chapterId;
    //     $add->name    = $request->name;
    //     $add->url    = $file_nameone;
    //     $add->save();
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    // }

    // public function edit(Video $video)
    // {
    //     $chapter=Chapter::all();  
    //     $courses=Course::all();  
    //     return view('instructor.courses.videos.edit',compact('video','courses','chapter'));
    // }

    // public function update(Request $request, Video $video)

    // {
    //     // dd($request->name);
    //     $this->validate( $request,[          
    //             'courseId'=>'required',
    //             // 'chapterId'=>'required',
    //             'name'=>'required',
    //         ],
    //         [
    //             'courseId.required'=>'يرجي اختيار التخصص',
    //             // 'chapterId.required'=>' التخصص الفرعي مطلوب ',
    //             'name.required'=>' التخصص الفرعي مطلوي  ',
                
    //         ]
    //     );$edit = Video::findOrFail($video->id);
    //     if($file=$request->file('url'))
    //     {
    //         $file_extension = $request -> file('url') -> getClientOriginalExtension();
    //         $file_name = time().'.'.$file_extension;
    //         $file_nameone = $file_name;
    //         $path = 'assets_admin/img/courses/videos';
    //         $request-> file('url') ->move($path,$file_name);
    //         $edit->url  = $file_nameone;
    //     }else{
    //         $edit->url  =$edit->url;
    //     }

    //     $edit->courseId    = $request->courseId;
    //     // $edit->chapterId    = $request->chapterId;
    //     $edit->name    = $request->name;
        
    //     $edit->save();
    //     return redirect()->route('courses.index')->with("message", 'تم التعديل بنجاح'); 
    // }


    public function destroy(Request $request )
    {
    //   dd('nnnn');
            $delete = Curricul_Video::findOrFail($request->id);
            $delete->delete();
            return back()->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}