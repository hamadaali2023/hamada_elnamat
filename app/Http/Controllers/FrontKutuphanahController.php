<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Language;
use App\Country;
use App\User;
use App\Instructor;
use App\Slider;
use App\Course;
use App\Chapter;
use App\Video;
use App\View;
use App\Review;
use App\ChildCategory;
use Auth;
use App\Bank;
use App\Lecture;
use App\Straight;
use App\Favorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\TranslateClient;
use App\Subscription;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Session;
use App\LastCoursesWatch;
use Illuminate\Support\Facades\Hash;
use App\Wallet;
use App\Transaction;
use Mail;
use App\Mail\SendMailable;
use App\Certificate;
use App\Courses_joined;
use DB;
use App\SubscriptionValue;
use app\ContactInfo;
use DateTimeZone;
use DateTime;
use App\Consulting;
use App\ConsultingJoined;
use Carbon\Carbon;
use App\Curriculum;
use App\Curricul_Branch;
use App\Curricul_Video;
use App\Branch;
use App\Material;
use App\Marquee_Text;
class FrontKutuphanahController extends Controller
{   
    public function curriculums()
    {
        $user = Auth::guard('instructors')->user(); 
        $branches=Branch::all();
        $materials=Material::all();
        
        $curriculums=Curriculum::where('status',1)->get();
        
        
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
        //  dd($curriculums);
        $marquees=Marquee_Text::where('type','منهج')->get();
        return view('front.curriculums',compact('user','curriculums','branches','materials','marquees'));
        
    }
    public function curriculasDetails( $id)
    {
        $user = Auth::guard('instructors')->user(); 
        $details=Curriculum::where('id',$id)->first(); 
        
        $curriculas_branches= Curricul_Branch::where('curricul_id',$details->id)->get();
        $branch=[];
        foreach ($curriculas_branches as $cur_branches) { 
                $curricul_branch=Branch::where('id',$cur_branches->branch_id)->first();
                $branch[]=$curricul_branch;
        }
        $details->branch=$branch;
        $details->material= Material::where('id',$details->material_id)->first();
        
        
        if($user && $user->type=='student'){
            if($user->status_teacher ==1){
                $curricul_branch_sub='null';
                foreach ($curriculas_branches as $_item) { 
                    if($_item->branch_id ==$user->branch_id){
                        $curricul_branch_sub=true;
                    }
                    // elseif(!$user->branch_id){
                    //     $curricul_branch_sub=true;
                    // }else{
                    //     $curricul_branch_sub='null';
                    // }
                }
            }else{
                $curricul_branch_sub='nulll';
            }    
        }else{
            $curricul_branch_sub='nulll';
        }    
        // dd($curricul_branch_sub);
        if($user){
            $favorite_check=Favorite::where('courseId',$details->id)->where('userId',$user->id)->first();
        }else{
            $favorite_check=null;
        }
        
        $todayDate = date("Y-m-d");
       

        if($user){
            $student_course_whatch =View::where('studentId',$user->id)->where('courseId',$details->id)->sum('watchtime');
            $student_course_views = $student_course_whatch / 60;
        }else{
            $student_course_views=0;
        }
        $cours_time = Curricul_Video::where('curricul_id',$details->id)->sum('videotime');
        if($cours_time==0){
            
            $totalpercent=$student_course_views * 100 / 1 ;
        }else{
            $totalpercent=$student_course_views * 100 / $cours_time ;
        }
       
        $videos = Curricul_Video::where('curricul_id',$details->id)->orderBy('order', 'ASC')->get();
        $video_count=0;
        foreach ($videos as $_item) {
            $video_count++;
            if($user){
                $vid_views=View::where('studentId',$user->id)->where('videoId',$_item->id)->first();
                if($vid_views){
                    $_item->vid_views=$vid_views->watchtime;
                }else{
                    $_item->vid_views=0;
                }
            }
           
        }
        $instructor= Instructor::where('id',$details->instructor_id)->first();
        if($user){
            $subscriptions= Subscription::where('userId',$user->userId)->first();
        }else{
            $subscriptions=null;
        }

        $sum_review=Review::where('courseId',$details->id)->sum('rate');
        $allreview=Review::where('courseId',$details->id)->get();

        $count_review= count($allreview);        
       
        if($count_review ==0){
            $rate= 0.0;    
        }else{
            $total_rate= $sum_review / $count_review;
            $rate=$total_rate;               
        }

        
        if($user){
            $user_rate=Review::where('courseId',$details->id)->where('userId',$user->id)->first();
            // dd($user->id);
            if($user_rate){
                $user_rate='true';
            }else{
                $user_rate='false';
            }
        }else{
            $user_rate='false';
        }  
        
        
        $country= Country::where('id',$instructor->countryId)->first();
         
        $shareComponent = \Share::page(
            'https://elnamat.com/courses//',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        // dd($curricul_branch_sub);
        return view('front.curriculas-details',compact('user','curricul_branch_sub','cours_time','totalpercent','favorite_check','details','videos','video_count','instructor','rate','country','subscriptions','shareComponent','user_rate','student_course_views'));
    }

    public function getSubCategory($id){
         echo json_encode(SubCategory::where('categoryId', $id)->get());
        // echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }
    
    public function getSearchCourse(Request $request)
    {
        $categories=Category::all();
        $courses_result=Course::where('categoryId',$request->categoryId)->where('subCategoryId',$request->subCategoryId)->get();
        
        
        foreach ($courses_result as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
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
        return view('front.allcourses',compact('courses_result','categories'));
    }
    public function getSearchCurriculums(Request $request)
    {
        $user = Auth::guard('instructors')->user(); 
        $branches=Branch::all();
        $materials=Material::all();
        $marquees=Marquee_Text::where('type','منهج')->get();
        $curriculums=[];
        $curriculas_branches= Curricul_Branch::where('branch_id',$request->branch_id)->get();
        foreach ($curriculas_branches as $branche) { 
            $curriculum=Curriculum::where('status',1)->where('id',$branche->curricul_id)->where('classroom',$request->classroom)->first();
            if($curriculum)
            
            $curriculums[]=$curriculum;
        }    
        // $curriculums=Curriculum::where('status',1)->where('id',$request->classroom)->where('subCategoryId',$request->classroom)->get();
        // dd($curriculums);
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
        //  dd($curriculums);
        return view('front.curriculums',compact('user','curriculums','branches','materials','marquees'));
        
    }
    public function allInstructor()
    {
        // $instructors=Instructor::where('type','instructor')->get();
        // $course_sum= Course::where('userId',$item->id)->first();
        $instructor_publish_course=Instructor::where('type','instructor')->get();
        $instructors=[];
        foreach ($instructor_publish_course as $item) {   
            $course_sum= Course::where('userId',$item->id)->first();
            if($course_sum){
                if($item->id !=296){
                    $instructors[]=$item;
                }
                
            }
        }
        return view('front.all-instructor',compact('instructors'));
    }
    public function allTeacher()
    {
        $instructors=Instructor::where('type','instructor')->whereHas('curriculums', function ($query) {
             return $query;
        })->get();
        // $instructor_publish_course=Instructor::where('type','instructor')->get();
        // $instructors=[];
        // foreach ($instructor_publish_course as $item) {   
        //     $course_sum= Course::where('userId',$item->id)->first();
        //     if($course_sum){
        //         if($item->id !=296){
        //             $instructors[]=$item;
        //         }
                
        //     }
        // }
        // dd(count($instructors));
        return view('front.all-teacher',compact('instructors'));
    }
    public function courseMore()
    {
        // $courses=Course::with('views', function ($query) {
        //      return $query;
        // })->get();
        
         $doctor= Course::whereHas('views')->with(array('views'=>function($query){
                              $query;
                            }))->get(); 
        
        //  $vendors=Vendor::whereHas('product_vendors', function ($query) {
        //      return $query->where('price_before', '!=', 0);
        // })->get();
    //   $doctor= Doctor::selection()->where('id',$item->doctorId)
    //                         ->with(array('specialityName'=>function($query){
    //                             $query->selection();
    //                         }))
    //                         ->with(array('services'=>function($query){
    //                             $query->selection();
    //                         }))->first();
                            
            //   dd($doctor);                 
        return $doctor ;
        $array=array("a"=>1,"b"=>2,"c"=>4,"d"=>5);
        $value = max($array);
        $key = array_search($value, $array);
        dd($value);
        $courses=Course::where('status',1)->whereHas('views', function ($query) {
             return $query;
        })->get();
        dd($courses);
        // $max_scores_table= DB::table('views')->max('watchtime');
        
        
        $courses=Course::where('status',1)->get();
        $c = array();
        foreach ($courses as $item) {            
            // $item->instructor= Instructor::where('id',$item->userId)->first();
            $val =View::where('courseId',$item->id)->sum('watchtime');
            if ($val > 0) {
                $obj = [
                    'id' => $item->id,
                    'watch' => $val,
                ];
                $c[]=$obj;
            }
        }
        
        dd($c);
        
        
        $a = array(10, 20, 52, 105, 56, 89, 96);
        $b = 0;
        foreach ($a as $key=>$val) {
            if ($val > $b) {
                $b = $val;
            }
        }
        echo $b;
        $array=array("a"=>1,"b"=>2,"c"=>4,"d"=>5);
        $value = max($array);
        $key = array_search($value, $array);
        dd($key);

    }
    public function userBills()
    {
        $user = Auth::guard('instructors')->user(); 
        $bills=Transaction::get();
        $instructors=Instructor::where('type','instructor')->get();
        foreach ($bills as $item) {
            $user= Instructor::where('id',$item->user_id)->first();
            $country= Country::where('id',$user->countryId)->first();
            $user->country=$country->name;
            $item->user=$user;
        }
        // dd($bills);
        return view('front.bills',compact('bills','instructors','user'));
    }

    public function index()
    {
        $sliders=Slider::all();
        return view('front.home',compact('sliders'));
    }
    
    public function courses()
    {
        $user = Auth::guard('instructors')->user(); 
        $categories=Category::all();
        $sliders=Slider::all();
        
        $courses=Course::where('status',1)->get();
        
        foreach ($courses as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();

            $sum_review=Review::where('courseId',$item->id)->sum('rate');
            $allreview=Review::where('courseId',$item->id)->get();
            $count_review= count($allreview);        
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;               
            }
            
            if($user){
                $user_favorite=Favorite::where('courseId',$item->id)->where('userId',$user->id)->first();
                // dd($recently->id);
                if($user_favorite){
                   $item->user_favorite='true';
                }else{
                    
                    $item->user_favorite='falsess';
                }
            }else{
                $item->user_favorite='false';
            }    
        }
       
        // $todayDate = date("Y-m-d");
        $new_courses = Course::orderBy('date', 'DESC')->take(9)->where('status',1)->get();  
         foreach ($new_courses as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();

            $sum_review=Review::where('courseId',$item->id)->sum('rate');
            $allreview=Review::where('courseId',$item->id)->get();
            $count_review= count($allreview);        
            if($count_review ==0){
                $item->rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
                $item->rate=$total_rate;               
            }
            
            
            if($user){
                $user_favorite=Favorite::where('courseId',$item->id)->where('userId',$user->id)->first();
                // dd($recently->id);
                if($user_favorite){
                   $item->user_favorite='true';
                }else{
                    
                    $item->user_favorite='falsess';
                }
            }else{
                $item->user_favorite='false';
            }    


        }
        $marquees=Marquee_Text::where('type','مسجلة')->get();
        if($user){
            if($user->type=="student"){
                $favorites = Favorite::where('userId',$user->id)->get();
                foreach ($favorites as $item) {            
                    $course= Course::where('id',$item->courseId)->first();
                    $sum_review=Review::where('courseId',$course->id)->sum('rate');
                    $allreview=Review::where('courseId',$course->id)->get();
                    $count_review= count($allreview);        
                    if($count_review ==0){
                       $course->rate= 0.0;    
                    }else{
                        $total_rate= $sum_review / $count_review;
                        $course->rate=$total_rate;               
                    }
                    $course->instructor= Instructor::where('id',$course->userId)->first();
                    $item->course=$course;
                }
                
                
                $continue_watching= LastCoursesWatch::where('user_id',$user->id)->get();
                $lastcourses=[];
                foreach ($continue_watching as $_item) {
                    $course_last= Course::where('id',$_item->course_id)->first();
                    $course_last->check_last = $_item;
                    
                    
                    $user_favorite=Favorite::where('courseId',$course_last->id)->where('userId',$user->id)->first();
                    if($user_favorite){
                        $course_last->user_favorite='true';
                    }else{
                        $course_last->user_favorite='false';
                    }
                    
                   $course_last->instructor= Instructor::where('id',$course_last->userId)->first();
                   
                   
                    
                    
                    $cours_time = Video::where('courseId',$_item->course_id)->sum('videotime');
                    $students_views =View::where('courseId',$_item->course_id)->sum('watchtime');
                    
                    $student_view=$students_views / 60;
                    if($cours_time==0){
                        $totalpercent=$student_view * 100 / 1;
                    }else{
                        $totalpercent=$student_view * 100 / $cours_time;
                    }
                    $course_last->cm=$cours_time;
                    $course_last->sv=$students_views;
                    $course_last->tp=$totalpercent;
                    // if($totalpercent >= 80){
                        if(!in_array($course_last, $lastcourses))
                        {
                            array_push($lastcourses,$course_last);
                        }
                    // }
                }
                
                
                // dd($lastcourses);
                // $lastcourses =[];
                // $lastwatchs=LastCoursesWatch::where('userId',$user->id)->get();
                // foreach ($lastwatchs as $lastwatch) { 
                //     $course=Course::where('id', $lastwatch->courseId)->first();
    
    
                //     $sum_review=Review::where('courseId',$course->id)->sum('rate');
                //     $allreview=Review::where('courseId',$course->id)->get();
                //     $count_review= count($allreview);        
                //     if($count_review ==0){
                //       $course->rate= 0.0;    
                //     }else{
                //         $total_rate= $sum_review / $count_review;
                //         $course->rate=$total_rate;               
                //     }
                //     $lastcourses[]=$course;
                    
    
                // }
                // dd($lastcourses);
                return view('front.courses',compact('user','courses','categories','sliders','favorites','new_courses','lastcourses','marquees'));
            }
        }   
        return view('front.courses',compact('user','courses','categories','sliders','new_courses','marquees'));
        
    }
    
    public function loadMoreone(Request $request)
    {
                $user = Auth::guard('instructors')->user(); 

        $new_courses = Course::orderBy('date', 'DESC')->where('status',1)->paginate(2);    
        // dd($users);    
        $data = '';
        if ($request->ajax()) {
            // foreach ($new_courses as $courses) {
            //     $data.='<li>'.'Name:'.' <strong>'.$courses->title.'</strong></li>';
            // }
            foreach ($new_courses as $courses) {
            $instructor= Instructor::where('id',$courses->userId)->first();
            $sum_review=Review::where('courseId',$courses->id)->sum('rate');
            $allreview=Review::where('courseId',$courses->id)->get();
            $count_review= count($allreview);        
            if($count_review ==0){
                $total_rate= 0.0;    
            }else{
                $total_rate= $sum_review / $count_review;
            }
            $courserate='';
            if($total_rate >4){
                for ($i = 0; $i < $total_rate; $i++){
                    $courserate.='<span class="fa fa-star checked"></span>';
                } 
            }elseif($total_rate >3){
                for ($i = 0; $i < $total_rate; $i++){
                    $courserate.='<span class="fa fa-star checked"></span>';
                }
                $courserate.='<span class="fa fa-star"></span>';  
            }elseif($total_rate >2){
                for ($i = 0; $i < $total_rate; $i++){
                    $courserate.='<span class="fa fa-star checked"></span>';
                }
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
            }elseif($total_rate >1){
                for ($i = 0; $i < $total_rate; $i++){
                    $courserate.='<span class="fa fa-star checked"></span>';
                }
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
            }elseif($total_rate >0){
                for ($i = 0; $i < $total_rate; $i++){
                    $courserate.='<span class="fa fa-star checked"></span>';
                }
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
            }else{
                $courserate.='<span class="fa fa-star"></span> '; 
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';
                $courserate.='<span class="fa fa-star"></span>';            
            }
            
            
            $favo_url ="{{url('user/addfavorite')}}";  
            if($user){
                $user_favorite=Favorite::where('courseId',$courses->id)->where('userId',$user->id)->first();
                if($user_favorite){
                    $userfavorite='<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>';
                }else{
                    $userfavorite='<i class="fas fa-heart pr-2"></i>';
                }
            }else{
                 $userfavorite='<i class="fas fa-heart pr-2"></i>';
                
            }  
            
            // $coursefavorite='';
            // if($userfavorite == 'true'){
            //     $coursefavorite='<i class="fas fa-heart pr-2"></i>';
            // }else{            
            //     $coursefavorite='<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>';
            // }
            $data.='<div class="col-12 col-lg-3 col-md-6">
                                            <a href="courses/'.$courses->slug.'/'.$courses->id.'">
                                                <img src="assets_admin/img/courses/'.$courses->image.'" class="img-fluid">
                                            </a>
                                            <a href="courses/'.$courses->slug.'/'.$courses->id.'">
                                                <div class="bg-light">

                                                    <p class="text-dark font-weight-bold mb-2"> '.$courses->title.'</p>

                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>'.$instructor->name.'</span>
                                                    </div>

                                          </a>
    

                                    <div class="row">
                                            
                                            <div class="col-7">
                                                
                                                    
                                                 <div class="mb-2">
                                                '.$courserate.'
                                        </div>
                                                
                                            </div>
                                            
                                            <div class="col-5">
                                                 
                                         <div class="featured-buttons mb-4">
                                           <form action="user/addfavoritemore" method="get">
                                                
                                                <input type="hidden" name="courseId" value="'.$courses->id.'"> 
                                                <button type="submit">
                                                   '.$userfavorite.'
                                                </button>
                                            </form>
                                            
                                        </div>
                                        
                                                
                                            </div>
                                            
                                        </div>

                                                 

                                                </div>
                                        </div>
                
                ';
            }
            return $data;
        }
        $categories=[];
            $user=[];
                return view('front.courses',compact('user','categories','new_courses'));

    }
    public function RemoveContenueWatch(Request $request)
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
            // dd($request->courseId);
            $delete = LastCoursesWatch::findOrFail($request->last_watch_id);
            $delete->delete();
            return redirect()->back()->with("message", 'تم الإزالة من الاستمرار في المشاهدة');
        
    }
     


    // public function searching(Request $request) {
    //     $text = $request->input('txtSearch');
    //     $patients = DB::table('books')->where('name', 'Like', "$text")->get();
    //     return response()->json($patients);
    // }


    public function searching(Request $request){
        
        if($request->ajax()) {
          
           $data = Story::where('name', 'LIKE', $request->country.'%')->where('status',1)->get();
           foreach ($data as $item) {            
                $item->instructor= Instructor::where('id',$item->userId)->first();
                $item->country= Country::where('id',$item->countryId)->first();
                $item->category= Category::where('id',$item->categoryId)->first();
                $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            }
           
            return $data;
        }
    }

     public function searchcourse(Request $request)
    {
        $courses_result=Course::where('title', 'LIKE', "%{$request->title}%")->where('status',1)->get();               
        foreach ($courses_result as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
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
        return view('front.allcourses',compact('courses_result'));
    }

    public function getcoursesbycategory(Request $request){
        
        // $data = Course::where('categoryId', 1)->get();
        // dd($data);
        if($request->ajax()) {
            if($request->categoryId==0){
                $data =Course::where('status',1)->get();
            }else{
                $data = Course::where('categoryId', $request->categoryId)->where('status',1)->get();
            }
            
            foreach ($data as $item) {            
                $item->instructor= Instructor::where('id',$item->userId)->first();
                $item->category= Category::where('id',$item->categoryId)->first();
                $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
                $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
                
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
           
            return $data;
        }
    }
    public function getCurriculums(Request $request){
        
        
        
        
       
        // if($request->ajax()) {
            $data=[];
            $allbranch= Curricul_Branch::where('branch_id',$request->branchId)->get();
            foreach ($allbranch as $_item) {
                $curriculums= Curriculum::where('status',1)->where('id',$_item->curricul_id)->first();
                if($curriculums){
                $data[]= $curriculums;
                }
            } 
            // dd($allbranch); 
            
            
            
            foreach ($data as $item) {            
                $item->instructor= Instructor::where('id',$item->instructor_id)->first();
                // $curriculas_branches= Curricul_Branch::where('curricul_id',$item->id)->where('branch_id',$request->branchId)->first();
                $branch=Branch::where('id',$request->branchId)->first();
                // $branch=[];
                // foreach ($curriculas_branches as $_item) { 
                //     $curricul_branch=Branch::where('id',$_item->branch_id)->first();
                //     $branch[]=$curricul_branch;
                // }
                $item->branch=$branch;
                $item->material= Material::where('id',$item->material_id)->first();
            }
           
            return $data;
        // }
    }
    public function getConsultings(Request $request){
        if($request->ajax()) {
            $data= Consulting::where('title',$request->categoryId)->get();
            
            // foreach ($data as $item) {            
            //     $sum_review=Review::where('courseId',$item->id)->sum('rate');
            //     $allreview=Review::where('courseId',$item->id)->get();
            //     $count_review= count($allreview);        
            //     if($count_review ==0){
            //         $item->rate= 0.0;    
            //     }else{
            //         $total_rate= $sum_review / $count_review;
            //         $item->rate=$total_rate;               
            //     }
            // }
            return $data;
        }
    }

    public function coursesDetails($slug ,$id)
    {
        $details=Course::where('id',$id)->first();                   
        // $lang= Language::where('id',$details->languageId)->first();
        // $country= Country::where('id',$details->countryId)->first();
        $user = Auth::guard('instructors')->user(); 
        if($user){
            $favorite_check=Favorite::where('courseId',$details->id)->where('userId',$user->id)->first();
        }else{
            $favorite_check=null;
        }
        
        $todayDate = date("Y-m-d");
       

        if($user){
            $student_course_whatch =View::where('studentId',$user->id)->where('courseId',$details->id)->sum('watchtime');
            $student_course_views = $student_course_whatch / 60;
        }else{
            $student_course_views=0;
        }
        $cours_time = Video::where('courseId',$details->id)->sum('videotime');
        if($cours_time==0){
            // dd('ddd');
            $totalpercent=$student_course_views * 100 / 1 ;
        }else{
            // dd($student_course_views);
            // dd($cours_time);
            $totalpercent=$student_course_views * 100 / $cours_time ;
        }
        // dd($totalpercent);
        
        $videos = Video::where('courseId',$details->id)->orderBy('order', 'ASC')->get();
        $video_count=0;
        foreach ($videos as $_item) {
            $video_count++;
            if($user){
                $vid_views=View::where('studentId',$user->id)->where('videoId',$_item->id)->first();
                if($vid_views){
                    $_item->vid_views=$vid_views->watchtime;
                }else{
                    $_item->vid_views=0;
                }
            }
           
        }
        // dd($video_count);
        
        $category= Category::where('id',$details->categoryId)->first();
        $subcategory= SubCategory::where('id',$details->subCategoryId)->first();
        $childcategory= ChildCategory::where('id',$details->childCategoryId)->first();
        $instructor= Instructor::where('id',$details->userId)->first();
        if($user){
            $subscriptions= Subscription::where('userId',$user->userId)->first();
        }else{
            $subscriptions=null;
        }

        $sum_review=Review::where('courseId',$details->id)->sum('rate');
        $allreview=Review::where('courseId',$details->id)->get();

        $count_review= count($allreview);        
       
        if($count_review ==0){
            $rate= 0.0;    
        }else{
            $total_rate= $sum_review / $count_review;
            $rate=$total_rate;               
        }

        
        if($user){
            $user_rate=Review::where('courseId',$details->id)->where('userId',$user->id)->first();
            // dd($user->id);
            if($user_rate){
                $user_rate='true';
            }else{
                $user_rate='false';
            }
        }else{
            $user_rate='false';
        }  
        
        
        $country= Country::where('id',$instructor->countryId)->first();
        $recently_courses=Course::where('categoryId',$details->categoryId)->where('status',1)->get();
        foreach ($recently_courses as $recently) {
            if($user){
                $user_favorite=Favorite::where('courseId',$recently->id)->where('userId',$user->id)->first();
                // dd($recently->id);
                if($user_favorite){
                   $recently->user_favorite='true';
                }else{
                    
                    $recently->user_favorite='falsess';
                }
            }else{
                $recently->user_favorite='false';
            }  
        }    



        // dd($recently_courses);


        $shareComponent = \Share::page(
            'https://elnamat.com/courses//',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return view('front.course-detail',compact('cours_time','totalpercent','favorite_check','details','videos','video_count','category','subcategory','childcategory','instructor','rate','country','recently_courses','subscriptions','shareComponent','user_rate','student_course_views'));
    }




    public function consultings()
    {
        $consultings=Consulting::where('status',1)->get();    
        foreach ($consultings as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        $marquees=Marquee_Text::where('type','استشارة')->get();
        return view('front.consultings',compact('consultings','marquees'));
    }    
    
    
    public function consultingDetails($slug)
    {
        $details=Consulting::where('id',$slug)->first();                   
        $user = Auth::guard('instructors')->user(); 
        $instructor= Instructor::where('id',$details->userId)->first();

        $subscriptions= ConsultingJoined::where('id',$details->userId)->first();
        $sum_review=Review::where('consulting_id',$details->id)->sum('rate');
        $allreview=Review::where('consulting_id',$details->id)->get();
        $count_review= count($allreview);        
        if($count_review ==0){
            $rate= 0.0;    
        }else{
            $total_rate= $sum_review / $count_review;
            $rate=$total_rate;               
        }
            

        $country= Country::where('id',$instructor->countryId)->first();
        $recently_courses=Course::where('categoryId',$details->categoryId)->where('status',1)->get();
        return view('front.consulting-details',compact('details','user','rate','country','recently_courses','subscriptions','instructor'));
    }
    public function livesCourses()
    {
        $straights=Straight::where('status',1)->orderBy('date', 'asc')->get();  
        foreach ($straights as $item) {   
            $item->instructor= Instructor::where('id',$item->userId)->first();
        }
        $marquees=Marquee_Text::where('type','اون لاين')->get();
        return view('front.lives',compact('straights','marquees'));
    }    
    
    
    public function livesDetails($slug ,$id)
    { 
        
        $details=Straight::where('id',$id)->first();                   
        $user = Auth::guard('instructors')->user(); 
        $lectures = Lecture::where('liveId',$details->id)->get();
       
        $instructor= Instructor::where('id',$details->userId)->first();
        $subscriptions= Subscription::where('id',$details->userId)->first();
        $sum_review=Review::where('courseId',$details->id)->sum('rate');
        $allreview=Review::where('courseId',$details->id)->get();
        $count_review= count($allreview);        
        if($count_review ==0){
            $rate= 0.0;    
        }else{
            $total_rate= $sum_review / $count_review;
            $rate=$total_rate;               
        }
            
        $country= Country::where('id',$instructor->countryId)->first();
        
        $recently_courses=Course::where('categoryId',$details->categoryId)->where('status',1)->get();
        if($user){
            $checklive = Courses_joined::where("student_id" , $user->id)->where("liveId" ,$id)->first();
        }else{
            $checklive='';
        }
        // dd($details);
        return view('front.live-details',compact('details','checklive','lectures','user','instructor','rate','country','recently_courses','subscriptions'));
    }


    
    
    public function renewSubscrip(Request $request )
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $subscription_type=SubscriptionValue::where('type', $request->subtype)->first();
        $userid = Auth::guard('instructors')->user();
        $user = instructor::findOrFail($userid->id); 
        $user->subscription_type = $request->subtype;
        $user->subscription_value =$subscription_type->value ;
        
        $user->save();
        
        $transaction= Transaction::where('user_id',$user->id)->first();
        if(!$transaction){
            Session::put('payCreateOrCertificateOrRenew','create');
        }else{
            Session::put('payCreateOrCertificateOrRenew','renew');
        }
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return redirect('get-checkout')->with("message", 'registered Successfully'); 
        }else{
            return redirect('get-checkout')->with("message", 'تم التسجيل بنجاح'); 
        } 
    } 
    
    public function renewSubCurriculas()
    {
        $user = Auth::guard('instructors')->user();  
        if(!$user)
            return redirect('login/user'); 
        $branches=Branch::get();    
        $transaction= Transaction::where('user_id',$user->id)
        ->whereIn('report', ['create', 'renew'])
            ->orderBy('id', 'DESC')->first();
    
        $bank= Bank::where('userId',$user->id)->first();
        $subscription_type=SubscriptionValue::get();
        
        return view('front.renew_subscrip_curriculas',compact('user','bank','subscription_type','transaction','branches'));
    }
    public function renewSubscripCurriculas(Request $request )
    {
        // $subscription_type=SubscriptionValue::where('type', $request->subtype)->first();
        $userid = Auth::guard('instructors')->user();
        if(!$userid)
            return redirect('login/user'); 
        if($userid->type=="instructor")
            return redirect('/');  
        // dd($userid);
        // dd($request->all());
        $user = instructor::findOrFail($userid->id); 
        $user->sub_curriculas = $request->sub_curriculas;
        $user->branch_id  = $request->branch_id;
        $user->save();
        
        $transaction= Transaction::where('user_id',$user->id)->first();
        Session::put('create_type','curriculums');
        if(!$transaction){
            Session::put('payCreateOrCertificateOrRenew','create');
        }else{
            Session::put('payCreateOrCertificateOrRenew','renew');
        }
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return redirect('get-checkout')->with("message", 'registered Successfully'); 
        }else{
            return redirect('get-checkout')->with("message", 'تم التسجيل بنجاح'); 
        } 
    } 
    
    public function coursesJoine($typeCourse,$id)
    {
      
       
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $course=Straight::where('id',$id)->first(); 
        $checklive = Courses_joined::where("student_id" , $user->id)->where("liveId" ,$id)->first();
        // dd($checklive);
        if($checklive){
            // dd('dddx');
            return back()->with("signinsucces", 'قمت بالتسجيل في الكورس مسبقا'); 
        }elseif($course->price == 0){
            // dd('ddd');
            $add = new Courses_joined;
            $add->student_id = $user->id;
            $add->liveId = $id;
            $add->save();
            // dd($course);
            return back()->with("signinsucces", 'تم التسجيل في الكورس'); 
        }else{
            // dd('dddf');
            return redirect('get-checkout/'.$typeCourse.'/'.$id)->with("message", 'تم التسجيل بنجاح'); 
        } 
    }
    public function consultingJoine($typeCourse,$id)
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $course=Consulting::where('id',$id)->first(); 
        $checklive = ConsultingJoined::where("student_id" , $user->id)->where("consulting_id" ,$id)->first();
      
        if($checklive){
            
            return back()->with("signinsucces", 'قمت بالحجر في الاستشارة مسبقا'); 
        }elseif($course->price == 0){
            // dd('ddd');
            $add = new ConsultingJoined;
            $add->student_id = $user->id;
            $add->instructor_id = $course->userId;
            $add->consulting_id = $id;
            $add->save();
            // dd($course);
            return back()->with("signinsucces", 'تم حجز الاستشارة'); 
        }else{
            // dd('dddf');
            return redirect('get-checkout/'.$typeCourse.'/'.$id)->with("message", 'تم الحجز بنجاح'); 
        } 
    }
    
    public function renewCancel()
    {
        // dd($todayDate = date("d"));
        
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $transaction= Transaction::where('user_id',$user->id)
        ->whereIn('report', ['create', 'renew'])
            ->orderBy('id', 'DESC')->first();
        //   dd($transaction);
        // dd($transaction->created_at->addMonth(1)->format('d-m-Y'));
            // ->addMonth()
        $bank= Bank::where('userId',$user->id)->first();
        $subscription_type=SubscriptionValue::get();
        // dd($user);
        
        return view('front.renew_cancel',compact('user','bank','subscription_type','transaction'));
    }


    public function removeAcount()
    {
       $user = Auth::guard('instructors')->user();  
        if(!$user)
            return redirect('login/user'); 
        // $bank= Bank::where('userId',$user->id)->first();
        $subscription_type=SubscriptionValue::get();
        return view('front.remove_acount',compact('user','subscription_type'));
    }

    
    public function cancellationAcountPost(Request $request )
    {
        $this->validate( $request,[          
                'password'=>'required',
            ],
            [
                'password.required'=>'كلمة المرور مطلوبة',
            ]
        );
        
        $userid = Auth::guard('instructors')->user();
        if (!(Hash::check($request->get('password'), $userid->password))){
            return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        $userblocked = instructor::findOrFail($userid->id); 
        $userblocked->status = 2;
        $userblocked->save();
        // Auth::guard('instructors')->logout();
       
        return back()->with("message",' تم  إلغاء الإشتراك '); 
    } 
    public function removeAcountPost(Request $request )
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        
        $this->validate( $request,[          
                'password'=>'required',
            ],
            [
                'password.required'=>'كلمة المرور مطلوبة',
            ]
        );

        $userid = Auth::guard('instructors')->user();

        if (!(Hash::check($request->get('your-password'), $userid->password))){
            return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        $userblocked = instructor::findOrFail($userid->id); 
        $userblocked->blocked = 0;
        $userblocked->save();
        Auth::guard('instructors')->logout();
        // $delete->delete();
        return redirect('/')->with("message",' تم حذف الحساب '); 
    } 

    public function updateBankDetails(Request $request)
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        
        $this->validate( $request,[          
                'countryId'=>'required',
                'cityId'=>'required',
                'persone_name'=>'required',
                'bank_name'=>'required',
                'bank_sub_name'=>'required',
            ],
            [
                'countryId.required'=>'الدولة مطلوبه',
                'cityId.required'=>' المدينة  مطلوبه ',
                'persone_name.required'=>' اسم الشخص صاحب الحساب مطلوب  ', 
                'bank_name.required'=>' اسم البنك مطلوب   ', 
                'bank_sub_name.required'=>' اسم فرع البنك الذي تم فيه فتح الحساب مطلوب  ', 
            ]
        );

         $userid = Auth::guard('instructors')->user();
         $edit = Bank::where('userId',$userid->id)->first();
         // dd($edit);
         $edit->persone_name  = $request->persone_name;
         $edit->iban  = $request->iban;
         $edit->countryId  = $request->countryId;
         $edit->cityId  = $request->cityId;
         $edit->bank_name  = $request->bank_name;
         $edit->acount_number  = $request->acount_number;

         $edit->bank_sub_name  = $request->bank_sub_name;
         $edit->swift_code  = $request->swift_code;

         $edit->save();
         return back()->with("message", 'تم التعديل بنجاح'); 
    }
    
    
    public function userAddFavorite(Request $request)
    {
        if(Auth::guard('instructors')->user()==null){
            return redirect('login/user'); 
        }else{
            $user = Auth::guard('instructors')->user();
            $cart_check=Favorite::where('courseId',$request->courseId)->where('userId',$user->id)->first();
            if($cart_check){
                $cart_check->delete();
                return redirect()->back(); 
            }else{
                $user = Auth::guard('instructors')->user();
                $add = new Favorite;
                $add->courseId    = $request->courseId;
                $add->userId    = $user->id;
                $add->save();
                return redirect()->back()->with("message", 'تم الاضافة');
            }   
        }
    }  

    public function userAddRate(Request $request)
    {
        // dd($request->all());
        if(Auth::guard('instructors')->user()==null){
            return redirect('login/user'); 
        }else{
            $user = Auth::guard('instructors')->user();
            $rev_check=Review::where('courseId',$request->courseId)->where('userId',$user->id)->first();
            if($rev_check){
                return redirect()->back(); 
            }else{
                $add = new Review;
                $add->courseId    = $request->courseId;
                $add->userId    = $user->id;
                $add->rate    = $request->rating;
                $add->comment    = $request->comment;


                $add->save();
                return redirect()->back()->with("message", 'تم الاضافة');
            }   
        }
    }  
    
    public function mywishlist()
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $favorites = Favorite::where('userId',$user->id)->get();
        foreach ($favorites as $item) {            
            $item->course= Course::where('id',$item->courseId)->first();
        }
        // dd($favorites);
        return view('front.mywishlist',compact('user','favorites'));
    }

    public function myprofile()
    {
        
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        return view('front.myprofile',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        // $edit->name    = $request->name;
        $edit->mobile  = $request->mobile;
        $edit->detail  = $request->detail;
        $edit->dateOfBirth  = $request->dateOfBirth;
        // $edit->address  = $request->address; 
        // $edit->countryId  = $request->countryId; 
        // $edit->cityId  = $request->cityId;         
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo')-> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  =$file_nameone;
        }else{
            $edit->photo  = $edit->photo; 
        }
        $edit->save();

        return back()->with("success", 'تم التعديل بنجاح'); 
    }
    
   
    public function myCertificates()
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        
        
        $contactInfoo=ContactInfo::first();
        $courses = [];
        $views = View::where('studentId',$user->id)->get();
        foreach ($views as $item) {            
            
            $coursee_hamada= Course::where('id',$item->courseId)->first();
            // dd($coursee_hamada->categoryId);
            if($coursee_hamada){
                if($coursee_hamada->categoryId !=36){
                    if(!in_array($coursee_hamada, $courses))
                    {
                        array_push($courses,$coursee_hamada);
                    }
                }
            }    
        }
        // dd($courses);
        $courseToCertificates=[];
        foreach ($courses as $_item) {
            $course_certificates= Course::where('id',$_item->id)->first();
            $certificate= Certificate::where('course_id',$course_certificates->id)->where('student_id',$user->id)->first();
            $course_certificates->certificate=$certificate;
            $cours_time = Video::where('courseId',$_item->id)->sum('videotime');
            
            $students_views =View::where('courseId',$_item->id)->sum('watchtime2');
            
            $student_view=$students_views / 60;
            if($cours_time==0){
                $totalpercent=$student_view * 100 / 1;
            }else{
                $totalpercent=$student_view * 100 / $cours_time;
            }
            // dd($totalpercent);
            // $totalpercent=36 * 100 / 40;
            $totalper=round($totalpercent);
            $inttt = (int)$totalper;
            // dd($totalpercent);
            if($inttt > 80){
                if(!in_array($course_certificates, $courseToCertificates))
                {
                    array_push($courseToCertificates,$course_certificates);
                }
            }
        }
        
    //   dd($courseToCertificates);
      
        return view('front.my-certificates',compact('user','courseToCertificates','contactInfoo'));
       
    }
    
   
    public function printCertificates($id)
    {
        
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        
                       
        
        $courses=Course::where('id',$id)->first();
        $certificate= Certificate::where('course_id',$courses->id)->where('student_id',$user->id)->first();
        $allcours_time = Video::where('courseId',$courses->id)->sum('videotime');
        $cours_time=$allcours_time / 60;
        // return view('front.certificate',compact('user','courses'));
        
        $fileName='certificate.pdf';
    	$mpdf = new \Mpdf\Mpdf([
    		'margin_left'=>0,
    		'margin_right'=>0,
    		'margin_top'=>0,
    		'margin_bootom'=>0,
    		'margin_header'=>0,
    		'margin_footer'=>0,
            'autoArabic' => true,
            'format' => 'A4-L',
            'orientation' => 'L',
            
    	]);
    	
    	$html = view('front.certificate',compact('user','courses','certificate','cours_time'));

    	$html = $html->render();
    	$mpdf->WriteHTML($html);
    	$mpdf->Output($fileName,'I');
        
    }
    
    public function liveCertificates()
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        $contactInfo=ContactInfo::first();
        $user = Auth::guard('instructors')->user();
        $lives = Courses_joined::where("student_id" , $user->id)->where("status" ,1)->get();
        foreach ($lives as $_item) {
            $certificate= Certificate::where('live_id',$_item->liveId)->where('student_id',$user->id)->first();
            $_item->certificate=$certificate;
            $_item->live= Straight::where('id',$_item->liveId)->first();
        }
        // dd($lives);
        return view('front.live-certificates',compact('user','lives','contactInfo'));
    }
    
    public function printLiveCertificates($id)
    {
        
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
            
        $straight=Straight::where('id',$id)->first();
        $certificate= Certificate::where('live_id',$straight->id)->where('student_id',$user->id)->first();
        // dd($certificate);
        $fileName='certificate.pdf';
    	$mpdf = new \Mpdf\Mpdf([
    		'margin_left'=>0,
    		'margin_right'=>0,
    		'margin_top'=>0,
    		'margin_bootom'=>0,
    		'margin_header'=>0,
    		'margin_footer'=>0,
            'autoArabic' => true,
            'format' => 'A4-L',
            'orientation' => 'L',
            
    	]);
    	
    	$html = view('front.print-live-certificate',compact('user','straight','certificate'));

    	$html = $html->render();
    	$mpdf->WriteHTML($html);
    	$mpdf->Output($fileName,'I');
        
    }
    
    public function urlMeetingNotFound($id)
    {
    
         return back()->with(['notFound' => 'انتظر موعد الدورة','liveId' => $id]);
        // return redirect()->to('my-lives')->with("notFound", 'انتظر موعد الدورة',"live-id",$id);
        
    }
    public function myLives()
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');    
       //'Asia/Amman' => 'Jordan'
        $time_now=Carbon::now()->timezone('Asia/Amman')->format('h:i');
        // echo date('h:i:s a m/d/Y', strtotime($date));

        // dd($time_now);
        // $time_now->modify('+2 hours');
        
        
        $user = Auth::guard('instructors')->user();
        $lives = Courses_joined::where("student_id" , $user->id)->get();
        foreach ($lives as $_item) {
            $certificate= Certificate::where('live_id',$_item->liveId)->where('student_id',$user->id)->first();
            $_item->certificate=$certificate;
            $_item->live= Straight::where('id',$_item->liveId)->first();
            $_item->time_now=$time_now;
        }
        // dd($lives);
        return view('front.my-lives',compact('user','lives'));
    }
    public function becomeInstructor()
    {
        $user = Auth::guard('instructors')->user();  
        return view('front.become-instructor',compact('user'));
    }
    public function updatebecomeInstructor(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        $edit->type    = $request->type;
        $edit->save();
        if ($request->type=='instructor') {
            return redirect()->to('instructor/dashboard')->with("success", 'تم التعديل بنجاح'); 
        }else{
            return back()->with("success", 'تم التعديل بنجاح'); 
        }
    }
    public function studentPassword()
    {
        $user = Auth::guard('instructors')->user();
        if(!$user)
            return redirect('login/user'); 
        if($user->type=="instructor")
            return redirect('/');  
        
        return view('front.student-password',compact('user'));
    }
    public function studentChangePassword(Request $request){
        $user= Auth::guard('instructors')->user();
        // $this->validate($request, [
        //     'current-password'     => 'required',
        //     'new-password'     => 'required',
        //     // 'confirm_password' => 'required|same:new_password',
        // ]);

        $this->validate( $request,[          
                'current-password'=>'required',
                'new-password'=>'required',
            ],
            [
                'current-password'=>'required',
                'new-password'=>'required',
            ]
        );

        // dd('ugutg');
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("errorss","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        }
        // dd('veferfrr');
        
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("message","تم تغيير الرقم السري بنجاح !");
    }
    public function studentChangePasswordFromAdmin(Request $request){
        $user= Auth::guard('instructors')->user();

        $this->validate( $request,[          
                // 'current-password'=>'required',
                'new-password'=>'required',
            ],
            [
                // 'current-password'=>'required',
                'new-password'=>'required',
            ]
        );

        // if (!(Hash::check($request->get('current-password'), $user->password))) {
        //     return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        // }

        // if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //     return redirect()->back()->with("errorss","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        // }

        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("message","تم تغيير الرقم السري بنجاح !");
    }

    public function categoryId(Request $request,$id)
    {
        // $courses_result=Course::where('title',$request->title)->get();
        $courses_result=Course::where('categoryId',$id)->where('status',1)->get();
        foreach ($courses_result as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
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
        return view('front.allcourses',compact('courses_result'));
    }
    public function subcategoryId(Request $request,$id)
    {
        // dd($id);
        // $courses_result=Course::where('title',$request->title)->get();
        $courses_result=Course::where('subCategoryId',$id)->where('status',1)->get();                   
        foreach ($courses_result as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
            
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
        // dd($courses_result);
        return view('front.allcourses',compact('courses_result'));
    }
    
    public function childcategoryId(Request $request,$id)
    {
        $courses=Course::where('childCategoryId',$id)->where('status',1)->get();                   
        foreach ($courses as $item) {            
            $item->instructor= Instructor::where('id',$item->userId)->first();
            $item->category= Category::where('id',$item->categoryId)->first();
            $item->subcategory= SubCategory::where('id',$item->subCategoryId)->first();
            $item->subcategory= ChildCategory::where('id',$item->childCategoryId)->first();
        }
        return view('front.allcourses',compact('courses'));
    }

    public function about()
    {
        return view('front.about');
    }
    
    public function returnPolicy()
    {
        return view('front.return-policy');
    }

    public function cancellationPolicy()
    {
        return view('front.cancellation-policy');
    }
    
    public function deliveryPolicy()
    {
        return view('front.delivery-policy');
    }
    
    

    public function contact()
    {
        // $name = 'Krunal';
        // Mail::to('hamadaali221133@gmail.com')->send(new SendMailable($name));
        // return 'Email was sent';
        return view('front.contact');
    }
    public function send_report(Request $request)
    {
        // dd('vsfvsfvsf');

        $input = $request->all();
        $this->validate( $request,[          
            'name' => "required",
            'subject' => "required",
            'email' => "required",
            'mobile' => "required",
            'report' => "required",
            ],
            [
                'name.required' => "ادخل الاسم",
                'subject.required' => "الموضوع المطلوب",
                'email.required' => "ادخل البريد الإلكتروني",
                'mobile.required' => "ادخل رقم الهاتف",
                'report.required' => "ادخل الرسالة",
            ]
        );
       
        
            try {
                $details = [
                    'subject' => $request->subject,
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'report' => $request->report,
                ];
                
                Mail::to('info@alnamat.com')->send(new \App\Mail\SendReport($details));
                // dd('vsfvsfvsfaaaaa');
                return back()->with("message", 'تم الإرسال'); 
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        
    }

    public function termsconditions()
    {
        return view('front.terms-of-use');
    }
    public function agreements()
    {
        return view('front.agreements');
    }

    public function return_policy()
    {
        return view('front.privacy-policy');
    }
    public function instuctorPolicy()
    {
        return view('front.instuctor-policy');
    }
    public function studentPolicy()
    {
        return view('front.student-policy');
    }

    // public function policy()
    // {
    //     return view('web.policy');
    // }
   
     public function teslive()
    {
        return view('testlive');
    }
    
    public function search()
    {
        return view('search');
    }
    


    public function saveNewWhach(Request $request)
    {

        $videos_sessions = session()->get('cart');       
        if(!$videos_sessions) {
            $videos_sessions = [
                $request->videoid => [
                    "videoid" => $request->videoid,
                    "watchtime" => $request->watchtime,
                    "courseId" => $request->courseId,
                    "userid" => $request->userid,
                ]
            ];
            session()->put('cart', $videos_sessions);
        }
        //if videos_sessions not empty then check if this product exist then increment quantity
        if(isset($videos_sessions[$request->videoid])) {
            $videos_sessions[$request->videoid]['videoid']=$request->videoid;
            $videos_sessions[$request->videoid]['watchtime']=$request->watchtime;
            $videos_sessions[$request->videoid]['courseId']=$request->courseId;
            $videos_sessions[$request->videoid]['userid']=$request->userid;
            session()->put('cart', $videos_sessions);
        }

        // if item not exist in videos_sessions then add to videos_sessions with quantity = 1
        $videos_sessions[$request->videoid] = [
            "videoid" => $request->videoid,
            "watchtime" => $request->watchtime,
            "courseId" => $request->courseId,
            "userid" => $request->userid,
        ];
        session()->put('cart', $videos_sessions);
        // return Response()->json($videos_sessions);
        
    }

    public function saveNewWhachCurriculums(Request $request)
    {

        $videos_sessions = session()->get('cartCurriculums');       
        if(!$videos_sessions) {
            $videos_sessions = [
                $request->videoid => [
                    "videoid" => $request->videoid,
                    "watchtime" => $request->watchtime,
                    "courseId" => $request->courseId,
                    "userid" => $request->userid,
                ]
            ];
            session()->put('cartCurriculums', $videos_sessions);
        }
        //if videos_sessions not empty then check if this product exist then increment quantity
        if(isset($videos_sessions[$request->videoid])) {
            $videos_sessions[$request->videoid]['videoid']=$request->videoid;
            $videos_sessions[$request->videoid]['watchtime']=$request->watchtime;
            $videos_sessions[$request->videoid]['courseId']=$request->courseId;
            $videos_sessions[$request->videoid]['userid']=$request->userid;
            session()->put('cartCurriculums', $videos_sessions);
        }

        // if item not exist in videos_sessions then add to videos_sessions with quantity = 1
        $videos_sessions[$request->videoid] = [
            "videoid" => $request->videoid,
            "watchtime" => $request->watchtime,
            "courseId" => $request->courseId,
            "userid" => $request->userid,
        ];
        session()->put('cartCurriculums', $videos_sessions);
        // return Response()->json($videos_sessions);
        
    }


    // public function checkout()
    // {
    //     $user = Auth::guard('instructors')->user();
    //     if(!$user)
    //         return redirect('login/user'); 
    //     return view('front.checkout');
    // }






    public function newSubscription(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        $edit->name    = $request->name;
        $edit->mobile  = $request->mobile;
        $edit->detail  = $request->detail;
        $edit->dateOfBirth  = $request->dateOfBirth;
        $edit->address  = $request->address; 
        
        $edit->save();

        return back()->with("success", 'تم التعديل بنجاح'); 
    }

    

    public function searchCertificate(Request $request)
    {
        $check_certificate= Certificate::where('serial_number',$request->serial_number)->first();
        if(!$check_certificate)
            return back()->with("errorss", 'الشهادة غير صحيحة وليست مسجلة لدينا'); 

        return back()->with("message", 'الشهادة صحيحة');
    }






    
}
