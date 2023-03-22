<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Video;
use App\Session;
use App\Category;
use App\SubCategory;
use App\Chapter;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class SessionsController extends Controller
{
    
    public function index()
    {
        $videos=Session.php::all();
        foreach ($videos as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
            $item->chapter= Chapter::where('id',$item->chapterId)->first();
        }
        return view('instructor.courses.videos.all',compact('videos'));
    }

    public function create()
    {
        
        $courses=Session.php::all();      
        return view('instructor.courses.videos.create',compact('chapter','courses'));
    }
    
    public function store(Request $request)
    {
        $this->validate( $request,[          
                'courseId'=>'required',
                'chapterId'=>'required',
                'name'=>'required',
                // 'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                'chapterId.required'=>' التخصص الفرعي مطلوب ',
                'name.required'=>' التخصص الفرعي مطلوي  ',              
                // 'url.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
      

        $add = new Session.php;
        $add->courseId    = $request->courseId;
        $add->chapterId    = $request->chapterId;
        $add->name    = $request->name;
        $add->url    = $file_nameone;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Video $video)
    {
        $chapter=Chapter::all();  
        $courses=Course::all();  
        return view('instructor.courses.videos.edit',compact('video','courses','chapter'));
    }

   
}
