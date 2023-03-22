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
use App\Courses_joined;
use App\Subscription;
use App\Certificate;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
    public function index()
    {
        //
    }
     public function allStudentsEmails()
    {
        $students=Instructor::where('type','student')->orderBy('id', 'DESC')->get();
        return view('admin.students.all-students-emails',compact('students'));
    }
    public function userCertificate()
    {
        $certificates = Certificate::get();
        
        foreach ($certificates as $item) {
            $item->student=Instructor::where('id',$item->student_id)->first();
            $item->course= Course::where('id',$item->course_id)->first();
            
        }
        // dd($certificates);
        return view('admin.students.certificate',compact('certificates'));
    }

    
  
   
    public function destroy(Request $request)
    {
        $delete = Instructor::findOrFail($request->id);
        // dd($delete);
        $delete->delete();
        return back()->with("message",'تم الحذف بنجاح'); 
    }

    public function profile($id)
    {
        $instructor = Instructor::where('id',$id)->first();
        $country= Country::where('id',$instructor->countryId)->first();
        $instructor->country=$country->name;
        $country= Country::All();
        
        $cities=City::all();
        
        
        // dd($reviews);
        $courses_joind=[];
        $courses_joined_live=[];
        $coursejoind_student=Courses_joined::where('student_id',$instructor->id)->get();
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
        
          
        
        // dd($instructor);
          
        return view('admin.students.student-profile',compact('instructor','country','cities','courses_joind','courses_joined_live'));
    }
    public function updateProfile(Request $request)
    {
        // dd($request->id);
        $edit = instructor::findOrFail($request->id);
        $edit->full_name    = $request->name;
        $edit->mobile  = $request->mobile;
        // $edit->detail  = $request->detail; 
        // $add->countryId  = $request->countryId; 
        // $add->cityId  = $request->cityId;         
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/profiles';
            $request-> file('photo') ->move($path,$file_name); 
            $edit->photo  =$file_nameone;
        }else{
            $edit->photo  = $request->url; 
        }
        $edit->save();
        return back()->with("success", 'تم التعديل بنجاح'); 
    }
    public function studentChangePassword(Request $request){
        
        $user=  Instructor::find($request->id);
        // dd('hhhhh');
        $this->validate( $request,[          
                // 'current-password'=>'required',
                'new-password'=>'required',
            ],
            [
                // 'current-password'=>'required',
                'new-password'=>'required',
            ]
        );

        // if (!(Hash::check($request->get('current-password'), $user->password))) {
        //     return redirect()->back()->with("errorss","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        // }

        // if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //     return redirect()->back()->with("errorss","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        // }

        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","تم تغيير الرقم السري بنجاح !");
    }

    public function studentNotifaction()
    {
        $students= Instructor::where('type','student')->where('status',1)->get();
        return view('admin.students.notifaction',compact('students'));
    }

    public function studentSendNotifaction(Request $request)
    {
        // dd($request->doctorId);
        // dd($request->message);
        $length = count($request->device_token);
        if($length > 0)
        {
            for($i=0; $i<$length; $i++)
            {
                $SERVER_API_KEY = 'AAAA12iRXek:APA91bHSmMEKt_Vi3RamfrBtk5R6p6hN5w0qsj5NotG5Xa5ttX1TudSPZLHBiUEXV4jKQ6CZBb1Cm_142nJroxyVU-3LRfQUYyz2ainfRFqIOdf1srFSU5RTsIgcI1LT1TtWPNf5TwXZ';
                $token_1 = $request->device_token[$i];
                $message = $request->message;
                // if(isset($request->lang)  && $request ->lang == 'en' ){
                //     $message= $request->message;
                // }else{
                //     $message= $request->message;
                // }
                
                $data = [
                    "registration_ids" => [
                        $token_1
                    ],
                    "notification" => [
                        "title" => 'Espitalia',
                        "body" =>  $message,
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
                    
            }                      
        }
        return redirect()->back()->with("message","تم الإرسال");       
    }
}
