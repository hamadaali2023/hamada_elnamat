<?php
namespace App\Http\Controllers\Api\Doctor;

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
        public function doctorChat(Request $request)
        {
            // $user = Auth::guard('patient-api')->user();
            $chats = Chat::where("doctorId" , $request->doctorId)->get();
            foreach ($chats as $item) {
                $item->doctor= Patient::selection()->where('id',$item->patientId)->first();   
                $item->messages= Message::where('chatID',$item->id)->first();       
            }
            return $this->returnDataa('chats', $chats,'good');
        }

        public function doctorFetchMessages(Request $request)
        {
            // return Message::with('user')->get();
            $messages = Message::where("chatID" , $request->chatID)->get();
            return $this->returnDataa('messages', $messages,'fireyfr');

        }

        

        public function doctorSendMessage(Request $request)
        {
               // dd('ertyuiop');  
              // $user = Auth::user();
                // doctor-api
                // patient-api
        
              // $user = Auth::guard('patient-api')->user();
                         
           $user = Doctor::where("id" , $request->id)->first();


            $file='';
            $message='';    
            $todayDate = date("Y-m-d");
            $time = new DateTime();
            $time->modify('+2 hours');
            // $time->format("H:i");
            // dd($time);
            
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
                'time'=>$request->input('time'),
            ]);
             
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
                return $this->returnDataa('data', $data,'reoifher');



        }


}
