<?php

namespace App\Http\Controllers;

use App\User;
use App\ContactInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id=Auth::user()->id;
        $users=User::findOrFail($id);
        //$users= Auth::user();
        // $edit = User::findOrFail($users);
        //dd($users);
        return view('admin.profile',compact('users'));
    }
   



    public function updateProfile(Request $request)
    {
         // $userId = 1;
         $edit = User::findOrFail($request->id);
         $edit->name    = $request->name;
         $edit->dateOfBirth  = $request->dateOfBirth;
         $edit->mobile  = $request->mobile;
         $edit->address  = $request->address;
         $edit->photo  = $request->photo;
        
         if($file=$request->file('photo'))
         {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/users';
            $request-> file('photo') ->move($path,$file_name);

            $edit->photo  =$file_nameone;
         }else{
            $edit->photo  = $request->url; 
         }
         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect('profile')->with("message", 'تم التعديل بنجاح'); 
    }

    public function settings()
    {
        
        // $id=Auth::user()->id;
        $contactInfo=ContactInfo::first();
        //$users= Auth::user();
        // $edit = User::findOrFail($users);

        // dd($contactInfo);
        return view('admin.settings.settings',compact('contactInfo'));
    }
    

    public function about()
    {
        $contactInfo=ContactInfo::first();
        return view('admin.settings.about',compact('contactInfo'));
    }

    public function contact()
    {
        $contactInfo=ContactInfo::first();
        return view('admin.settings.contact',compact('contactInfo'));
    }

    public function privacy()
    {
        $contactInfo=ContactInfo::first();
        return view('admin.settings.privacy',compact('contactInfo'));
    }
    
    public function updateSettings(Request $request)
    {
         // $userId = 1;
         $edit = ContactInfo::findOrFail($request->id);
         
         if($file=$request->file('logo'))
         {
            $file_extension = $request -> file('logo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/settings';
            $request-> file('logo') ->move($path,$file_name);
            $edit->logo  = $file_nameone;
         }else{
            $edit->logo  = $request->url; 
         }

         if($file=$request->file('favicon'))
         {
            $file_extension2 = $request -> file('favicon') -> getClientOriginalExtension();
            $file_name2 = time().'.'.$file_extension2;
            $file_nameone2 = $file_name2;
            $path2 = 'assets_admin/img/settings';
            $request-> file('favicon') ->move($path2,$file_name2);
            $edit->favicon  = $file_nameone2;  
         }else{
            $edit->favicon  = $request->url2;
         }
        if($file=$request->file('vesion_image'))
         {
            $file_extension3= $request -> file('vesion_image') -> getClientOriginalExtension();
            $file_name3 = time().'.'.$file_extension3;
            $file_nameone3 = $file_name3;
            $path3 = 'assets_admin/img/settings';
            $request-> file('vesion_image') ->move($path3,$file_name3);
            $edit->vesion_image  = $file_nameone3;   
         }else{
            $edit->vesion_image  = $request->url3;
        }
        if($file=$request->file('mesion_image'))
         {
            $file_extension4 = $request -> file('mesion_image') -> getClientOriginalExtension();
            $file_name4 = time().'.'.$file_extension4;
            $file_nameone4 = $file_name4;
            $path4 = 'assets_admin/img/settings';
            $request-> file('mesion_image') ->move($path4,$file_name4);
            $edit->mesion_image  = $file_nameone4;
         }else{
            $edit->mesion_image  = $request->url4;
         }

         $edit->title_ar  = $request->title_ar;
         $edit->title_en  = $request->title_en;
         $edit->phone  = $request->phone;
         $edit->email  = $request->email;
         $edit->address_ar  = $request->address_ar;
         $edit->address_en  = $request->address_en;
         $edit->location  = $request->location;
         $edit->mesion_ar  = $request->mesion_ar;
         $edit->mesion_en  = $request->mesion_en;
         $edit->vesion_ar  = $request->vesion_ar;
         $edit->vesion_en  = $request->vesion_en;
         $edit->description_ar  = $request->description_ar;
         $edit->description_en  = $request->description_en;
         $edit->version  = $request->version;
         
         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect('settings')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request )
    {
        // $delete = User::findOrFail($request->id);
        // $delete->delete();
        //     return redirect()->route('users.index')->with("message",'تم الحذف بنجاح');

    } 


    public function changePassword(Request $request){
        $user=Auth::user();
        $this->validate($request, [
            'current-password'     => 'required',
            'new-password'     => 'required',
            // 'confirm_password' => 'required|same:new_password',
        ]);
        // dd('ugutg');
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            return redirect()->back()->with("error","كلمة المرور الحالية لا تتطابق مع كلمة المرور التي قدمتها. حاول مرة اخرى.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error","لا يمكن أن تكون كلمة المرور الجديدة هي نفسها كلمة مرورك الحالية. الرجاء اختيار كلمة مرور مختلفة.");
        }

        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("message","تم تغيير الرقم السري بنجاح !");
    }
}
