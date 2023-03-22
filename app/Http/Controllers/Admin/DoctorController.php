<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Doctor;
use App\Appointment;
use App\Speciality;
use App\WorkingDays;
use App\Service;
use App\Patient;
use App\Offer;
use App\Country;
use App\City;
use App\Reviews;
use App\Article;
use App\Payment;
use Carbon\Carbon;
use Hash;
use Auth;
use Illuminate\Support\Str;
use DB;
use Mail;
class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:doctors', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }

    public function index()
    {
       $doctors=Doctor::all();
       $specialities=Speciality::all();
        $countries=Country::all();
        $cities=City::all();
        foreach ($doctors as $item) {
            
            // $item->categorynamear= Speciality::where('id',$item->specialityId)->first();
            
            $item->categoryname= Speciality::where('id',$item->specialityId)->first();

        }
        return view('admin.doctors.all',compact('doctors','specialities','countries','cities'));
    }


    public function store(Request $request)
    {
        
        $this->validate( $request,[  
                'specialityId'=>'required',
                'specialityDesc_ar'=>'required',

                'specialityDesc_ar'=>'required',
                'countryId'=>'required',
                'cityId'=>'required',
                'longitude'=>'required',

                'latitude'=>'required',                         
                'first_name_ar'=>'required',
                'first_name_en'=>'required',
                'last_name_ar'=>'required',

                'last_name_en'=>'required',
                'email'=>'required',
                'password'=>'required',
                'mobile'=>'required',

                'address_ar'=>'required',
                'address_en'=>'required',
                'experience'=>'required',
                'gender'=>'required',

                'membershipNo'=>'required',
                'authority_ar'=>'required',
                'authority_en'=>'required',
                'degree_ar'=>'required',

                'degree_en'=>'required',
                'yearOfRegistration'=>'required',
                'bankNumber'=>'required',
                'photo' => 'required|max:10000|mimes:jpeg,jpg,png,gif|',
                // 'university_degree' => 'required|max:10000|mimes:pdf|',
                // 'practice_certificate' => 'required|max:10000|mimes:pdf|',
                // 'photo' => 'required|max:10000|mimes:jpeg,jpg,png,gif|',
            ],
            [
                'specialityDesc_ar.required'=>'ادخل وصف التخصص عربي',     
                'specialityDesc_en.required'=>'ادخل وصف التخصص انجليزي',

                'countryId.required'=>'اختر البلد',
                'cityId.required'=>'اختر المدينه',
                'longitude.required'=>'ادخل اللوكيشن',
                'latitude.required'=>'ادخل اللوكيشن',

                'first_name_ar.required'=>'يرجي ادخال الاسم الاول بالعربي',                
                'first_name_en.required'=>'يرجى ادخال الاسم الاول بالانجليزي ',
                'last_name_ar.required'=>'يرجي ادخال الثانى بالعربي ',
                'last_name_en.required'=>' يرجى ادخال الاسم الثاني بالانجليزي',


                'email.required'=>'البريد الالكتروني مطلوب ',
                'password.required'=>'يرجى ادخال كلمة المرور ',
                'mobile.required'=>' الموبايل مطلوب',
                'address_ar.required'=>'العنوان عربي مطلوب',

                'address_en.required'=>' العنوان انجليزي مطلوب',
                'experience.required'=>' يرجى ادخال عدد سنوات الخبرة',
                'gender.required'=>'ادخل النوع',
                'membershipNo.required'=>'ادخل رقم العضويه',

                'authority_ar.required'=>'ادخل جهة العمل عربي',
                'authority_en.required'=>'ادخل جهة العمل انجليزي',
                'degree_ar.required'=>'ادخل الدرجه العلمية عربي',
                'degree_en.required'=>'ادخل الدرجة العمية انجليزي',

                'yearOfRegistration.required'=>'سنة التتسجيل',
                'bankNumber.required'=>'اكتب رقم الحساب البنكي',
                'specialityId.required'=>'يرجى اختيار تخصص ',
                'photo.required'=>' يرجي إختيار صروة jpeg,jpg,png,gif ',
                // 'university_degree.required'=>' يرجي إختيار ملف pdf ',
                // 'practice_certificate.required'=>' يرجي إختيار ملف pdf',

            ]
        );
         $checkemail = Doctor::where("email" , $request->email)->first();
        if($checkemail){
            if(isset($request->lang)  && $request -> lang == 'en' ){
                return $this -> returnError('001','Email already exists');
            }else{
                return $this -> returnError('001','البريد الإلكتروني موجود مسبقا');
            }
        }else{
        $add = new Doctor();
         if($file=$request->file('photo'))
         {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/doctors/photo';
            $request-> file('photo') ->move($path,$file_name);
            $add->photo  = $file_nameone;
         }else{
            $add->photo  = "profile_image.png"; 
         }
        
        $add->specialityDesc_ar  = $request->specialityDesc_ar;
        $add->specialityDesc_en  = $request->specialityDesc_en;

        $add->countryId  = $request->countryId;
        $add->cityId  = $request->cityId;
        $add->longitude  = $request->longitude;
        $add->latitude  = $request->latitude;

        $add->first_name_ar  = $request->first_name_ar; 
        $add->last_name_ar  = $request->last_name_ar; 
        $add->first_name_en  = $request->first_name_en; 
        $add->last_name_en  = $request->last_name_en; 


        $add->email  = $request->email;   
        $add->password  = bcrypt($request->password);  
        $add->mobile  = $request->mobile;
        $add->address_ar  = $request->address_ar;

        $add->address_en  = $request->address_en;
        $add->experience  = $request->experience;
        $add->gender  = $request->gender;
        $add->membershipNo  = $request->membershipNo;

        $add->authority_ar  = $request->authority_ar;
        $add->authority_en  = $request->authority_en;
        $add->degree_ar  = $request->degree_ar;
        $add->degree_en  = $request->degree_en;

        $add->yearOfRegistration  = $request->yearOfRegistration;
        $add->bankNumber  = $request->bankNumber;
        $add->specialityId  = $request->specialityId;         
        $add-> save();




          $user = $add->toArray();
            $user['link'] = Str::random(32);
            DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
            Mail::send('emails.doctor-activation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('esptaila - Activation Code');
            });

            $video=[
                'doctorId' => $add->id,
                'services_name_ar'  => "استشارة فيديو",
                'services_name_en'  => "Video consulting",
                'price'  => 3,
                'icon' => 'video.jpeg',
                'type'  => "Video",
            ];
            $reavel=[
                'doctorId' => $add->id,
                'services_name_ar'  => "كشف ف العيادة",
                'services_name_en'  => "Examination in the clinic",
                'price'  => 3,
                'icon' => 'reavl.png',
                'type'  => "reavel",
            ];   
            $serv1 = Service::create($video);
            $serv2 = Service::create($reavel);

        return redirect()->back()->with("message",'تم تسجيل طبيب جديد بنجاح');
        } 
    }
    //   public function upload(Request $request)
    // {
    //     $uniqueFileName = uniqid() . $request->get('upload_file')->getClientOriginalName() . '.' . $request->get('upload_file')->getClientOriginalExtension());

    //     $request->get('upload_file')->move(public_path('files') . $uniqueFileName);

    //     return redirect()->back()->with('success', 'File uploaded successfully.');
    // }

    public function edit(Doctor $doctor)
    {
        $specialities=Speciality::all();
        $countries=Country::all();
        $cities=City::all();
        return view('admin.doctors.edit',compact('doctor','specialities','countries','cities'));
    }

    public function update(Request $request, Doctor $doctor)
    {

         $this->validate( $request,[  
                'specialityId'=>'required',
                'specialityDesc_ar'=>'required',

                'specialityDesc_ar'=>'required',
                'countryId'=>'required',
                'cityId'=>'required',
                'longitude'=>'required',

                'latitude'=>'required',                         
                'first_name_ar'=>'required',
                'first_name_en'=>'required',
                'last_name_ar'=>'required',

                'last_name_en'=>'required',
                'email'=>'required',
                'password'=>'required',
                'mobile'=>'required',

                'address_ar'=>'required',
                'address_en'=>'required',
                'experience'=>'required',
                'gender'=>'required',

                'membershipNo'=>'required',
                'authority_ar'=>'required',
                'authority_en'=>'required',
                'degree_ar'=>'required',

                'degree_en'=>'required',
                'yearOfRegistration'=>'required',
                'bankNumber'=>'required',
                'photo' => 'required|max:10000|mimes:jpeg,jpg,png,gif|',
                // 'university_degree' => 'required|max:10000|mimes:pdf|',
                // 'practice_certificate' => 'required|max:10000|mimes:pdf|',
                // 'photo' => 'required|max:10000|mimes:jpeg,jpg,png,gif|',
            ],
            [
                'specialityDesc_ar.required'=>'ادخل وصف التخصص عربي',     
                'specialityDesc_en.required'=>'ادخل وصف التخصص انجليزي',

                'countryId.required'=>'اختر البلد',
                'cityId.required'=>'اختر المدينه',
                'longitude.required'=>'ادخل اللوكيشن',
                'latitude.required'=>'ادخل اللوكيشن',

                'first_name_ar.required'=>'يرجي ادخال الاسم الاول بالعربي',                
                'first_name_en.required'=>'يرجى ادخال الاسم الاول بالانجليزي ',
                'last_name_ar.required'=>'يرجي ادخال الثانى بالعربي ',
                'last_name_en.required'=>' يرجى ادخال الاسم الثاني بالانجليزي',


                'email.required'=>'البريد الالكتروني مطلوب ',
                'password.required'=>'يرجى ادخال كلمة المرور ',
                'mobile.required'=>' الموبايل مطلوب',
                'address_ar.required'=>'العنوان عربي مطلوب',

                'address_en.required'=>' العنوان انجليزي مطلوب',
                'experience.required'=>' يرجى ادخال عدد سنوات الخبرة',
                'gender.required'=>'ادخل النوع',
                'membershipNo.required'=>'ادخل رقم العضويه',

                'authority_ar.required'=>'ادخل جهة العمل عربي',
                'authority_en.required'=>'ادخل جهة العمل انجليزي',
                'degree_ar.required'=>'ادخل الدرجه العلمية عربي',
                'degree_en.required'=>'ادخل الدرجة العمية انجليزي',

                'yearOfRegistration.required'=>'سنة التتسجيل',
                'bankNumber.required'=>'اكتب رقم الحساب البنكي',
                'specialityId.required'=>'يرجى اختيار تخصص ',
                'photo.required'=>' يرجي إختيار صروة jpeg,jpg,png,gif ',
                // 'university_degree.required'=>' يرجي إختيار ملف pdf ',
                // 'practice_certificate.required'=>' يرجي إختيار ملف pdf',

            ]
        );
        
        $edit = Doctor::findOrFail($doctor->id);
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

         if($file2=$request->file('university_degree'))
         {
            $file2 = $request->file('university_degree');
            $file_nameone2 = time() . '.' . $request->file('university_degree')->extension();
            // $filePath2 = public_path() . '/assets_admin/img/doctors/degree';
            $filePath2 = 'assets_admin/img/doctors/degree';
            $file2->move($filePath2, $file_nameone2);
            $edit->university_degree  = $file_nameone2;  
         }else{
            $edit->university_degree  = $edit->university_degree ;
         }
        if($fil3=$request->file('practice_certificate'))
         {
            $file3 = $request->file('practice_certificate');
            $file_nameone3 = time() . '.' . $request->file('practice_certificate')->extension();
            $filePath3 ='assets_admin/img/doctors/certificate';
            $file3->move($filePath3, $file_nameone3);

            $edit->practice_certificate  = $file_nameone3;   
         }else{
            $edit->practice_certificate  = $edit->practice_certificate;
        }
        if($file4=$request->file('other_qualification'))
         {
            $file4 = $request->file('other_qualification');
            $file_nameone4 = time() . '.' . $request->file('other_qualification')->extension();
            $filePath4 =  'assets_admin/img/doctors/qualification';
            $file4->move($filePath4, $file_nameone4);
            $edit->other_qualification  = $file_nameone4;
         }else{
            $edit->other_qualification  = $edit->other_qualification;
         }

        if($request->specialityDesc_ar){
            $edit->specialityDesc_ar  = $request->specialityDesc_ar;  
        }else{
            $edit->specialityDesc_ar  = $edit->specialityDesc_ar; 
        } 
        if($request->specialityDesc_en){
            $edit->specialityDesc_en  = $request->specialityDesc_en;  
        }else{
            $edit->specialityDesc_en  = $edit->specialityDesc_en; 
        } 

        if($request->countryId){
            $edit->countryId  = $request->countryId;  
        }else{
            $edit->countryId  = $edit->countryId; 
        } 
         if($request->cityId){
            $edit->cityId  = $request->cityId;  
        }else{
            $edit->cityId  = $edit->cityId; 
        } 
        if($request->longitude){
            $edit->longitude  = $request->longitude;  
        }else{
            $edit->longitude  = $edit->longitude; 
        } 

        if($request->latitude){
            $edit->latitude  = $request->latitude;  
        }else{
            $edit->latitude  = $edit->latitude; 
        } 

        if($request->first_name_ar){
            $edit->first_name_ar  = $request->first_name_ar;  
        }else{
            $edit->first_name_ar  = $edit->first_name_ar; 
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

         if($request->first_name_en){
            $edit->first_name_en  = $request->first_name_en;  
        }else{
            $edit->first_name_en  = $edit->first_name_en; 
        } 


        if($request->last_name_en){
            $edit->last_name_en  = $request->last_name_en;  
        }else{
            $edit->last_name_en  = $edit->last_name_en; 
        } 

        if($request->mobile){
            $edit->mobile  = $request->mobile;  
        }else{
            $edit->mobile  = $edit->mobile; 
        } 

        if($request->address_ar){
            $edit->address_ar  = $request->address_ar;  
        }else{
            $edit->address_ar  = $edit->address_ar; 
        }

        if($request->address_en){
            $edit->address_en  = $request->address_en;  
        }else{
            $edit->address_en  = $edit->address_en; 
        }

        if($request->experience){
            $edit->experience  = $request->experience;  
        }else{
            $edit->experience  = $edit->experience; 
        }
        if($request->gender){
            $edit->gender  = $request->gender;  
        }else{
            $edit->gender  = $edit->gender; 
        }  

        if($request->membershipNo){
            $edit->membershipNo  = $request->membershipNo;  
        }else{
            $edit->membershipNo  = $edit->membershipNo; 
        }  
        if($request->authority_ar){
            $edit->authority_ar  = $request->authority_ar;  
        }else{
            $edit->authority_ar  = $edit->authority_ar; 
        } 

        if($request->authority_en){
            $edit->authority_en  = $request->authority_en;  
        }else{
            $edit->authority_en  = $edit->authority_en; 
        } 

        if($request->degree_ar){
            $edit->degree_ar  = $request->degree_ar;  
        }else{
            $edit->degree_ar  = $edit->degree_ar; 
        } 

        if($request->degree_en){
            $edit->degree_en  = $request->degree_en;  
        }else{
            $edit->degree_en  = $edit->degree_en; 
        }

        if($request->yearOfRegistration){
            $edit->yearOfRegistration  = $request->yearOfRegistration;  
        }else{
            $edit->yearOfRegistration  = $edit->yearOfRegistration; 
        } 

        if($request->bankNumber){
            $edit->bankNumber  = $request->bankNumber;  
        }else{
            $edit->bankNumber  = $edit->bankNumber; 
        }


        if($request->specialityId){
            $edit->specialityId  = $request->specialityId;  
        }else{
            $edit->specialityId  = $edit->specialityId; 
        }  
        $edit-> save();

        return redirect()->back()->with("message",'تمت التعديل بنجاح'); 
    
    }

    public function destroy(Request $request )
    {

        $appointment=Appointment::where('doctorId',$request->id)->get(); 
        if(count($appointment) == 0){
            $delete = Doctor::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('doctors.index')->with("message",'تم الحذف بنجاح');
        }else{
           return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        }

    } 
    



    public function updateStatus(Request $request)
    {
       $user = Doctor::findOrFail($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['message' => 'User status updated successfully.']);



    }

    public function profile($doctor)
    {
        $doctors = Doctor::findOrFail($doctor);
        // dd($doctor);
        $workday= WorkingDays::where('doctorId',$doctor)->get();
        $services= Service::where('doctorId',$doctor)->get();
        $offers= Offer::where('doctorId',$doctor)->get();

        $appointments=Appointment::where('doctorId',$doctors->id)->get();
        foreach ($appointments as $item) {
            $item->doctor= Doctor::where('id',$item->doctorId)->first();
            $item->patient= Patient::where('id',$item->patientId)->first();
            $item->category= Speciality::all();
        }

        $reviews=Reviews::where('doctorId',$doctors->id)->get();
        foreach ($reviews as $item) {
            $item->patient= Patient::where('id',$item->patientId)->first();
        }

        $articles=Article::where('doctorId',$doctors->id)->get();
        $payment=Payment::where('doctorId',$doctors->id)->get();
        $sum=Payment::where('doctorId',$doctors->id)->sum('amount');
        foreach ($payment as $item) {
            $item->patient= Patient::where('id',$item->patientId)->first(); 
            // $item->apointment= Appointment::where('id',$item->appointmentId)->first();   
        }
        $specialities=Speciality::all();
        return view('admin.doctors.doctor-profile',compact(
                                        'doctors','offers','workday','services',
                                        'reviews','payment','sum','articles','appointments','specialities'));
    }



    public function changePassword(Request $request){
        $doctor=Doctor::where('id',$request->doctorId)->first();
        // dd($patient->password);
        $this->validate($request, [
            'current-password'     => 'required',
            'new-password'     => 'required',
            // 'confirm_password' => 'required|same:new_password',
        ]);
        // dd('ugutg');
        if (!(Hash::check($request->get('current-password'), $doctor->password))) {
            return redirect()->back()->with("error","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        }

        $doctor->password = bcrypt($request->get('new-password'));
        $doctor->save();
        return redirect()->back()->with("message","تم تغيير الرقم السري بنجاح !");
    }

    
    public function getDocument( $id)
    {
        
        $docid = Doctor::findOrFail($id);
         
        View('admin.doctors.pdf',compact('docid'));
        
        // return view('admin.pdf.demo',compact('data'));
    }
    //  public function AddApointment(Request $request)
    // {
        
        





    //     $from_date = $request->input("from_date");
    //     $to_date = $request->input("to_date");

    //     if($from_date < $to_date )
    //         {

                
                

    //             // $length = count($res);

    //             $length = count($request->day);
    //             dd($length);
    //             if($res > 0)
    //             {
    //                 for($i=0; $i<$res; $i++)
    //                {
    //                 $person= new WorkingDays;
    //                 $person->doctorId  = $request->doctorId;
    //                 $person->from_date  = $request->from_date[$i];
    //                 $person->to_date  = $request->to_date;
    //                 $person->day  = $request->day;
    //                 $person->from_morning  = $request->from_morning;
    //                 $person->to_morning  = $request->to_morning;
    //                 $person->from_afternoon  = $request->from_afternoon;
    //                 $person->to_afternoon  = $request->to_afternoon;
    //                 $person->from_evening  = $request->from_evening;
    //                 $person->to_evening  = $request->to_evening;
    //                 $person->duration  = $request->duration;
    //                 $person->save();
    //                }
    //                return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    //             }
                
    //         }else{
    //            return redirect()->back()->with("error", ' يجب ان يكون تاريخ البداية اصغر من تاريخ النهاية'); 
    //         }

    // }






     public function AddApointment(Request $request)
    {
        
        $this->validate( $request,[          
                'from_date'=>'required',
                'to_date'=>'required',
                'day'=>'required',
                'day_number'=>'required',
                // 'from_morning'=>'required',
                // 'to_morning'=>'required',
                // 'from_afternoon'=>'required',
                // 'to_afternoon'=>'required',
                // 'from_evening'=>'required',
                // 'to_evening'=>'required',
                'duration'=>'required',
            ],
            [
                'from_date.required'=>'تاريخ بداية الفتره مطلوب',
                'to_date.required'=>' تاريخ نهاية الفترة مطلوب ',
                'day.required'=>' ادخل ايام العمل',
                // 'from_morning.required'=>' ادخل موعد الفتره الصباحيه  ',
                // 'to_morning.required'=>'  ادخل موعد الفتره الصباحيه  ',
                // 'from_afternoon.required'=>'  ادخل موعد الفتره بعد الظهر ',
                // 'to_afternoon.required'=>'  ادخل موعد الفتره بعد الظهر  ',
                // 'from_evening.required'=>'  ادخل موعد الفتره المسائية ',
                // 'to_evening.required'=>'  ادخل موعد الفتره المسائية ',
                'duration.required'=>' ادخل مدة الكشف ',   
            ]
        );


        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");

        $workingdays=WorkingDays::where('doctorId',$request->doctorId)
                                   ->where('from_date',$request->from_date)
                                   ->where('to_date',$request->to_date)
                                   ->first();
        if($workingdays){
            return $this->returnError('001', 'يوجد فترة عمل في هذا التاريخ');
        }else{ 
            if($from_date < $to_date )
            {
                $length = count($request->day);
                if($length > 0)
                {
                    for($i=0; $i<$length; $i++)
                    {
                        $person= new WorkingDays;
                        $person->doctorId  = $request->doctorId;
                        $person->from_date  = $request->from_date;
                        $person->to_date  = $request->to_date;
                        $person->day  = $request->day[$i];
                        $person->day_number  = $request->day_number[$i];
                        $person->from_morning  = $request->from_morning;
                        $person->to_morning  = $request->to_morning;

                        $person->from_afternoon  = $request->from_afternoon;
                        $person->to_afternoon  = $request->to_afternoon;

                        $person->from_evening  = $request->from_evening;
                        $person->to_evening  = $request->to_evening;
                        
                        $person->duration  = $request->duration;
                        $person->save();
                    }
                    return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
                }
                
            }else{
               return redirect()->back()->with("error", ' يجب ان يكون تاريخ البداية اصغر من تاريخ النهاية'); 
            }
        }    
    }







    public function deleteApointment(Request $request )
    {
        $delete = WorkingDays::findOrFail($request->id);
        $delete->delete();
        return redirect()->back()->with("message",'تم الحذف بنجاح');
    } 

     public function updateApointment(Request $request)
    {
        
       $edit = WorkingDays::findOrFail($request->id);
        $edit->day  = $request->day;
        $edit->from_morning  = $request->from_morning;
        $edit->to_morning  = $request->to_morning;
        $edit->from_afternoon  = $request->from_afternoon;
        $edit->to_afternoon  = $request->to_afternoon;
        $edit->from_evening  = $request->from_evening;
        $edit->to_evening  = $request->to_evening;
        $edit->save();              
        return redirect()->back()->with("message", 'تم التعديل بنجاح'); 

    }
    
    
    // public function addService(Request $request)
    // {    
    //     $this->validate( $request,[          
    //             'services_name_ar'=>'required',
    //             'services_name_en'=>'required',
    //             'price'=>'required',
    //             'type'=>'required',
    //             'icon' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
    //         ],
    //         [
    //             'services_name_ar.required'=>'ادخل الاسم بالعربي',
    //             'services_name_en.required'=>' ادخل الاسم بالانجليزي ',
    //             'price.required'=>' يرجى ادخال السعر',
    //             'type.required'=>' ىرجي اختيار نوع الخدمة ',
    //             'icon.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
    //         ]
    //     );

    //     $add= new Service;
    //     if($file=$request->file('icon'))
    //      {
    //         $file_extension = $request -> file('icon') -> getClientOriginalExtension();
    //         $file_name = time().'.'.$file_extension;
    //         $file_nameone = $file_name;
    //         $path = 'assets_admin/img/services';
    //         $request-> file('icon') ->move($path,$file_name);
    //         $add->icon  = $file_nameone;
    //      }else{
    //         $add->icon  = "profile_image.png"; 
    //      }
    //     $add->doctorId  = $request->doctorId;
    //     $add->services_name_ar  = $request->services_name_ar;
    //     $add->services_name_en  = $request->services_name_en;
    //     $add->price  = $request->price;
    //     $add->type  = $request->type;
    //     $edit->status  = $request->status;
        

    //     $add->save();                   
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    // }

//     public function deleteService(Request $request )
//     {
//         $delete = Service::findOrFail($request->id);
// //dd($delete);
//         $delete->delete();
//         return redirect()->back()->with("message",'تم الحذف بنجاح');
        

//     } 
    public function editServic($id)
    {
        $edit = Service::findOrFail($id);
        return view('admin.doctors.edit_servic',compact('edit'));
    }


    public function updateService(Request $request)
    {


        $edit = Service::findOrFail($request->id);
        // $edit->doctorId  = $request->doctorId;
        $edit->price  = $request->price;
        $edit->status  = $request->status;
        $edit->update();
        // return $this -> returnSuccessMessage('تم التعديل بنجاح');

        // $edit = Service::findOrFail($request->id);
        // if($file=$request->file('icon'))
        // {
        //     $file_extension = $request -> file('icon') -> getClientOriginalExtension();
        //     $file_name = time().'.'.$file_extension;
        //     $file_nameone = $file_name;
        //     $path = 'assets_admin/img/services';
        //     $request-> file('icon') ->move($path,$file_name);
        //     $edit->icon  = $file_nameone;
        // }else{
        //     $edit->icon  = $request->url; 
        // }
        // $edit->services_name_ar  = $request->services_name_ar;
        // $edit->services_name_en  = $request->services_name_en;
        // $edit->price  = $request->price;
        // $edit->type  = $request->type;
        // $edit->status  = $request->status;
        
        // $edit->save();              
        return redirect()->back()->with("message", 'تم التعديل بنجاح'); 

    }
    
    public function addOffer(Request $request)
    {    
        $this->validate( $request,[          
                'offer_name_ar'=>'required',
                'offer_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'old_price'=>'required',
                'new_price'=>'required',
                'type'=>'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'offer_name_ar.required'=>'عنوان العرض عربي',
                'offer_name_en.required'=>' عنوان العرض انجليزي ',
                'description_ar.required'=>' وصف العرض عربي',
                'description_en.required'=>' وصف العرض انجليزي ',
                'old_price.required'=>' السعرد القديم ',
                'new_price.required'=>' السعر الجديد ',
                'type.required'=>' نوع العرض ',
                'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );
        $percent = (($request->old_price - $request->new_price) / $request->old_price) * 100;

        $add= new Offer;
        if($file=$request->file('image'))
         {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/offers';
            $request-> file('image') ->move($path,$file_name);
            $add->image  = $file_nameone;
         }else{
            $add->image  = "profile_image.png"; 
         }
        $add->doctorId  = $request->id;
        $add->offer_name_ar  = $request->offer_name_ar;
        $add->offer_name_en  = $request->offer_name_en;
        $add->description_ar  = $request->description_ar;
        $add->description_en  = $request->description_en;
        $add->old_price  = $request->old_price;
        $add->new_price  = $request->new_price;
        $add->type  = $request->type;
        
        $add->percent = intval($percent);


        $add->save();                   
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function deleteOffer(Request $request )
    {
        $delete = Offer::findOrFail($request->id);
        $delete->delete();
        return redirect()->back()->with("message",'تم الحذف بنجاح');
    } 

    public function editOffer($id)
    {
        $edit = Offer::findOrFail($id);
        return view('admin.doctors.edit_offer',compact('edit'));
    }

    public function updateOffer(Request $request)
    {
        // dd($request->id);
        $this->validate( $request,[          
                'offer_name_ar'=>'required',
                'offer_name_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'old_price'=>'required',
                'new_price'=>'required',
                'type'=>'required',
            ],
            [
                'offer_name_ar.required'=>'عنوان العرض عربي',
                'offer_name_en.required'=>' عنوان العرض انجليزي ',
                'description_ar.required'=>' وصف العرض عربي',
                'description_en.required'=>' وصف العرض انجليزي ',
                'old_price.required'=>' السعرد القديم ',
                'new_price.required'=>' السعر الجديد ',
                'type.required'=>' نوع العرض ',
               
            ]
        );

        $edit = Offer::findOrFail($request->id);
        
        if($file=$request->file('image'))
        {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/offers';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
        }else{
            $edit->image  = $request->url; 
        }
        $edit->offer_name_ar  = $request->offer_name_ar;
        $edit->offer_name_en  = $request->offer_name_en;
        $edit->description_ar  = $request->description_ar;
        $edit->description_en  = $request->description_en;
        $edit->old_price  = $request->old_price;
        $edit->new_price  = $request->new_price;
        $edit->type  = $request->type;
        
        $edit->save();              
        return redirect()->back()->with("message", 'تم التعديل بنجاح'); 

    }

    // public function deleteReviews(Request $request )
    // {
    //     $delete = Offer::findOrFail($request->id);
    //     //dd($delete);
    //     $delete->delete();
    //     return redirect()->back()->with("message",'تم الحذف بنجاح');
    // } 
    public function deletePayment(Request $request )
    {
        $delete = Payment::findOrFail($request->id);
        $delete->delete();
        return redirect()->back()->with("message",'تم الحذف بنجاح');
    }


}
