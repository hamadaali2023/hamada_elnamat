<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Patient;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Country;
use App\City;
use App\Doctor;
use App\Category;
use App\Service;
use App\Doctor_bank;
use App\Doctor_certificate;
use App\Doctor_education;
use App\Doctor_insurance;
use App\Doctor_language;
use App\Doctor_license;
use App\Doctor_service;
use App\Doctor_experience;
use App\PlaceIssuanceLicense;
use App\Companies_insurance;
use App\Member_ship_type;
use App\Doctor_case;

use App\Degree;
use Hash;
use Mail;
use Password;
use Illuminate\Support\Str;
use DB;
class DoctorAuthController extends Controller
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
                
                $credentials = $request->only(['email','password']) ;

                $token =  Auth::guard('doctor-api') -> attempt($credentials);
                if(!$token)
                    if(isset($request->lang)  && $request -> lang == 'en' ){
                        return $this -> returnError('404','The email or password is incorrect');
                    }else{
                        return $this -> returnError('404','البريد الإلكتروني أو كلمة المرور خطأ');
                    } 

                    $UserData = Doctor::where("email" , $request->email)->first();
                    if($UserData->is_activated ==0)
                    {
                        if(isset($request->lang)  && $request -> lang == 'en' ){
                            return $this -> returnError('404','your email is not active');
                        }else{
                            return $this -> returnError('404','البريد الإلكتروني غير مفعل');
                        }   
                    }else{
                        $admin = Auth::guard('doctor-api') -> user();
                        $admin -> api_token = $token;
                        $UserData->device_token=$request->device_token;
                        $UserData->token=$token;
                        $UserData->save();
                        // $doctor = Doctor::where('id',$UserData->id)->get();
                        
                        
                        
                        $doctor = Doctor::where('id',$UserData->id)->first();
                        
                        $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
                        $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
                        $doctor_certificate =  Doctor_certificate::where('doctorId',$UserData->doctorId)->get();
                        foreach($doctor_certificate as $item)
                        {
                            $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
                        } 
                        $doctor_bank = Doctor_bank::where('doctorId',$UserData->id)->first();  
                        $doctor_education =  Doctor_education::where('doctorId',$UserData->id)->get();
                        $doctor_insurance =  Doctor_insurance::where('doctorId',$UserData->id)->get();
                        $doctor_language =  Doctor_language::where('doctorId',$UserData->id)->get();            
                        $doctor_experience =  Doctor_experience::where('doctorId',$UserData->id)->get();
                        $doctor_license =   Doctor_license::where('doctorId',$UserData->id)->first();
                        $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
                        $countries= Country::selection()->where('id',$doctor->countryId)->first();
                        $cities= City::selection()->where('id',$doctor->cityId)->first();
                        $doctor_case= Doctor_case::where('doctorId',$UserData->id)->first();
                        $doctor_not_status=$doctor_case->status_not;
                        $doctor_servic_status=$doctor_case->status_servic;
                        
                        $home  = [  
                            'doctor'=>$doctor,
                            'doctor_bank'=>$doctor_bank,
                            'doctor_certificate'=>$doctor_certificate, 
                            'doctor_education'=>$doctor_education, 
                            'doctor_insurance'=>$doctor_insurance, 
                            'doctor_language'=>$doctor_language, 
                            'doctor_license'=>$doctor_license, 
                            'doctor_experience'=>$doctor_experience, 
                            'doctor_license'=>$doctor_license, 
                            'member_ship_types'=>$member_ship_types,
                            'countries'=>$countries,
                            'cities'=>$cities,
                            'doctor_not_status'=>$doctor_not_status,
                            'doctor_servic_status'=>$doctor_servic_status,

                        ];
                        return $this -> returnDataa(
                            'data',$home,'fihrwfr'
                        );
                        
                        // 
                    } 
           

        }catch (\Exception $ex){
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
    public function register(Request $request)
    {
        // dd('iughi');
        $checkemail = Doctor::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnError('001','Email already exists');
            }else{
                return $this -> returnError('001','البريد الإلكتروني موجود مسبقا');
            }
        }else{
            $add = new Doctor();
            // if($file=$request->file('photo'))
            // {
            //     $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            //     $file_name = time().'.'.$file_extension;
            //     $file_nameone = $file_name;
            //     $path = 'assets_admin/img/doctors/photo';
            //     $request-> file('photo') ->move($path,$file_name);
            //     $add->photo  = $file_nameone;
            // }else{
            //     $add->photo  = "profile_image.png"; 
            // }
            $add->type  = $request->type;
            $add->first_name  = $request->first_name; 
            $add->last_name  = $request->last_name; 
            $add->dateOfBirth  = $request->dateOfBirth;
            $add->email  = $request->email;   
            $add->password  = bcrypt($request->password);  
            $add->countryId  = $request->countryId;
            $add->cityId  = $request->cityId;
            $add->mobile  = $request->mobile;            
            $add->gender  = $request->gender; 
            $add-> save();
            
            $user = $add->toArray();
            $user['link'] = Str::random(32);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.doctor-activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('esptaila - Activation Code');
            });

            
            
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Please visit your email to activate the account ');
            }else{
                return $this -> returnSuccessMessage('يرجى زيارة بريدك الإلكتروني لتفعيل الحساب');
            }
        } 
        // return $this -> returnData('doctor' , $doctor);
        // return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
    }
    
    
    public function getDoctorData(Request $request)
    {
            $doctor = Doctor::where('id',$request->doctorId)->first();
            $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
            $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
            $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
            foreach($doctor_certificate as $item)
            {
                $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
            }  
            
            
            $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
             

               
            
            $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
            $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
            $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
            $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
            $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
            $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
            $countries= Country::selection()->where('id',$doctor->countryId)->first();
            $cities= City::selection()->where('id',$doctor->cityId)->first();
            $doctor_case =  Doctor_case::where('doctorId',$request->doctorId)->first();
            $doctor_not_status=$doctor_case->status_not;
            $doctor_servic_status=$doctor_case->status_servic;
            
            $home  = [  
                'doctor'=>$doctor,
                'doctor_bank'=>$doctor_bank,
                'doctor_certificate'=>$doctor_certificate, 
                'doctor_education'=>$doctor_education, 
                'doctor_insurance'=>$doctor_insurance, 
                'doctor_language'=>$doctor_language, 
                'doctor_license'=>$doctor_license, 
                'doctor_experience'=>$doctor_experience, 
                'doctor_license'=>$doctor_license, 
                'member_ship_types'=>$member_ship_types,
                'countries'=>$countries,
                'cities'=>$cities,
                'doctor_not_status'=>$doctor_not_status,
                'doctor_servic_status'=>$doctor_servic_status,

            ];
        return $this -> returnDataa(
            'data',$home,'fihrwfr'
        );
    }
    
    
    public function personalDataUpdate(Request $request)
    {
        $edit = Doctor::findOrFail($request->doctorId);
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/doctors/photo';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  = $file_nameone;
        }else{
            $edit->photo  = $edit->photo; 
        }

        if($file2=$request->file('personality_photo'))
        {  
            $file2 = $request->file('personality_photo');
            $file_nameone2 = time() . '.' . $request->file('personality_photo')->extension();
            $filePath2 = 'assets_admin/img/doctors/photo';
            $file2->move($filePath2, $file_nameone2);
            $edit->personality_photo  = $file_nameone2;  
        }else{
            $edit->personality_photo  = $edit->personality_photo;
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

        if(isset($request->mobile)){
            $edit->mobile  = $request->mobile;  
        }else{
            $edit->mobile  = $edit->mobile; 
        } 
        
        if(isset($request->state)){
            $edit->state  = $request->state;  
        }else{
            $edit->state  = $edit->state; 
        }
        if(isset($request->gender)){
            $edit->gender  = $request->gender;  
        }else{
            $edit->gender  = $edit->gender; 
        } 

        if(isset($request->type)){
            $edit->type  = $request->type;  
        }else{
            $edit->type  = $edit->type; 
        } 

        if(isset($request->longitude)){
            $edit->longitude  = $request->longitude;  
        }else{
            $edit->longitude  = $edit->longitude; 
        }

        if(isset($request->latitude)){
            $edit->latitude  = $request->latitude;  
        }else{
            $edit->latitude  = $edit->latitude; 
        } 

        if(isset($request->dateOfBirth  )){
            $edit->dateOfBirth  = $request->dateOfBirth;  
        }else{
            $edit->dateOfBirth  = $edit->dateOfBirth; 
        } 

        if(isset($request->personality_number)){
            $edit->personality_number  = $request->personality_number;  
        }else{
            $edit->personality_number  = $edit->personality_number; 
        } 
         if(isset($request->nationality)){
            $edit->nationality  = $request->nationality;  
        }else{
            $edit->nationality  = $edit->nationality; 
        }  
         if(isset($request->bio)){
            $edit->bio  = $request->bio;  
        }else{
            $edit->bio  = $edit->bio; 
        }  

        $edit-> save();
        // dd($edit->id);
        $doctor = Doctor::find($edit->id);
        
        $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
        $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
        $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
        foreach($doctor_certificate as $item)
        {
            $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
        }  
        

            
        
        $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();
        $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
        $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
        $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
        $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
        $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
        $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
        $countries= Country::selection()->where('id',$doctor->countryId)->first();
        $cities= City::selection()->where('id',$doctor->cityId)->first();
        $doctor_case =  Doctor_case::where('doctorId',$request->doctorId)->first();
            $doctor_not_status=$doctor_case->status_not;
            $doctor_servic_status=$doctor_case->status_servic;
            
            $home  = [  
                'doctor'=>$doctor,
                'doctor_bank'=>$doctor_bank,
                'doctor_certificate'=>$doctor_certificate, 
                'doctor_education'=>$doctor_education, 
                'doctor_insurance'=>$doctor_insurance, 
                'doctor_language'=>$doctor_language, 
                'doctor_license'=>$doctor_license, 
                'doctor_experience'=>$doctor_experience, 
                'doctor_license'=>$doctor_license, 
                'member_ship_types'=>$member_ship_types,
                'countries'=>$countries,
                'cities'=>$cities,
                'doctor_not_status'=>$doctor_not_status,
                'doctor_servic_status'=>$doctor_servic_status,

            ];       
        
         if(isset($request->lang)  && $request->lang == 'en' ){
            return $this -> returnDataa('data' , $home,'weferg');
        }else{
            return $this -> returnDataa('data' , $home,'weferg');
        } 
    }
    
    public function locationUpdate(Request $request)
    {
        $edit = Doctor::findOrFail($request->doctorId);
        

        
        if(isset($request->longitude)){
            $edit->longitude  = $request->longitude;  
        }else{
            $edit->longitude  = $edit->longitude; 
        }

        if(isset($request->latitude)){
            $edit->latitude  = $request->latitude;  
        }else{
            $edit->latitude  = $edit->latitude; 
        } 

        $edit-> save();
        $doctor = Doctor::find($edit->id);
        
        $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
        $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
        $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
        foreach($doctor_certificate as $item)
        {
            $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
        } 
        $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
        $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
        $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
        $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
        $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
        $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
        $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
        $countries= Country::selection()->where('id',$doctor->countryId)->first();
        $cities= City::selection()->where('id',$doctor->cityId)->first();
        $doctor_case =  Doctor_case::where('doctorId',$request->doctorId)->first();
            $doctor_not_status=$doctor_case->status_not;
            $doctor_servic_status=$doctor_case->status_servic;
            
            $home  = [  
                'doctor'=>$doctor,
                'doctor_bank'=>$doctor_bank,
                'doctor_certificate'=>$doctor_certificate, 
                'doctor_education'=>$doctor_education, 
                'doctor_insurance'=>$doctor_insurance, 
                'doctor_language'=>$doctor_language, 
                'doctor_license'=>$doctor_license, 
                'doctor_experience'=>$doctor_experience, 
                'doctor_license'=>$doctor_license, 
                'member_ship_types'=>$member_ship_types,
                'countries'=>$countries,
                'cities'=>$cities,
                'doctor_not_status'=>$doctor_not_status,
                'doctor_servic_status'=>$doctor_servic_status,

            ];       
        
         if(isset($request->lang)  && $request->lang == 'en' ){
            return $this -> returnDataa('data' , $home,'weferg');
        }else{
            return $this -> returnDataa('data' , $home,'weferg');
        } 
    }

    public function certificatesUpdate(Request $request)
    {   
        
        $certificat = Doctor_certificate::where('doctorId',$request->doctorId)->get();
        foreach($certificat as $item)
        {
            $delete = Doctor_certificate::find($item->id);
            $delete->delete();            
        }   
        
        
        // if($request->file)
        // {
        //     $data=$request->file;
        //     foreach($data as $_file)
        //     {   
        //         $file_extension = $_file['file'] -> getClientOriginalExtension();
        //         $file_name = time().'.'.$file_extension;
        //         $file_nameone = $file_name;
        //         $path = 'assets_admin/img/doctors/photo';
        //         $request-> file('photo') ->move($path,$file_name);
                
                
                
        //         $add_certificate= new Doctor_certificate;
        //         $add_certificate->doctorId  = $request->doctorId;
        //         $add_certificate->file  =  $file_nameone;                    
        //         $add_certificate->save();
        //     }
            
        // }
        
        
        if($request->file)
        {
            
            foreach($request->file('file') as $file)
            {
                $file_extension = $file -> getClientOriginalExtension();
                $file_name = time().rand(1,100).'.'.$file_extension;
                $file->move('assets_admin/img/doctors/certificate/', $file_name);   
                $data[] = $file_name;  
            }
            $length_file = count($data);
            if($length_file > 0)
            {
                for($i=0; $i<$length_file; $i++)
                {
                    $edit= new Doctor_certificate;
                    $edit->doctorId  = $request->doctorId;
                    $edit->file  = $data[$i];                    
                    $edit->save();
                }
            }
        }
        // dd('cccccc');
        // /// lang /////////////
        $language = Doctor_language::where('doctorId',$request->doctorId)->get();
        foreach($language as $item)
        {
            $delete = Doctor_language::find($item->id);
            $delete->delete();            
        }            
        if(isset($request->languageId))
        {
            $length_lang = count($request->languageId);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit_language= new Doctor_language;
                    $edit_language->doctorId  = $request->doctorId;
                    $edit_language->languageId  = $request->languageId[$i];                    
                    $edit_language->save();
                }
            }
        }

        // /////experience//////////
        $experience = Doctor_experience::where('doctorId',$request->doctorId)->get();
        foreach($experience as $item)
        {
            $delete = Doctor_experience::find($item->id);
            $delete->delete();            
        }            

        if(isset($request->year))
        {
            $length_lang = count($request->year);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit_experience= new Doctor_experience;
                    $edit_experience->doctorId  = $request->doctorId;
                    $edit_experience->year  = $request->year[$i];
                    $edit_experience->organization  = $request->organization[$i];
                    $edit_experience->from  = $request->from[$i]; 
                    $edit_experience->to  = $request->to[$i];      
                    $edit_experience->job_title  = $request->job_title[$i];
                    $edit_experience->job_desc  = $request->job_desc[$i];                    

                    $edit_experience->save();
                }
            }
        }

        /// education /////
         $lang = Doctor_education::where('doctorId',$request->doctorId)->get();
        foreach($lang as $item)
        {
            $delete = Doctor_education::find($item->id);
            $delete->delete();            
        }            

        if(isset($request->degree))
        {
            $length_lang = count($request->degree);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit= new Doctor_education;
                    $edit->doctorId  = $request->doctorId;
                    $edit->degree  = $request->degree[$i];
                    $edit->speciality  = $request->speciality[$i];   
                    $edit->degreeId  = $request->degreeId[$i];
                    $edit->name  = $request->name[$i];

                    $edit->save();
                }
            }
        }
        
        

        //// insurance //////////
        $insurance = Doctor_insurance::where('doctorId',$request->doctorId)->get();
        foreach($insurance as $item)
        {
            $delete = Doctor_insurance::find($item->id);
            $delete->delete();            
        }            

        if(isset($request->name))
        {
            $length_lang = count($request->name_insurance);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit_insurance= new Doctor_insurance;
                    $edit_insurance->doctorId  = $request->doctorId;
                    $edit_insurance->companies_insuranceId  = $request->companies_insuranceId[$i];
                    $edit_insurance->name  = $request->name_insurance[$i];
                    $edit_insurance->type  = $request->type[$i]; 
                    $edit_insurance->number  = $request->number[$i];        
                    $edit_insurance->date  = $request->date[$i];            
                    $edit_insurance->save();
                }
            }
        }


        //// license /////////
        $license = Doctor_license::where('doctorId',$request->doctorId)->get();
        foreach($license as $item)
        {
            $delete = Doctor_license::find($item->id);
            $delete->delete();            
        }            

        if(isset($request->name_license))
        {
            // $length_lang = count($request->name_license);
            // if($length_lang > 0)
            // {
            //     for($i=0; $i<$length_lang; $i++)
            //     {
            //         $edit_license= new Doctor_license;
            //         $edit_license->doctorId  = $request->doctorId;
            //         $edit_license->placeLicensesId  = $request->placeLicensesId[$i];
            //         $edit_license->num  = $request->num_license[$i]; 
            //         $edit_license->name  = $request->name_license[$i];        
            //         $edit_license->save();
            //     }
            // }
            $edit_license= new Doctor_license;
                    $edit_license->doctorId  = $request->doctorId;
                    $edit_license->placeLicensesId  = $request->placeLicensesId;
                    $edit_license->placeLicensesName  = $request->placeLicensesName;
                    $edit_license->num  = $request->num_license; 
                    $edit_license->name  = $request->name_license;        
                    $edit_license->save();
        }
        
         
        $doctor = Doctor::find($request->doctorId);
        $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
        $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
        $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
        foreach($doctor_certificate as $item)
        {
            $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
        } 
        $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
        $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
        $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
        $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
        $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
        $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
        $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
        $countries= Country::selection()->where('id',$doctor->countryId)->first();
        $cities= City::selection()->where('id',$doctor->cityId)->first();
        $doctor_case =  Doctor_case::where('doctorId',$request->doctorId)->first();
            $doctor_not_status=$doctor_case->status_not;
            $doctor_servic_status=$doctor_case->status_servic;
            
            $home  = [  
                'doctor'=>$doctor,
                'doctor_bank'=>$doctor_bank,
                'doctor_certificate'=>$doctor_certificate, 
                'doctor_education'=>$doctor_education, 
                'doctor_insurance'=>$doctor_insurance, 
                'doctor_language'=>$doctor_language, 
                'doctor_license'=>$doctor_license, 
                'doctor_experience'=>$doctor_experience, 
                'doctor_license'=>$doctor_license, 
                'member_ship_types'=>$member_ship_types,
                'countries'=>$countries,
                'cities'=>$cities,
                'doctor_not_status'=>$doctor_not_status,
                'doctor_servic_status'=>$doctor_servic_status,

            ];
        
        if(isset($request->lang)  && $request->lang == 'en' ){
            return $this -> returnDataa('data' , $home,'weferg');
        }else{
            return $this -> returnDataa('data' , $home,'weferg');
        } 
    }

    public function langUpdate(Request $request)
    {
        $lang = Doctor_language::all();
        foreach($lang as $item)
        {
            $delete = Doctor_language::find($item->id);
            $delete->delete();            
        }            
        if(isset($request->languageId))
        {
            $length_lang = count($request->languageId);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit= new Doctor_language;
                    $edit->doctorId  = $request->doctorId;
                    $edit->languageId  = $request->languageId[$i];                    
                    $edit->save();
                }
            }
        }

        // $langs = Doctor_language::where('doctorId',$request->doctorId)->get();
        
            
        $doctor = Doctor::find($request->doctorId);
        $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
        $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
        $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
        foreach($doctor_certificate as $item)
        {
            $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
        } 
        $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
        $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
        $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
        $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
        $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
        $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
        $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
        $countries= Country::selection()->where('id',$doctor->countryId)->first();
        $cities= City::selection()->where('id',$doctor->cityId)->first();
        
        
        $home  = [  
            'doctor'=>$doctor,
            'doctor_bank'=>$doctor_bank,
            'doctor_certificate'=>$doctor_certificate, 
            'doctor_education'=>$doctor_education, 
            'doctor_insurance'=>$doctor_insurance, 
            'doctor_language'=>$doctor_language, 
            'doctor_license'=>$doctor_license, 
            'doctor_experience'=>$doctor_experience, 
            'doctor_license'=>$doctor_license, 
            'member_ship_types'=>$member_ship_types,
            'countries'=>$countries,
            'cities'=>$cities,
        ];
        if(isset($request->lang)  && $request->lang == 'en' ){
            return $this -> returnDataa('data' , $home,'weferg');
        }else{
            return $this -> returnDataa('data' , $home,'weferg');
        } 
    }

    public function serviceUpdate(Request $request)
    {
        $lang = Doctor_service::all();
        foreach($lang as $item)
        {
            $delete = Doctor_service::find($item->id);
            $delete->delete();            
        }            

        if(isset($request->price))
        {
            $length_lang = count($request->price);
            if($length_lang > 0)
            {
                for($i=0; $i<$length_lang; $i++)
                {
                    $edit= new Doctor_service;
                    $edit->doctorId  = $request->doctorId;
                    $edit->categoryId  = $request->categoryId[$i];
                    $edit->price  = $request->price[$i];
                    $edit->gender  = $request->gender[$i];                    
                    $edit->save();
                }
            }
        }
        
        $service = Doctor_service::where('doctorId',$request->doctorId)->get();
        
        
        
        if(isset($request->lang)  && $request->lang == 'en' ){
            return $this -> returnDataa('data' , $service,'weferg');
        }else{
            return $this -> returnDataa('data' , $service,'weferg');
        } 
    } 

    // public function experienceUpdate(Request $request)
    // {

    //     // dd($request->all());
    //     $lang = Doctor_experience::all();
    //     foreach($lang as $item)
    //     {
    //         $delete = Doctor_experience::find($item->id);
    //         $delete->delete();            
    //     }            

    //     if(isset($request->year))
    //     {
    //         $length_lang = count($request->year);
    //         if($length_lang > 0)
    //         {
    //             for($i=0; $i<$length_lang; $i++)
    //             {
    //                 $edit= new Doctor_experience;
    //                 $edit->doctorId  = $request->doctorId;
    //                 $edit->year  = $request->year[$i];
    //                 $edit->organization  = $request->organization[$i];
    //                 $edit->from  = $request->from[$i]; 
    //                 $edit->to  = $request->to[$i];      
    //                 $edit->job_title  = $request->job_title[$i];
    //                 $edit->job_desc  = $request->job_desc[$i];                    

    //                 $edit->save();
    //             }
    //         }
    //     }
        
    //     // $experience = Doctor_experience::where('doctorId',$request->doctorId)->get();
        
            
    //     $doctor = Doctor::find($request->doctorId);
    //     $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
    //     $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
    //     $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
    //     foreach($doctor_certificate as $item)
    //     {
    //         $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
    //     } 
        
    //     $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
    //     $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
    //     $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
    //     $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
    //     $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
    //     $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
    //     $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
    //     $countries= Country::selection()->where('id',$doctor->countryId)->first();
    //     $cities= City::selection()->where('id',$doctor->cityId)->first();
        
        
    //     $home  = [  
    //         'doctor'=>$doctor,
    //         'doctor_bank'=>$doctor_bank,
    //         'doctor_certificate'=>$doctor_certificate, 
    //         'doctor_education'=>$doctor_education, 
    //         'doctor_insurance'=>$doctor_insurance, 
    //         'doctor_language'=>$doctor_language, 
    //         'doctor_license'=>$doctor_license, 
    //         'doctor_experience'=>$doctor_experience, 
    //         'doctor_license'=>$doctor_license, 
    //         'member_ship_types'=>$member_ship_types,
    //         'countries'=>$countries,
    //         'cities'=>$cities,
    //     ];
        
    //     if(isset($request->lang)  && $request->lang == 'en' ){
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }else{
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     } 
    // }    


    // public function educationUpdate(Request $request)
    // {
    //     $lang = Doctor_education::all();
    //     foreach($lang as $item)
    //     {
    //         $delete = Doctor_education::find($item->id);
    //         $delete->delete();            
    //     }            

    //     if(isset($request->name))
    //     {
    //         $length_lang = count($request->name);
    //         if($length_lang > 0)
    //         {
    //             for($i=0; $i<$length_lang; $i++)
    //             {
    //                 $edit= new Doctor_education;
    //                 $edit->doctorId  = $request->doctorId;
    //                 $edit->degreeId  = $request->degreeId[$i];
    //                 $edit->name  = $request->name[$i];
    //                 $edit->degree  = $request->degree[$i]; 
    //                 $edit->speciality  = $request->speciality[$i];                    
    //                 $edit->save();
    //             }
    //         }
    //     }
        
    //     // $service = Doctor_education::where('doctorId',$request->doctorId)->get();
        
    //     $doctor = Doctor::find($request->doctorId);
    //     $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
    //     $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
    //     $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
    //     foreach($doctor_certificate as $item)
    //     {
    //         $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
    //     } 
    //     $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
    //     $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
    //     $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
    //     $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
    //     $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
    //     $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
    //     $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
    //     $countries= Country::selection()->where('id',$doctor->countryId)->first();
    //     $cities= City::selection()->where('id',$doctor->cityId)->first();
        
        
    //     $home  = [  
    //         'doctor'=>$doctor,
    //         'doctor_bank'=>$doctor_bank,
    //         'doctor_certificate'=>$doctor_certificate, 
    //         'doctor_education'=>$doctor_education, 
    //         'doctor_insurance'=>$doctor_insurance, 
    //         'doctor_language'=>$doctor_language, 
    //         'doctor_license'=>$doctor_license, 
    //         'doctor_experience'=>$doctor_experience, 
    //         'doctor_license'=>$doctor_license, 
    //         'member_ship_types'=>$member_ship_types,
    //         'countries'=>$countries,
    //         'cities'=>$cities,
    //     ];
        
    //     if(isset($request->lang)  && $request->lang == 'en' ){
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }else{
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     } 
    // } 

    // public function insuranceUpdate(Request $request)
    // {
    //     $lang = Doctor_insurance::all();
    //     foreach($lang as $item)
    //     {
    //         $delete = Doctor_insurance::find($item->id);
    //         $delete->delete();            
    //     }            

    //     if(isset($request->name))
    //     {
    //         $length_lang = count($request->name);
    //         if($length_lang > 0)
    //         {
    //             for($i=0; $i<$length_lang; $i++)
    //             {
    //                 $edit= new Doctor_insurance;
    //                 $edit->doctorId  = $request->doctorId;
    //                 $edit->companies_insuranceId  = $request->companies_insuranceId[$i];
    //                 $edit->name  = $request->name[$i];
    //                 $edit->type  = $request->type[$i]; 
    //                 $edit->number  = $request->number[$i];        
    //                 $edit->date  = $request->date[$i];            
    //                 $edit->save();
    //             }
    //         }
    //     }
        
    //     // $service = Doctor_insurance::where('doctorId',$request->doctorId)->get();
        
    //     $doctor = Doctor::find($request->doctorId);
    //     $doctor->photo= "https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo;
    //     $doctor->personality_photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->personality_photo;
    //     $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
    //     foreach($doctor_certificate as $item)
    //     {
    //         $item->file="https://findfamily.net/care/assets_admin/img/doctors/certificate/".$item->file;
    //     } 
    //     $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
    //     $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
    //     $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
    //     $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
    //     $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
    //     $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
    //     $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
    //     $countries= Country::selection()->where('id',$doctor->countryId)->first();
    //     $cities= City::selection()->where('id',$doctor->cityId)->first();
        
    //     $home  = [  
    //         'doctor'=>$doctor,
    //         'doctor_bank'=>$doctor_bank,
    //         'doctor_certificate'=>$doctor_certificate, 
    //         'doctor_education'=>$doctor_education, 
    //         'doctor_insurance'=>$doctor_insurance, 
    //         'doctor_language'=>$doctor_language, 
    //         'doctor_license'=>$doctor_license, 
    //         'doctor_experience'=>$doctor_experience, 
    //         'doctor_license'=>$doctor_license, 
    //         'member_ship_types'=>$member_ship_types,
    //         'countries'=>$countries,
    //         'cities'=>$cities,
    //     ];
        
    //     if(isset($request->lang)  && $request->lang == 'en' ){
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }else{
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     } 
    // } 



    // public function licenseUpdate(Request $request)
    // {
    //     $lang = Doctor_license::all();
    //     foreach($lang as $item)
    //     {
    //         $delete = Doctor_license::find($item->id);
    //         $delete->delete();            
    //     }            

    //     if(isset($request->name))
    //     {
    //         $length_lang = count($request->name);
    //         if($length_lang > 0)
    //         {
    //             for($i=0; $i<$length_lang; $i++)
    //             {
    //                 $edit= new Doctor_license;
    //                 $edit->doctorId  = $request->doctorId;
    //                 $edit->placeLicensesId  = $request->placeLicensesId[$i];
    //                 $edit->place  = $request->place[$i];
    //                 $edit->num  = $request->num[$i]; 
    //                 $edit->name  = $request->name[$i];        
    //                 $edit->save();
    //             }
    //         }
    //     }
        
    //     // $service = Doctor_license::where('doctorId',$request->doctorId)->get();
           
    //     $doctor = Doctor::find($request->doctorId);
    //     $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
    //     $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
    //     $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
    //     $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
    //     $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
    //     $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
    //     $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
    //     $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
    //     $countries= Country::selection()->where('id',$doctor->countryId)->first();
    //     $cities= City::selection()->where('id',$doctor->cityId)->first();
        
    //     $home  = [  
    //         'doctor'=>$doctor,
    //         'doctor_bank'=>$doctor_bank,
    //         'doctor_certificate'=>$doctor_certificate, 
    //         'doctor_education'=>$doctor_education, 
    //         'doctor_insurance'=>$doctor_insurance, 
    //         'doctor_language'=>$doctor_language, 
    //         'doctor_license'=>$doctor_license, 
    //         'doctor_experience'=>$doctor_experience, 
    //         'doctor_license'=>$doctor_license, 
    //         'member_ship_types'=>$member_ship_types,
    //         'countries'=>$countries,
    //         'cities'=>$cities,
    //     ];
        
    //     if(isset($request->lang)  && $request->lang == 'en' ){
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }else{
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }
    // } 
    
    //  public function bankUpdate(Request $request)
    // {
    //     $doctorbank = Doctor_bank::where('doctorId',$request->doctorId)->get();
    //     foreach($doctorbank as $item)
    //     {
    //         $delete = Doctor_bank::find($item->id);
    //         $delete->delete();            
    //     }            

    //     if(isset($request->name))
    //     {
    //         $edit= new Doctor_bank;
    //         $edit->doctorId  = $request->doctorId;
    //         $edit->countryId  = $request->countryId;                    
    //         $edit->cityId  = $request->cityId;                    
    //         $edit->name_acount  = $request->name_acount;
    //         $edit->name  = $request->name;                    
    //         $edit->number  = $request->number;                    
    //         $edit->International_bank_number  = $request->International_bank_number;                    
    //         $edit->swift_code  = $request->swift_code;
    //         $edit->transit_number  = $request->transit_number;
    //         $edit->save();       
    //     }
        
    //     // $service = Doctor_license::where('doctorId',$request->doctorId)->get();
           
    //     $doctor = Doctor::find($request->doctorId);
    //     $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
    //     $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
    //     $doctor_education =  Doctor_education::where('doctorId',$request->doctorId)->get();
    //     $doctor_insurance =  Doctor_insurance::where('doctorId',$request->doctorId)->get();
    //     $doctor_language =  Doctor_language::where('doctorId',$request->doctorId)->get();            
    //     $doctor_experience =  Doctor_experience::where('doctorId',$request->doctorId)->get();
    //     $doctor_license =   Doctor_license::where('doctorId',$request->doctorId)->first();
    //     $member_ship_types = Member_ship_type::where('id',$doctor->membershipTypeId)->first(); 
    //     $countries= Country::selection()->where('id',$doctor->countryId)->first();
    //     $cities= City::selection()->where('id',$doctor->cityId)->first();
        
    //     $home  = [  
    //         'doctor'=>$doctor,
    //         'doctor_bank'=>$doctor_bank,
    //         'doctor_certificate'=>$doctor_certificate, 
    //         'doctor_education'=>$doctor_education, 
    //         'doctor_insurance'=>$doctor_insurance, 
    //         'doctor_language'=>$doctor_language, 
    //         'doctor_license'=>$doctor_license, 
    //         'doctor_experience'=>$doctor_experience, 
    //         'doctor_license'=>$doctor_license, 
    //         'member_ship_types'=>$member_ship_types,
    //         'countries'=>$countries,
    //         'cities'=>$cities,
    //     ];
        
    //     if(isset($request->lang)  && $request->lang == 'en' ){
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }else{
    //         return $this -> returnDataa('data' , $home,'weferg');
    //     }
    // } 


    public function change_password(Request $request)
    {

        // $gg= Auth::guard('doctor-api')->user();
        // dd($gg);
        $input = $request->all();
        $userid = Doctor::where("id" , $request->doctorId)->first();
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
                if ((Hash::check(request('old_password'), $userid->password)) == false) {
                    $arr = array("status" => 400, "message" => "Check your old password.", "data" => array());
                } else if ((Hash::check(request('new_password'), $request->password)) == true) {
                    $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                } else {
                     $userid->password  = Hash::make($input['new_password']);
                     $userid->save();
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
                 
                 $doctorss= Doctor::where('email',$request->email)->first();
                if($doctorss==null){
                    return $this -> returnError('البريد الإلكتروني غير موجود');
                }else{
                    // $user->registartionId = str_rand(6 only digit)->unique;

                    $gene = mt_rand(1000000000, 9999999999);
                    $doctorss->password = bcrypt($gene);
                    // str_rand(8)->make_bcrypt->unique;
                    $doctorss->save();
                   
                    $details = [
                        'title' => 'Password of Esptalia',
                        'body' => 'cope this password to enter Esptalia ' ." " . $gene . " "
                    ];
                   
                
                    Mail::to($request->email)->send(new \App\Mail\SendEmail($details));

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
