<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sliders=Slider::all();
        return view('admin.sliders.all',compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {


        $this->validate( $request,[          
                'title_ar'=>'required',
                'title_en'=>'required',
                'description_ar'=>'required',
                'description_en'=>'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ],
            [
                'title_ar.required'=>'يرجى كتابة العنوان عربي',
                'title_en.required'=>' يرجى كتابة العنوان انجليزي ',
                'description_ar.required'=>'يرجى كتابة الوصف عربي',
                'description_en.required'=>' يرجى كتابة الوصف انجليزي ',
                'image.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );

        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/sliders';
        $request-> file('image') ->move($path,$file_name);

        $ghgth = new Slider;
        $ghgth->title_ar    = $request->title_ar;
        $ghgth->title_en  = $request->title_en;
        $ghgth->description_ar    = $request->description_ar;
        $ghgth->description_en  = $request->description_en;

        $ghgth->image    = $file_nameone;
        $ghgth->save();
        return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
    }

    
    public function edit(Slider $article)
    {
        return view('admin.sliders.edit',compact('article'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
         $edit = Slider::findOrFail($request->id);
         $edit->title_ar    = $request->title_ar;
         $edit->title_en  = $request->title_en;
         $edit->description_ar    = $request->description_ar;
         $edit->description_en  = $request->description_en;
        
        
         if($file=$request->file('image'))
         {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/sliders';
            $request-> file('image') ->move($path,$file_name);

            $edit->image  =$file_nameone;
         }else{
            $edit->image  = $edit->image; 
         }
         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect()->route('sliders.index')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request)
    {

        $delete = Slider::findOrFail($request->id);
        $delete->delete();
            return redirect()->route('sliders.index')->with("message",'تم الحذف بنجاح');

       
        
    }  
}
