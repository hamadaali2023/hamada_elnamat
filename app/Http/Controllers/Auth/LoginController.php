<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Instructor;
use App\Student;
use DB;
use Crypt;
use Hash;
use Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function LoginAdmin()
    {        
        return view('admin.login');
    }

    //  public function UserLogin()
    // {   
    //     return view('web.loginuser');
    // }


    // public function LoginUser(request $request)
    // {
    //   $this->validate(request(),[
    //         'email'    => 'required',
    //         'password' => 'required',
    //     ],
    //     [
    //        'email.required'=>' البريد  الإلكتروني مطلوب',
    //         'password.required'=>' كلمة المرور مطلوبة',
    //     ]
    //   );

    //   $credentials = $request -> only(['email','password']);

    //   $checkinstructor = Instructor::where("email" , $request->email)->first();
    //   $checkstudent = Student::where("email" , $request->email)->first();
    //   if($checkinstructor){
    //       $good =  Auth::guard('instructors') -> attempt($credentials);
    //       if($good ) {
    //           $user = Auth::guard('instructors')->user();
    //           if($user->is_activated ==0)
    //           {
    //             Auth::logout();
    //             return redirect('login/user')->with("errorss", 'الحساب غير مفعل'); 
    //           }
    //         return redirect('/');
    //       }
    //   }elseif ($checkstudent) {
    //     $good =  Auth::guard('students') -> attempt($credentials);
    //       if($good){
    //           $user = Auth::guard('students')->user();
    //           if($user->is_activated ==0)
    //           {
    //             Auth::logout();
    //             return redirect('login/user')->with("errorss", 'الحساب غير مفعل'); 
    //           }
    //         return redirect('/');
    //       }
    //   }else{
    //     return redirect('login/user')->with("errorss", 'بيانات الدخول غير صحيحة'); 
    //   }
    // }
    // public function signOutInstructors() {
    //   Auth::guard('students')->user()::logout();
    //   return redirect('/');
    // }
    // public function signOutInstructors() {
    //   Auth::guard('students')->user()::logout();
    //   return redirect('/');
    // }
    public function signOut() {
      Auth::logout();
      return redirect('/');
    }

    
}
