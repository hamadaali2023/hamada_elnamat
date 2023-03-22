<?php

namespace App\Http\Controllers\Api\Doctor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Banner;
use App\Article;
use App\Category;
use App\Doctor;
use App\Patient;
use App\Doctor_service;
use App\Degree;
use App\SubCategory;

use App\Work_days;
use App\Day;
use App\Time;

use App\Doctor_bank;
use App\Doctor_certificate;
use App\Doctor_education;
use App\Doctor_insurance;
use App\Doctor_language;
use App\Doctor_license;
use App\Doctor_experience;
use App\PlaceIssuanceLicense;
use App\Companies_insurance;
use App\Member_ship_type;
use App\Country;
use App\City;
use App\Slider;
use App\Speciality;
use App\Service;
use App\Offer;
use App\Payment;
use App\Appointment;
use App\Diagnostic;
use Carbon\Carbon;
use App\Traits\GeneralTrait;
use DateTime;
use DB;
use App\Doctor_case;

class HomeController extends Controller
{
    use GeneralTrait;
    // public function index(Request $request)
    // {
        
    //     $workday= WorkingDays::where('doctorId',$request->doctorId)->first();
    //      $todayDate = date("Y-m-d");
         
    //     $appoint_morning=Appointment::where('doctorId',$request->doctorId)
    //                                  ->where('permanent_type','AM')
    //                                  ->where('date',$todayDate)
    //                                  ->where('status','confirmed')
    //                                  ->where('payment_status',1)
    //                                  ->where('doctorId',$request->doctorId)
    //                                  ->orderBy('id', 'DESC')->get();
    //     foreach ($appoint_morning as $item) {
    //         $item->patient= Patient::selection()->where('id',$item->patientId)->first();
    //     }
    //     $count_morning= count($appoint_morning);
        
    //     $appoint_after=Appointment::where('doctorId',$request->doctorId)
    //                                 ->where('permanent_type','AF')
    //                                 ->where('date',$todayDate)
    //                                 ->where('status','confirmed')
    //                                 ->where('payment_status',1)
    //                                 ->orderBy('id', 'DESC')->get();
    //     foreach ($appoint_after as $item) {
    //         $item->patient= Patient::selection()->where('id',$item->patientId)->first();
    //     }
    //             // dd($appoint_after);

    //     $count_after= count($appoint_after);
    //     $appoint_evening=Appointment::where('doctorId',$request->doctorId)
    //                                     ->where('permanent_type','PM')
    //                                     ->where('date',$todayDate)
    //                                     ->where('status','confirmed')
    //                                     ->where('payment_status',1)
    //                                     ->orderBy('id', 'DESC')->get();
    //     foreach ($appoint_evening as $item) {
    //         $item->patient= Patient::selection()->where('id',$item->patientId)->first();
    //     }
    //     $count_evening= count($appoint_after);
    //     $offers = Offer::selection()->where('doctorId',$request->doctorId)->orderBy('id', 'DESC')->get();        
    //     $articles = Article::selection()->where('doctorId',$request->doctorId)->get();  
    //     foreach ($articles as $item) {
    //         $item->specialityName= Speciality::selection()->where('id',$item->specialityId)->first();     
    //     }  
    //     $home  =[  
    //                 'appoint_morning'=>$appoint_morning,
    //                 'appoint_after'=>$appoint_after,
    //                 'appoint_evening'=>$appoint_evening,
    //                 'workday'=> $workday,
    //                 'count_morning'=> $count_morning,
    //                 'count_after'=> $count_after,
    //                 'count_evening'=> $count_evening,
    //                 'offers'=>$offers,
    //                 'articles'=>$articles,
    //             ];
    //     return $this -> returnData('home',$home);
    // }


    public function getcount()
    {    
        $categotries = Category::all();
        $doctor = Doctor::all();
        $patient = Patient::all();
        $categotries= count($categotries);
        $doctor= count($doctor);
        $patient= count($patient);
        $home  = [  
                    'categotries'=>$categotries,
                    'doctor'=>$doctor,
                    'patient'=>$patient,                  
                ];
        return $this -> returnDataa(
            'data',$home,'frf'
        );
    } 

     public function degrees(Request $request)
    {
            $degree = Degree::selection()->get(); 
            
            return $this->returnDataa('data', $degree,'vrev');
    }
    
    public function companies_insurance(Request $request)
    {
        $companies_insurance = companies_insurance::selection()->get(); 
        return $this->returnDataa('data', $companies_insurance,'fwr');
    }
    public function MyServices(Request $request)
    {
        // dd('erfefr');
        $myservices=Doctor_service::where('doctorId',$request->doctorId)->where('categoryId',$request->categoryId)->get();

        foreach ($myservices as $item) {
            $item->subcategory= SubCategory::selection()->where('id',$item->subCategoryId)->first();
            //  $item->notselectedservice= SubCategory::selection()
            //                                       ->where('id','!=',$item->subCategoryId)->get();
        }

        $notselectedservice=[];
        $sub= SubCategory::get();
        foreach ($sub as $_item) {  
            $mys=Doctor_service::where('subCategoryId',$_item->id)->first();
            if($mys){
               
            }else{
                $notselectedservice[]= SubCategory::selection()->where('categoryId',$request->categoryId)
                                                  ->where('id',$_item->id)->first();
            }
        }    
        // dd($notselectedservice);
        $home  =[  
            'myservices'=>$myservices,
            'notselectedservice'=>$notselectedservice,
        ];
        return $this -> returnDataa('data',$home,'lnkj');
    }
   public function addNewService(Request $request)
    {
        $checservice = Doctor_service::where('doctorId',$request->doctorId)->where('categoryId',$request->categoryId)->first();
        if($checservice){
            $checservice->delete();
        }
        
        $length = count($request->subCategoryId);
                if($length > 0)
                {
                    for($i=0; $i<$length; $i++)
                   {
                    $add = new Doctor_service;
                    $add->doctorId    = $request->doctorId;
                    $add->categoryId  = $request->categoryId;
                    $add->subCategoryId  = $request->subCategoryId[$i];
                    $add->price  = $request->price[$i];
                    $add->gender  = $request->gender[$i];
                    $add->save();
                   }
                   
                }
        
        if(isset($request -> lang)  && $request -> lang == 'en' ){
            return $this -> returnSuccessMessage('added Successfully ');
        }else{
            return $this -> returnSuccessMessage('تم الاضافة بنجاح');
        }

    }
    
    public function MyServicesCount(Request $request)
    {
        $services_not_verified=Doctor_service::where('doctorId',$request->doctorId)
                                
                                ->where('status','not verified')
                                ->get();

        $services_verified=Doctor_service::where('doctorId',$request->doctorId)
                                
                                ->where('status','verified')
                                ->get(); 
        $allservices=Doctor_service::where('doctorId',$request->doctorId)
                               
                                ->get();                         
        $subcategory=[];

        foreach ($allservices as $item) {
            $subcategory= SubCategory::selection()
                                                  ->where('id',"!=",$item->subCategoryId)->get();
        }
        // dd($subcategory);
        $services_not_verified_count= count($services_not_verified);
        $services_verified_count= count($services_verified);
        $subcategory_count= count($subcategory);
        $home  =[  
            'services_not_verified_count'=>$services_not_verified_count,
            'services_verified_count'=>$services_verified_count,
            'subcategory_count'=>$subcategory_count,
        ];
        return $this -> returnDataa('data',$home,'fref');
    }
    
    public function getWorkDays(Request $request)
    {
        $work_days = Work_days::where('doctorId',$request->doctorId)->first();
        $days= Day::where('work_dayId',$work_days->id)->first();
        $times=Time::where('work_dayId',$work_days->id)->first();
        
        $home  = [  
            'work_days'=>$work_days,
            'days'=>$days,
            'times'=>$times, 
        ];        
         return $this->returnDataa('data', $home,'vrev');
    }
    public function addWorkDays(Request $request)
    {
        // dd($request->doctorId);
        $checkworkday = Work_days::where('doctorId',$request->doctorId)->first();
        // dd($checkworkday);
        if($checkworkday !=null){
            $checkworkday->delete();
            $add = new Work_days;
            $add->doctorId  = $request->doctorId;
            // $add->from_date  = $request->from_date;
            // $add->to_date  = $request->to_date;
            // $add->duration =$request->duration;
            $add->save();

            $day = new Day;
            $day->work_dayId = $add->id;
            $day->sat  = $request->sat;
            $day->sun  = $request->sun;
            $day->mon  = $request->mon;
            $day->tus  = $request->tus;
            $day->wed  = $request->wed;
            $day->thu  = $request->thu;
            $day->fri  = $request->fri;
            $day->save();

            $time = new Time;
            $time->work_dayId  = $add->id;
            $time->from_time  = $request->from_time;
            $time->to_time  = $request->to_time;
            $time->save();
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Saved successfully');
            }else{
                return $this -> returnSuccessMessage('تم الحفظ بنجاح');
            }
        }else{
            $add = new Work_days;
            $add->doctorId  = $request->doctorId;
            $add->save();

            $day = new Day;
            $day->work_dayId = $add->id;
            $day->sat  = $request->sat;
            $day->sun  = $request->sun;
            $day->mon  = $request->mon;
            $day->tus  = $request->tus;
            $day->wed  = $request->wed;
            $day->thu  = $request->thu;
            $day->fri  = $request->fri;
            $day->save();

            $time = new Time;
            $time->work_dayId  = $add->id;
            $time->from_time  = $request->from_time;
            $time->to_time  = $request->to_time;
            $time->save();
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Saved successfully');
            }else{
                return $this -> returnSuccessMessage('تم الحفظ بنجاح');
            }
        }
    }
    
    
    public function doctorNotStatus(Request $request)
    {
        $changstatus = Doctor_case::where('doctorId',$request->doctorId)->first();

        if($changstatus !=null){
            $changstatus->status_not  = $request->status_not;
            $changstatus->save();
        }else{
            $add = new Doctor_not;
            $add->status_not  = $request->status_not;
            $add->save();
        }
            $doctor = Doctor::where('id',$request->doctorId)->first();
            $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
            $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
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
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnDataa('data',$home,'done');
        }else{
            return $this -> returnDataa('data',$home,'تم الحفظ');
        }  
    }

    public function doctorServicStatus(Request $request)
    {
        $changstatus = Doctor_case::where('doctorId',$request->doctorId)->first();

        if($changstatus !=null){
            $changstatus->status_servic  = $request->status_servic;
            $changstatus->save();
        }else{
            $add = new Doctor_case;
            $add->status_servic  = $request->status_servic;
            $add->doctorId  = $request->doctorId;
            $add->save();
        }


            $doctor = Doctor::where('id',$request->doctorId)->first();
            $doctor_bank = Doctor_bank::where('doctorId',$request->doctorId)->first();  
            $doctor_certificate =  Doctor_certificate::where('doctorId',$request->doctorId)->get();
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
        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnDataa('data',$home,'done');
        }else{
            return $this -> returnDataa('data',$home,'تم الحفظ');
        } 


        
    }    
 
    
//     public function EditApointment(Request $request)
//     {
//         $edit = Work_days::findOrFail($request->apointmentId);
//         // $edit->from_date  = $request->from_date;
//         // $edit->to_date  = $request->to_date;
//         // $edit->duration =$request->duration;
//         $edit->save();


//         $day = Day::where('work_dayId',$edit->id)->first();
//         $day->sat  = $request->sat;
//         $day->sun  = $request->sun;
//         $day->mon  = $request->mon;
//         $day->tus  = $request->tus;
//         $day->wed  = $request->wed;
//         $day->thu  = $request->thu;
//         $day->fri  = $request->fri;
//         $day->save();

//         $time = Time::where('work_dayId',$edit->id)->first();
//         $time->work_dayId  = $edit->id;
//         $time->from_time  = $request->from_time;
//         $time->to_time  = $request->to_time;
//         $time->save();
        
//         if(isset($request -> lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('Updated Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم التعديل بنجاح');
//         }

//     }

//     public function getDoctorOffer(Request $request)
//     {
//         $offers = Offer::where('id',$request->offerId)->first();  
//         return $this -> returnData('offer',$offers);
//     }

//     public function getAppointmentById(Request $request)
//     {
//         $appoint_morning=Appointment::where('doctorId',$request->doctorId)
//                                      ->where('date',$request->date)
//                                      ->where('status','!=',"combledted")
//                                       ->where('status','!=',"absent")
//                                       ->where('payment_status',1)
//                                      ->where('permanent_type','AM')->get();
//         foreach ($appoint_morning as $item) {
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first();
//         }
        
        
//       $appoint_after=Appointment::where('doctorId',$request->doctorId)
//                                      ->where('date',$request->date)
//                                      ->where('status','!=',"combledted")
//                                       ->where('status','!=',"absent")
//                                       ->where('payment_status',1)
//                                      ->where('permanent_type','AF')->get();
//         foreach ($appoint_after as $item) {
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first();
//         }
      
//         $appoint_evening=Appointment::where('doctorId',$request->doctorId)
//                                      ->where('date',$request->date)
//                                      ->where('status','!=',"combledted")
//                                      ->where('status','!=',"absent")
//                                      ->where('payment_status',1)
//                                      ->where('permanent_type','PM')->get();
//         foreach ($appoint_evening as $item) {
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first();
//         }
//         $workday= WorkingDays::where('doctorId',$request->doctorId)->first();
      
//         $appointment  =[  
//                 'appoint_morning'=>$appoint_morning,
//                 'appoint_after'=>$appoint_after,
//                 'workday'=>$workday,
//                 'appoint_evening'=>$appoint_evening,
//         ];
//         return $this -> returnData(
//             'appointment',$appointment
//         );
//     }

    
    
    
//     public function updateServices(Request $request)
//     {
            
//             $edit = Service::findOrFail($request->id);
//             $edit->doctorId  = $request->doctorId;
//             $edit->price  = $request->price;
//             $edit->status  = $request->status;
//             $edit->update();
//             if(isset($request -> lang)  && $request -> lang == 'en' ){
//                 return $this -> returnSuccessMessage('Updated Successfully ');
//             }else{
//                 return $this -> returnSuccessMessage('تم التعديل بنجاح');
//             }
//             // dd($edit);
//             // if($file=$request->file('icon'))
//             // {
//             //     $file_extension = $request -> file('icon') -> getClientOriginalExtension();
//             //     $file_name = time().'.'.$file_extension;
//             //     $file_nameone = $file_name;
//             //     $path = 'assets_admin/img/services';
//             //     $request-> file('icon') ->move($path,$file_name);
//             //     $edit->icon  = $file_nameone;
//             // }else{
//             //     // $edit->icon  = $request->url; 
//             // }
//             // $edit->doctorId    = $edit->doctorId;
//             // $edit->services_name_ar  = $request->services_name_ar;
//             // $edit->services_name_en  = $request->services_name_en;
            
//     }

  
//     public function doctorSpecialities()
//     {
//         $speciality=Speciality::selection()->get();
//         return $this -> returnData(
//             'speciality',$speciality
//         );
//     }
//     public function addArticle(Request $request)
//     {
//         $file_extension = $request -> file('image') -> getClientOriginalExtension();
//         $file_name = time().'.'.$file_extension;
//         $file_nameone = $file_name;
//         $path = 'assets_admin/img/article';
//         $request-> file('image') ->move($path,$file_name);
        
//         $ghgth = new Article;
//         $ghgth->specialityId    = $request->specialityId;
//         $ghgth->doctorId    = $request->doctorId;
//         $ghgth->title_ar    = $request->title_ar;
//         $ghgth->title_en  = $request->title_ar;
//         $ghgth->description_ar  = $request->description_ar;
//         $ghgth->description_en  = $request->description_ar;
//         $ghgth->image    = $file_nameone;
//         $ghgth->save();   
//         if(isset($request -> lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('added Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم الاضافة بنجاح');
//         }
//     }
//       public function articleDelete(Request $request){
//         $cats = Article::find($request->id);
//         $cats->delete();
//         if(isset($request->lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('Deleted Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم الحذف بنجاح');
//         }
//     }
//     public function updateArticle(Request $request)
//     {
//         $edit = Article::findOrFail($request->id);
//         if($file=$request->file('image'))
//         {
//             $file_extension = $request -> file('image') -> getClientOriginalExtension();
//             $file_name = time().'.'.$file_extension;
//             $file_nameone = $file_name;
//             $path = 'assets_admin/img/offers';
//             $request-> file('image') ->move($path,$file_name);
//             $edit->image  = $file_nameone;
//         }else{
//             $edit->image  = $edit->image; 
//         }
//         // dd($file_nameone);
//       if($request->specialityId){
//             $edit->specialityId  = $request->specialityId;  
//         }else{
//             $edit->specialityId  = $edit->specialityId; 
//         } 
//         if($request->doctorId){
//             $edit->doctorId  = $request->doctorId;  
//         }else{
//             $edit->doctorId  = $edit->doctorId; 
//         } 
//         if($request->title_ar){
//             $edit->title_ar  = $request->title_ar;  
//         }else{
//             $edit->title_ar  = $edit->title_ar; 
//         } 
//         if($request->title_en){
//             $edit->title_en  = $request->title_ar;  
//         }else{
//             $edit->title_en  = $edit->title_en; 
//         }
//         if($request->description_ar){
//             $edit->description_ar  = $request->description_ar;  
//         }else{
//             $edit->description_ar  = $edit->description_ar; 
//         }
//         if($request->description_ar){
//             $edit->description_en  = $request->description_ar;  
//         }else{
//             $edit->description_en  = $edit->description_en; 
//         }

//         $edit->save();   
//          if(isset($request -> lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('Updated Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم التعديل بنجاح');
//         }
//     }

//     public function getDiagnosis(Request $request)
//     {
//         $diagnostics=Diagnostic::where('doctorId',$request->doctorId)->get();
//         // foreach ($diagnostics as $item) {
//         //     $item->patient= Patient::selection()->where('id',$item->patientId)->first();
//         // }
        
//          foreach ($diagnostics as $item) {
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first();
//             $item->sum=Payment::where('doctorId',$request->doctorId)
//                                 ->where('patientId',$request->patientId)
//                                 ->sum('amount');
//         }
//         return $this -> returnData('diagnostics',$diagnostics);
//     }
//     public function addDiagnosis(Request $request)
//     {
//         // $todayDate = date("Y-m-d");
//         // $time = date("H:i");
//         if($request->id==null){
//             $todayDate = date("Y-m-d");
//             $time = new DateTime();
//             $time->modify('+2 hours');
//             $ghgth = new Diagnostic;
//             $ghgth->doctorId      = $request->doctorId;
//             $ghgth->patientId     = $request->patientId;
//             $ghgth->appointmentId = $request->appointmentId;
//             $ghgth->weight    = $request->weight;
//             $ghgth->hight  = $request->hight;
//             $ghgth->blood  = $request->blood;
//             $ghgth->temp  = $request->temp;
//             $ghgth->complaint  = $request->complaint;
//             $ghgth->symptoms  = $request->symptoms;
//             $ghgth->diagnosis  = $request->diagnosis;
//             $ghgth->medicine  = $request->medicine;
//             $ghgth->date  = $todayDate;
//             $ghgth->time  = $time->format("H:i");
//             $ghgth->save();
            
//             $edit = Appointment::findOrFail($request->appointmentId);
//             $edit->status  = "combledted";//Completed
//             $edit->save();    
               
//             if(isset($request->lang)  && $request -> lang == 'en' ){
//                 return $this -> returnSuccessMessage('added Successfully ');
//             }else{
//                 return $this -> returnSuccessMessage('تم الاضافة بنجاح');
//             }
//         }else{
//             $todayDate = date("Y-m-d");
//             $time = new DateTime();
//             $time->modify('+2 hours');
//             // $ghgth = new Diagnostic;
//             $ghgth = Diagnostic::findOrFail($request->id);
//             $ghgth->doctorId    = $request->doctorId;
//             $ghgth->patientId    = $request->patientId;
//             $ghgth->weight    = $request->weight;
//             $ghgth->hight  = $request->hight;
//             $ghgth->blood  = $request->blood;
//             $ghgth->temp  = $request->temp;
//             $ghgth->complaint  = $request->complaint;
//             $ghgth->symptoms  = $request->symptoms;
//             $ghgth->diagnosis  = $request->diagnosis;
//             $ghgth->medicine  = $request->medicine;
//             $ghgth->date  = $todayDate;
//             $ghgth->time  = $time->format("H:i");
//             $ghgth->save();
//             // dd($ghgth);    
                
//             if(isset($request->lang)  && $request -> lang == 'en' ){
//                 return $this -> returnSuccessMessage('Updated Successfully ');
//             }else{
//                 return $this -> returnSuccessMessage('تم التعديل بنجاح');
//             }
//         }
        
//     }
//     public function appointmentStatus(Request $request)
//     {
//         $edit = Appointment::findOrFail($request->id);
//         $edit->status  = $request->status;
//         $edit->save();
//         if(isset($request->lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('Updated Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم التعديل بنجاح');
//         }
//     }

   
    

   
    
    
//     public function removeWorkingDays(Request $request){
//         $cats = WorkingDays::find($request->id);
//         $cats->delete();
//         if(isset($request->lang)  && $request -> lang == 'en' ){
//             return $this -> returnSuccessMessage('Deleted Successfully ');
//         }else{
//             return $this -> returnSuccessMessage('تم الحذف بنجاح');
//         }
//     }
//     public function updateApointment(Request $request)
//     {
//                 $edit = WorkingDays::findOrFail($request->id);
//                 $edit->doctorId  = $request->doctorId;
//                 $edit->from_date  = $request->from_date;
//                 $edit->to_date  = $request->to_date;
//                 $edit->day  = $request->day;
//                 $edit->day_number  = $request->day_number;
//                 $edit->from_morning  = $request->from_morning;
//                 $edit->to_morning  = $request->to_morning;
//                 $edit->from_afternoon  = $request->from_afternoon;
//                 $edit->to_afternoon  = $request->to_afternoon;
//                 $edit->from_evening  = $request->from_evening;
//                 $edit->to_evening  = $request->to_evening;
//                 $edit->duration  = $request->duration;
//                 $edit->save();
//                 if(isset($request->lang)  && $request -> lang == 'en' ){
//                     return $this -> returnSuccessMessage('Updated Successfully ');
//                 }else{
//                     return $this -> returnSuccessMessage('تم التعديل بنجاح');
//                 }
//     }   
    
//     public function getPaymentById(Request $request)
//     {

//         $payment=Payment::where('doctorId',$request->doctorId)->get();
//         $sum=Payment::where('doctorId',$request->doctorId)->sum('amount');
        
//         // dd($sum);
//         foreach ($payment as $item) {
//             $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first(); 
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first(); 
//             $item->apointment= Appointment::where('id',$item->appointmentId)->first();   
//         }
//         $home  =[  
//             'payment'=>$payment,
            
//             'sum'=>$sum,
//         ];
//         return $this->returnData('payment', $home);
//     }
    
    
//   public function getPaymentByIdfilter(Request $request)
//     {
//         $payment=Payment::where('doctorId',$request->doctorId)
//                           ->whereBetween('date', array($request->from_date, $request->to_date))->get();
        
//         $sum=Payment::where('doctorId',$request->doctorId)
//                      ->whereBetween('date', array($request->from_date, $request->to_date))->sum('amount');
        
//         // dd($sum);
//         foreach ($payment as $item) {
//             $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first(); 
//             $item->patient= Patient::selection()->where('id',$item->patientId)->first(); 
//             $item->apointment= Appointment::where('id',$item->appointmentId)->first();   
//         }
//         $home  =[  
//             'payment'=>$payment,
            
//             'sum'=>$sum,
//         ];
//         return $this->returnData('payment', $home);
//     }

}
