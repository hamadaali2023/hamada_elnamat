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
use App\Image;
use Session;
use App\Video;
use Illuminate\Support\Facades\File;
use DB;
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
        $userid = Auth::guard('instructors')->user();
        $courses=Course::where('userId',$userid->id)->get();
        foreach ($courses as $item) {   
            $item->videos= Video::where('courseId',$item->id)->get();
        }
        return view('instructor.courses.all',compact('courses','categories'));
    }
    
     public function getSubCategory($id){
         echo json_encode(SubCategory::where('categoryId', $id)->get());
        // echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }

    public function getChildCategory($id){
        // dd('bbg');
        echo json_encode(ChildCategory::where('subCategoryId', $id)->get());
        // echo json_encode(DB::table('child_categories')->where('subCategoryId', $id)->get());
    }
    
    public function create()
    {
        $userid = Auth::guard('instructors')->user();

        session()->forget('videos_sessions');
        $categories=Category::all();    
        return view('instructor.courses.create',compact('categories','userid'));
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
            // return 'ffffffsfsfvsfvfs';
            //if videos_sessions not empty then check if this product exist then increment quantity
            if(isset($videos_sessions[$request->id])) {
                // File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/videos/" . $videos_sessions[$request->id]['name']);
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
        File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/videos/" . $videos[$id]['name']);
       
        if(isset($videos[$id])) {
            unset($videos[$id]);
            session()->put('videos_sessions', $videos);
        }
        return Response()->json($id);
    }


    
    public function store(Request $request)
    {


        // dd('yguyguyguv');
        $this->validate( $request,[          
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                // 'childCategoryId'=>'required',
                'title'=>'required',
                // 'level'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                'requirement'=>'required',
                // 'duration'=>'required',
                // 'meta_key'=>'required',
                // 'meta_desc'=>'required',
                'imagee'=>'required',
                
            ],
            [
                'categoryId.required'=>'يرجي اختيار التخصص',
                'subCategoryId.required'=>' التخصص الفرعي مطلوب ',
                // 'childCategoryId.required'=>' التخصص الفرعي مطلوي  ',
                
                'title.required'=>' العنوان مطلوب ',
                // 'level.required'=>' المستوى مطلوب ',
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
                
                // 'duration.required'=>' مدة الكورس مطلوبة ',
                // 'meta_key.required'=>' ادخل بعض الكلامات الدلالية ',
                // 'meta_desc.required'=>' ادخل الميتا دسك ',
                'imagee.required'=>' يجب ارفاق صورة ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
       
        // $file_extension = $request ->file('image') -> getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $file_nameone = $file_name;
        // $path = 'assets_admin/img/courses';
        // $request-> file('image') ->move($path,$file_name);

         $add = new Course;
        if ($files = $request->file('imagee')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $destinationPath = 'assets_admin/img/courses';
            $files->move($destinationPath, $profileImage);
            
            $add->image    = $profileImage;
        }else{
            $add->image="fffffff.png";
        }    
            
       
        $add->categoryId    = $request->categoryId;
        $add->subCategoryId    = $request->subCategoryId;
        // $add->childCategoryId    = $request->childCategoryId;
        $add->userId    = $userid->id;
        $add->title    = $request->title;
        $add->title_ar    = $request->title_ar;
        $add->short_detail    = $request->short_detail;
        $add->detail    = $request->detail;
        $add->requirement    = $request->requirement;
        $add->date    = $date;
        // $add->duration    = $request->duration;
        $add->slug =Str::slug($request->title, '-', Null);
        $add->meta_key    = $request->meta_key;
        // $add->meta_desc    = $request->meta_desc;
        
        $add->save();

        

        $length = count($request->name);
        if($length > 0)
        {
            for($i=0; $i<$length; $i++)
            {
                // echo $request->file.'file <br>';
                // echo $request->name[$i].'name<br>';
                // echo $request->videovalue[$i].'val<br>';
                $add_video = new Video;
                $add_video->courseId    = $add->id;
                $add_video->name    = $request->name[$i];
                $add_video->url    = $request->videovalue[$i];
                $add_video->videotime    = $request->videotime[$i];
                $add_video->videosize    = $request->videosize[$i];
                $add_video->save();
            }
             
        }
        
                
                
        // if(session('videos_sessions')){
        //     $videos=session()->get('videos_sessions');
        //     $items=[];
        //     foreach($videos as $id => $_item){
        //         $cars = array("name"=>$_item['name']);
        //         $items[]= $cars;
        //     }
        //     foreach($items as $i => $item){
        //         $add_video = new Video;
        //         $add_video->courseId    = 16;
              
        //         $add_video->name    = $request->name[$i];
        //         $add_video->url    = $item['name'];
        //         $add_video->save();
        //     }
        // }




        return redirect('instructor/courses')->with("message", 'تم رفع الدورة بنجاح وبانتظار موافقة الادارة لنشرها على المنصة'); 
    }

    
   

    public function edit(Course $course)
    {
        $categories=Category::all();
        // $subcategory=SubCategory::all();
        $subcategory=SubCategory::where('categoryId', $course->categoryId)->get();
        $childcategory=ChildCategory::all();
        return view('instructor.courses.edit',compact('course','categories','subcategory','childcategory'));
    }

    public function update(Request $request, Course $course)

    {
        $this->validate( $request,[          
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                // 'childCategoryId'=>'required',
                'title'=>'required',
                // 'level'=>'required',
                'short_detail'=>'required',
                'detail'=>'required',
                'requirement'=>'required',
                // 'price'=>'required',
                
                // 'duration'=>'required',
                'meta_key'=>'required',
                // 'meta_desc'=>'required',
                
            ],
            [
                'categoryId.required'=>'يرجي اختيار التخصص',
                'subCategoryId.required'=>' التخصص الفرعي مطلوب ',
                // 'childCategoryId.required'=>' التخصص الفرعي مطلوي  ',
                
                'title.required'=>' العنوان مطلوب ',
                // 'level.required'=>' المستوى مطلوب ',
                'short_detail.required'=>' يرجى كتابة وصف قصير ',
                'detail.required'=>' يرجي كتابة تفاصيل الكورس',
                'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
                // 'price.required'=>' سعر الكورس مطلوب ',
                
                // 'duration.required'=>' مدة الكورس مطلوبة ',
                'meta_key.required'=>' ادخل بعض الكلامات الدلالية ',
                // 'meta_desc.required'=>' ادخل الميتا دسك ',
            ]
        );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        $edit = Course::findOrFail($course->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/courses';
            $request-> file('image') ->move($path,$file_name);
            // File::delete(public_path("assets_admin/img/courses/". $edit->image));
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/" . $edit->image);
            
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->categoryId    = $request->categoryId;
        $edit->subCategoryId    = $request->subCategoryId;
        // $edit->childCategoryId    = $request->childCategoryId;
        $edit->userId    = $userid->id;
        $edit->title    = $request->title;
        $edit->title_ar    = $request->title_ar;
        $edit->short_detail    = $request->short_detail;
        $edit->detail    = $request->detail;
        $edit->requirement    = $request->requirement;
        // $edit->price    = $request->price;
        $edit->date    = $date;
        // $edit->duration    = $request->duration;
        $edit->slug =Str::slug($request->title, '-', Null);
        $edit->meta_key    = $request->meta_key;
        $edit->meta_desc    = $request->meta_desc;
        $edit->save();
        return redirect()->route('courses.index')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request )
    {
            $delete = Course::findOrFail($request->id);
            // dd('gggghytghgt');
            if($delete){
                $course_video= Video::where('courseId',$delete->id)->get();
                foreach ($course_video as $video) {         
                    File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/" . $video->url);
                    $delete_video = Video::findOrFail($video->id);
                    $delete_video->delete();
                }
                
                
                $courses_joined= Courses_joined::where('courseId',$delete->id)->get();
                foreach ($courses_joined as $item) {         
                    $delete_course = Courses_joined::findOrFail($item->id);
                    $delete_course->delete();
                }
                
                
            }
            $delete->delete();
            // File::delete(public_path("assets_admin/img/courses/". $delete->image));
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/" . $delete->image);
            return redirect()->route('courses.index')->with("message",'تم الحذف بنجاح'); 
    } 
    
}