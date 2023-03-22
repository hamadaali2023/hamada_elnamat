<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
// use App\Curricul;
use App\Curriculum;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\Curricul_Video;
use App\Branch;
use App\Curricul_Branch;
use Session;
use App\Material;
use Storage;
use Illuminate\Support\Facades\File;

use DB;
class CurriculumController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }
    public function indexxx(){
        $path = '/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos';
        $filesInFolder = File::allFiles($path);
        
        
        foreach($filesInFolder as $key => $path){
          $files = pathinfo($path);
          $allMedia[] = $files['basename'];
        }
        dd($allMedia);
    }
    public function index()
    {
        $branches=Branch::all();
        $userid = Auth::guard('instructors')->user();
        $curriculums=Curriculum::where('instructor_id',$userid->id)->get();
        foreach ($curriculums as $item) {   
            $item->videos= Curricul_Video::where('curricul_id',$item->id)->get();
            $item->material=Material::where('id',$item->material_id)->first();
            $curriculas_branches= Curricul_Branch::where('curricul_id',$item->id)->get();
            $branch=[];
            foreach ($curriculas_branches as $_item) { 
                $curricul_branch=Branch::where('id',$_item->branch_id)->first();
                $branch[]=$curricul_branch;
            }
            $item->branch=$branch;
        }
        // dd($curriculums);
        return view('instructor.curriculums.all',compact('curriculums','branches'));
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

        session()->forget('curriculas_videos');
        $branches=Branch::all();
        $materials=Material::all();
        return view('instructor.curriculums.create',compact('branches','materials','userid'));
    }
    public function addvideostore(Request $request)
    {
        // dd('fffffff');
        
        if ($files = $request->file('file')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $destinationPath = 'assets_admin/img/curriculums/videos';
            $files->move($destinationPath, $profileImage);
            $videos_sessions = session()->get('curriculas_videos');
            if(!$videos_sessions) {
                $videos_sessions = [
                    $request->id => [
                        "name" => $profileImage,
                    ]
                ];
                session()->put('curriculas_videos', $videos_sessions);
            }
            
            //if videos_sessions not empty then check if this product exist then increment quantity
            if(isset($videos_sessions[$request->id])) {
                // $image_path ="/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/".$profileImage;
                // unlink($image_path);
                //  File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/".$profileImage);
                $videos_sessions[$request->id]['name']=$profileImage;
                session()->put('curriculas_videos', $videos_sessions);
            }
            // if item not exist in videos_sessions then add to videos_sessions with quantity = 1
            $videos_sessions[$request->id] = [
                "name" => $profileImage,
            ];
            session()->put('curriculas_videos', $videos_sessions);
            
            return Response()->json($profileImage);
        }
    }
    public function removeVideoSession($id)
    {
        $videos=session()->get('curriculas_videos');
        //     File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/".$videos[$id]['name']);

        // dd($videos);

        // return Response()->json($videos);
        File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/".$videos[$id]['name']);

       
        if(isset($videos[$id])) {
            unset($videos[$id]);
            session()->put('videos_sessions', $videos);
        }
        return Response()->json($id);
    }
    public function store(Request $request)
    {
        // dd( $length = count($request->name));
        // $this->validate( $request,[          
        //         'categoryId'=>'required',
        //         'subCategoryId'=>'required',
        //         'title'=>'required',
        //         'short_detail'=>'required',
        //         'detail'=>'required',
        //         'requirement'=>'required',
        //         'imagee'=>'required',
                
        //     ],
        //     [
        //         'categoryId.required'=>'يرجي اختيار التخصص',
        //         'subCategoryId.required'=>' التخصص الفرعي مطلوب ',

        //         'title.required'=>' العنوان مطلوب ',
        //         'short_detail.required'=>' يرجى كتابة وصف قصير ',
        //         'detail.required'=>' يرجي كتابة تفاصيل الكورس',
        //         'requirement.required'=>' يرجى كتابة متطلبات الكورس ',
        //         'imagee.required'=>' يجب ارفاق صورة ',
        //     ]
        // );
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        $add = new Curriculum;
        if ($files = $request->file('imagee')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $destinationPath = 'assets_admin/img/curriculums';
            $files->move($destinationPath, $profileImage);
            
            $add->image    = $profileImage;
        }else{
            $add->image="fffffff.png";
        }    
            
       
        $add->instructor_id    = $userid->id;
        $add->name    = $request->title;
        $add->material_id    = $request->material_id;
        
        $add->classroom    = $request->classroom;
        $add->date    = $date;
        $add->save();
        // dd('ddddd');
        $length_branch_id = count($request->branch_id);
        if($length_branch_id > 0)
        {
            for($i=0; $i<$length_branch_id; $i++)
            {
                $add_branch = new Curricul_Branch;
                $add_branch->curricul_id    = $add->id;
                $add_branch->branch_id    = $request->branch_id[$i];
                $add_branch->instructor_id    = $userid->id;
                $add_branch->save();
            }
             
        }
        
        
        $length = count($request->name);
        if($length > 0)
        {
            for($i=0; $i<$length; $i++)
            {
                $add_video = new Curricul_Video;
                $add_video->curricul_id    = $add->id;
                $add_video->instructor_id    = $userid->id;
                $add_video->name    = $request->name[$i];
                $add_video->url    = $request->videovalue[$i];
                $add_video->videotime    = $request->videotime[$i];
                $add_video->videosize    = $request->videosize[$i];
                $add_video->save();
            }
             
        }
        

        return redirect('instructor/curriculums')->with("message", 'تم رفع الدورة بنجاح وبانتظار موافقة الادارة لنشرها على المنصة'); 
    }

    
   
// use App\Curricul;

    public function edit(Curriculum $curriculum)
    {
        $branches=Branch::all();
        $materials=Material::all();
        $curricul_Branch=Curricul_Branch::where('curricul_id',$curriculum->id)->get();
        // dd($branches);
        return view('instructor.curriculums.edit',compact('curriculum','branches','materials','curricul_Branch'));
    }

    public function update(Request $request, Curriculum $curriculum){
        $userid = Auth::guard('instructors')->user();
        $date = date('Y-m-d');
        
        
                
        $edit = Curriculum::findOrFail($curriculum->id);
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/curriculums';
            $request-> file('image') ->move($path,$file_name);
            // File::delete(public_path("assets_admin/img/curriculums/". $edit->image));
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/" .  $edit->image);
       
       
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->name    = $request->title;
        $edit->material_id    = $request->material_id;
        
        $edit->classroom    = $request->classroom;
        $edit->date    = $date;
        $edit->save();
        
        
        $curricul_Branch=Curricul_Branch::where('curricul_id',$curriculum->id)->get();
            
        foreach ($curricul_Branch as $item) {         
            $delete_curriculas = Curricul_Branch::findOrFail($item->id);
            $delete_curriculas->delete();
        }
        $length_branch_id = count($request->branch_id);
        if($length_branch_id > 0)
        {
            for($i=0; $i<$length_branch_id; $i++)
            {
                $add_branch = new Curricul_Branch;
                $add_branch->curricul_id    = $edit->id;
                $add_branch->branch_id    = $request->branch_id[$i];
                $add_branch->instructor_id    = $userid->id;
                $add_branch->save();
            }
             
        }
        return redirect()->route('curriculums.index')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request )
    {
            $delete = Curriculum::findOrFail($request->id);
            // dd('gggghytghgt');
            if($delete){
                $curricul_video= Curricul_Video::where('curricul_id',$delete->id)->get();
                foreach ($curricul_video as $item) {         
                    File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/" . $item->url);
                    $delete_curriculum = Curricul_Video::findOrFail($item->id);
                    $delete_curriculum->delete();
                }
                
                $curricul_branch= Curricul_Branch::where('curricul_id',$delete->id)->get();
                foreach ($curricul_branch as $branch) {         
                    $delete_branch = Curricul_Branch::findOrFail($branch->id);
                    $delete_branch->delete();
                }
            }
            $delete->delete();
            // File::delete(public_path("assets_admin/img/curriculums/". $delete->image));
            File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/" . $delete->image);
       
            return redirect()->route('curriculums.index')->with("message",'تم الحذف بنجاح'); 
    } 
    
}