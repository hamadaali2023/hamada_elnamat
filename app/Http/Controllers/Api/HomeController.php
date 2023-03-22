<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\ContactInfo;
use App\Language;
use App\SubCategory;



use App\Category;
use App\Courses_joined;
use App\Instructor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;
use Auth;
use App\City;
use App\Country;
use App\Live;
use App\Session;
use Validator;

use Hash;
use App\Course;
use App\Chapter;
use App\Video;
use App\Review;
use App\ChildCategory;
use Mail;
use Password;
use Illuminate\Support\Str;
use App\Curricul_Video;
class HomeController extends Controller   
{  
    use GeneralTrait; 


    
    public function videosortable(Request $request)
    {
        $videos = Video::get();
        // return response($request->myorder, 200);
        foreach ($videos as $video) {
            foreach ($request->myorder as $order) {
               
                if ($order['id'] == $video->id) {
                   
                    $editv = Video::findOrFail($order['id']);
                    $editv->order    = $order['position'];
                    $editv->save();
                    //  return response($order['position'], 200);
                    
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
   
    public function videosortableCurriculums(Request $request)
    {
        $videos = Curricul_Video::get();
        // return response($request->myorder, 200);
        foreach ($videos as $video) {
            foreach ($request->myorder as $order) {
               
                if ($order['id'] == $video->id) {
                   
                    $editv = Curricul_Video::findOrFail($order['id']);
                    $editv->order    = $order['position'];
                    $editv->save();
                    //  return response($order['position'], 200);
                    
                }
            }
        }
        
        return response('Update Successfully.', 200);
    }
   

   
    
   
   

}
