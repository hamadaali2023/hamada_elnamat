<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Instructor;
use App\Student;
use DB;
use Crypt;
use App\Wallet;
use Hash;
use Illuminate\Support\Str;
use Mail;
use Session;
use Auth;
use App\Country;
use App\Bank;
use App\SubscriptionValue;
use App\Branch;
use App\Traveler;


use Carbon\Carbon;



class InstructorLoginController extends Controller
{
    
    public function UserLogin()
    {   
        return view('front.instructorlogin');
    }

    public function LoginUser(request $request)
    {
        $this->validate(request(),[
            'email'    => 'required',
            'password' => 'required',
            ],
            [
                'email.required'=>' البريد  الإلكتروني مطلوب',
                'password.required'=>' كلمة المرور مطلوبة',
            ]
        );

        $credentials = $request -> only(['email','password']);
        $checkinstructor = Instructor::where("email" , $request->email)->first();
        if($checkinstructor){
            
                if($checkinstructor->is_activated ==0)
                {
                    return redirect('instructorlogin')->with("errorss", 'الحساب غير مفعل'); 
                }else{
                    $good = Auth::guard('instructors') -> attempt($credentials);
                    if($good) {
                    $subscription = Subscription::where('id',$item->userId)->first(); 
                    if($subscription) {    
                        return redirect('/');
                    }else{
                        return view('front.checkout');
                    }     
    
                   
                    }else{
                        return redirect('instructorlogin')->with("errorss", 'بيانات الدخول غير صحيحةة'); 
                    }
                }
              
          
      }else{
        return redirect('instructorlogin')->with("errorss", 'بيانات الدخول غير صحيحة'); 
      }
    }
    public function signOutInstructors() {
      Auth::guard('instructors')->logout();
      return redirect('/');
    }

    public function instructorSignup()
    {   
        $user = Auth::guard('instructors')->user();
        if($user)
            return redirect('/');
        $countries=Country::all()->sortBy('name');
        
        return view('front.instructor-signup',compact('countries'));
    }
    
    public function studentSignup()
    {   
        $user = Auth::guard('instructors')->user();
        if($user)
            return redirect('/');
        $subscription_type=SubscriptionValue::get();
        $countries=Country::all()->sortBy('name');
        $branches=Branch::get();
        return view('front.student-signup',compact('countries','subscription_type','branches'));
    }
    
    public function getCountry($id){
        echo json_encode(DB::table('cities')->where('countryId',$id)->get());
    }
    
    public function registerNewUser(Request $request)
    {
        
            
        $user = Auth::guard('instructors')->user();
        if($user)
            return redirect('/');
            
        if($request->type !="instructor"){
            $this->validate(request(),[
                    'first_name'    => 'required|min:3',
                    'last_name'    => 'required|min:3',
                    'full_name' =>'required',
                    'email'    => 'required|email',
                    'password' => 'required|min:3',
                    'confirm_password' => 'required|same:password',
                    'countryId'=>'required' ,
                    'city'=>'required' ,
                    'state'=>'required' ,
                    'street1'=>'required',
                    'phone'=>'required'
                ],
                [
                    'first_name.required'=>'الاسم الاول مطلوب',
                    'last_name.required'=>'الاسم الثاني مطلوب',
                    'full_name.required'=>'يرجى كتابةأسمك بالكامل',
                    'email.required'=>' البريد  الإلكتروني مطلوب',
                    'email.email'=>'يجب أن يكون من نوع بريد إلكتروني',
                    'password.required'=>' كلمة المرور مطلوبة',
                    'confirm_password.required'=>' يرجى إعادة كلمة المرور ',
                    'countryId.required'=>' يرجى إختيار الدولة ',
                    'city.required'=>' أدخل المدينة ',
                    'state.required'=>' أدخل المنطقة ',
                    'street1.required'=>' يرجى أدخال الشارع ',
                    'phone.required'=>' أدخل رقم الهاتف ',
                ]
            );
        }
        $checkemail = Instructor::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return back()->with("errorss", 'Email already exists'); 
            }else{
                return back()->with("errorss", 'البريد الإلكتروني موجود مسبقا'); 
            }
        }else{
            $subscription_type=SubscriptionValue::where('type', $request->subtype)->first();
        
            $add = new Instructor();
            $add->name  = $request->first_name .' '. $request->last_name;  
            $add->full_name  = $request->full_name;   
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password); 
            $add->countryId  = $request->countryId; 
            
            
            $add->city  = $request->city;
            $add->street1  = $request->street1;
            $add->state  = $request->state;
            $add->first_name  = $request->first_name;
            $add->last_name  = $request->last_name;
            
            $add->type  = $request->type; 
            $add->postal_code  = $request->postal_code; 
            $add->mobile  = $request->phone; 
            
            // if($request->coursestype=="curriculums"){
            //     $add->sub_curriculas  = $request->sub_curriculas;
            //     $add->branch_id  = $request->branch_id;
            // }elseif($request->coursestype=="course"){
            //     $add->subscription_type=$request->subtype;
            //     if($request->subtype=="free"){
            //         $add->subscription_value =0;
            //     }else{
            //         $add->subscription_value =$subscription_type->value;
            //     }    
            // }elseif($request->coursestype=="free"){
            //     $add->subscription_type="free";
            //     $add->subscription_value =0;
            // }else{
            //     $add->subscription_type="free";
            //     $add->subscription_value =0;
            // }
            
            
            // if($request->coursestype=="course"){
            //     if($request->subtype=="free"){
            //         $add->status=1;
            //     }else{
            //         $add->status  = 2; 
            //     }  
            // }elseif($request->coursestype=="free" || $request->coursestype==null){
            //     $add->status=1;
            // }
            // $add->status_teacher  = 2;
            
            
            
            
            
            
            
            
            $add->subscription_type="free";
            $add->subscription_value =0;
            $add->status=2;
            $add->status_teacher  = 2;
            $add->save();

            // $createBank = new Bank;
            // $createBank->userId    = $add->id;
            // $createBank->save();

            // $createwallet = new Wallet;
            // $createwallet->user_Id    = $add->id;
            // $createwallet->save();

            $country = Country::where("id" , $request->countryId)->first();
            // $number = rand(100,100000);
            // $t=time();
            // $random = $number.''.$t;
            // $random_with_userid=$random.'444';

            // Session::put('merchantTransactionId', $random_with_userid);
            // Session::put('customer_email', $request->email);
            // Session::put('billing_street1', $request->street1);
            // Session::put('billing_city', $request->city);
            // Session::put('billing_state', $request->state);
            // Session::put('billing_country', $country->iso);
            // Session::put('billing_postcode', $request->postal_code);
            
            // Session::put('customer_givenName', $request->first_name);
            // Session::put('customer_surname', $request->last_name);
            // Session::put('customer_subtype', $request->subtype);
            
            Session::put('customer_idd', $add->id);
            Session::put('payCreateOrCertificateOrRenew','create');
            Session::put('create_type',$request->coursestype);
            
            
            if($request->coursestype=="course"){
                if($request->subtype=="free"){
                    return redirect('login/user')->with("message", 'تم التسجيل بنجاح'); 
                }else{
                    return redirect('get-checkout')->with("message", 'تم التسجيل بنجاح'); 
                }
            }elseif($request->coursestype=="curriculums"){
                return redirect('get-checkout')->with("message", 'تم التسجيل بنجاح'); 
            }elseif($request->coursestype=="free"){
                    return redirect('login/user')->with("message", 'تم التسجيل بنجاح'); 
            }else{
                return redirect('login/user')->with("message", 'تم التسجيل بنجاح'); 
            }
            
            // if($request->coursestype=="normal"){
            //     if(isset($request->lang)  && $request -> lang == 'en' ){
            //         return redirect('login/user')->with("message", 'registered Successfully'); 
            //     }else{
            //         return redirect('login/user')->with("message", 'تم التسجيل بنجاح'); 
            //     }
            // }elseif($request->subtype=="free"){
            //     if(isset($request->lang)  && $request -> lang == 'en' ){
            //         return redirect('login/user')->with("message", 'registered Successfully'); 
            //     }else{
            //         return redirect('login/user')->with("message", 'تم التسجيل بنجاح'); 
            //     }
            // }else{
            //      if(isset($request->lang)  && $request -> lang == 'en' ){
            //         return redirect('get-checkout')->with("message", 'registered Successfully'); 
            //     }else{
            //         return redirect('get-checkout')->with("message", 'تم التسجيل بنجاح'); 
            //     }
            // }
           
            
            
            
            
            
        }
        

    }

    
    public function registerNewInstructor(Request $request)
    {
        $user = Auth::guard('instructors')->user();
        if($user)
            return redirect('/');
        $this->validate(request(),[
                'name'    => 'required|min:10',
                'email'    => 'required|email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
                'countryId'=>'required',
                'phone'=>'required' ,
            ],
            [
                'name.required'=>'الاسم مطلوب',
                'email.required'=>' البريد  الإلكتروني مطلوب',
                'email.email'=>'يجب أن يكون من نوع بريد إلكتروني',
                'password.required'=>' كلمة المرور مطلوبة',
                'confirm_password.required'=>' يرجى إعادة كلمة المرور ',
                'countryId.required'=>' يرجى إختيار الدولة ',
                'phone.required'=>' أدخل رقم الهاتف ',
            ]
        );
        $checkemail = Instructor::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return back()->with("errorss", 'Email already exists'); 
            }else{
                return back()->with("errorss", 'البريد الإلكتروني موجود مسبقا'); 
            }
        }else{
            $add = new Instructor();
            $add->name  = $request->name;    
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password); 

            $add->countryId  = $request->countryId; 
            $add->type  = $request->type; 
            $add->mobile  = $request->phone; 
            $add->save();

            $createBank = new Bank;
            $createBank->userId    = $add->id;
            $createBank->save();

            $createwallet = new Wallet;
            $createwallet->user_Id    = $add->id;
            $createwallet->save();

            $user = $add->toArray();
            $user['link'] = Str::random(30);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('elnamat.com');
            });

            if(isset($request->lang)  && $request -> lang == 'en' ){
                return redirect('login/user')->with("message", 'registered Successfully');
            }else{
                return redirect('login/user')->with("message", 'تم التسجيل بنجاح');
            }
            
        }
        

    }
    public function instructorActivation($token){
        $check = DB::table('user_activations')->where('token',$token)->first();
        if(!is_null($check)){
            $user = Instructor::find($check->id_user);
            if ($user->is_activated ==1){
              //  return $this -> returnSuccessMessage('حسابكم مفعل');
                return redirect()->to('login/user')->with('message'," الحساب مفعل ");
            }
            $user->update(['is_activated' => 1]);
            DB::table('user_activations')->where('token',$token)->delete();
            //  return $this -> returnSuccessMessage('تم تفعيل حسابك');
            return redirect()->to('checkout')->with('message',"تم تفعيل حسابك");
        }
        // return $this -> returnError('رمز التفعيل غير صالح');  
        return redirect()->to('/login/user')->with('Warning',"رمز التفعيل غير صالج");
    }
        
    
    

    public function travelingSignup()
    {   
        // dd('tr');
        // $user = Auth::guard('instructors')->user();
        // if($user)
        //     return redirect('/');
        // $countries=Country::all()->sortBy('name');
        
        return view('front.traveling-signup');
    }
    public function registerTraveling(Request $request)
    {
        // dd('trare');
        // $user = Auth::guard('instructors')->user();
        // if($user)
        //     return redirect('/');
        $this->validate(request(),[
                'name'    => 'required',
                'email'    => 'required|email',
                'phone'=>'required' ,
            ],
            [
                'name.required'=>'الاسم مطلوب',
                'email.required'=>' البريد  الإلكتروني مطلوب',
                'email.email'=>'يجب أن يكون من نوع بريد إلكتروني',
                
                'phone.required'=>' أدخل رقم الهاتف ',
            ]
        );
        
        
        
        $checkemail = Traveler::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return back()->with("errorss", 'Email already exists'); 
            }else{
                return back()->with("errorss", 'البريد الإلكتروني موجود مسبقا'); 
            }
        }else{
            // dd('ccccc');
            $add = new Traveler();
            $add->name  = $request->name;    
            $add->email  = $request->email;   
           
            $add->mobile  = $request->phone; 
            $add->save();



            //start for token
              $token = Str::random(64);
      
              DB::table('travel_resets')->insert([
                  'email' => $request->email, 
                  'token' => $token, 
                  'created_at' => Carbon::now()
              ]);
      
              Mail::send('emails.travel_resets', ['token' => $token], function($message) use($request){
                  $message->to($request->email);
                  $message->subject('إصدار تأشيره');
              });
             //end for token
             return back()->with("message", 'يرجي زيارة بريدك الالكتروني والضغط علي الرابط لتكملة البيانات ');
             
            // $user = $add->toArray();
            
            // $user['link'] = Str::random(30);
            // DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            // Mail::send('emails.activation', $user, function($message) use ($user){
            //     $message->to($user['email']);
            //     $message->subject('elnamat.com');
            // });

            
        }
        

    }
    public function travelUserTokenGet($token) { 
         return view('auth.travel_link', ['token' => $token]);
    }
    
    public function travelData(Request $request)
    {
        // dd($request->('personalphoto'));
        $updatePassword = DB::table('travel_resets')->where([
                                // 'email' => $request->email, 
                                'token' => $request->token
                              ])->first();
        // dd($updatePassword);
        
        $user = Traveler::where('email', $updatePassword->email)->first();
        if($request->arrival_date){
            $user->arrival_date  =$request->arrival_date;
        }else{
             $user->arrival_date  =$user->arrival_date;
        }
        if($request->departure_date){
            $user->departure_date  =$request->departure_date;
        }else{
             $user->departure_date  =$user->departure_date;
        }
        if($request->profession){
            $user->profession  =$request->profession;
        }else{
             $user->profession  =$user->profession;
        }
        if($request->room_type){
            $user->room_type  =$request->room_type;
        }else{
             $user->room_type  =$user->room_type;
        }
        if($request->type){
            $user->type  =$request->type;
        }else{
             $user->type  =$user->type;
        }
        if($request->arrival_date){
            $user->arrival_date  =$request->arrival_date;
        }else{
             $user->arrival_date  =$user->arrival_date;
        }
        // $user->departure_date  =$request->departure_date;
        // $user->profession  =$request->profession;
        // $user->room_type  =$request->room_type;
        // $user->type  =$request->type;
        // $user->arrival_date  =$request->arrival_date;
        
        
         if($request->file('personal_photo'))
        {
            $file_extension = $request -> file('personal_photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/travel';
            $request-> file('personal_photo') ->move($path,$file_name);
            $user->personal_photo  = $file_nameone;
        }else{
            dd('personal_photo');
            $user->personal_photo  = $request->personal_photo; 
        }

        if($fileee=$request->file('passport_photo'))
        {
            $file_extension2 = $request -> file('passport_photo') -> getClientOriginalExtension();
            $file_name2 = time().time().'.'.$file_extension2;
            $file_nameone2 = $file_name2;
            $path2 = 'assets_admin/img/travel';
            $request-> file('passport_photo') ->move($path2,$file_name2);
            $user->passport_photo  = $file_nameone2;  
        }else{
            $user->passport_photo  = $user->passport_photo;
        }
        
        $user-> save();
          
        return redirect()->to('user-show-data/'.$request->token);
        // return redirect('/login/user')->with('message', 'تم تغيير كلمة السر الخاصة بك!');
    }
    public function userShowData($token) { 
        $updatePassword = DB::table('travel_resets')->where([
                                // 'email' => $request->email, 
                                'token' =>$token
                              ])->first();
        
        $user = Traveler::where('email', $updatePassword->email)->first();
        // return view('auth.travel_link', ['token' => $token]);
         return view('front.user_show_data',compact('user'));
    }
    public function travelUserdone($id) { 
        // return back()->with('message', 'تم ارسال رساله بتأكيد اصدار الفيزا');
        $user = Traveler::where('id', $id)->first();
        
        
    //   dd($user);
        $users = $user->toArray();
        // Mail::send('emails.travel_resets_done', function($message) use($users){
        //     $message->to($user->email);
        //         $message->subject('اصدار تأشيرة');
        // });
        
        Mail::send('emails.travel_resets_done', ['token' => $users], function($message) use($users){
                  $message->to($users['email']);
                  $message->subject('إصدار تأشيره');
              });
              return back()->with('message', 'تم ارسال رساله بتأكيد اصدار الفيزا');
        // return back()->with("message", 'يرجي زيارة بريدك الالكتروني والضغط علي الرابط لتكملة البيانات ');
        // return view('auth.travel_link', ['token' => $token]);
         return view('front.travel-user-done',compact('user'))->with("message", 'يرجي زيارة بريدك الالكتروني  ');
        //   return redirect()->to('travel-user-done/'.$user->id)->with('message', 'رجي زيارة بريدك الالكتروني!');
    }
    
    
}
