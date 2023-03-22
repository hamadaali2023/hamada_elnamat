<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class SliderController extends Controller
{
   
    public function index()
    {
        // $sliders=Slider::all();
        return view('slid');
    }

    public function create()
    {
            return redirect('slidersss')->with("message",'تمت الإضافة بنجاح'); 

        // return redirect('sliders')->withMessage('IT WORKS!');
        // return redirect('sliders')->with("success",'تمت الإضافة بنجاح'); 
        // return redirect()->route('sliders.create')->with('success', 'your message,here');  
        // return redirect('admin/sliders/create')->with('message',"erfugeruyfguyergufgueyrgfu");
        // return redirect('admin/sliders/create')->with('success','Successfully Log in '); 
    }

    public function store(Request $request)
    {

        // $file_extension = $request -> file('image') -> getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $file_nameone = $file_name;
        // $path = 'img/sliders';
        // $request-> file('image') ->move($path,$file_name);

        // $ghgth = new Slider;
        // $ghgth->title    = ['ar' => $request->title_ar, 'en' => $request->title_en];
        // $ghgth->description    =  ['ar' => $request->description_ar, 'en' => $request->description_en];

       
        // $ghgth->image    = $file_nameone;
        // $ghgth->save();
        return redirect()->back()->with("success",'تمت الإضافة بنجاح'); 
    }

   
}
