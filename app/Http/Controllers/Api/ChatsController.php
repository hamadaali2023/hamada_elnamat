<?php
namespace App\Http\Controllers\Api;
// all
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
            if($request->doctorId !=null){
                $chats = Chat::where("doctorId" , $request->doctorId)->get();
                foreach ($chats as $item) {
                    $patient= Patient::where('id',$item->patientId)->first(); 
                    $patient->photo="https://findfamily.net/care/assets_admin/img/patients/".$patient->photo; 
                    $item->patient= $patient; 
                    $item->messages= Message::where('chatID',$item->id)->first();       
                }
                return $this->returnDataa('data', $chats,'good');
            }else{
                $chats = Chat::where("patientId" , $request->patientId)->get();
                foreach ($chats as $item) {
                    $doctor= Doctor::where('id',$item->doctorId)->first(); 
                    $doctor->photo="https://findfamily.net/care/assets_admin/img/doctors/photo/".$doctor->photo; 
                    $item->doctor= $doctor; 
                    $item->messages= Message::where('chatID',$item->id)->first();       
                }
                return $this->returnDataa('data', $chats,'rwefw');  
            }
        }

        public function usersGetMessages(Request $request)
        {
            $messages = Message::where("chatID" , $request->chatID)->get();
            foreach($messages as $item)
            {
                $item->file="https://findfamily.net/care/assets_admin/img/chats/".$item->file;
            } 
            return $this->returnDataa('messages', $messages,'fireyfr');
        }

        public function doctorSendMessage(Request $request)
        {
            if($request->doctorId !=null){
                $user = Doctor::where("id" , $request->doctorId)->first();
                $file='';
                $message='';    
                $todayDate = date("Y-m-d");
                $time = new DateTime();
                $time->modify('+2 hours');
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
                    'senderType'=>$request->input('doctorId'),
                    'date'=>$todayDate,
                    // 'time'=>$time->format("H:i")
                    'time'=>$request->input('time'),
                ]);
                 
                broadcast(new MessageSent($user,$message,$request->chatID))->toOthers();
                return $this -> returnSuccessMessage('Message Sent!');
            }else{
                $user = Patient::where("id" , $request->patientId)->first();
                $file='';
                $message='';    
                $todayDate = date("Y-m-d");
                $time = new DateTime();
                $time->modify('+2 hours');
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
                    'senderType'=>$request->input('patientId'),
                    'date'=>$todayDate,
                    // 'time'=>$time->format("H:i")
                    'time'=>$request->input('time')
                ]);
                broadcast(new MessageSent($user,$message,$request->chatID))->toOthers();
                return $this -> returnSuccessMessage('Message Sent!');
            }
        }


        public function creatOrGetMessages(Request $request)
        {
           
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
                foreach($messages as $item)
                {
                    $item->file="https://findfamily.net/care/assets_admin/img/chats/".$item->file;
                } 
                $data  = [  
                    'message'=>$messages,
                    'chatid'=>$chatid,
                    
                ];
                return $this->returnDataa('data', $data,'reoifher');
        }


}
