<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Http\Request;
use App\Course;
use App\Bank;
use Auth;
use App\Country;
use App\City;
use App\Review;
class AdvisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $advisors=Instructor::where('type','advisor')->get();
        return view('admin.advisors.all',compact('advisors'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Instructor $instructor)
    {
        //
    }
    
    public function edit(Instructor $instructor)
    {
        //
    }

    
    public function update(Request $request, Instructor $instructor)
    {
        
    }

    public function destroy(Request $request)
    {
        $delete = Instructor::findOrFail($request->id);
        // dd($delete);
        $delete->delete();
        return back()->with("message",'تم الحذف بنجاح'); 
    }


    public function profile($id)
    {
        $instructor = Instructor::findOrFail($id);
        $courses = Course::where('userId',$instructor->id)->get();
        // $courses = Course::where('userId',$instructor->id)->get();


        
        $bankdetails=Bank::where('userId',$instructor->id)->first();
        $country= Country::All();
      
        
        $cities=City::all();
        foreach ($cities as $item) {
            $item->country= Country::where('id',$item->countryId)->first();
        }

        $reviews=Review::where('userId',$instructor->id)->get();
        foreach ($reviews as $item) {
            $item->patient= Instructor::where('id',$item->userId)->first();
            $item->patient= Course::where('id',$item->courseId)->first();
        }
        // dd($reviews);
        return view('admin.advisors.advisor-profile',compact('instructor','courses','bankdetails','country','cities','reviews'));
    }
}
