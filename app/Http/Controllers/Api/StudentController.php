<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Courses_joined;

use App\SubCategory;
use App\Category;

use App\Instructor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Auth;
use App\City;
use App\Country;

use Validator;
use App\Live;
use App\Session;
use Hash;
use App\Course;
use App\Chapter;
use App\Video;
use App\Review;
use App\ChildCategory;
use Mail;
use Password;
use Illuminate\Support\Str;
class StudentController extends Controller   
{  
    use GeneralTrait; 
    public function coursesJoined(Request $request)
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        if($request->courseId){
            $checkcourse = Courses_joined::where("userId" , $user->id)->where("courseId" , $request->courseId)->first();
            if($checkcourse)
                return $this -> returnError('أنت منضم بالفعل');
            $add = new Courses_joined;
            $add->userId = $user->id;
            $add->courseId = $request->courseId;
            $add->save();
        }else{
            $checkcourse = Courses_joined::where("userId" , $user->id)->where("liveId" , $request->liveId)->first();
            if($checkcourse)
                return $this -> returnError('أنت منضم بالفعل');
            $add = new Courses_joined;
            $add->userId = $user->id;
            $add->liveId = $request->liveId;
            $add->save();
        }
        
        return $this -> returnSuccessMessage('تم إنضمامك للكورس');
    }
    
    public function myCourses()
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
             return $this->returnError('يجب تسجيل الدخول أولا');
        $courses=[];
        
        $courses_joined= Courses_joined::where('userId',$user->id)
                            ->with(array('courses'=>function($query){
                                $query;
                            }))->get(); 
        foreach ($courses_joined as $items) {  
            $coursejoin=Course::where("id" , $items->courseId)->first();
            if($coursejoin){
                $courses[]=$coursejoin;
            }
            
        }     
       
        foreach ($courses as $item) {         
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->childcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            $item->chapters= Chapter::where('courseId',$item->id)
                            ->with(array('videos'=>function($query){
                                $query;
                            }))->get(); 
            $lectures_count= Video::where('courseId',$item->id)->count();                
            $item->lectures_count=$lectures_count;  
            $joined_student = Courses_joined::where("courseId" , $item->id)->count();
            $item->joined_student=$joined_student;
            $isjoind= Courses_joined::where('userId',$user->id)->first();
             if($isjoind){
                $item->isjoind = 1;
             }else{
                $item->isjoind = 0;
             }
        // ///////////     
            $sum_review=Review::where('courseId',$item->id)->sum('rate');
            $allreview=Review::where('courseId',$item->id)->get();
            $count_review= count($allreview);
            
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;
                
            }
           
        }
        
        $lives=[];
        $lives_joined= Courses_joined::where('userId',$user->id)
                            ->with(array('lives'=>function($query){
                                $query;
                            }))->get(); 
        foreach ($lives_joined as $items) {  
            $livejoin=Live::where("id" , $items->liveId)->first();
            if($livejoin){
                $lives[]=$livejoin;
            }
            
        }     
       
        foreach ($lives as $item) {         
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->sessions= Session::where('liveId',$item->id)->get();
            $lectures_count= Session::where('liveId',$item->id)->count();                
            $item->lectures_count=$lectures_count;  
            
            $joined_student = Courses_joined::where("liveId" , $item->id)->count();
            $item->joined_student=$joined_student;
            $isjoind= Courses_joined::where('userId',$user->id)->first();
             if($isjoind){
                $item->isjoind = 1;
             }else{
                $item->isjoind = 0;
             }
        // ///////////     
            $sum_review=Review::where('liveId',$item->id)->sum('rate');
            $allreview=Review::where('liveId',$item->id)->get();
            $count_review= count($allreview);
            
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;
                
            }
           
        }
        $home  = [  
            'courses'=>$courses,
            'lives'=>$lives,
        ];
         
        return $this->returnDataa('data', $home,'');
    }
    
    public function addRate(Request $request)
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $add = new Review;
        $add->userId = $user->id;
        $add->courseId = $request->courseId;
        $add->comment = $request->comment;
        $add->rate = $request->rate;
        $add->save();
        return $this -> returnSuccessMessage('تم الاضافة بنجاح');
    }
    public function addRateCourseLive(Request $request)
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $add = new Review;
        $add->userId = $user->id;
        $add->liveId = $request->liveId;
        $add->comment = $request->comment;
        $add->rate = $request->rate;
        $add->save();
        return $this -> returnSuccessMessage('تم الاضافة بنجاح');
    }
    public function sessionStatus(Request $request)
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
            return $this->returnError('يجب تسجيل الدخول أولا');
        $edit = Session::where('id',$request->sessionId)->first();
        
        $edit->status = $request->status;
        $edit->save();
        return $this -> returnSuccessMessage('تم الحضور');
    }
    
    
}