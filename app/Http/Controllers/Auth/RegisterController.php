<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Instructor;
use App\Student;
use App\Wallet;
use App\Bank;
use Illuminate\Support\Str;
use Mail;
use DB;
use Crypt;
use Auth;
use App\Country;

class RegisterController extends Controller
{
    use RegistersUsers;
    // protected $redirectTo = RouteServiceProvider::HOME;

    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // public function registerUser()
    // {   
    //     $countries=Country::all();

    //     return view('front.signup',compact('countries'));
    // }
    // public function getCountry($id){
    //     echo json_encode(DB::table('cities')->where('countryId', $id)->get());
    // }
    
    // public function registerNewUser(Request $request)
    // {
    //     $checkemail = Instructor::where("email" , $request->email)->first();
    //     if($checkemail){
    //         if(isset($request->lang)  && $request -> lang == 'en' ){
    //             return back()->with("errorss", 'Email already exists'); 
    //         }else{
    //             return back()->with("errorss", 'البريد الإلكتروني موجود مسبقا'); 
    //         }
    //     }else{
    //         $add = new Instructor();
    //         // if($file=$request->file('photo'))
    //         // {
    //         //     $file_extension = $request -> file('photo') -> getClientOriginalExtension();
    //         //     $file_name = time().'.'.$file_extension;
    //         //     $file_nameone = $file_name;
    //         //     $path = 'img/profiles';
    //         //     $request-> file('photo') ->move($path,$file_name);
    //         //     $add->photo  = $file_nameone;
    //         // }else{
    //         //     $add->photo  = $request->url; 
    //         // }
    
    //         $add->name  = $request->name;    
    //         $add->email  = $request->email;   
    //         $add->password  = bcrypt($request->password); 
    //         // $add->mobile  = $request->mobile; 
    //         // $add->detail  = $request->detail; 
    //         $add->countryId  = $request->countryId; 
    //         $add->type  = $request->type; 
    //         // $add->cityId  = $request->cityId; 
    //         // $add->dateOfBirth  = $request->dateOfBirth; 
    //         // $add->address  = $request->address; 
    //         // $add->gender  = $request->gender;
    //         $add->save();

    //         $createwallet = new Wallet;
    //         $createwallet->userId    = $add->id;
    //         $createwallet->save();

    //         $createwallet = new Bank;
    //         $createwallet->userId    = $add->id;
    //         $createwallet->save();

    //         $user = $add->toArray();
    //         $user['link'] = Str::random(30);
    //         DB::table('user_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);
    //         Mail::send('emails.activation', $user, function($message) use ($user){
    //             $message->to($user['email']);
    //             $message->subject('walletskids.com - Activation Code');
    //         });

    //         if(isset($request->lang)  && $request -> lang == 'en' ){
    //             return redirect()->back()->with("message", 'registered Successfully'); 
    //         }else{
    //             return redirect()->back()->with("message", 'تم التسجيل بنجاح يرجي زيارة بريدك الإلكتروني'); 
    //         }
    //     }
       

    // }
    // public function instructorActivation($token){
    //     $check = DB::table('user_activations')->where('token',$token)->first();
    //     if(!is_null($check)){
    //         $user = Instructor::find($check->id_user);
    //         if ($user->is_activated ==1){
    //           //  return $this -> returnSuccessMessage('حسابكم مفعل');
    //             return redirect()->to('login/user')->with('message'," الحساب مفعل ");
    //         }
    //         $user->update(['is_activated' => 1]);
    //         DB::table('user_activations')->where('token',$token)->delete();
    //         //  return $this -> returnSuccessMessage('تم تفعيل حسابك');
    //         return redirect()->to('login/user')->with('message',"تم تفعيل حسابك");
    //     }
    //     // return $this -> returnError('رمز التفعيل غير صالح');  
    //     return redirect()->to('/login/user')->with('Warning',"رمز التفعيل غير صالج");
    // }
           

    
}
