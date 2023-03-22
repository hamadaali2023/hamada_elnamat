<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ContactInfo;
use App\Language;
use App\SubCategory;



use App\Category;

use App\Instructor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Auth;
use App\City;
use App\Country;

use Validator;

use Hash;
use App\Course;
use App\Chapter;
use App\Video;
use App\Review;
use App\Courses_joined;
use App\ChildCategory;
use Mail;
use Password;
use Illuminate\Support\Str;
class InstructorController extends Controller   
{  
    use GeneralTrait; 
    public function getInstructorData(Request $request)
    {
        // dd('vevreverv');
        $user = Auth::guard('instructors-api')->user();
         if(!$user)
                return $this -> returnError('يجب تسجيل الدخول أولا');
       
        $user->photo="https://kutuphanah.com/courses/img/profiles/".$user->photo;
        return $this->returnDataa('data', $user,'');
    }
    public function myCourses()
    {
        $user = Auth::guard('instructors-api')->user();
        if(!$user)
             return $this->returnError('يجب تسجيل الدخول أولا');
        $courses=Course::where("userId" , $user->id)->get();
        foreach ($courses as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->childcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
            // $chapters= Chapter::where('courseId',$item->id)->get();
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
        
        return $this->returnDataa('data', $courses,'');
    }
}