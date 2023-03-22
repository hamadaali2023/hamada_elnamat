<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use File;
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

        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/sliders';
        $request-> file('image') ->move($path,$file_name);

        $ghgth = new Slider;
        $ghgth->title    = ['ar' => $request->title_ar, 'en' => $request->title_en];
        $ghgth->description    =  ['ar' => $request->description_ar, 'en' => $request->description_en];

        // $ghgth->title_en  = $request->title_en;
        // $ghgth->description_ar    = $request->description_ar;
        // $ghgth->description_en  = $request->description_en;

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
         $edit->title    = ['ar' => $request->title_ar, 'en' => $request->title_en];;
         $edit->description    = ['ar' => $request->description_ar, 'en' => $request->description_en];
        
        // dd($request -> file('image'));
        // if($file=$request->file('image'))
        // {
        //     $file_extension = $request -> file('image') -> getClientOriginalExtension();
        //     $file_name = time().'.'.$file_extension;
        //     $file_nameone = $file_name;
        //     $path = 'img/sliders';
        //     $request-> file('image') ->move($path,$file_name);

        //     $edit->image  =$file_nameone;
        // }else{
        //     $edit->image  = $edit->image; 
        // }

         if($file=$request->file('image'))
         {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/sliders';
            $request-> file('image') ->move($path,$file_name);
            $edit->image  = $file_nameone;
         }else{
            $edit->image  = $edit->image; 
         }






























         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect()->route('sliders.index')->with("message", 'تم التعديل بنجاح'); 
    }

    // public function destroy(Request $request)
    // {
    //     // dd($request->id);
    //     $delete = Slider::findOrFail($request->id);
    //     $delete->delete();
    //         return redirect()->route('sliders.index')->with("message",'تم الحذف بنجاح');
    // }  
    
    public function destroy(Request $request)
    {
        $delete             = Slider::findOrFail($request->id);
        $image_path         = base_path("assets_admin/img/sliders/") .$delete->image;
        
        if(File::exists($image_path)) {
            // unlink($image_path);
            File::delete($image_path);
        }
        else{
            $delete->delete();
        }
        
        $delete->delete();
        return redirect()->route('sliders.index')->with("message",'تم الحذف بنجاح');
        // return response()->json(['success'=>'Slider deleted successfully!']);
    }
}
