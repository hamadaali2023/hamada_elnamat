<?php

namespace App\Http\Controllers\Api;

use App\Speciality;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Traits\GeneralTrait;


class SpecialityController extends Controller
{

    use GeneralTrait;
    public function index()
    {

         $specialities = Speciality::selection()->get();
        return $this -> returnData('specialities',$specialities);

    }

    public function create()
    {
        return view('admin.specialities.create');
    }
    

    
    public function store(Request $request)
    {
        $file_extension = $request -> file('icon') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/specialities';
        $request-> file('icon') ->move($path,$file_name);

        $ghgth = new Speciality;
        $ghgth->name_en    = $request->name_en;
        $ghgth->name_ar  = $request->name_ar;
        $ghgth->icon    = $file_nameone;
        $ghgth->save();


 
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Speciality $speciality)
    {
        return view('admin.specialities.edit',compact('speciality'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
         $edit = Speciality::findOrFail($request->id);
         $edit->name_ar  = $request->name_ar;
         $edit->name_en    = $request->name_en;
         
         if($file=$request->file('icon'))
         {
            $file_extension = $request -> file('icon') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/specialities';
            $request-> file('icon') ->move($path,$file_name);

            $edit->icon  =$file_nameone;
         }else{
            $edit->icon  = $request->url; 
         }
         $edit->save();
        // $category = Speciality::findOrFail($request->id);
        // $category->update($request->all());
        return redirect()->route('specialities.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        $appointment=Doctor::where('specialityId',$request->id)->get(); 
        if(count($appointment) == 0){
            $delete = Speciality::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('specialities.index')->with("message",'تم الحذف بنجاح'); 
        }else{
           return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        }        
    } 
}
