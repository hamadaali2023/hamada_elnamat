<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\Story;
use App\Category;   
use Hash;
use Session;
use Auth;
use App\Subscription;
use DateTime;
use Carbon\Carbon;
use App\Country;
use App\Transaction;
use App\Instructor;
use App\Course;
use App\ContactInfo;
use App\Certificate;
use App\Wallet;
use App\Consulting;
use App\Straight;
use App\Courses_joined;

class PaymentProviderController extends Controller
{
    public $module_view_folder;
    public function __construct()
    {
        $this->module_view_folder = 'front.checkout';
    }
    
    public function checkout()
    {
    //   return redirect('/'); 
        $user = Auth::guard('instructors')->user(); 

        $mytime = Carbon::now('egypt');
        $todayDate = $mytime->toDateString();
        $time = new DateTime();
        $time->modify('+3 hours');
        $timenow=$time->format("h:i");
       
        $courseId= Session::get('courseId');
        $createCertificateRenew= Session::get('payCreateOrCertificateOrRenew');
        $create_type= Session::get('create_type');
        // dd($createCertificateRenew);
        if($user){
            if($createCertificateRenew =="courseCertificate"){
                $ContactInfo=ContactInfo::first();
                // $customer_subtype=$ContactInfo->certificate_price;
                // $balance_admin=$customer_subtype;
                
                
                $customer_subtype=$ContactInfo->certificate_price;
                $course=Course::where('id',$courseId)->first();  
                $balance_admin=$customer_subtype * 40 / 100;
                $on_instructor=$customer_subtype * 60 / 100; 
                
                $balance_instructor=0;
                $customer_id= $user->id;
            }elseif($createCertificateRenew =="liveCertificate"){
                $ContactInfo=ContactInfo::first();
                $customer_subtype=$ContactInfo->live_certificate;
                $course=Straight::where('id',$courseId)->first();  
                
                $balance_admin=$customer_subtype * 15 / 100;
                $on_instructor=$customer_subtype * 85 / 100; 
                
                $balance_instructor=0;
                $customer_id= $user->id;
            }elseif($createCertificateRenew =="signinLive"){
                $course=Straight::where('id',$courseId)->first();    
                $customer_subtype=$course->price;
                
                $balance_admin=$customer_subtype * 15 / 100;
                $on_instructor=$customer_subtype * 85 / 100; 
                
                $balance_instructor=0;
                $customer_id= $user->id;
            }elseif($createCertificateRenew =="consultings"){
                $course=Consulting::where('id',$courseId)->first();    
                $customer_subtype=$course->price;
                
                $balance_admin=$customer_subtype * 15 / 100;
                $on_instructor=$customer_subtype * 85 / 100; 
                
                $balance_instructor=0;
                $customer_id= $user->id;
            }else{
                $customer_subtype=$user->subscription_value;
                // $balance_admin=$customer_subtype;
                // $balance_instructor=0;
                $balance_admin=$customer_subtype * 40 / 100;
                $balance_instructor=$customer_subtype * 60 / 100; 
                $customer_id= $user->id;
            }
        }else{
            $customer_id= Session::get('customer_idd');
            $userSign = Instructor::where("id" , $customer_id)->first();
            if($create_type=="curriculums"){
                $customer_subtype=$userSign->sub_curriculas;
            }else{
                $customer_subtype=$userSign->subscription_value;
            }
            
            
            $balance_admin=$customer_subtype * 40 / 100;
            $balance_instructor=$customer_subtype * 60 / 100;           
        }
        
        $last_balance=Transaction::orderBy('id', 'DESC')->first();
        if(!$last_balance){
            $last_balance=0;
        }

        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
            // dd($payment_status['result']['code']);
            // dd($payment_status['id']);
            if(isset($payment_status['id'])) { //success payment id -> transaction bank id
                $showSuccessPaymentMessage = true;
                if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $payment_status['result']['code'])
                    || preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', $payment_status['result']['code']))
                {
                    $transaction = new Transaction;
                    $transaction->user_id    = $customer_id;
                    if($create_type=="curriculums"){
                        $transaction->balance_teacher    = $last_balance->balance_teacher + $balance_instructor;
                        $transaction->balance    = $last_balance->balance;
                    }else{
                        $transaction->balance    = $last_balance->balance + $balance_instructor;
                        $transaction->balance_teacher    = $last_balance->balance_teacher;
                    }
                    $transaction->balance_admin    = $last_balance->balance_admin + $balance_admin;
                    $transaction->payments    = $last_balance->payments + $customer_subtype;
                    $transaction->transferFrom    = $customer_subtype;
                    
                    if($createCertificateRenew == "courseCertificate"){
                        $instructor =Instructor::where('id',$course->userId)->first();
                        $transaction->transferTo    = $on_instructor;
                        $transaction->instructor_id    = $instructor->id;
                        $transaction->report    = "شهادة مسجلة";
                    }elseif($createCertificateRenew =="liveCertificate"){
                        // $course=Straight::where('id',$courseId)->first(); 
                        $instructor =Instructor::where('id',$course->userId)->first();
                        $transaction->transferTo    = $on_instructor;
                        $transaction->instructor_id    = $instructor->id;
                        $transaction->report    = "شهادة أونلاين";
                    }elseif($createCertificateRenew =="signinLive"){
                        $instructor =Instructor::where('id',$course->userId)->first();
                        $transaction->transferTo    = $on_instructor;
                        $transaction->instructor_id    = $instructor->id;
                        $transaction->report    = " تسجيل في دورة اونلاين";
                    }elseif($createCertificateRenew =="consultings"){
                        $instructor =Instructor::where('id',$course->userId)->first();
                        $transaction->transferTo    = $on_instructor;
                        $transaction->instructor_id    = $instructor->id;
                        
                        
                        $transaction->report    = "consultings";
                    }elseif($createCertificateRenew =="create"){
                         $transaction->report    = "create";
                    }else{
                        $transaction->report    = "renew";
                    }
                    $transaction->date    = $todayDate;
                    $transaction->time    = $timenow;
                    $transaction->save();
                    // dd($transaction);
                    $edit = instructor::findOrFail($customer_id);
                    
                    if($createCertificateRenew =="create" || $createCertificateRenew =="renew"){
                        if($create_type=="curriculums"){
                            $edit->status_teacher    = 1;
                        }else{
                            $edit->status    = 1;
                        }
                    }
                    $edit->save();
                    
                    $cer_uniqid=uniqid();
                    if($user){
                        if($createCertificateRenew =="signinLive"){
                            $add = new Courses_joined;
                            $add->student_id = $user->id;
                            $add->liveId = $course->id;
                            $add->save();
                            // $transaction->report    = "تسجيل في دورة مسجلة";
                            
                            $instructor =Instructor::where('id',$course->userId)->first();
                            $instructor_wallet =Wallet::where('user_id',$instructor->id)->first();
                            $instructor_wallet->total = $instructor_wallet->total + $on_instructor;
                            $instructor_wallet->save();
                        }
                        
                        if($createCertificateRenew=="courseCertificate"){
                            $certificate  = new Certificate;
                            $certificate->student_id    = $user->id;
                            $certificate->course_id    = $courseId;
                            $certificate->transaction_id    = $transaction->id;
                            $certificate->serial_number    = $cer_uniqid;
                            $certificate->save();
                            
                            $instructor =Instructor::where('id',$course->userId)->first();
                            $instructor_wallet =Wallet::where('user_id',$instructor->id)->first();
                            $instructor_wallet->total = $instructor_wallet->total + $on_instructor;
                            $instructor_wallet->save();
                        }
                        
                        if($createCertificateRenew=="liveCertificate"){
                            
                            $certificate  = new Certificate;
                            $certificate->student_id    = $user->id;
                            $certificate->live_id    = $courseId;
                            $certificate->transaction_id    = $transaction->id;
                            $certificate->serial_number    = $cer_uniqid;
                            $certificate->save();
                            
                            // $course=Straight::where('id',$courseId)->first(); 
                            $instructor =Instructor::where('id',$course->userId)->first();
                            $instructor_wallet =Wallet::where('user_id',$instructor->id)->first();
                            $instructor_wallet->total = $instructor_wallet->total + $on_instructor;
                            $instructor_wallet->save();
                        }
                        if($createCertificateRenew=="consultings"){
                            
                            $certificate  = new ConsultingJoined;
                            $certificate->student_id    = $user->id;
                            $certificate->instructor_id    = $course->userId;
                            $certificate->consulting_id    = $course->id;
                            $certificate->save();
                        }
                        
                        
                    }
                    session()->forget('courseId');
                    session()->forget('payCreateOrCertificateOrRenew');
                    session()->forget('customer_id'); 
                    session()->forget('$create_type'); 
                    return view($this->module_view_folder)-> with(['success' =>  'تم الاشتراك بنجاح يمكنك الان تسجيل الدخول ومشاهدة جميع الدورات']);
                }else{
                    return view($this->module_view_folder )-> with(['fail'  => 'فشلت عملية الدفع']);
                }
                
            }else{
                $showFailPaymentMessage = true;
                 return view($this->module_view_folder )-> with(['fail'  => 'فشلت عملية الدفع']);
            }
        }


        return view($this->module_view_folder );

        // return view('front.checkout');
    }
    

    public function getCheckOutId(Request $request)
    {
        $number = rand(100,100000);
        $t=time();
        $random = $number.''.$t;
        $merchantTransactionId=$random.'444';
        $user = Auth::guard('instructors')->user(); 
        $create_type= Session::get('create_type');
        if($user){
            $customer_id= $user->id; 
        }else{
            $customer_id= Session::get('customer_idd'); 
        }
            
           
            $userSign = Instructor::where("id",$customer_id)->first();
            $country = Country::where("id", $userSign->countryId)->first();
            if($create_type=="curriculums"){
                $price=$userSign->sub_curriculas;
            }else{
                $price=$userSign->subscription_value;
            }    
            // dd($price);
            $url = "https://eu-prod.oppwa.com/v1/checkouts";
            $data = "entityId=8acda4c782aad9470182e30dfec203f9" .
                        "&amount=". $price .
                        "&currency=USD" .
                        "&paymentType=DB".
                        "&merchantTransactionId=". $merchantTransactionId .
                        "&customer.email=". $userSign->email .
                        "&billing.street1=". $userSign->street1 .
                        "&billing.city=". $userSign->city .
                        "&billing.state=". $userSign->state .
                        "&billing.country=". $country->iso .
                        "&billing.postcode=". $userSign->postal_code .
                        "&customer.givenName=". $userSign->first_name .
                        "&customer.surname=". $userSign->last_name ;
        
           
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                           'Authorization:Bearer OGFjZGE0Y2E4MjYyYWY0NDAxODJlMzBjYTU1NzFjZGJ8Sm03Nlg0aHhiRQ=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $res = json_decode($responseData, true); 
            // return $res;
            return view('front.payment',compact('res'));
            
            
            // $view = view('front.ajax.form')->with(['responseData' => $res])->renderSections();
            // return response()->json([
            //     'status' => true,
            //     'content' => $view['main']
            // ]);
    }
    
    
    
    public function getCheckOutIdCertificate($typeCourse,$id,Request $request)
    {
        // return redirect('/'); 
        // dd($typeCourse);
        // create ,renew , courseCertificate, liveCertificate 
        $contactInfo=ContactInfo::first();
        
        $user = Auth::guard('instructors')->user();  
        if(!$user)
            return redirect('login/user'); 
        $number = rand(100,100000);
        $t=time();
        $random = $number.''.$t;
        $merchantTransactionId=$random.'444';
       
        
        if($typeCourse=="course-certificate"){
            
            // شراء شهادة دورة مسجلة 
            $course=Course::where('id',$id)->first();
            
            $price= $contactInfo->certificate_price;
            Session::put('payCreateOrCertificateOrRenew','courseCertificate');
        }elseif($typeCourse=="live-certificate"){
           
            // شراء شهادة دورة تفاعلية
            $course=Straight::where('id',$id)->first(); 
            
            $price= $contactInfo->live_certificate;
            
            Session::put('payCreateOrCertificateOrRenew','liveCertificate');
        }elseif($typeCourse=="consultings"){
            $course=Consulting::where('id',$id)->first();
             $price= $course->price;
            Session::put('payCreateOrCertificateOrRenew','consultings');
        }else{
            // التسجيل دورة تفاعلية
            $course=Straight::where('id',$id)->first();    
             $price= $course->price;
            Session::put('payCreateOrCertificateOrRenew','signinLive');
        }
        
        Session::put('courseId', $course->id);
        $user = Auth::guard('instructors')->user(); 
        if($user){
            $country = Country::where("id" , $user->countryId)->first();
           
            
            $url = "https://eu-prod.oppwa.com/v1/checkouts";
            $data = "entityId=8acda4c782aad9470182e30dfec203f9" .
                        "&amount=". $price .
                        "&currency=USD" .
                        "&paymentType=DB".
                        "&merchantTransactionId=". $merchantTransactionId .
                        "&customer.email=". $user->email .
                        "&billing.street1=". $user->street1 .
                        "&billing.city=". $user->city .
                        "&billing.state=". $user->state .
                        "&billing.country=". $country->iso .
                        "&billing.postcode=". $user->postal_code .
                        "&customer.givenName=". $user->first_name .
                        "&customer.surname=". $user->last_name;

        }
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                           'Authorization:Bearer OGFjZGE0Y2E4MjYyYWY0NDAxODJlMzBjYTU1NzFjZGJ8Sm03Nlg0aHhiRQ=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);
            $res = json_decode($responseData, true); 
           
            return view('front.payment',compact('res'));
    }

    private function getPaymentStatus($id, $resourcepath)
    {
        $url = "https://eu-prod.oppwa.com/";
        $url .= $resourcepath;
        $url .= "?entityId=8acda4c782aad9470182e30dfec203f9";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                       'Authorization:Bearer OGFjZGE0Y2E4MjYyYWY0NDAxODJlMzBjYTU1NzFjZGJ8Sm03Nlg0aHhiRQ=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        // return $responseData;
        return json_decode($responseData, true); 

    }

    
}
