<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Country;
use App\City;
use App\Straight;
use App\Review; 
use App\Subscription;
use App\Courses_joined;
use DateTimeZone;
use DateTime;
use Carbon\Carbon;
use App\Transaction;
class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function studentsActive()
    {
        $subscriptions=Instructor::where('type','student')->where('status','1')->orderBy('id', 'DESC')->get();
        
        foreach ($subscriptions as $item) {
            $country= Country::where('id',$item->countryId)->first();
            // if(!$country){
            //     dd($item->countryId);
            // }
            $item->country=$country->name;
        }
        //   dd($subscriptions);
        return view('admin.students.all_active',compact('subscriptions'));
    }
    public function studentsNotctive()
    {
        $subscriptions=Instructor::where('type','student')->where('status','!=','1')->orderBy('id', 'DESC')->get();
        foreach ($subscriptions as $item) {
            $country= Country::where('id',$item->countryId)->first();
            $item->country=$country->name;
        }
        // foreach ($subscriptions as  $item) {
        //     $item->student=Instructor::where('id',$item->userId)->first();
        // }
        //  dd($subscriptions);
        return view('admin.students.all_notactive',compact('subscriptions'));
    }

    public function liveJoined($id)
    {
        // $student_sign=Instructor::where('type','student')->where('status','1')->orderBy('id', 'DESC')->get();
        
        // foreach ($student_sign as $item) {
        //     $country= Country::where('id',$item->countryId)->first();
        //     $item->country=$country->name;
        // }
        $subscriptions = Courses_joined::where("liveId" , $id)->get();
        foreach ($subscriptions as $_item) {
             $instructor= Instructor::where('id',$_item->student_id)->first();
             $_item->instructor=$instructor;
             $_item->country= Country::where('id',$instructor->countryId)->first();
        }
        // dd($subscriptions);
        return view('admin.students.live-joined',compact('subscriptions'));
    }
    
    public function needToPay()
    {
        
              
        
        $todayDate = date("Y-m-d");
        $r= '2022-12-10';
        
        // $t= '06-11-2022';
        // if($r > $todayDate  ){
        //         echo "v <br>";
        // }
        // $date1 = "1998-10-27";
        // $date2 = "1998-11-26";
        // if($date1 > $date2  ){
        //         echo "v <br>";
        // }
        
        // $instructors=Instructor::where('type','student')->where('status','1')->where('id','918')->get();
        $instructors=Instructor::where('type','student')->where('status','1')->get();
        $subscription=[];
        
        
        foreach ($instructors as $item) {
            $transaction= Transaction::where('user_id',$item->id)
            ->whereIn('report', ['create', 'renew'])
            ->orderBy('id', 'DESC')->first();
            
            // $checksub=$transaction->created_at->addDays(28)->format('d-m-Y');
            
            
            if($transaction){
                $checksub= $transaction->created_at->format('Y-m-d');
                $to = Carbon::createFromFormat('Y-m-d', $checksub);
                $from = Carbon::createFromFormat('Y-m-d', $todayDate);
                $diff_in_hours = $to->diffInDays($from);
                
                    
                if($item->subscription_type =='شهري'){    
                    if($diff_in_hours >= 31  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                }elseif($item->subscription_type =='سنوي'){
                    if($diff_in_hours >= 366  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                }elseif($item->subscription_type =='free'){
                    if($diff_in_hours >= 3  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                }else{
                    if($diff_in_hours >= 3  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                } 
                
                    
            }else{
                $checksub= $item->created_at->format('Y-m-d');
                $to = Carbon::createFromFormat('Y-m-d', $checksub);
                $from = Carbon::createFromFormat('Y-m-d', $todayDate);
                $diff_in_hours = $to->diffInDays($from);
                if($item->subscription_type =='free'){
                    if($diff_in_hours >= 8  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                }else{
                    if($diff_in_hours >= 8  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                } 
            }
        }
        // dd($instructors);
        return view('admin.students.need_to_pay',compact('subscription'));
    }
    public function removeSubscription(Request $request)
    {
        $user = Instructor::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
    public function needToPaySubCurriculums()
    {
        $todayDate = date("Y-m-d");
        $r= '2022-12-10';
        $instructors=Instructor::where('type','student')->where('status_teacher','1')->get();
        $subscription=[];
        
        foreach ($instructors as $item) {
            $transaction= Transaction::where('user_id',$item->id)
            ->whereIn('report', ['create', 'renew'])
            ->orderBy('id', 'DESC')->first();
            
            if($transaction){
                $checksub= $transaction->created_at->format('Y-m-d');
                $to = Carbon::createFromFormat('Y-m-d', $checksub);
                $from = Carbon::createFromFormat('Y-m-d', $todayDate);
                $diff_in_hours = $to->diffInDays($from);
                
                
                    if($diff_in_hours >= 366  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                
                    
            }else{
                
                
                $checksub= $item->created_at->format('Y-m-d');
                $to = Carbon::createFromFormat('Y-m-d', $checksub);
                $from = Carbon::createFromFormat('Y-m-d', $todayDate);
                $diff_in_hours = $to->diffInDays($from);
                if($item->sub_curriculas=='0'){
                    if($diff_in_hours >= 2  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                }else{
                    if($diff_in_hours >= 366  ){
                        $item->transaction=$transaction;
                        $subscription[]=$item;
                    }
                } 
            }
        }
        return view('admin.students.need_to_pay_curriculums',compact('subscription'));
    }

    
   
    public function removeSubscriptionCurriculums(Request $request)
    {
        $user = Instructor::findOrFail($request->user_id);
        $user->status_teacher = $request->status_teacher;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
    

    
    public function show(Student $student)
    {
        //
    }

    
    public function edit(Student $student)
    {
        //
    }

    
    public function update(Request $request, Student $student)
    {
        //
    }

    
    public function destroy(Request $request)
    {
        $delete = Subscription::findOrFail($request->id);
        // dd($delete);
        $delete->delete();
        return back()->with("message",'تم الحذف بنجاح'); 
    }

    public function profile($id)
    {
        $instructor = Instructor::where('id',$id)->first();
        
        $country= Country::All();
        
        $cities=City::all();
        foreach ($cities as $item) {
            $item->country= Country::where('id',$item->countryId)->first();
        }

        
        // dd($reviews);
        $courses_joind=[];
        $courses_joined_live=[];
        $coursejoind_student=Courses_joined::where('userId',$instructor->id)->get();
        foreach ($coursejoind_student as $items) {
            $coursejoind = Course::where("id" , $items->courseId)->first(); 
            if($coursejoind){
                $courses_joind[] = $coursejoind; 
            }

            $courses_live= Straight::where("id" , $items->liveId)->first();   
            if($courses_live){
                $courses_joined_live[] = $courses_live;     
            }
        }
        
          
        
        // dd($courses_joind);
          
        return view('admin.students.student-profile',compact('instructor','bankdetails','country','cities','reviews','courses_joind','courses_joined_live'));
    }
    public function updateStatus(Request $request)
    {
        // dd('ffff');
        // return response()->json(['message' => 'User status updated successfully.']);
        $user = Courses_joined::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully.']);
    }
    
    public function studentsActiveCurriculas()
    {
        $subscriptions=Instructor::where('type','student')->where('status_teacher','1')->orderBy('id', 'DESC')->get();
        
        foreach ($subscriptions as $item) {
            $country= Country::where('id',$item->countryId)->first();
            // if(!$country){
            //     dd($item->countryId);
            // }
            $item->country=$country->name;
        }
        //   dd($subscriptions);
        return view('admin.students.curriculas_active',compact('subscriptions'));
    }
    
    public function studentsNotActiveCurriculas()
    {
        $subscriptions=Instructor::where('type','student')->where('status_teacher','2')->orderBy('id', 'DESC')->get();
        foreach ($subscriptions as $item) {
            $country= Country::where('id',$item->countryId)->first();
            $item->country=$country->name;
        }
        // foreach ($subscriptions as  $item) {
        //     $item->student=Instructor::where('id',$item->userId)->first();
        // }
        //  dd($subscriptions);
        return view('admin.students.curriculas_not_active',compact('subscriptions'));
    }
}
