<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Appointment;
use App\Speciality;
use App\WorkingDays;
use App\Service;
use App\Patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Traits\GeneralTrait;
use DB;
class DoctorController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $doctors = Doctor::selection()->get();         //$doctors=Doctor::all();
        foreach ($doctors as $item) {
            $item->categorynam= Speciality::selection()->where('id',$item->specialityId)->first();
        }

        // dd($doctors);
        
        return $this -> returnData('doctors',$doctors);

       
       
    }

    public function create()
    {
        return view('admin.doctors.create');
    }
    

    public function store(Request $request)
    {
        // dd($request->photo);
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
            $add->photo  = $request->url; 
         }

         if($file2=$request->file('university_degree'))
         {
            // $file_extension2 = $request -> file('university_degree') -> getClientOriginalExtension();
            // $file_name2 = time().'.'.$file_extension2;
            // $file_nameone2 = $file_name2;
            // $path2 = 'assets_admin/img/doctors';
            // $request-> file('university_degree') ->move($path2,$file_name2);

            $file2 = $request->file('university_degree');
            $file_nameone2 = time() . '.' . $request->file('university_degree')->extension();
            $filePath2 = public_path() . '/assets_admin/img/doctors/degree';
            $file2->move($filePath2, $file_nameone2);


            $add->university_degree  = $file_nameone2;  
         }else{
            $add->university_degree  = $request->url2;
         }
        if($fil3=$request->file('practice_certificate'))
         {
            // $file_extension3 = $request -> file('practice_certificate') -> getClientOriginalExtension();
            // $file_name3 = time().'.'.$file_extension3;
            // $file_nameone3 = $file_name3;
            // $path3 = 'assets_admin/img/doctors';
            // $request-> file('practice_certificate') ->move($path3,$file_name3);

            $file3 = $request->file('practice_certificate');
            $file_nameone3 = time() . '.' . $request->file('practice_certificate')->extension();
            $filePath3 = public_path() . '/assets_admin/img/doctors/certificate';
            $file3->move($filePath3, $file_nameone3);

            $add->practice_certificate  = $file_nameone3;   
         }else{
            $add->practice_certificate  = $request->url3;
        }
        if($file4=$request->file('other_qualification'))
         {
            // $file_extension4 = $request -> file('other_qualification') -> getClientOriginalExtension();
            // $file_name4 = time().'.'.$file_extension4;
            // $file_nameone4 = $file_name4;
            // $path4 = 'assets_admin/img/doctors/qualification';
            // $request-> file('other_qualification') ->move($path4,$file_name4);

            $file4 = $request->file('other_qualification');
            $file_nameone4 = time() . '.' . $request->file('other_qualification')->extension();
            $filePath4 = public_path() . '/assets_admin/img/doctors/qualification';
            $file4->move($filePath4, $file_nameone4);

            $add->other_qualification  = $file_nameone4;
         }else{
            $add->other_qualification  = $request->url4;
         }


        
        $add->first_name_ar  = $request->first_name_ar; 
        $add->last_name_ar  = $request->last_name_ar; 
        $add->first_name_en  = $request->first_name_en; 
        $add->last_name_en  = $request->last_name_en;  
        $add->email  = $request->email;   
        $add->password  = bcrypt($request->password);  
        $add->mobile  = $request->mobile;
        $add->address_ar  = $request->address_ar;
        $add->address_en  = $request->address_en;
        $add->location  = $request->location;
        $add->experience  = $request->experience;
        $add->gender  = $request->gender;   
        $add->detectionPrice  = $request->detectionPrice;     
        $add->specialityId  = $request->specialityId; 
        $add-> save();

        return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
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
        return view('admin.doctors.edit',compact('doctor','specialities'));
    }

    public function update(Request $request, Doctor $doctor)
    {
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
            $edit->photo  = $request->url; 
         }

         if($file2=$request->file('university_degree'))
         {
            // $file_extension2 = $request -> file('university_degree') -> getClientOriginalExtension();
            // $file_name2 = time().'.'.$file_extension2;
            // $file_nameone2 = $file_name2;
            // $path2 = 'assets_admin/img/doctors';
            // $request-> file('university_degree') ->move($path2,$file_name2);

            $file2 = $request->file('university_degree');
            $file_nameone2 = time() . '.' . $request->file('university_degree')->extension();
            $filePath2 = public_path() . '/assets_admin/img/doctors/degree';
            $file2->move($filePath2, $file_nameone2);


            $edit->university_degree  = $file_nameone2;  
         }else{
            $edit->university_degree  = $request->url2;
         }
        if($fil3=$request->file('practice_certificate'))
         {
            // $file_extension3 = $request -> file('practice_certificate') -> getClientOriginalExtension();
            // $file_name3 = time().'.'.$file_extension3;
            // $file_nameone3 = $file_name3;
            // $path3 = 'assets_admin/img/doctors';
            // $request-> file('practice_certificate') ->move($path3,$file_name3);

            $file3 = $request->file('practice_certificate');
            $file_nameone3 = time() . '.' . $request->file('practice_certificate')->extension();
            $filePath3 = public_path() . '/assets_admin/img/doctors/certificate';
            $file3->move($filePath3, $file_nameone3);

            $edit->practice_certificate  = $file_nameone3;   
         }else{
            $edit->practice_certificate  = $request->url3;
        }
        if($file4=$request->file('other_qualification'))
         {
            // $file_extension4 = $request -> file('other_qualification') -> getClientOriginalExtension();
            // $file_name4 = time().'.'.$file_extension4;
            // $file_nameone4 = $file_name4;
            // $path4 = 'assets_admin/img/doctors/qualification';
            // $request-> file('other_qualification') ->move($path4,$file_name4);

            $file4 = $request->file('other_qualification');
            $file_nameone4 = time() . '.' . $request->file('other_qualification')->extension();
            $filePath4 = public_path() . '/assets_admin/img/doctors/qualification';
            $file4->move($filePath4, $file_nameone4);

            $edit->other_qualification  = $file_nameone4;
         }else{
            $edit->other_qualification  = $request->url4;
         }


        
        $edit->first_name_ar  = $request->first_name_ar; 
        $edit->last_name_ar  = $request->last_name_ar; 
        $edit->first_name_en  = $request->first_name_en; 
        $edit->last_name_en  = $request->last_name_en;  
        $edit->email  = $request->email;   
        $edit->password  = bcrypt($request->password);  
        $edit->mobile  = $request->mobile;
        $edit->address_ar  = $request->address_ar;
        $edit->address_en  = $request->address_en;
        $edit->location  = $request->location;
        $edit->experience  = $request->experience;
        $edit->gender  = $request->gender;        
        $edit->detectionPrice  = $request->detectionPrice;  
        $edit->specialityId  = $request->specialityId; 
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

        $appointments=Appointment::where('doctorId',$doctors->id)->get();
        
        foreach ($appointments as $item) {
            $item->doc= Doctor::where('id',$item->doctorId)->first();
            $item->patient= Patient::where('id',$item->patientId)->first();
            $item->category= Speciality::all();
        }
        // dd($appointments);
        return view('admin.doctors.doctor-profile',compact('doctors','workday','services','appointments'));
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
        
        
        $from_date = $request->input("from_date");
        $to_date = $request->input("to_date");

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
    
    
    public function addService(Request $request)
    {    
        $person= new Service;
        $person->doctorId  = $request->doctorId;
        $person->services_name  = $request->services_name;
        $person->price  = $request->price;
        $person->save();                   
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function deleteService(Request $request )
    {
        $delete = Service::findOrFail($request->id);
//dd($delete);
        $delete->delete();
        return redirect()->back()->with("message",'تم الحذف بنجاح');
        

    } 

     public function updateService(Request $request)
    {
        
        $edit = Service::findOrFail($request->id);
        $edit->services_name  = $request->services_name;
        $edit->price  = $request->price;
        $edit->save();              
        return redirect()->back()->with("message", 'تم التعديل بنجاح'); 

    }
    


}
