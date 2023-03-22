<?php

namespace App\Http\Controllers\Instructor;
use App\User;
use App\ContactInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\City;
use DB;
use App\Bank;
use App\Course;
use App\View;
use App\Admin_Video;
use App\Instructor;
use App\Student;
use App\Certificate;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        
        
        $countries=Country::all()->sortBy('name');
        $userid = Auth::guard('instructors')->user();
        
        $course=Course::where('userId',$userid->id)->get();
        
        
        $users=instructor::findOrFail($userid->id);
        $country=Country::where('id',$userid->countryId)->first();
        if($country){
            $users->country=$country->name;
        }else{
            $users->country='';
        }
        
        return view('instructor.profile',compact('users','countries','course'));
    }
    public function printCertificates()
    {
        // dd('ggg');
        $user = Auth::guard('instructors')->user();
        // if(!$user)
        //     return redirect('login/user');  
        
        $cer_uniqid=uniqid();
        $check_certificate=Certificate::where('instructor_id',$user->id)->first();    
        if(!$check_certificate){
            $certificate  = new Certificate;
            $certificate->instructor_id    = $user->id;
            $certificate->serial_number    = $cer_uniqid;
            $certificate->save();
        } 
        $serial_number_certificate=Certificate::where('instructor_id',$user->id)->first(); 
        $courses=Course::where('userID',$user->id)->get();
        $course_count=count($courses);
        // return  view('instructor.certificate',compact('user','course_count'));
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
    	
    	$html = view('instructor.certificate',compact('user','course_count','serial_number_certificate'));

    	$html = $html->render();
    	$mpdf->WriteHTML($html);
    	$mpdf->Output($fileName,'I');
        
    }
    public function agreements()
    {
        return view('instructor.agreement');
    }
    public function termsConditions()
    {
        return view('instructor.terms_conditions');
    }

    public function updateProfile(Request $request)
    {
        $userid = Auth::guard('instructors')->user();

        $edit = instructor::findOrFail($userid->id);
        // $edit->name    = $request->name;
        $edit->mobile  = $request->mobile;
        $edit->detail  = $request->detail; 
        $edit->nationality  = $request->nationality;
        if(!$request->countryId){
            $edit->countryId  = $edit->countryId; 
        }else{
            $edit->countryId  = $request->countryId;
        }
        
        // $add->cityId  = $request->cityId;         
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles';
            $request-> file('photo') ->move($path,$file_name);
            File::delete(public_path("img/profiles/". $edit->photo));
            $edit->photo  =$file_nameone;
        }else{
            $edit->photo  = $request->url; 
        }

      
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }


    public function updateDocuments(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        if($passport=$request->file('passport'))
        {
            $passport_extension = $request -> file('passport') -> getClientOriginalExtension();
            $passport_name = rand(1,100).'.'.time().'.'.$passport_extension;
            $passport_nameone = $passport_name;
            $passportـpath = 'img/profiles/documents';
            $request-> file('passport') ->move($passportـpath,$passport_name);
            $edit->passport  =$passport_nameone;
        }else{
            $edit->passport  = $edit->passport;
        }
        if($file=$request->file('identity'))
        {
            $file_extension = $request -> file('identity')-> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles/documents';
            $request-> file('identity') ->move($path,$file_name);
            $edit->identity  =$file_nameone;
        }else{
            $edit->identity  = $edit->identity; 
        }
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }
    public function updateCertificates(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        if($certificate_one=$request->file('certificate_one'))
        {
            $passport_extension = $request -> file('certificate_one') -> getClientOriginalExtension();
            $passport_name = rand(1,100).'.'.time().'.'.$passport_extension;
            $passport_nameone = $passport_name;
            $passportـpath = 'img/profiles/certificate';
            $request-> file('certificate_one') ->move($passportـpath,$passport_name);
            $edit->certificate_one  =$passport_nameone;
        }else{
            $edit->certificate_one  = $edit->certificate_one;
        }
        if($certificate_two=$request->file('certificate_two'))
        {
            $passport_extension = $request -> file('certificate_two') -> getClientOriginalExtension();
            $passport_name = rand(1,90).'.'.time().'.'.$passport_extension;
            $passport_nameone = $passport_name;
            $passportـpath = 'img/profiles/certificate';
            $request-> file('certificate_two') ->move($passportـpath,$passport_name);
            $edit->certificate_two  =$passport_nameone;
        }else{
            $edit->certificate_two  = $edit->certificate_two;
        }
        if($file=$request->file('certificate_three'))
        {
            $file_extension = $request -> file('certificate_three')-> getClientOriginalExtension();
            $file_name = rand(1,50).'.'.time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles/certificate';
            $request-> file('certificate_three') ->move($path,$file_name);
            $edit->certificate_three  =$file_nameone;
        }else{
            $edit->certificate_three  = $edit->certificate_three; 
        }
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }
    public function updateCv(Request $request)
    {
        $userid = Auth::guard('instructors')->user();
        $edit = instructor::findOrFail($userid->id);
        if($cv=$request->file('cv'))
        {
            $passport_extension = $request -> file('cv') -> getClientOriginalExtension();
            $passport_name = rand(1,100).'.'.time().'.'.$passport_extension;
            $passport_nameone = $passport_name;
            $passportـpath = 'img/profiles/cv';
            $request-> file('cv') ->move($passportـpath,$passport_name);
            $edit->cv  =$passport_nameone;
        }else{
            $edit->cv  = $edit->cv;
        }
        
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }

    
    public function changePassword(Request $request){
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


public function getCity($id){
    echo json_encode(DB::table('cities')->where('countryId', $id)->get());
}


    public function bankDetails()
    {        
        $userid = Auth::guard('instructors')->user();
        $bankdetails=Bank::where('userId',$userid->id)->first();
        // dd($userid->id);
        $country= Country::All()->sortBy('nicename');
        $cities= City::All();
        // dd($cities);
        $cities=City::all();
        foreach ($cities as $item) {
            $item->country= Country::where('id',$item->countryId)->first();
        }
        return view('instructor.bank.edit',compact('bankdetails','country','cities'));
    }
   
    public function updateBankDetails(Request $request)
    {
        // dd(strlen($request->acount_number));
        $this->validate( $request,[          
                'countryId'=>'required',
                'city'=>'required',
                'persone_name'=>'required',
                'bank_name'=>'required',
                'bank_sub_name'=>'required',
                // 'acount_number'=>'required',  
                'acount_number'=>'required|max:30',
                
            ],
            [
                'countryId.required'=>'الدولة مطلوبه',
                'city.required'=>' المدينة  مطلوبه ',
                'persone_name.required'=>' اسم الشخص صاحب الحساب مطلوب  ', 
                'bank_name.required'=>' اسم البنك مطلوب   ', 
                'bank_sub_name.required'=>' اسم فرع البنك الذي تم فيه فتح الحساب مطلوب  ', 
                'acount_number.required'=>' رقم الحساب مطلوب',
                // 'acount_number.numeric'=>' رقم الحساب يجب ان يحتوي على ارقام فقط',
                // 'acount_number.max'=>' رقم الحساب لا يجب ان يزيد عن 20 رقم ',

            ]
        );

         $userid = Auth::guard('instructors')->user();
         $edit = Bank::where('userid',$userid->id)->first();
         $edit->persone_name  = $request->persone_name;
         $edit->iban  = $request->iban;
         $edit->countryId  = $request->countryId;
         $edit->city  = $request->city;
         $edit->bank_name  = $request->bank_name;
         $edit->bank_sub_name  = $request->bank_sub_name;
         $edit->acount_number  = $request->acount_number;
         $edit->swift_code  = $request->swift_code;

         $edit->save();
         return back()->with("message", 'تم التعديل بنجاح'); 
    }
    public function westernInfo()
    {        
        $userid = Auth::guard('instructors')->user();
        $bankdetails=Bank::where('userId',$userid->id)->first();
        return view('instructor.bank.western_info',compact('bankdetails'));
    }
    public function updateWesternInfo(Request $request)
    {
        $this->validate( $request,[          
                'persone_name'=>'required',
                'western_country'=>'required',
                'western_city'=>'required',
                'western_mobile'=>'required',
            ],
            [
                'persone_name.required'=>'الاسم مطلوب ويجب ان يكو مطابق للهويه او جواز السفر',
                'western_country.required'=>' البلد',
                'western_city.required'=>' المدينة  ', 
                'western_mobile.required'=>'رقم الهاتف ', 
            ]
        );

        $userid = Auth::guard('instructors')->user();
        $edit = Bank::where('userid',$userid->id)->first();
        $edit->persone_name  = $request->persone_name;
        $edit->western_country  = $request->western_country;
        $edit->western_city  = $request->western_city;
        $edit->western_mobile  = $request->western_mobile;
        $edit->save();
        return back()->with("message", 'تم التعديل بنجاح'); 
    }



    public function removeAcount(Request $request )
    {
        $this->validate( $request,[          
                'your-password'=>'required',
            ],
            [
                'your-password'=>'required',
            ]
        );

        $userid = Auth::guard('instructors')->user();

        if (!(Hash::check($request->get('your-password'), $userid->password))){
            return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        $userblocked = instructor::findOrFail($userid->id); 
        $userblocked->blocked = 0;
        $userblocked->save();

        $user_courses = Course::where('userId',$userid->id)->get();
        foreach ($user_courses as $user_course) {         
            $delete_course = Course::findOrFail($user_course->id);
            File::delete(public_path("assets_admin/img/courses/". $delete_course->image));

            $delete_course->delete();
        }

        $user_views =View::where('userId',$userid->id)->get();
        foreach ($user_views as $user_view) {         
            $delete_view = View::findOrFail($user_view->id);
            $delete_view->delete();
        }
        

        Auth::guard('instructors')->logout();
        // $delete->delete();
        return redirect('/')->with("message",' تم حذف الحساب '); 
    } 

    public function instructionalVideo()
    {
        $admin_videos=Admin_Video::get();
        return view('instructor.instructional_video',compact('admin_videos'));
    }


}


