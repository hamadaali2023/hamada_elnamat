<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Video;
use App\Lecture;
use App\Category;
use App\SubCategory;
use App\Chapter;
use App\Straight;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Course;
class SessionssController extends Controller
{
    
    // public function index()
    // {
    //     $videos=Lecture::all();
    //     foreach ($videos as $item) {
    //         $item->course= Course::where('id',$item->courseId)->first();
    //         $item->chapter= Chapter::where('id',$item->chapterId)->first();
    //     }
    //     return view('instructor.courses.videos.all',compact('videos'));
    // }

   
    public function allsessions($id)
    {
        // dd('wefrwf');
        $sessions = Lecture::where('liveId',$id)->get();
        foreach ($sessions as $item) {
            $item->live= Straight::where('id',$item->liveId)->first();
        }
        // dd($sessions);
        return view('instructor.livecourses.sessions.all',compact('sessions'));
    }

    public function addsessions($id)
    {
        $courses = Straight::where('id',$id)->first();     
        return view('instructor.livecourses.sessions.create',compact('courses'));
    }
    // public function create()
    // {
        
    //     $courses=Straight::all();
    //     return view('instructor.livecourses.sessions.create',compact('courses'));
    // }
    
    public function store(Request $request)
    {
        $this->validate( $request,[          
                'liveId'=>'required',
                'title'=>'required',
                'date'=>'required',
                'time'=>'required',
                'duration'=>'required',
            ],
            [
                'liveId.required'=>'يرجى اختيار الكورس',
                'title.required'=>' ادخل عنوان الجلسة ',
                'date.required'=>' ادخل تاريخ الجلسة  ',              
                'time.required'=>'ادخل وقت الجلسة',
                'duration.required'=>'ادخل مدة الجلسة',
            ]
        );
       
        // dd($request->all());
        $add = new Lecture;
        $add->liveId    = $request->liveId;
        $add->title    = $request->title;
        $add->date    = $request->date;
        $add->time    = $request->time;
        $add->duration    = $request->duration;
        $add->url    = $request->url;
        $add->meeting_password    = $request->meeting_password;
        $add->meeting_id    = $request->meeting_id;
       
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Lecture $lecture)
    {
        // $chapter=Chapter::all();  
        $lives=Straight::all();  
        return view('instructor.livecourses.sessions.edit',compact('lecture','lives'));
    }

    public function update(Request $request, Lecture $session)
    {
        
        // dd($request->all());
        $edit = Lecture::findOrFail($session->id);
        
        $edit->title    = $request->title;
        $edit->date    = $request->date;
        $edit->time    = $request->time;
        $edit->duration    = $request->duration;
        $edit->url    = $request->url;
        $edit->meeting_password    = $request->meeting_password;
        $edit->meeting_id    = $request->meeting_id;
       
        $edit->save();

        return back()->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Lecture::findOrFail($request->id);
            $delete->delete();
            return back()->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    }
   
}
