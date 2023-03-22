<?php

namespace App\Http\Controllers\Api;

use App\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
class SliderController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $sliders = Slider::selection()->get();
        //return response()->json($categories);

        return $this -> returnData('sliders',$sliders);
        
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
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
            $edit->image  = $request->url; 
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
