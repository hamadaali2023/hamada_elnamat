<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\Course;
use App\Category;
use App\SubCategory;
use App\Chapter;
use App\Image;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Session;
use App\Video;
class ChapterController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        
    }
    public function index()
    {   
        $chapters=Chapter::all();
        foreach ($chapters as $item) {
            $item->course= Course::where('id',$item->courseId)->first();
        }
        return view('instructor.courses.chapters.all',compact('chapters'));
    }

    public function create()
    {
        session()->forget('videos_sessions');
        $courses=Course::all();    
        return view('instructor.courses.chapters.create',compact('courses'));
    }
    
    public function addvideostore(Request $request)
    {
        // if ($request->hasFile('file')) {
        //       $photo = $request->file('file');
        //       $fileName = date('YmdHis') . "." . $photo->getClientOriginalExtension();
        //       $request->file('file')->move(public_path('uploads'), $fileName);
        //       // $file->name = $fileName;
        //   }
        if ($files = $request->file('file')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            // $destinationPath = public_path('assets_admin/img/courses/videos');
            $destinationPath = 'assets_admin/img/courses/videos';
            // dd($destinationPath);
            $files->move($destinationPath, $profileImage);
            
            $videos_sessions = session()->get('videos_sessions');
            if(!$videos_sessions) {
                $videos_sessions = [
                    $request->id => [
                        "name" => $profileImage,
                    ]
                ];
                session()->put('videos_sessions', $videos_sessions);
            }
            //if videos_sessions not empty then check if this product exist then increment quantity
            if(isset($videos_sessions[$request->id])) {
                $videos_sessions[$request->id]['name']=$profileImage;
                session()->put('videos_sessions', $videos_sessions);
            }

            // if item not exist in videos_sessions then add to videos_sessions with quantity = 1
            $videos_sessions[$request->id] = [
                "name" => $profileImage,
            ];
            session()->put('videos_sessions', $videos_sessions);
            return Response()->json($profileImage);
        }
        

        
    }
    public function removeVideoSessionItem($id)
    {
        $videos=session()->get('videos_sessions');
        if(isset($videos[$id])) {
            unset($videos[$id]);
            session()->put('videos_sessions', $videos);
        }
        return Response()->json($id);
    }

    public function store(Request $request)
    {
        // $this->validate( $request,[          
        //         'courseId'=>'required',
        //         'chapter_name'=>'required',
        //         'short_number'=>'required',
        //     ],
        //     [
        //         'courseId.required'=>'يرجي اختيار التخصص',
        //         'chapter_name.required'=>' التخصص الفرعي مطلوب ',
        //         'short_number.required'=>' التخصص الفرعي مطلوي  ',
        //     ]
        // );
        $userid = Auth::guard('instructors')->user();
        
        $add = new Chapter;
        $add->courseId    = $request->courseId;
        $add->chapter_name    = $request->chapter_name;
        $add->chapter_number    = $request->chapter_number;
        $add->save();


        if(session('videos_sessions')){
            $videos=session()->get('videos_sessions');
            // $vid=[];
            // foreach($videos as $id => $details){
            //     $vid['name']= $details['name'];
            // }
            // foreach($vid as $i => $deta){
            
            //     $add_video = new Video;
            //     $add_video->courseId    = $request->courseId;
            //     $add_video->chapterId    = $add->id;
            //     $add_video->name    = $request->name[$i];
            //     $add_video->url    = $deta;
            //     $add_video->save();
            // }


            $items=[];
            foreach($videos as $id => $_item){
                $cars = array("name"=>$_item['name']);
                $items[]= $cars;
                // echo $_item['name'].'zzzzzzz<<<<<';
                // echo '<br>';
            }
            foreach($items as $i => $item){
                // echo $request->name[$i].">>>cccc";
                 
                $add_video = new Video;
                $add_video->courseId    = $request->courseId;
                $add_video->chapterId    = $add->id;
                $add_video->name    = $request->name[$i];
                $add_video->url    = $item['name'];
                $add_video->save();
            }
            // dd($items);


            
        }
        
        
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
   

    public function edit(Chapter $chapter)
    {
        $courses=Course::all();
        
        return view('instructor.courses.chapters.edit',compact('chapter','courses'));
    }

    public function update(Request $request, Chapter $chapter)

    {
        $this->validate( $request,[          
                 'courseId'=>'required',
                'chapter_name'=>'required',
                'short_number'=>'required',
            ],
            [
                'courseId.required'=>'يرجي اختيار التخصص',
                'chapter_name.required'=>' التخصص الفرعي مطلوب ',
                'short_number.required'=>' التخصص الفرعي مطلوي  ',
            ]
        );
        
        $edit = Chapter::findOrFail($chapter->id);
       
        $edit->courseId    = $request->courseId;
        $edit->chapter_name    = $request->chapter_name;
        $edit->chapter_number    = $request->chapter_number;
        $edit->save();        
         
        return redirect()->route('chapters.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = Chapter::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('chapters.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}