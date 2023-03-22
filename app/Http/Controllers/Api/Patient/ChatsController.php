<?php
namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Message;

// use Illuminate\Support\Facades\Auth;
// use App\Events\MessageSent;
use App\Traits\GeneralTrait;

use App\Events\MessageSent;
use Validator;
use App\User;
use App\Chat;
use DateTime;
use Auth;
use App\Patient;
use App\Doctor;
class ChatsController extends Controller
{
         use GeneralTrait;
        public function patientChat(Request $request)
        {
            // $user = Auth::guard('patient-api')->user();
            $chats = Chat::where("patientId" , $request->patientId)->get();
            foreach ($chats as $item) {
                $item->doctor= Doctor::selection()->where('id',$item->doctorId)->first();   
                $item->messages= Message::where('chatID',$item->id)->first();       
            }
            return $this->returnData('chats', $chats);
        }

        public function patientFetchMessages(Request $request)
        {
            // return Message::with('user')->get();
            $messages = Message::where("chatID" , $request->chatID)->get();
            return $this->returnData('messages', $messages);

        }

        

        public function patientSendMessage(Request $request)
        {
            // $user = Auth::user();
            // doctor-api
            // patient-api
        
            // $user = Auth::guard('patient-api')->user();
            $user = Patient::where("id" , $request->id)->first();
           
            $file='';
            $message='';    
            $todayDate = date("Y-m-d");
            $time = new DateTime();
            $time->modify('+2 hours');
            // $time->format("H:i");            
            if($file=$request->file('file'))
            {
                $file_extension = $request -> file('file') -> getClientOriginalExtension();
                $file_name = time().'.'.$file_extension;
                $file_nameone = $file_name;
                $path = 'assets_admin/img/chats';
                $request-> file('file') ->move($path,$file_name);
                    $file = $file_nameone;
            }else{
                $file = '';
            }
            if($message=$request->input('message'))
            {
                $message = $message = $request->input('message');
            }else{
                $message = '';
            }

            
            $message = $user->messages()->create([
                'file' => $file,
                'message' => $message,
                'chatID' => $request->input('chatID'),
                'senderType'=>$request->input('id'),
                'date'=>$todayDate,
                // 'time'=>$time->format("H:i")
                'time'=>$request->input('time')
            ]);
            //  dd($message);
              broadcast(new MessageSent($user,$message,$request->chatID))->toOthers();

               // return ['status' => 'Message Sent!'];
              return $this -> returnSuccessMessage('Message Sent!');
        }


        public function creatOrGetMessages(Request $request)
        {
            // return Message::with('user')->get();
            // $messages = Chat::where("patientId" , $request->patientId)->where("doctorId" , $request->doctorId)->first());
            //     if(!$messages){
            //         $chatid=$messages->id ;
            //         $messages = Message::where("chatID" , $request->chatid)->get();
            //         return $this->returnData('messages', $messages);

            //     }
            // $chats = Chat::where("patientId" , $request->patientId)->where("doctorId" , $request->doctorId)->get();
            // dd($chats);
            $mess1 = Chat::where("patientId" , $request->patientId)->where("doctorId" , $request->doctorId)->first();
            // dd($mess1);

            if($mess1 ==null)
            {
                $add = new Chat;
                $add->patientId    = $request->patientId;
                $add->doctorId    = $request->doctorId;
                $add->save();
                $data  = [  
                    'message'=>[],
                    'chatid'=>$add->id,
                    
                ];
                return $this->returnData('data', $data);
            }
                $chatid=$mess1->id ;
                $messages = Message::where("chatID" , $chatid)->get();
                $data  = [  
                    'message'=>$messages,
                    'chatid'=>$chatid,
                    
                ];
                return $this->returnData('data', $data);



        }












    public function login(Request $request)
    {
// dd('token');
        try {
            // $rules = [
            //     "email" => "required",
            //     "password" => "required",
            //     // "device_token" => "required"


            // ];

            // $validator = Validator::make($request->all(), $rules);

            // if ($validator->fails()) {
            //     $code = $this->returnCodeAccordingToInput($validator);
            //     return $this->returnValidationError($code, $validator);
            // }

            //login

             $credentials = $request -> only(['email','password']) ;

           $token =  Auth::guard('api') -> attempt($credentials);
           // dd($token);
           // if(!$token)
           //     return $this->returnError('E001','بيانات الدخول غير صحيحة');

             $admin = Auth::guard('api') -> user();
             $admin -> api_token = $token;

             $UserData = User::where("email" , $request->email)->first();
             // $UserData->device_token=$request->device_token;
             $UserData->token=$token;
            
             $UserData->save();


        //   $userid= $UserData->id;
              // $patient = User::find($UserData->id);
       
             return response()->json($UserData);

        }catch (\Exception $ex){
            // return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function patientlogin(Request $request)
    {
// dd('token');
        try {
            // $rules = [
            //     "email" => "required",
            //     "password" => "required",
            //     // "device_token" => "required"


            // ];

            // $validator = Validator::make($request->all(), $rules);

            // if ($validator->fails()) {
            //     $code = $this->returnCodeAccordingToInput($validator);
            //     return $this->returnValidationError($code, $validator);
            // }

            //login

             $credentials = $request -> only(['email','password']) ;

           $token =  Auth::guard('patient-api') -> attempt($credentials);
           // dd($token);
           // if(!$token)
           //     return $this->returnError('E001','بيانات الدخول غير صحيحة');

             $admin = Auth::guard('patient-api') -> user();
             $admin -> api_token = $token;

             $UserData = Patient::where("email" , $request->email)->first();
             // $UserData->device_token=$request->device_token;
             $UserData->token=$token;
            
             $UserData->save();


        //   $userid= $UserData->id;
              // $patient = User::find($UserData->id);
       
             return response()->json($UserData);

        }catch (\Exception $ex){
            // return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function doctorlogin(Request $request)
    {
// dd('token');
        try {
            // $rules = [
            //     "email" => "required",
            //     "password" => "required",
            //     // "device_token" => "required"


            // ];

            // $validator = Validator::make($request->all(), $rules);

            // if ($validator->fails()) {
            //     $code = $this->returnCodeAccordingToInput($validator);
            //     return $this->returnValidationError($code, $validator);
            // }

            //login

           $credentials = $request -> only(['email','password']) ;

           $token =  Auth::guard('doctor-api') -> attempt($credentials);
           // dd($token);
           // if(!$token)
           //     return $this->returnError('E001','بيانات الدخول غير صحيحة');

             $admin = Auth::guard('doctor-api') -> user();
             $admin -> api_token = $token;

             $UserData = Doctor::where("email" , $request->email)->first();
             // $UserData->device_token=$request->device_token;
             $UserData->token=$token;
            
             $UserData->save();


        //   $userid= $UserData->id;
              // $patient = User::find($UserData->id);
       
             return response()->json($UserData);

        }catch (\Exception $ex){
            // return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

}
