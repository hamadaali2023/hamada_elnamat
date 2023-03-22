<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instructor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


use App\Curriculum;

use Auth;
use App\Curricul_Video;
use App\Branch;
use App\Curricul_Branch;
use App\Material;
use App\Video;
class CurriculumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function recyclessCurriculums(){
        $path = '/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos';
        // curmbuckup
        // curriculums/videos
        $filesInFolder = File::allFiles($path);
        
        $curricul_video= Curricul_Video::get();
        foreach ($curricul_video as $key=>$_item ) {     
            $allvideo[]   =$_item->url;
        }    
        $allMediassss=[];
        foreach($filesInFolder as $key => $path){
            $files = pathinfo($path);
            $allMedia[] = $files['basename'];
        }
        foreach ($allMedia as $key=>$item) { 
            if(!in_array($item, $allvideo))
            {
                //  File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curriculums/videos/" . $item);
                echo $key.'-' .$item;
                echo '<br>';
                array_push($allMediassss,$item);
            }
        }
        
        
        // foreach ($curricul_video as $key=>$_item ) {        
        //     // $delete_curriculum = Curricul_Video::findOrFail($item->id);
           
           
        //     foreach ($allMedia as $item) { 
                
        //         if($item != $_item->url ){
              
        //             if(!in_array($_item->url, $allMediassss))
        //             {
                        
                        
        //                 array_push($allMediassss,$_item->url);
        //             }
        //             // $allMediassss[]   =$_item->url;
        //         }
        //     }   
        // }
        //  File::delete("/home/u9ak0fjx/public_html/assets_admin/img/curmbuckup/" . $item);
        echo count($allMediassss);
         echo '<br>';
        $indatabase=count($curricul_video);
        $in_storage=count($allMedia);
        $differencees=$in_storage - $indatabase;
         echo '<h4> التوجيهي</h4>';
        echo 'in data base ' .$indatabase;
        echo '<br>';
        echo 'in storage '. $in_storage;
        echo '<br>';
        echo 'the difference '.$differencees; 
        
        // dd($allMedia);
        // dd(count($allMedia));
    }
    public function recyclessCourses(){
        $path = '/home/u9ak0fjx/public_html/assets_admin/img/courses/videos';
        $filesInFolder = File::allFiles($path);
        
        $curricul_video= Video::get();
        foreach ($curricul_video as $key=>$_item ) {     
            $allvideo[]   =$_item->url;
        } 
        
        $allMediassss=[];
        foreach($filesInFolder as $key => $path){
            $files = pathinfo($path);
            $allMedia[] = $files['basename'];
        }
        foreach ($allMedia as $key=>$item) { 
            if(!in_array($item, $allvideo))
            {
                 File::delete("/home/u9ak0fjx/public_html/assets_admin/img/courses/videos/" . $item);
                echo $key.'-' .$item;
                echo '<br>';
                array_push($allMediassss,$item);
            }
        }
        
        echo count($allMediassss);
        $indatabase=count($curricul_video);
        $in_storage=count($allMedia);
        $differencees=$in_storage-$indatabase;
         echo '<h4> الدورات المسجلة</h4>';
        echo 'in data base ' .$indatabase;
        echo '<br>';
        echo 'in storage '. $in_storage;
        echo '<br>';
        echo 'the difference '.$differencees;
        
        // dd($allMedia);
        // dd(count($allMedia));
    }
    public function index()
    {
        $branches=Branch::orderBy('id', 'DESC')->get();
        $curriculums=Curriculum::orderBy('id', 'DESC')->get();
        foreach ($curriculums as $item) {   
            $item->instructor= Instructor::where('id',$item->instructor_id)->first();
            
            $curriculas_branches= Curricul_Branch::where('curricul_id',$item->id)->get();
            $branch=[];
            foreach ($curriculas_branches as $_item) { 
                $curricul_branch=Branch::where('id',$_item->branch_id)->first();
                $branch[]=$curricul_branch;
            }
            $item->branch=$branch;
            $item->material= Material::where('id',$item->material_id)->first();
        }
        // dd($curriculums);
        return view('admin.curriculums.all',compact('curriculums','branches'));
    }
    public function updateStatus(Request $request)
    {
       $course = Curriculum::findOrFail($request->id);
        $course->status = $request->status;
        $course->save();
        return back()->with("message", 'تم تغيير الحالة '); 
        // return response()->json(['message' => 'User status updated successfully.']);
    }

    
    public function curriculumFilter(Request $request)
    {
        $branches=Branch::orderBy('id', 'DESC')->get();
        $curriculums = Curriculum::where('status',$request->filter)->orderBy('id', 'DESC')->get();
        foreach ($curriculums as $item) {   
            $item->instructor= Instructor::where('id',$item->instructor_id)->first();
        }
        return view('admin.curriculums.all',compact('curriculums','branches'));
    }
     public function getSubCategory($id){
         echo json_encode(SubCategory::where('categoryId', $id)->get());
    }
    public function curriculumEdit($id)
    {
        
        $edit=Curriculum::findOrFail($id);
        $branches=Branch::all();
        $materials=Material::all();
        $curricul_Branch=Curricul_Branch::where('curricul_id',$edit->id)->get();
        // dd($branches);
        return view('admin.curriculums.edit',compact('edit','branches','materials','curricul_Branch'));
        
        
    }
    
    public function curriculumUpdate(Request $request)

    {
        
       
        $date = date('Y-m-d');
        $edit = Curriculum::findOrFail($request->id);
        $instructor= Instructor::where('id',$edit->instructor_id)->first();
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/curriculums';
            $request-> file('image') ->move($path,$file_name);
            File::delete(public_path("assets_admin/img/curriculums/". $edit->image));

            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $edit->image;
        }
        $edit->name    = $request->title;
        $edit->material_id    = $request->material_id;
        
        $edit->classroom    = $request->classroom;
        $edit->date    = $date;
        $edit->save();
        
        
        $curricul_Branch=Curricul_Branch::where('curricul_id',$request->id)->get();
            
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
                $add_branch->instructor_id    = $instructor->id;
                $add_branch->save();
            }
             
        }
        return back()->with("message", 'تم التعديل بنجاح'); 
    }
    
     public function destroycurriculum(Request $request)
    {
        $delete = Curriculum::findOrFail($request->id);
        $delete->delete();
        return back()->with("message",'تم الحذف بنجاح'); 
    }
    
}
