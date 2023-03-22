<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\City;
use App\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function index()
    {
        $cities=City::all();
        foreach ($cities as $item) {
            $item->country= Country::where('id',$item->countryId)->first();
        }
        $countries=Country::all();
        return view('admin.cities.all',compact('cities','countries'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name'=>'required',
            ],
            [
                'name.required'=>'يرجى ادخال اسم التخصص عربي',
            ]
        );

        $add = new City;
        $add->countryId    = $request->countryId;
        $add->name   = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $add->save(); 
        // toastr()->success(trans('messages.success'));
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(City $city)
    {
        // dd($city);
        $countries=Country::get(); 
        return view('admin.cities.edit',compact('city','countries'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'name'=>'required',
            ],
            [
                'name.required'=>'يرجى ادخال اسم التخصص عربي',
            ]
        );


         $edit = City::findOrFail($request->id);
         $edit->countryId  = $request->countryId;
         $edit->name  = ['ar' => $request->name_ar, 'en' => $request->name_en];
         
         $edit->save();
        // $category = Speciality::findOrFail($request->id);
        // $category->update($request->all());
        return redirect()->route('cities.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $doctors=Doctor::where('countryId',$request->id)->get(); 
        // if(count($doctors) == 0){
            $delete = City::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('cities.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}
