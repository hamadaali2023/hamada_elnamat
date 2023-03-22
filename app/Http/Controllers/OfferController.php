<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $offers=Offer::all();
        foreach ($offers as $item) {
            $item->doctor= Doctor::where('id',$item->doctorId)->first('name')->name;
        }
        return view('admin.offers.all',compact('offers'));
    }

    public function create()
    {
        return view('adminscreen.aircraft.create');
    }
    

    public function store(AircraftRequest $request)
    {
        $userId = 1;
        $file_extension = $request -> file('logoone') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'admin/images/aircraft';
        $request-> file('logoone') ->move($path,$file_name);

        $request->merge(['created_by'=>$userId]);
        $request->merge(['logo'=>$file_nameone]);
        //dd($request->all());
        AirCraft::create($request->all());
        return redirect()->back()->with("message", __('admin.createSuccess')); 
    }

    
    public function edit(AirCraft $aircraft)
    {
        return view('adminscreen.aircraft.edit',compact('aircraft'));
    }

    public function update(AircraftRequest $request, AirCraft $aircraft)
    {
        $userId = 1;
         if($file=$request->file('logoone'))
         {
            $file_extension = $request -> file('logoone') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'admin/images/aircraft';
            $request-> file('logoone') ->move($path,$file_name);
            $request->merge(['logo'=>$file_nameone]);

             $request->merge(['updated_by'=>$userId]);
             $aircraft->update($request->all());
         }else{
          $request->merge(['logo'=> $request->url]);
          $request->merge(['updated_by'=>$userId]);
          $aircraft->update($request->all());
         }
       
        dd($request->all());
        //return redirect()->route('aircraft.index')->with("message", __('admin.updateSuccess')); 
    }

    public function destroy(AirCraft $aircraft)
    {

        $Charter=Charter::where('aircraftId',$aircraft->id)->get(); 
        if(count($Charter) == 0){
            $aircraft->delete();
            return redirect()->route('aircraft.index')->with("message", __('admin.deleteSuccess')); 
        }else{
           return redirect()->back()->with("error", 'It is not allowed to delete this item'); 
        }

        
    } 
}
