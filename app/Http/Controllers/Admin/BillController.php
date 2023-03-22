<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Country;

use App\View;
use App\Bank;
use App\Transfer;
use App\SubscriptionValue;
use App\Withdrawal;




use DB;
use Crypt;

use Session;
use Auth;
use App\Subscription;
use DateTime;
use Carbon\Carbon;
use App\Transaction;
use App\Instructor;
use App\Course;
use App\ContactInfo;
use App\Certificate;
use App\Wallet;
use App\Consulting;
use App\Straight;
use App\Video;
use App\Courses_joined;
use App\Branch;
use App\Curricula_View;
class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getCourseName($id){
        $courses = [];
        $views = View::where('studentId',$id)->get();
        foreach ($views as $item) {            
            $course= Course::where('id',$item->courseId)->first();
            
            if($course->categoryId !=36){
                if(!in_array($course, $courses))
                {
                    array_push($courses,$course);
                }
            }
            
        }
       
        $courseToCertificates=[];
        foreach ($courses as $_item) {
            $course_certificates= Course::where('id',$_item->id)->first();
            $certificate= Certificate::where('course_id',$course_certificates->id)->where('student_id',$id)->first();
            $course_certificates->certificate=$certificate;
            $cours_time = Video::where('courseId',$_item->id)->sum('videotime');
            
            $students_views =View::where('courseId',$_item->id)->sum('watchtime2');
            
            $student_view=$students_views / 60;
            if($cours_time==0){
                $totalpercent=$student_view * 100 / 1;
            }else{
                $totalpercent=$student_view * 100 / $cours_time;
            }
            
            // $totalpercent=36 * 100 / 40;
            if($totalpercent >= 80){
                if(!in_array($course_certificates, $courseToCertificates))
                {
                    array_push($courseToCertificates,$course_certificates);
                }
            }
        }
        
        echo json_encode($courseToCertificates);
        // echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }
    
    public function getLiveName($id)
    {
        $liveToCertificates=[];
        $lives = Courses_joined::where("student_id" , $id)->where("status" ,1)->get();
        foreach ($lives as $_item) {
            $live= Straight::where('id',$_item->liveId)->first();
            // if($live->status ==5){
                $liveToCertificates[]= $live;
            // }
        }
        echo json_encode($liveToCertificates);
    }    
    public function index()
    {
        $branches=Branch::all();
        $bills=Transaction::orderBy('id', 'DESC')->get();
        foreach ($bills as $item) {
            $user= Instructor::where('id',$item->user_id)->first();
            if ($user) {
                $country= Country::where('id',$user->countryId)->first();
                if($country){
                    $user->country=$country->name;
                    $item->user=$user; 
                }
               
            }
            $item->instructor= Instructor::where('id',$item->instructor_id)->first();
        }
        $instructors=Instructor::where('type','instructor')->get();
        $students=Instructor::where('type','student')->get();
        $instructor_balance=Transaction::orderBy('id', 'DESC')->first();
        if($instructor_balance){
            $balance_total=$instructor_balance->balance;
        }else{
            $balance_total=0;
        }
        $subscription_type=SubscriptionValue::get();
        
        
        return view('admin.bills.all',compact('bills','instructors','students','balance_total','subscription_type','branches'));
    }
    public function searchDate(Request $request)
    {

        $bills=Transaction::whereBetween('date', [$request->from_date, $request->to_date])->get();
        
        foreach ($bills as $item) {
            $user= Instructor::where('id',$item->user_id)->first();
            
            $country= Country::where('id',$user->countryId)->first();
            $user->country=$country->name;
            $item->user=$user;

        }
        $instructors=Instructor::where('type','instructor')->get();
        $instructor_balance=Transaction::orderBy('id', 'DESC')->first();
        if($instructor_balance){
            $balance_total=$instructor_balance->balance;
        }else{
            $balance_total=0;
        }
        
        // dd($bills);
        return view('admin.bills.all',compact('bills','instructors','balance_total'));
    }

   
    
    public function SendBalanceToAllIstructor(Request $request)
    {
        $this->validate( $request,[          
                'report'=>'required',
            ],
            [
                'report.required'=>' بيان التحويل مطلوب ', 
            ]
        );
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        
        
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
        
        // all instructor
        $instructors =Instructor::where('type','instructor')->where('blocked',1)->get();
        $all_balance=Transaction::orderBy('id', 'DESC')->first();
        $all_views =View::sum('watchtime');
        $all_video_views = $all_views / 60;
        if($instructors->count() >=0){
            foreach($instructors as $item){
                $instructor_balance=Transaction::orderBy('id', 'DESC')->first();
                if($instructor_balance->balance < 0){    
                    return back()->with("errorss", 'لا يوجد إشتراكات الرصيد صفر'); 
                }
                
                $user_videoviews =View::where('userId',$item->id)->sum('watchtime');
                $inst_videoviews =$user_videoviews / 60;
                
               
                if($inst_videoviews > 0){
                    $views_balance=$all_balance->balance / $all_video_views;
                    $result_balance = $views_balance * $inst_videoviews;
                    if($result_balance > 0.1){
                        if($instructor_balance->balance >= $request->transferTo ){
                            $balance=$instructor_balance->balance - $result_balance;
                            $transaction = new Transaction;
                            // $transaction->walletId    = $walletId->id;
                            $transaction->instructor_id    = $item->id;
                            $transaction->balance    = $balance;
                            
                            $transaction->balance_teacher  = $all_balance->balance_teacher;
                            
                            $transaction->balance_admin    = $instructor_balance->balance_admin;
                            $transaction->payments    = $instructor_balance->payments;
                            $transaction->transferTo    = $result_balance;
                            $transaction->report    = $request->report;
                            $transaction->date    = $todayDate;
                            $transaction->time    = $timenow;
                            $transaction->save();
    
                            $walletId=Wallet::where('user_id',$item->id)->first();
                            $walletId->total    = $walletId->total + $result_balance;
                            $walletId->save();
    
                            $videoviews =View::where('userId',$item->id)->get();
                            foreach($videoviews as $videoview){
                               
                                $onevideo =View::findOrFail($videoview->id);
                                $onevideo->watchtime = 0;
                                $onevideo->save();
                            }
                        }
                    }
                   
                }
                    
                
            }
        }else{
             return back()->with("errorss", 'المدربين الذي يتم التحويل لهم ربما حساباتهم معلقة جميعاً'); 
        }
    return redirect()->back()->with("message", 'تم توزيع ارباح المدربين لهذا الشهر ');
    }
    
    public function SendBalanceToTeacher(Request $request)
    {
        $this->validate( $request,[          
                'report'=>'required',
            ],
            [
                'report.required'=>' بيان التحويل مطلوب ', 
            ]
        );
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        
        
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
        
        // all instructor
        $instructors =Instructor::where('type','instructor')->where('blocked',1)->get();
        $all_balance=Transaction::orderBy('id', 'DESC')->first();
        $all_views =Curricula_View::sum('watchtime');
        $all_video_views = $all_views / 60;
        if($instructors->count() >=0){
            foreach($instructors as $item){
                $instructor_balance=Transaction::orderBy('id', 'DESC')->first();
                if($instructor_balance->balance_teacher < 0){    
                    return back()->with("errorss", 'لا يوجد إشتراكات الرصيد صفر'); 
                }
                
                $user_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');
                $inst_videoviews =$user_videoviews / 60;
                
               
                if($inst_videoviews > 0){
                    $views_balance=$all_balance->balance_teacher / $all_video_views;
                    $result_balance = $views_balance * $inst_videoviews;
                    if($result_balance > 0.1){
                        if($instructor_balance->balance_teacher >= $request->transferTo ){
                            $balance=$instructor_balance->balance_teacher - $result_balance;
                            $transaction = new Transaction;
                            // $transaction->walletId    = $walletId->id;
                            $transaction->instructor_id    = $item->id;
                            $transaction->balance_teacher    = $balance;
                            $transaction->balance  = $all_balance->balance;
                            $transaction->balance_admin    = $instructor_balance->balance_admin;
                            $transaction->payments    = $instructor_balance->payments;
                            $transaction->transferTo    = $result_balance;
                            $transaction->report    = $request->report;
                            $transaction->date    = $todayDate;
                            $transaction->time    = $timenow;
                            $transaction->save();
    
                            $walletId=Wallet::where('user_id',$item->id)->first();
                            $walletId->total    = $walletId->total + $result_balance;
                            $walletId->save();
    
                            $videoviews =Curricula_View::where('userId',$item->id)->get();
                            foreach($videoviews as $videoview){
                               
                                $onevideo =Curricula_View::findOrFail($videoview->id);
                                $onevideo->watchtime = 0;
                                $onevideo->save();
                            }
                        }
                    }
                   
                }
                    
                
            }
        }else{
             return back()->with("errorss", 'المدربين الذي يتم التحويل لهم ربما حساباتهم معلقة جميعاً'); 
        }
    return redirect()->back()->with("message", 'تم توزيع ارباح المدربين لهذا الشهر ');
    }
   
    
    public function walletUserBalance($id){
       
         echo json_encode(Wallet::where('user_id', $id)->first());
        // echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }
    public function SendToBank(Request $request)
    {
        // dd($request->all());
         $this->validate( $request,[          
                'user_id'=>'required',
                'report'=>'required',
            ],
            [
                'user_id.required'=>' يجب اختيار مدرب',
                
                'report.required'=>' بيان التحويل مطلوب ', 
            ]
        );
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();

        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");

        $instructors =Instructor::where('id',$request->user_id)
         ->where('status',1)
                                    ->where('blocked',1)
                                    ->where('suspended',1)
        ->first();
        if(!$instructors){
            return back()->with("errorss", 'هذا الحساب لم يتم التحقق منه'); 
        }    
        if($instructors->blocked==0 || $instructors->suspended==0)
            return back()->with("errorss", 'هذا الحساب معلق لا يمكنك تحويل'); 
        
        $user_wallet=Wallet::where('user_id',$request->user_id)->first();
        // if($user_wallet){
            if($user_wallet->total >= 10 ){
                // $transfer = new Transfer;
                // $transfer->walletId    = $user_wallet->id;
                // $transfer->user_id    = $request->user_id;
                // $transfer->amount    = $user_wallet->total;
                // $transfer->report    = $request->report;
                // $transfer->date    = $todayDate;
                // $transfer->time    = $timenow;
                // $transfer->save();



                $last_balance=Transaction::orderBy('id', 'DESC')->first();
                $transaction = new Transaction;
                $transaction->user_id    = $request->user_id;
                $transaction->balance    = $last_balance->balance;
                $transaction->balance_admin    = $last_balance->balance_admin;
                $transaction->payments    = $last_balance->payments - $user_wallet->total;
                $transaction->transfers    = $user_wallet->total;
                $transaction->report    = $request->report;
                $transaction->date    = $todayDate;
                $transaction->time    = $timenow;
                $transaction->save();



                $onevideo =Wallet::findOrFail($user_wallet->id);
                $onevideo->total = 0;
                $onevideo->save();

               
            }else{
                return back()->with("errorss", 'رصيد المدرب لم يصل للحد الأدني للتحويل'); 
            }    
        // }else{
        //     return back()->with("errorss", 'لا يوجد إشتراكات'); 
        // }
        
        return redirect()->back()->with("message", 'تم التحويل بنجاح');
    }
    public function SendToBankk(Request $request)
    {
        dd($request->all());
         $this->validate( $request,[          
                'user_id'=>'required',
                'report'=>'required',
            ],
            [
                'user_id.required'=>' يجب اختيار مدرب',
                
                'report.required'=>' بيان التحويل مطلوب ', 
            ]
        );
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();

        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");

        $instructors =Instructor::where('id',$request->user_id)->first();
        if($instructors->blocked==0 || $instructors->suspended==0)
            return back()->with("errorss", 'هذا الحساب معلق لا يمكنك تحويل'); 

        $user_wallet=Wallet::where('user_id',$request->user_id)->first();
        // if($user_wallet){
            if($user_wallet->total >= 100 ){
                // $transfer = new Transfer;
                // $transfer->walletId    = $user_wallet->id;
                // $transfer->user_id    = $request->user_id;
                // $transfer->amount    = $user_wallet->total;
                // $transfer->report    = $request->report;
                // $transfer->date    = $todayDate;
                // $transfer->time    = $timenow;
                // $transfer->save();

                

                $all_payments=Transaction::orderBy('id', 'DESC')->first();
                // $onevideo =Transaction::findOrFail($user_wallet->id);
                $all_payments->payments = $all_payments->payments - $user_wallet->total;
                $all_payments->save();
                
                $onevideo =Wallet::findOrFail($user_wallet->id);
                $onevideo->total = 0;
                $onevideo->save();
            }else{
                return back()->with("errorss", 'رصيد المدرب لم يصل للحد الأدني للتحويل'); 
            }    
        // }else{
        //     return back()->with("errorss", 'لا يوجد إشتراكات'); 
        // }
        
        return redirect()->back()->with("message", 'تم التحويل بنجاح');
    }

    public function videoViewsAndBalanceInstructor()
    {
        $instructors =Instructor::where('type','instructor')->get();
        $instructors_r = array();
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }else{
                $bank_data->country='';
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =View::where('userId',$item->id)->sum('watchtime');
           
            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews / 60;
            }else{
                $item->inst_videoviews="0";
            }
            
            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =View::sum('watchtime');
            // dd($all_video_views);
            if($all_video_views){
                if($all_video_views==0){
                     $views_balance=$all_balance->balance / 1;
                }else{
                   $views_balance=$all_balance->balance / $all_video_views;
                }
                
                
                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
                // $inst=Instructor::where('id', $item->id)->first();
                // if( $result_balance < "1200"  ){

                //     array_push($instructors_r,$inst);
                    
                // }
                

            }else{
                
            }
        }
        // dd($instructors);

        return view('admin.videoviews.all',compact('instructors'));
    }
     public function lessThan(Request $request)
    {   
        $instructors_r =Instructor::where('type','instructor')->get();
        $instructors = array();
        foreach($instructors_r as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }
            
            $item->bank_data=$bank_data;
            $inst_videoviews =View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
                $inst=Instructor::where('id', $item->id)->first();
                if( $result_balance < $request->lessthan ){

                    array_push($instructors,$inst);
                    
                }
                

            }else{
                
            }
        }
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            
            if($country){
                $bank_data->country=$country->name;
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
            }else{
                
            }
        } 
        return view('admin.videoviews.all',compact('instructors'));
       
    }
    public function biggerThan(Request $request)
    {
        $instructors_r =Instructor::where('type','instructor')->get();
        $instructors = array();
        foreach($instructors_r as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            // dd($bank_data);
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }else{
                $bank_data->country='';
            }
            
            $item->bank_data=$bank_data;
            $inst_videoviews =View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
                $inst=Instructor::where('id', $item->id)->first();
                if( $result_balance > $request->biggerthan){

                    array_push($instructors,$inst);
                    
                }
            }else{
                
            }
        }
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            
            if($country){
                $bank_data->country=$country->name;
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
            }else{
                
            }
        } 
       
        return view('admin.videoviews.all',compact('instructors'));
        
    }
    public function videoViewsAndBalanceTeacher()
    {
        $instructors =Instructor::where('type','instructor')->get();
        $instructors_r = array();
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }else{
                $bank_data->country='';
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');
           
            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews / 60;
            }else{
                $item->inst_videoviews="0";
            }
            
            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =Curricula_View::sum('watchtime');
            if($all_video_views){
                if($all_video_views==0){
                    $views_balance=$all_balance->balance_teacher / 1;
                }else{
                    $views_balance=$all_balance->balance_teacher / $all_video_views;
                }
                
                
                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
            }else{
                
            }
        }
        // dd($instructors);

        return view('admin.videoviews.all_teacher',compact('instructors'));
    }



    public function lessThanTeacher(Request $request)
    {   
        $instructors_r =Instructor::where('type','instructor')->get();
        $instructors = array();
        foreach($instructors_r as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }
            
            $item->bank_data=$bank_data;
            $inst_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =Curricula_View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance_teacher / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
                $inst=Instructor::where('id', $item->id)->first();
                if( $result_balance < $request->lessthan ){

                    array_push($instructors,$inst);
                    
                }
                

            }else{
                
            }
        }
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            
            if($country){
                $bank_data->country=$country->name;
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =Curricula_View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance_teacher / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
            }else{
                
            }
        } 
        return view('admin.videoviews.all_teacher',compact('instructors'));
       
    }
    public function biggerThanTeacher(Request $request)
    {
        $instructors_r =Instructor::where('type','instructor')->get();
        $instructors = array();
        foreach($instructors_r as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            // dd($bank_data);
            $country=Country::where('id',$bank_data->countryId)->first();
            if($country){
                $bank_data->country=$country->name;
            }else{
                $bank_data->country='';
            }
            
            $item->bank_data=$bank_data;
            $inst_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =Curricula_View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance_teacher / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
                $inst=Instructor::where('id', $item->id)->first();
                if( $result_balance > $request->biggerthan){

                    array_push($instructors,$inst);
                    
                }
            }else{
                
            }
        }
        foreach($instructors as $item){
            $bank_data= Bank::where('userId',$item->id)->first();
            $country=Country::where('id',$bank_data->countryId)->first();
            
            if($country){
                $bank_data->country=$country->name;
            }
            $item->bank_data=$bank_data;
            $inst_videoviews =Curricula_View::where('userId',$item->id)->sum('watchtime');

            if($inst_videoviews){
                $item->inst_videoviews=$inst_videoviews;
            }else{
                $item->inst_videoviews=0;
            }

            $all_balance=Transaction::orderBy('id', 'DESC')->first();
            $all_video_views =Curricula_View::sum('watchtime');
            if($all_balance){
                $views_balance=$all_balance->balance_teacher / $all_video_views;

                $item->views_balance=$views_balance;
                $result_balance = $views_balance * $inst_videoviews;
                $item->result_balance=$result_balance;
            }else{
                
            }
        } 
       
        return view('admin.videoviews.all_teacher',compact('instructors'));
        
    }

    public function transfers()
    {
        $transfers=Transfer::get();
        foreach ($transfers as $item) {
            $user= Instructor::where('id',$item->user_id)->first();
            $item->user=$user;
        }
        $instructors=Instructor::where('type','instructor')->get();
        
        // dd($transfers);
        return view('admin.bills.transfers',compact('transfers','instructors'));
    }
    public function SendWithdrawals(Request $request)
    {
        $this->validate( $request,[          
                'amount'=>'required',
                'report'=>'required',
            ],
            [
                'amount.required'=>' يجب اختيار ',
                'report.required'=>' بيان التحويل مطلوب ', 
            ]
        );
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();

        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");

        $last_balance =Transaction::orderBy('id', 'DESC')->first();
        
        if($last_balance->payments >= 100 ){
            $withdrawal = new Withdrawal;
            $withdrawal->amount    = $request->amount;
            $withdrawal->report    = $request->report;
            $withdrawal->date    = $todayDate;
            $withdrawal->time    = $timenow;
            $withdrawal->save();

            $transaction = new Transaction;
            $transaction->balance    = $last_balance->balance;
            $transaction->balance_admin    = $last_balance->balance_admin;
            $transaction->payments    = $last_balance->payments - $request->amount;
            $transaction->withdrawals    = $request->amount;
            $transaction->report    = $request->report;
            $transaction->date    = $todayDate;
            $transaction->time    = $timenow;
            $transaction->save();


            // $all_payments=Transaction::orderBy('id', 'DESC')->first();
            // $last_balance->payments = $all_payments->payments - $request->amount;
            // $last_balance->save();
        }else{
            return back()->with("errorss", 'رصيد البنك لم يصل للحد الأدنى للسحب'); 
       }    
        
        return redirect()->back()->with("message", 'تم التحويل بنجاح');
    }
    public function withdrawals()
    {
        $withdrawals=Withdrawal::get();
        return view('admin.bills.withdrawals',compact('withdrawals'));
    }

    public function addSubscriptions(Request $request){
        
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
       
        
        $subscription_type=SubscriptionValue::where('type', $request->subtype)->first();

        
        $edit = instructor::findOrFail($request->user_id);
        $edit->status    = 1;
        $edit->subscription_value=$subscription_type->value;
        $edit->subscription_type=$subscription_type->type;
        $edit->save();
        
        
        $customer_subtype=$subscription_type->value;
        $balance_admin=$customer_subtype * 40 / 100;
        $balance_instructor=$customer_subtype * 60 / 100; 
        
        $last_balance=Transaction::orderBy('id', 'DESC')->first();
        if(!$last_balance){
            $last_balance=0;
        }
        
        $transaction = new Transaction;
        $transaction->user_id    = $edit->id;
        $transaction->balance    = $last_balance->balance + $balance_instructor;
        $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
        $transaction->payments    = $last_balance->payments + $customer_subtype;
        $transaction->transferFrom    = $customer_subtype;
        if($request->type_renew =="create"){
            $transaction->report    = "create";
        }else{
            $transaction->report    = "renew";
        }
        $transaction->date    = $todayDate;
        $transaction->time    = $timenow;
        $transaction->type_pay    = $request->type_pay;
        
        $transaction->save();
       
        return redirect()->back()->with("message", 'تم إضافة إشتراك');
    }
    
    public function addSubscriptionsCurriculums(Request $request){
        dd($request->all());
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
       
        
        $subscription_type=SubscriptionValue::where('type', 'عام دراسي')->first();
    //   dd($subscription_type);
        $edit = instructor::findOrFail($request->user_id);
        $edit->status_teacher    = 1;
        $edit->sub_curriculas  = $subscription_type->value;
        $edit->branch_id  = $request->branch_id;
        $edit->save();    
       
        
        $customer_subtype=$subscription_type->value;
        $balance_admin=$customer_subtype * 40 / 100;
        $balance_instructor=$customer_subtype * 60 / 100; 
        
        $last_balance=Transaction::orderBy('id', 'DESC')->first();
        if(!$last_balance){
            $last_balance=0;
        }
        
        
        
        
       
                    
        
        $transaction = new Transaction;
        $transaction->user_id    = $edit->id;
        $transaction->balance_teacher    = $last_balance->balance + $balance_instructor;
        $transaction->balance    = $last_balance->balance;
        $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
        $transaction->payments    = $last_balance->payments + $customer_subtype;
        $transaction->transferFrom    = $customer_subtype;
        if($request->type_renew =="create"){
            $transaction->report    = "create";
        }else{
            $transaction->report    = "renew";
        }
        $transaction->date    = $todayDate;
        $transaction->time    = $timenow;
        $transaction->type_pay    = $request->type_pay;
        
        $transaction->save();
       
        return redirect()->back()->with("message", 'تم إضافة إشتراك');
    }
    
    
    
    public function buyCourseCertificat(Request $request){
        
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
       
        
        
        $ContactInfo=ContactInfo::first();
        $customer_subtype=$ContactInfo->certificate_price;
        // $balance_admin=$customer_subtype;
        $balance_instructor=0;
                
        $balance_admin=$customer_subtype * 40 / 100;
        $on_instructor=$customer_subtype * 60 / 100; 
        
                
        $course=Course::where('id',$request->course_id)->first();         
        $instructor =Instructor::where('id',$course->userId)->first();
        
        $last_balance=Transaction::orderBy('id', 'DESC')->first();
        if(!$last_balance){
            $last_balance=0;
        }
        
        $transaction = new Transaction;
        $transaction->user_id    = $request->user_id;
        $transaction->balance    = $last_balance->balance + $balance_instructor;
        $transaction->balance_teacher    = $last_balance->balance_teacher ;
        $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
        $transaction->payments    = $last_balance->payments + $customer_subtype;
        $transaction->transferFrom    = $customer_subtype;
        $transaction->transferTo    = $on_instructor;
        $transaction->report    = "شهادة مسجلة";
        $transaction->instructor_id    = $instructor->id;
        $transaction->date    = $todayDate;
        $transaction->time    = $timenow;
        $transaction->type_pay    = $request->type_pay;
        $transaction->save();
        
        $cer_uniqid=uniqid();
        $certificate  = new Certificate;
        $certificate->student_id    = $request->user_id;
        $certificate->course_id    = $request->course_id;
        $certificate->transaction_id    = $transaction->id;
        $certificate->serial_number    = $cer_uniqid;
        $certificate->save();
        
        $instructor_wallet =Wallet::where('user_id',$instructor->id)->first();
        $instructor_wallet->total = $instructor_wallet->total + $on_instructor;
        $instructor_wallet->save();
        
        return redirect()->back()->with("message", 'تم شراء الشهادة ');
    }
    public function buyLiveCertificat(Request $request){
        
        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
       
        
        
        $ContactInfo=ContactInfo::first();
        $customer_subtype=$ContactInfo->live_certificate;
        $balance_admin=$customer_subtype * 15 / 100;
        $on_instructor=$customer_subtype * 85 / 100; 
        $balance_instructor=0;
                
        $course=Straight::where('id',$request->course_id)->first();         
        $instructor =Instructor::where('id',$course->userId)->first();
       
        $last_balance=Transaction::orderBy('id', 'DESC')->first();
        if(!$last_balance){
            $last_balance=0;
        }
        
        $transaction = new Transaction;
        $transaction->user_id    = $request->user_id;
        $transaction->balance    = $last_balance->balance + $balance_instructor;
        $transaction->balance_teacher    = $last_balance->balance_teacher ;
        $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
        $transaction->payments    = $last_balance->payments + $customer_subtype;
        $transaction->transferFrom    = $customer_subtype;
        $transaction->transferTo    = $on_instructor;
        $transaction->report    = "شهادة أونلاين";
       
        $transaction->instructor_id    = $instructor->id;

        $transaction->date    = $todayDate;
        $transaction->time    = $timenow;
        $transaction->type_pay    = $request->type_pay;
        $transaction->save();
        
        
        $cer_uniqid=uniqid();
       
        $certificate  = new Certificate;
        $certificate->student_id    = $request->user_id;
        $certificate->live_id    = $request->course_id;
        $certificate->transaction_id    = $transaction->id;
        $certificate->serial_number    = $cer_uniqid;
        $certificate->save();
                            
       
        $instructor_wallet =Wallet::where('user_id',$instructor->id)->first();
        $instructor_wallet->total = $instructor_wallet->total + $on_instructor;
        $instructor_wallet->save();
        return redirect()->back()->with("message", 'تم شراء الشهادة ');
    }
    
    // public function addSubscriptions(){
    //     $edit = instructor::findOrFail($customer_id);
    //     $edit->status    = 1;
    //     $edit->save();
    //     $subscription_type=SubscriptionValue::where('type', $request->subtype)->first();
        
    //     $transaction = new Transaction;
    //     $transaction->user_id    = $edit->id;
    //     $transaction->balance    = $last_balance->balance + $balance_instructor;
    //     $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
    //     $transaction->payments    = $last_balance->payments + $customer_subtype;
    //     $transaction->transferFrom    = $customer_subtype;
    //     if($createCertificateRenew == "courseCertificate"){
    //         $transaction->report    = "شهادة مسجلة";
    //     }elseif($createCertificateRenew =="liveCertificate"){
    //                     // $course=Straight::where('id',$courseId)->first(); 
    //         $instructor =Instructor::where('id',$course->userId)->first();
    //         $transaction->transferTo    = $on_instructor;
    //         $transaction->instructor_id    = $instructor->id;
    //         $transaction->report    = "شهادة تفاعلية";
    //     }elseif($createCertificateRenew =="signinLive"){
    //         $instructor =Instructor::where('id',$course->userId)->first();
    //         $transaction->transferTo    = $on_instructor;
    //         $transaction->instructor_id    = $instructor->id;
    //         $transaction->report    = "تسجيل في دورة مسجلة";
    //     }elseif($createCertificateRenew =="consultings"){
    //         $instructor =Instructor::where('id',$course->userId)->first();
    //         $transaction->transferTo    = $on_instructor;
    //         $transaction->instructor_id    = $instructor->id;
    //         $transaction->report    = "consultings";
    //     }elseif($createCertificateRenew =="create"){
    //         $transaction->report    = "create";
    //     }else{
    //         $transaction->report    = "renew";
    //     }
    //     $transaction->date    = $todayDate;
    //     $transaction->time    = $timenow;
    //     $transaction->save();
    //     // dd($transaction);
       
    //     return redirect()->back()->with("message", 'تم التحويل بنجاح');
    // }
     // public function SendBalance(Request $request)
    // {
    //      $this->validate( $request,[          
    //             'user_id'=>'required',
    //             'transferTo'=>'required|numeric',
    //             'report'=>'required',
                
    //         ],
    //         [
    //             'user_id.required'=>' يجب اختيار مدرب',
    //             'transferTo.required'=>' مبلغ التحويل مطلوب  ',
    //             'transferTo.numeric'=>'المبلغ يجب ان يكون رقم فقط',
    //             'report.required'=>' بيان التحويل مطلوب ', 
    //         ]
    //     );
    //     $mytime = Carbon::now('egypt');
    //     $todayDate = $mytime->toDateString();

    //     // $walletId=Wallet::where('user_id',$request->user_id)->first();
    //     $instructor_balance=Transaction::orderBy('id', 'DESC')->first();
    //     if($instructor_balance){
    //         if($instructor_balance->balance >= $request->transferTo ){
    //             $balance=$instructor_balance->balance - $request->transferTo;
    //         }else{
    //             return back()->with("errorss", 'الرصيد غير كافي لا يمكن التحويل'); 
    //         }    
    //     }else{
    //         // dd('is zero');
    //          // $balance=0;
    //         return back()->with("errorss", 'لا يوجد إشتراكات'); 
    //     }
       

    //     $time = new DateTime();
    //     $time->modify('+3 hours');
    //     $timenow=$time->format("h:i");
        
        
    //         $transaction = new Transaction;
    //         // $transaction->walletId    = $walletId->id;
    //         $transaction->user_id    = $request->user_id;
    //         $transaction->balance    = $balance;
    //         $transaction->balance_admin    = $instructor_balance->balance_admin;

    //         $transaction->transferTo    = $request->transferTo;
    //         $transaction->report    = $request->report;
    //         $transaction->date    = $todayDate;
    //         $transaction->time    = $timenow;
    //         $transaction->save();

    //         // dd("ddaa");
    //         $videoviews =View::where('userId',$request->user_id)->get();
    //         foreach($videoviews as $item){
    //             // if($videoviews){
    //                 // $item->watchtime    = 0;
    //                 $onevideo =View::findOrFail($item->id);
    //                 $onevideo->watchtime = 0;
    //                 $onevideo->save();
    //                 // $item->save();
    //             // }
    //         }

        
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح');
    // }

    // public function SendBalance(Request $request)
    // {
    //     $mytime = Carbon::now('egypt');
    //     $todayDate = $mytime->toDateString();

    //     $time = new DateTime();
    //     $time->modify('+3 hours');
    //     $timenow=$time->format("h:i");
    //     $length = count($request->user_id);
    //     if($length > 0)
    //     {
    //         for($i=0; $i<$length; $i++)
    //         {  
    //             $walletId=Wallet::where('user_id',$request->user_id[$i])->first();
    //             $instructor_balance=Transaction::where('user_id',$request->user_id[$i])->latest()->first();
    //             $balance=$instructor_balance->balance - $request->transferTo;
    //             $transaction = new Transaction;
    //             $transaction->walletId    = $walletId->id;
    //             $transaction->user_id    = $request->user_id[$i];
    //             $transaction->balance    = $balance;
    //             $transaction->transferTo    = $request->transferTo;
    //             $transaction->report    = $request->report;
    //             $transaction->date    = $todayDate;
    //             $transaction->time    = $timenow;
    //             $transaction->save();
    //         }
    //     }
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح');
    // }

    // public function videoViewsAndBalanceInstructor()
    // {
    //     $instructors =Instructor::where('type','instructor')->get();
        
    //     foreach($instructors as $item){
    //         $bank_data= Bank::where('userId',$item->id)->first();
    //         $country=Country::where('id',$bank_data->countryId)->first();
    //         $bank_data->country=$country->name;
    //         $item->bank_data=$bank_data;
    //         $videoviews =View::where('userId',$item->id)->sum('watchtime');

    //         if($videoviews){
    //             $item->videoviews=$videoviews;
    //         }else{
    //             $item->videoviews=0;
    //         }

    //         $instructor_balance=Transaction::where('user_id',$item->id)->latest()->first();
    //         if($instructor_balance){
    //             $item->instructor_balance=$instructor_balance->balance;
    //         }else{
    //             $item->instructor_balance=0;
    //         }
    //     }  
    //     // dd($instructors); 
    //     return view('admin.videoviews.all',compact('instructors'));
    // }

}

