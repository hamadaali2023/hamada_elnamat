<?php

namespace App\Http\Controllers;

use App\Speciality;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }

    public function index()
    {
        $specialities=Speciality::all();
        return view('admin.specialities.all',compact('specialities'));
    }

    public function create()
    {
        return view('admin.specialities.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
                'icon' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
                'icon.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );


        $file_extension = $request -> file('icon') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/specialities';
        $request-> file('icon') ->move($path,$file_name);

        $add = new Speciality;
        $add->name_en    = $request->name_en;
        $add->name_ar  = $request->name_ar;
        $add->icon    = $file_nameone;
        if($request->top !=''){
            $add->top    = $request->top;
         }
        $add->save();


 
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Speciality $speciality)
    {
        return view('admin.specialities.edit',compact('speciality'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
                // 'icon' => 'required|max:10000|mimes:jpeg,jpg,png,gif|'
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
                // 'icon.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );


         $edit = Speciality::findOrFail($request->id);
         $edit->name_ar  = $request->name_ar;
         $edit->name_en    = $request->name_en;
         if($request->top !=''){
            $edit->top    = $request->top;
         }else{
            $edit->top    = 0;
         }
         
         if($file=$request->file('icon'))
         {
            $file_extension = $request -> file('icon') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/specialities';
            $request-> file('icon') ->move($path,$file_name);

            $edit->icon  =$file_nameone;
         }else{
            $edit->icon  = $edit->icon; 
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
