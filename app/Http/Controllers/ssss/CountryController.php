<?php

namespace App\Http\Controllers;

use App\Country;
use App\Doctor;
use App\City;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);

    }

    public function index()
    {
        $countries=Country::all();
        return view('admin.countries.all',compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
            ]
        );

        $add = new Country;
        $add->name_en    = $request->name_en;
        $add->name_ar  = $request->name_ar;
        $add->save(); 
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Country $country)
    {
        return view('admin.countries.edit',compact('country'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
            ]
        );


         $edit = Country::findOrFail($request->id);
         $edit->name_ar  = $request->name_ar;
         $edit->name_en    = $request->name_en;
         $edit->save();
        return redirect()->route('countries.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        $doctors=Doctor::where('countryId',$request->id)->get(); 
        $cities=City::where('countryId',$request->id)->get(); 
        if(count($doctors) == 0){
            if(count($doctors) == 0){
                $delete = Country::findOrFail($request->id);
                $delete->delete();
                return redirect()->route('countries.index')->with("message",'تم الحذف بنجاح'); 
            }else{
               return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
            }  
        }      
    } 
}
