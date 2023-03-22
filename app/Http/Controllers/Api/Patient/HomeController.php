<?php

namespace App\Http\Controllers\Api\Patient;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Banner;
use App\Article;
use App\Doctor;
use App\Patient;
use App\Slider;
use App\Speciality;
use App\Service;
use App\Offer;
use App\Appointment;
use App\ContactInfo;
use App\Favorite;
use App\Reviews;
use Carbon\Carbon;
use App\Payment;
use App\WorkingDays;
use App\Companies_insurance;
use App\Patient_location;
use App\Patient_health_information;
use App\Traits\GeneralTrait;
use App\People_under_care;
use App\Patient_case;

 
use App\Order;
use App\Order_image;

use Illuminate\Support\Facades\DB;
use Auth;
use App\City;
use App\Country;
use App\Diagnostic;
use DateTime;
class HomeController extends Controller   
{  
    use GeneralTrait; 
    public function index(Request $request ,$radius = 400)
    {
        // dd('ghjk');
        // $gg= Auth::guard('patient-api')->user();
        // dd($gg);
        $pannars=Banner::all();
        $sliders = Slider::selection()->get();

        $latitude       =  $request->latitude;
        $longitude      =  $request->longitude;

        // $doctors          =       DB::table("doctors");
        $doctors          =       Doctor::select(
            'id',
            'specialityId',
            'specialityDesc_' . app()->getLocale() . ' as specialityDesc',
            'countryId',
            'cityId',
            'first_name_' . app()->getLocale() . ' as first_name',
            'last_name_' . app()->getLocale() . ' as last_name',
            'email',
            'mobile',
            'bankNumber',
            'address_' . app()->getLocale() . ' as address',
            'longitude',
            'latitude',
            'experience',
            'gender',
            'photo',
            'university_degree',
            'practice_certificate',
            'other_qualification',
            'rate',
            'status',
            'token',
            'membershipNo',
            'specialityDesc_' . app()->getLocale() . ' as specialityDesc',
            'authority_' . app()->getLocale() . ' as authority',
            'degree_' . app()->getLocale() . ' as degree',
            'yearOfRegistration',
            'device_token',
            'created_at',
            'updated_at', 
            DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $doctors          =       $doctors->having('distance', '<', 20);
        $doctors          =       $doctors->orderBy('distance', 'asc');
        $doctors          =       $doctors->where('status',1)->get();
        
        // $doctors = Doctor::selection()->get();
        foreach ($doctors as $item) {
            $item->specialityName= Speciality::selection()->where('id',$item->specialityId)->first();   
            $item->serviceName= Service::selection()->where('doctorId',$item->id)->where('status',1)->get(); 
            $item->countries= Country::selection()->where('id',$item->countryId)->first();
            $item->cities= City::selection()->where('id',$item->cityId)->first();
            $working_days = WorkingDays::where('doctorId',$item->id)->first();
            $favorite = Favorite::where('doctorId',$item->id)->where('patientId',$request->patientId)->first();
            
            if($favorite ==null)
            {
                $item->favorite=0;
            }else{
             $item->favorite= 1;    
            }
            
            if($working_days ==null)
            {
                $item->duration="";
            }else{
             $item->duration= $working_days->duration;    
            }
               
        }


        $offers = Offer::selection()->orderBy('id', 'DESC')->get();
        foreach ($offers as $item) {
            $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first();   
        }
        // dd($doctors);
        
        $specialities = Speciality::selection()->orderBy('id', 'DESC')->get();
        $articles = Article::selection()->get();
        $home  = [  
                    'specialities'=>$specialities,
                    'doctors'=>$doctors,
                    'offers'=>$offers,
                    'sliders'=>$sliders,
                    'pannars'=>$pannars,
                    'articles'=>$articles,                    
                ];
        return $this -> returnData(
            'home',$home
        );
    }
    
    public function addRate(Request $request)
    {
            $add = new Reviews;
            $add->doctorId = $request->doctorId;
            $add->patientId = $request->patientId;
            $add->comment = $request->comment;
            $add->rate = $request->rate;
            $add->save();
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('added Successfully ');
            }else{
                return $this -> returnSuccessMessage('تم الاضافة بنجاح');
            } 
    }
    
    public function patientLocation(Request $request)
    {
            $add = new Patient_location;
            $add->patientId = $request->patientId;
            $add->countryId = $request->countryId;
            $add->cityId = $request->cityId;
            $add->location_name = $request->location_name;
            $add->state = $request->state;
            $add->street = $request->street;
            $add->building_name = $request->building_name;
            $add->longitude = $request->longitude;
            $add->latitude = $request->latitude;
            $add->floor_number = $request->floor_number;
            $add->save();
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('added Successfully ');
            }else{
                return $this -> returnSuccessMessage('تم الاضافة بنجاح');
            } 
    }
    public function patient_people_under_care(Request $request)
    {
        $edit = new People_under_care();
        
            $edit->patientId  = $request->patientId; 
            $edit->name  = $request->name; 
         
            $edit->age  = $request->age;  
        
            $edit->years  = $request->years;  
        
            $edit->gender  = $request->gender;  
         

            $edit->mobile  = $request->mobile;  
         
         
            $edit->relationship  = $request->relationship;  
         
            $edit->blood  = $request->blood;  
            $edit->weight  = $request->weight;  
            $edit->height  = $request->height;  
            $edit->pressure  = $request->pressure;  
            $edit->chronic  = $request->chronic;   
            
            $edit->companies_insuranceId  = $request->companies_insuranceId;  
            $edit->number  = $request->number;  
            $edit->type  = $request->type;  
            $edit->date  = $request->date;
            $edit-> save();
            $companies_insurance = Companies_insurance::where('id',$edit->companies_insuranceId)->first();
            // dd($companies_insurance);
            if($companies_insurance){
                $edit->companies_insuranceId=$companies_insurance->name_ar;
            }
            // else{
            //     $edit->companies_insuranceId='';
            // }
            
            ///////////
            
            
                     
         
        // health information

        
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnDataa('data',$edit,'done');
        }else{
            return $this -> returnDataa('data',$edit,'تم الحفظ');
        }  
    }
    
    public function getPeopleUnderCare(Request $request)
    {
        $data=People_under_care::where('patientId',$request->patientId)->get();
        return $this -> returnData(
            'data',$data
        );
    }
    public function removeUnderCare(Request $request){
        $people_under_care = People_under_care::find($request->id);
        if($people_under_care)
        $people_under_care->delete(); 
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnSuccessMessage('Deleted Successfully');
        }else{
            return $this -> returnSuccessMessage('تم الحذف بنجاح');
        }
    }
    
    
    public function removePatientLocation(Request $request)
    {
        $patient_location = Patient_location::find($request->id);
        $patient_location->delete(); 
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnSuccessMessage('Deleted Successfully');
        }else{
            return $this -> returnSuccessMessage('تم الحذف بنجاح');
        }
    }
    public function getPatientLocation(Request $request)
    {
        $data=Patient_location::where('patientId',$request->patientId)->get();
        foreach ($data as $item) {
            $country= Country::selection()->where('id',$item->countryId)->first();
            if($country){
                $item->country=$country->name;
            }else{
                $item->country=null;
            }
            
            $city= City::selection()->where('id',$item->cityId)->first();
            if($city){
                $item->city=$city->name;
            }else{
                $item->city=null;
            }
        }    
        
            
        
        return $this -> returnData(
            'data',$data
        );
    }
    public function paymentStatus(Request $request)
    {
            $edit = Patient::findOrFail($request->patientId);
            $edit->payment_method  = $request->payment_method;
            $edit->save();
            
            
            
            
            
            
            
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
           
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnDataa('data',$patient,'done');
            }else{
                return $this -> returnDataa('data',$patient,'تم الحفظ');
            } 
            
    }
    
    //  Order
    // Order_image
    public function createOrder(Request $request)
    {
            $add = new Order;
            $add->patientId = $request->patientId;
            $add->doctorId = $request->doctorId;
            $add->categoryId = $request->categoryId;
            $add->subCategoryId = $request->subCategoryId;
            $add->patientlocationId = $request->patientlocationId;
            $add->message = $request->message;
            $add->gender = $request->gender;
            $add->age = $request->age;
            $add->language = $request->language;
            $add->mobile = $request->mobile;
            $add->date = $request->date;
            $add->time = $request->time;
            $add->method_payment = $request->method_payment;
            $add->duration = $request->duration;
            
            $add->save();
            
            
            if($request->hasfile('image'))
            {
                foreach($request->file('image') as $item)
                {
                    $file_extension = $item -> getClientOriginalExtension();
                    $file_name = time().rand(1,100).'.'.$file_extension;
                    $item->move('assets_admin/img/orders/', $file_name);
                    $data[] = $file_name; 
                }
                
                $length_file = count($data);
                if($length_file > 0)
                {
                    for($i=0; $i<$length_file; $i++)
                    {
                        
                        $add_order_image= new Order_image;
                        $add_order_image->orderId  = $add->id;
                        $add_order_image->image  = $data[$i];                   
                        $add_order_image->save();
                    }
                }
            }
            
            
              
            
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('added Successfully ');
            }else{
                return $this -> returnSuccessMessage('تم الاضافة بنجاح');
            } 
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function sliders()
    {
        $sliders = Slider::selection()->get();
        return $this -> returnData(
            'sliders',$sliders
        );
    }    
    public function getDoctorsSpecialityById(Request $request)
    {
        $category = Speciality::selection()->find($request->id);
        // if (!$category)
        //     return $this->returnError('001', 'هذا التخصص غير موجود');
        // $doctors = Doctor::selection()->get();
        // dd($category);
        $doctors= Doctor::selection()->where('status',1)->where('specialityId',$category->id)->get();       
        foreach ($doctors as $item) {
            $item->specialityName= Speciality::selection()->where('id',$item->specialityId)->first();  
            $item->serviceName= Service::selection()->where('doctorId',$item->id)->where('status',1)->get();
            $item->countries= Country::selection()->where('id',$item->countryId)->first();
            $item->cities= City::selection()->where('id',$item->cityId)->first();
            $favorite = Favorite::where('doctorId',$item->id)->where('patientId',$request->patientId)->first();
            if($favorite ==null)
            {
                $item->favorite=0;
            }else{
             $item->favorite= 1;    
            }
            
             $working_days = WorkingDays::where('doctorId',$item->id)->first();
            if($working_days ==null)
            {
                $item->duration="";
            }else{
             $item->duration= $working_days->duration;    
            }
            
        }
        return $this->returnData('doctors', $doctors);
    }

    // public function getTime(Request $request){
    //     // dd($request->date);
    //     $day = Carbon::createFromFormat('Y-m-d', $request->date)->dayOfWeek;
    //     //  dd($day);
    //     $times=DB::table('working_days')->where('day_number', $day)->where('doctorId', $request->doctorId)->get();
    //     // dd($times);
    //   foreach ($times as $item) {
    //         $start=strtotime($item->from_morning);
    //         $end=strtotime($item->to_morning);

    //         if($start){
    //             for ($i=$start;$i<=$end;$i = $i + 15*60)
    //             {
    //                 $item->first_time[]= date('g:i ',$i);
    //             }
    //         }else{
    //             $item->first_time[]= 'لا يوجد مواعيد صباحا';
    //         }    

    //         $start2=strtotime($item->from_afternoon);
    //         $end2=strtotime($item->to_afternoon);
    //         if($start2){
    //             for ($i=$start2;$i<=$end2;$i = $i + 15*60)
    //             {
    //                 $item->second_time[]= date('g:i ',$i);
    //             }
                 
    //         }else{
    //             $item->second_time[]= 'لا يوجد مواعيد بعد الظهر';
    //         }

    //         $start3=strtotime($item->from_evening);
    //         $end3=strtotime($item->to_evening);
    //         if($start3){
    //             for ($i=$start3;$i<=$end3;$i = $i + 15*60)
    //             {
    //                 $item->third_time[]= date('g:i ',$i);
    //             }
    //         }else{
    //             $item->third_time[]= 'لا يوجد مواعيد ف المساء';
    //         }
    
            
    //     }   
       
    //     return $this->returnData('times', $times); 
    // }
    public function getTime(Request $request){
        // dd($request->date);
        $day = Carbon::createFromFormat('Y-m-d', $request->date)->dayOfWeek;
        //   dd($day);
        $times=DB::table('working_days')->where('day_number', $day)->where('doctorId', $request->doctorId)->get();
        // dd($times);
        // $checktimefound=Appointment::where('date', $request->date)->where('doctorId', $request->doctorId)->get();
        $checktimefound=Appointment::where('date', $request->date)
                                    ->where('status',"confirmed")
                                    ->where('payment_status',1)
                                    ->get();
        // dd($checktimefound);
        
        foreach ($times as $item) {
            
            if($request->date >=$item->from_date){
                if( $request->date <= $item->to_date ){
                     $start=strtotime($item->from_morning);
                    $end=strtotime($item->to_morning);
        
                    if($start){
                        for ($i=$start;$i<=$end;$i = $i + $item->duration *60)
                        {
                            $first[]= date('g:i ',$i).'AM';
                            
                            $first_time  = [  
                                'alltime'=>$first,
                                'appointmentbooked'=>$checktimefound,
                            ];
                            $item->first_time=$first_time;
                        }
                    }else{
                        $item->first_time= null;
                    }  
                    $start2=strtotime($item->from_afternoon);
                    $end2=strtotime($item->to_afternoon);
                    if($start2){
                        for ($i=$start2;$i<=$end2;$i = $i +  $item->duration*60)
                        {
                            $second[]= date('g:i ',$i).'AF';
                            
                            $second_time  = [  
                                'alltime'=>$second,
                                'appointmentbooked'=>$checktimefound,
                            ];
                            $item->second_time=$second_time;
                        }
                         
                    }else{
                        $item->second_time= null;
                    }
        
                    $start3=strtotime($item->from_evening);
                    $end3=strtotime($item->to_evening);
                    if($start3){
                        for ($i=$start3;$i<=$end3;$i = $i +  $item->duration*60)
                        {
                            $third[]= date('g:i ',$i).'PM';
                            
                            $third_time  = [  
                                'alltime'=>$third,
                                'appointmentbooked'=>$checktimefound,
                            ];
                            $item->third_time=$third_time;
                        }
                    }else{
                        // $third1=[];
                        // $third2= [];
                        // $third_time  = [  
                        //     'alltime'=>$third1,
                        //     'appointmentbooked'=>$third2,
                        // ];
                        // $item->third_time= $third_time;
                        $item->third_time= null;
                    } 

                }else{
                    return $this->returnData('times', []); 
                }
            }else{
                return $this->returnData('times', []); 
            }
            
        }   
       
        return $this->returnData('times', $times); 
    }
    
    public function addBooking(Request $request)
    {      
        // if($request->patientId & $request->doctorId & $request->date & $request->time & $request->type != null){
        $appointments=Appointment::where('patientId',$request->patientId)
                                   ->where('doctorId',$request->doctorId)
                                   ->where('date',$request->date)
                                   ->where('status',"confirmed")
                                   ->where('payment_status',1)
                                   ->first();
        if($appointments){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnError('You already have an appointment with this doctor ');
            }else{
                return $this -> returnError('لديك موعد سابق بالفعل مع هذا الدكتور');
            } 
        }else{
            $add = new Appointment;
            $add->patientId    = $request->patientId;
            $add->doctorId    = $request->doctorId;
            $add->date  = $request->date;
            if($request->permanent_type=='AM'){
                $add->time  = $request->time.' AM';
            }elseif($request->permanent_type=='AF'){
                $add->time  = $request->time.' AF';
            }else{
                $add->time  = $request->time.' PM';
            }
            $add->permanent_type  = $request->permanent_type;
            $add->type  = $request->type;
            $add->save();
                return $this->returnData('bookingid', $add->id); 
        }                           
            
            // }else{
            //     return $this -> returnSuccessMessage('يوجد داتا ناقصة');
            // }
            // $add = new Appointment;
            // $add->patientId    = $request->patientId;
            // $add->doctorId    = $request->doctorId;
            // $add->date  = $request->date;
            // $add->time  = $request->time;
            // $add->type  = $request->type;
            // $add->save();
            // return $this->returnData('bookingid', $add->id); 

            // return $this -> returnSuccessMessage('تم الحجز بنجاح');
    }


    public function addPayment(Request $request)
    {
            $todayDate = date("Y-m-d");
            $time = new DateTime();
            $time->modify('+3 hours');
             

            $add = new Payment;
            $add->doctorId    = $request->doctorId;
            $add->patientId    = $request->patientId;
            $add->appointmentId    = $request->appointmentId;
            $add->amount  = $request->amount;
            $add->type  = $request->type;
            $add->company  = $request->company;
            $add->name  = $request->name;
            $add->number  = $request->number;
            $add->cvc  = $request->cvc;
            $add->month  = $request->month;
            $add->year  = $request->year;
            $add->date  = $todayDate;
            $add->time  = $time->format("H:i");
            $add->save();
            
            $SERVER_API_KEY = 'AAAA12iRXek:APA91bHSmMEKt_Vi3RamfrBtk5R6p6hN5w0qsj5NotG5Xa5ttX1TudSPZLHBiUEXV4jKQ6CZBb1Cm_142nJroxyVU-3LRfQUYyz2ainfRFqIOdf1srFSU5RTsIgcI1LT1TtWPNf5TwXZ';
            $doctors= Doctor::where('id',$add->doctorId)->first();
            $patients= Patient::selection()->where('id',$add->patientId)->first();
            // dd($patients);
            $token_1 = $doctors->device_token;
            $name = $patients->first_name;
            $message='' ;
            if(isset($request->lang)  && $request -> lang == 'en' ){
                $message= 'booked an appointment';
            }else{
                $message='قام بحجز موعد';
            }
            
            $data = [
                "registration_ids" => [
                    $token_1
                ],
                "notification" => [
                    "title" => 'Espitalia',
                    "body" => $name + $message,
                    "sound"=> "default" // required for sound on ios
                ],
            ];

            $dataString = json_encode($data);
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            $response = curl_exec($ch);
            return $this->returnData('favorite', $add);
            
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Payment was successful');
            }else{
                return $this -> returnSuccessMessage('تم حجز الدفع والحجز بنجاح');
            } 
    }

    
    

    public function getAppointmentById(Request $request)
    {
        $appointments=Appointment::where('patientId',$request->id)
                                   ->where('payment_status','!=',0)
                                    ->orderBy('id', 'DESC')->get();
        foreach ($appointments as $item) {
            $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first(); 
            $item->specialityName= Speciality::selection()->first();  
        }
        return $this->returnData('appointments', $appointments);
    }


    public function getReviewsOfDoctorId(Request $request)
    {
        $reviews=Reviews::where('doctorId',$request->doctorId)->orderBy('id', 'DESC')->get();
        
        return $this->returnData('reviews', $reviews);
    }

    public function getfavoriteById(Request $request)
    {
        //dd($request->patientid);
        $favorite=Favorite::where('patientId',$request->patientid)->orderBy('id', 'DESC')->get();
        foreach ($favorite as $item) {
            
            $item->doctor= Doctor::selection()->where('id',$item->doctorId)
                            ->with(array('specialityName'=>function($query){
                                $query->selection();
                            }))
                            ->with(array('services'=>function($query){
                                $query->selection();
                            }))->first(); 
        }
       return $this->returnData('favorite', $favorite);
    }
    
    public function addToFavorite(Request $request)
    {
        //validation
        
        // dd($favorite);
        // dd($request->all());
        $favorite=Favorite::where('doctorId',$request->doctorId)->where('patientId',$request->patientId)->first();
        if($favorite){
             // Category::where('id',$request -> id) -> update(['active' =>$request ->  active]);
            $cats = Favorite::find($favorite->id);
            $cats->delete();
             if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('Updated Successfully');
            }else{
                return $this -> returnSuccessMessage('تم الحذف');
            } 
        }else{
            $add = new Favorite;
            $add->doctorId = $request->doctorId;
            $add->patientId = $request->patientId;
            $add->save();
              
            //  $doctor=Doctor::where('id',$request->doctorId)->first();
            //  dd($doctor->device_token);
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnSuccessMessage('added Successfully');
            }else{
                return $this -> returnSuccessMessage('تم الاضافة بنجاح');
            }
            // $SERVER_API_KEY = 'AAAA53eKt7M:APA91bHC4cjg4wABfBFgAo48iH-Q2jZsYxAVLjxvtUuTQJ5L2E11ZzEDEe7xmPwR1xIUQ1P90Nu3XE8-y58G9FSgGU8TLWwh47Fm5pYw7cbR372iYuhqkA2XsyedIbcPE7Y6rVEoOha4';
            // $token_1 = $doctor->device_token;
            // $data = [
            //     "registration_ids" => [
            //         $token_1
            //     ],
            //     "notification" => [
            //         "title" => 'Welcome',
            //         "body" => 'Description',
            //         "sound"=> "default" // required for sound on ios
            //     ],
            // ];

            // $dataString = json_encode($data);
            // $headers = [
            //     'Authorization: key=' . $SERVER_API_KEY,
            //     'Content-Type: application/json',
            // ];
            // $ch = curl_init();
            // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            // $response = curl_exec($ch);
            // dd($response); 
        }

       

        // $add = new Favorite;
        //     $add->doctorId = $request->doctorId;
        //     $add->patientId = $request->patientId;
        //     $add->save();
        //     return $this -> returnSuccessMessage('تم الاضافة بنجاح');   
    }


    public function removeFavorite(Request $request){
        $cats = Favorite::find($request->id);
        $cats->delete(); 
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnSuccessMessage('Deleted Successfully');
        }else{
            return $this -> returnSuccessMessage('تم الحذف بنجاح');
        }
    }


    public function patientUpdate(Request $request)
    {
          $edit = Patient::findOrFail($request->id);
         // dd($edit);
        //$edit = Patient::where('id',1);
        // dd($edit->photo);
        //return $this->returnData('appointments', $edit);
         if($file=$request->file('photo'))
         {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/patients';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  = $file_nameone;
         }else{
            $edit->photo  = $edit->photo; 
         }

         if($request->first_name_ar){
             $edit->first_name_ar  = $request->first_name_ar; 
         }else{
            $edit->first_name_ar  = $edit->first_name_ar; 
         }


         if($request->last_name_ar){
            $edit->last_name_ar  = $request->last_name_ar; 
         }else{
            $edit->last_name_ar  = $edit->last_name_ar; 
         }
         if($request->first_name_en ){
            $edit->first_name_en  = $request->first_name_en; 
         }else{
            $edit->first_name_en  = $edit->first_name_en; 
         }
         if($request->last_name_en){
            $edit->last_name_en  = $request->last_name_en;  
         }else{
            $edit->last_name_en  = $edit->last_name_en;  
         }

        //  if($request->password){
        //     $edit->password  = bcrypt($request->password);  
        //  }else{
        //     $edit->password  = bcrypt($edit->password);    
        //  }
         if($request->mobile){
             $edit->mobile  = $request->mobile; 
         }else{
             $edit->mobile  = $edit->mobile; 
         }

         if($request->gender){
             $edit->gender  = $request->gender; 
         }else{
            $edit->gender  = $request->gender; 
         }

         if($request->dateOfBirth){
             $edit->dateOfBirth  = $request->dateOfBirth; 
         }else{
            $edit->dateOfBirth  = $edit->dateOfBirth; 
         }

        $edit-> save();
        // dd($edit->id);
        $patient = Patient::selection()->find($edit->id);

        return $this -> returnData('patient' , $patient);

        // return $this -> returnSuccessMessage('تم التعديل بنجاح');
        
    }


    public function doctorSpecialities()
    {
        $speciality=Speciality::selection()->get();
        return $this -> returnData(
            'speciality',$speciality
        );
    }
    public function contactInfo()
    {    
        
        $contactinfo = ContactInfo::selection()->first();
        
        
        return $this -> returnData(
            'home',$contactinfo
        );
    }
    
    
    public function getPaymentById(Request $request)
    {
        $payment=Payment::where('patientId',$request->patientId)->orderBy('id', 'DESC')->get();
        foreach ($payment as $item) {
            $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first(); 
            $item->patient= Patient::selection()->where('id',$item->patientId)->first(); 
            $item->apointment= Appointment::where('id',$item->appointmentId)->first();   
        }
        return $this->returnData('payment', $payment);
    }
    public function Countries(Request $request)
    {
            $countries = Country::selection()->get(); 
            
            return $this->returnData('countries', $countries);
    }
    public function Cities(Request $request)
    {
            $cities = City::selection()->where('countryId',$request->countryId)->get(); 
            
            return $this->returnData('cities', $cities);
    }
    
    public function searchOnDoctor(Request $request)
    {
        $doctors = Doctor::selection()
                        ->where('gender',$request->gender)
                        ->where('specialityId',$request->specialityId)
                        ->where('countryId',$request->countryId)
                        ->where('cityId',$request->cityId)->get(); 
        foreach ($doctors as $item) {
            $item->specialityName= Speciality::selection()->where('id',$item->specialityId)->first();   
            $item->serviceName= Service::selection()->where('doctorId',$item->id)->where('status',1)->get(); 
            $item->countries= Country::selection()->where('id',$item->countryId)->first();
            $item->cities= City::selection()->where('id',$item->cityId)->first();
            $favorite = Favorite::where('doctorId',$item->id)->where('patientId',$request->patientId)->first();
            if($favorite ==null)
            {
                $item->favorite=0;
            }else{
                $item->favorite= 1;    
            }
            $working_days = WorkingDays::where('doctorId',$item->id)->first();
            if($working_days ==null)
            {
                $item->duration="";
            }else{
                $item->duration= $working_days->id;    
            }
        }
        return $this->returnData('doctors', $doctors);
    }
    public function appointmentStatus(Request $request)
    {
        // dd('gggg');
        $status_ppointment = Appointment::find($request->id);
        $status_ppointment->delete(); 
        if(isset($request->lang)  && $request -> lang == 'en' ){
            return $this -> returnSuccessMessage('Deleted Successfully');
        }else{
            return $this -> returnSuccessMessage('تم الحذف بنجاح');
        }
    }
    public function getDiagnosis(Request $request)
    {
        $diagnostics=Diagnostic::where('patientId',$request->patientId)->get();
        foreach ($diagnostics as $item) {
            $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first();
        }
        return $this -> returnData('diagnostics',$diagnostics);
    }

}
