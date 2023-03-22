<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Straight;
use App\Wallet;
class DashBoardController extends Controller
{
       
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
        // $this->middleware('permission:specialities', ['only' => ['index']]);
        // $this->middleware('permission:اضافة صلاحية', ['only' => ['create','store']]);
        // $this->middleware('permission:تعديل صلاحية', ['only' => ['edit','update']]);
        // $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }

    public function index()
    {
        
        // dd($notifications);
        // return \Response::json($notifications);
        // return $this->returnData('patients', $notifications);
        $userid = Auth::guard('instructors')->user();
        $user_wallet= Wallet::where('user_id',$userid->id)->first();
        $straights=Straight::where('userId',$userid->id)->count();
        $books_count=Course::where('userId',$userid->id)->count();
        // dd($books_count);
        return view('instructor.index',compact('books_count','straights','user_wallet'));
    }

    // public function create()
    // {
    //     return view('admin.sliders.create');
    // }
    

    // public function store(AircraftRequest $request)
    // {
    //     $userId = 1;
    //     $file_extension = $request -> file('logoone') -> getClientOriginalExtension();
    //     $file_name = time().'.'.$file_extension;
    //     $file_nameone = $file_name;
    //     $path = 'admin/images/aircraft';
    //     $request-> file('logoone') ->move($path,$file_name);

    //     $request->merge(['created_by'=>$userId]);
    //     $request->merge(['logo'=>$file_nameone]);
    //     //dd($request->all());
    //     Slider::create($request->all());
    //     return redirect()->back()->with("message", __('admin.createSuccess')); 
    // }

    
    // public function edit(Slider $slider)
    // {
    //     return view('admin.sliders.edit',compact('slider'));
    // }

    // public function update(AircraftRequest $request, Slider $slider)
    // {
    //     $userId = 1;
    //      if($file=$request->file('logoone'))
    //      {
    //         $file_extension = $request -> file('logoone') -> getClientOriginalExtension();
    //         $file_name = time().'.'.$file_extension;
    //         $file_nameone = $file_name;
    //         $path = 'admin/images/aircraft';
    //         $request-> file('logoone') ->move($path,$file_name);
    //         $request->merge(['logo'=>$file_nameone]);

    //          $request->merge(['updated_by'=>$userId]);
    //          $slider->update($request->all());
    //      }else{
    //       $request->merge(['logo'=> $request->url]);
    //       $request->merge(['updated_by'=>$userId]);
    //       $slider->update($request->all());
    //      }
       
    //     dd($request->all());
    //     //return redirect()->route('aircraft.index')->with("message", __('admin.updateSuccess')); 
    // }

    // public function destroy(Slider $slider)
    // {

    //     $Charter=Charter::where('aircraftId',$slider->id)->get(); 
    //     if(count($Charter) == 0){
    //         $slider->delete();
    //         return redirect()->route('aircraft.index')->with("message", __('admin.deleteSuccess')); 
    //     }else{
    //        return redirect()->back()->with("error", 'It is not allowed to delete this item'); 
    //     }

        
    // } 
}
