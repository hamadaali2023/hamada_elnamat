<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Admin;
use App\Patient;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

use App\Patient_health_information;
use App\Country;
use App\City;
use Mail;
use Password;
use Illuminate\Support\Str;
use DB;
use App\Patient_case;
class PatientAuthController extends Controller
{

    use GeneralTrait;
    
 
    public function login(Request $request)
    {
        try {
            $rules = [
                "email" => "required",
                "password" => "required",
                "device_token" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

               
                $credentials = $request -> only(['email','password']);

                $token =  Auth::guard('patient-api') -> attempt($credentials);
               // dd($token);
                if(!$token)

                if(isset($request->lang)  && $request -> lang == 'en' ){
                    return $this -> returnError('404','The login information is incorrect ');
                }else{
                    return $this -> returnError('404','بيانات الدخول غير صحيحة');
                }


                $UserData = Patient::where("email" , $request->email)->first();
                if($UserData->is_activated ==0)
                {
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        return $this -> returnError('404','your email is not active');
                    }else{
                        return $this -> returnError('404','البريد الإلكتروني غير مفعل');
                    }   
                }else{ 
                    $admin = Auth::guard('patient-api') -> user();
                    $admin -> api_token = $token;
                    $UserData->device_token=$request->device_token;
                    $UserData->token=$token;
                    $UserData->save();
                    $patient = Patient::find($UserData->id);
                    $patient->photo= "https://findfamily.net/care/assets_admin/img/patient/".$patient->photo;
                    $patient->patient_health_information = Patient_health_information::where('patientId',$patient->id)->first();
                    $country= Country::selection()->where('id',$patient->countryId)->first();
                    if($country){
                        $patient->country=$country->name;
                    }else{
                        $patient->country=null;
                    }
                    $city= City::selection()->where('id',$patient->cityId)->first();
                    if($city){
                        $patient->city=$city->name;
                    }else{
                        $patient->city=null;
                    }
                    
                    $patient_case =  Patient_case::where('patientId',$patient->id)->first();
                    if($patient_case){
                        $patient->patient_not_status=$patient_case->status_not;
                    }else{
                        $patient->patient_not_status=1;
                    }
                    
                    
                    
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        return $this -> returnDataa('data',$patient,'done');
                    }else{
                        return $this -> returnDataa('data',$patient,'تم الحفظ');
                    } 
                }   
                
                

            
        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }


    public function register(Request $request)
    {
        // dd($request->photo);
        $checkemail = Patient::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnError('404','Email already exists');
            }else{
                return $this -> returnError('404','البريد الإلكتروني موجود مسبقا');
            }
        }else{
            $add = new Patient();
            $add->first_name  = $request->first_name; 
            $add->last_name  = $request->last_name; 
            $add->dateOfBirth  = $request->dateOfBirth;
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password);  
            $add->countryId  = $request->countryId;
            $add->mobile  = $request->mobile;            
            $add->gender  = $request->gender;  
            $add-> save();
            
            
            
            $add_health= new Patient_health_information();
            $add_health->patientId  = $add->id;  
            
            $add_health-> save();

            $user = $add->toArray();
            $user['link'] = Str::random(32);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.patient-activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('esptalia - Activation Code');
            });
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Please visit your email to activate the account ');
            }else{
                return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني لتفعيل الحساب');
            }
        }
       
        // return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
    }
    public function getPatientData(Request $request)
    {
        $patient = Patient::find($request->id);
        $patient->photo= "https://findfamily.net/care/assets_admin/img/patient/".$patient->photo;
        $patient->patient_health_information = Patient_health_information::where('patientId',$patient->id)->first();
        $country= Country::selection()->where('id',$patient->countryId)->first();
        if($country){
            $patient->country=$country->name;
        }else{
            $patient->country=null;
        }
        $city= City::selection()->where('id',$patient->cityId)->first();
        if($city){
            $patient->city=$city->name;
        }else{
            $patient->city=null;
        }
        $patient_case =  Patient_case::where('patientId',$request->id)->first();
        if($patient_case){
            $patient->patient_not_status=$patient_case->status_not;
        }else{
            $patient->patient_not_status=1;
        }
       
        return $this -> returnDataa('data',$patient,'fihrwfr');
    }
    
    
    public function PatientNotStatus(Request $request)
    {
        $changstatus = Patient_case::where('patientId',$request->patientId)->first();

        if($changstatus !=null){
            $changstatus->status_not  = $request->status_not;
            $changstatus->save();
        }else{
            $add = new Patient_case;
            $add->status_not  = $request->status_not;
            $add->patientId  = $request->patientId;
            $add->save();
        }
        
        
        $patient = Patient::find($request->patientId);
        $patient->photo= "https://findfamily.net/care/assets_admin/img/patient/".$patient->photo;
        $patient->patient_health_information = Patient_health_information::where('patientId',$patient->id)->first();
        $country= Country::selection()->where('id',$patient->countryId)->first();
        if($country){
            $patient->country=$country->name;
        }else{
            $patient->country=null;
        }
        $city= City::selection()->where('id',$patient->cityId)->first();
        if($city){
            $patient->city=$city->name;
        }else{
            $patient->city=null;
        }
        
        $patient_case =  Patient_case::where('patientId',$request->patientId)->first();
        if($patient_case){
            $patient->patient_not_status=$patient_case->status_not;
        }else{
            $patient->patient_not_status=1;
        }
        
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnDataa('data',$patient,'done');
        }else{
            return $this -> returnDataa('data',$patient,'تم الحفظ');
        }  
    }
    
     public function patientDataUpdate(Request $request)
    {
        // dd('frefr');
        $edit = Patient::findOrFail($request->patientId);
        if($file=$request->file('photo'))
         {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/patient/photo';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  = $file_nameone;
        }else{
            $edit->photo  = $edit->photo; 
        }

        if(isset($request->first_name)){
            $edit->first_name  = $request->first_name; 
        }else{
            $edit->first_name  = $edit->first_name; 
        } 
        if(isset($request->last_name)){
            $edit->last_name  = $request->last_name; 
        }else{
            $edit->last_name  = $edit->last_name; 
        } 

        if(isset($request->countryId)){
            $edit->countryId  = $request->countryId;  
        }else{
            $edit->countryId  = $edit->countryId; 
        }  

        if(isset($request->cityId)){
            $edit->cityId  = $request->cityId;  
        }else{
            $edit->cityId  = $edit->cityId; 
        } 
        // if(isset($request->state)){
        //     $edit->state  = $request->state;  
        // }else{
        //     $edit->state  = $edit->state; 
        // }
        
        if(isset($request->personality_number)){
            $edit->personality_number  = $request->personality_number;  
        }else{
            $edit->personality_number  = $edit->personality_number; 
        } 

        // if(isset($request->mobile)){
        //     $edit->mobile  = $request->mobile;  
        // }else{
        //     $edit->mobile  = $edit->mobile; 
        // } 
        
        
        if(isset($request->gender)){
            $edit->gender  = $request->gender;  
        }else{
            $edit->gender  = $edit->gender; 
        } 

        if(isset($request->dateOfBirth  )){
            $edit->dateOfBirth  = $request->dateOfBirth;  
        }else{
            $edit->dateOfBirth  = $edit->dateOfBirth; 
        } 

        
        $edit-> save();
        // dd($edit->id);
        
        // health information
        
            $edit_health= Patient_health_information::where('patientId',$request->patientId)->first();
            
            if(isset($request->blood  )){
                $edit_health->blood  = $request->blood;  
            }else{
                $edit_health->blood  = $edit_health->blood; 
            }
            if(isset($request->weight  )){
                $edit_health->weight  = $request->weight;  
            }else{
                $edit_health->weight  = $edit_health->weight; 
            }
            if(isset($request->height  )){
                $edit_health->height  = $request->height;  
            }else{
                $edit_health->height  = $edit_health->height; 
            }
            if(isset($request->pressure  )){
                $edit_health->pressure  = $request->pressure;  
            }else{
                $edit_health->pressure  = $edit_health->pressure; 
            }
            if(isset($request->chronic  )){
                $edit_health->chronic  = $request->chronic;  
            }else{
                $edit_health->chronic  = $edit_health->chronic; 
            }
           
            if(isset($request->ege  )){
                $edit_health->ege  = $request->ege;  
            }else{
                $edit_health->ege  = $edit_health->ege; 
            } 
            if(isset($request->companies_insuranceId  )){
                $edit_health->companies_insuranceId  = $request->companies_insuranceId;  
            }else{
                $edit_health->companies_insuranceId  = $edit_health->companies_insuranceId; 
            } 
            if(isset($request->number  )){
                $edit_health->number  = $request->number;  
            }else{
                $edit_health->number  = $edit_health->number; 
            } 
            
            if(isset($request->type  )){
                $edit_health->type  = $request->type;  
            }else{
                $edit_health->type  = $edit_health->type; 
            } 
            if(isset($request->date  )){
                $edit_health->date  = $request->date;  
            }else{
                $edit_health->date  = $edit_health->date; 
            } 
         $edit_health-> save();
        // health information

        $patient = Patient::find($edit->id);
        $patient->photo= "https://findfamily.net/care/assets_admin/img/patient/".$patient->photo;

        $patient->patient_health_information = Patient_health_information::where('patientId',$patient->id)->first();
        $country= Country::selection()->where('id',$patient->countryId)->first();
        if($country){
            $patient->country=$country->name;
        }else{
            $patient->country=null;
        }
        $city= City::selection()->where('id',$patient->cityId)->first();
        if($city){
            $patient->city=$city->name;
        }else{
            $patient->city=null;
        }
        
        $patient_case =  Patient_case::where('patientId',$patient->id)->first();
        if($patient_case){
            $patient->patient_not_status=$patient_case->status_not;
        }else{
            $patient->patient_not_status=1;
        }
        // $home  = [  
        //     'patient'=>$patient,
        //     'patient_not_status'=>$patient_not_status,
        // ];
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnDataa('data',$patient,'done');
        }else{
            return $this -> returnDataa('data',$patient,'تم الحفظ');
        }  
    }
    
    public function change_password(Request $request)
    {

        // $gg= Auth::guard('doctor-api')->user();
        // dd($gg);
        $input = $request->all();
        $userid = Patient::where("id" , $request->id)->first();
        // $userid = Auth::guard('doctor-api')->user()->id;
        // dd($userid);
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                // dd('12345');
                // $cc=$userid->password;
                // dd($cc);
                // $ss=bcrypt($request->old_password);
                //  dd($ss);
                if ((Hash::check(request('old_password'), $userid->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), $request->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                     $userid->password  = Hash::make($input['new_password']);
                     $userid->save();
                    // Patient::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => $userid);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        }
        return \Response::json($arr);
    }
    
    
    // public function forgetPassword(Request $request)
    // {
    //         $email = Patient::where("email" , $request->email)->first();
    //         // $edit->save();
    //         return $this -> returnSuccessMessage('يرجي زيارة بريدك الإلكتروني');
    // }
    
    
     public function forgetPassword(Request $request)
    {
        
        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );




        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                 $patients= Patient::where('email',$request->email)->first();
                if($patients==null){
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                         return $this -> returnError('001','Email not found ');
                    }else{
                        return $this -> returnError('001','البريد الإلكتروني غير موجود');
                    }
                }else{
                   // $user->registartionId = str_rand(6 only digit)->unique;
                    // $gene = mt_rand(1000000000, 9999999999);
                    // $patients->password = bcrypt($gene);
                    // $patients->save();
                    // $details = [
                    //     'title' => 'Password of Esptalia',
                    //     'body' => 'cope this password to enter Esptalia ' ." " . $gene . " "
                    // ];
                    // \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));

                   $user = $patients->toArray();
                   $user['passwordgenerat'] =  mt_rand(1000000000, 9999999999);
                    Mail::send('emails.forgot', $user, function($message) use ($user){
                        $message->to($user['email']);
                        $message->subject('esptaila - New password');
                    });
                   
                   
                    // dd("Email is Sent.");



                    if(isset($request->lang)  && $request -> lang == 'en' ){
                         return $this -> returnSuccessMessage('Please visit your email ');
                    }else{
                        return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني');
                    }
                }
                    


                    











            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        // return \Response::json('doneeeee');
    }
}
