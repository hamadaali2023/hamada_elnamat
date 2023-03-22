<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Marquee_Text;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class MarqueeController extends Controller
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
        $marquees=Marquee_Text::all();
        
        return view('admin.marquees.all',compact('marquees'));
    }


    public function create()
    {
        return view('admin.marquees.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name'=>'required',
                'type'=>'required',
            ],
            [
                'name.required'=>'  اضف نص',
                'type.required'=>' اختر مكان ظهور النص ',
            ]
        );

        $add = new Marquee_Text;
        $add->name    = $request->name;
        $add->type    = $request->type;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Marquee_Text $marquee_text)
    {
        return view('admin.marquees.edit',compact('marquee_text'));
    }

    public function update(Request $request)
    {
        
        $this->validate( $request,[          
                'name'=>'required',
                
            ],
            [
                'name.required'=>'يرجى ادخال عنوان الفرع  ',
            ]
        );


        $edit = Marquee_Text::findOrFail($request->id);
        $edit->name  =  $request->name;
        
      
         $edit->save();
        
        return redirect()->route('marquees.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        $category = Marquee_Text::findOrFail($request->id);
        // $subcategory=SubCategory::where('id',$category->categoryId)->get();
        // foreach ($subcategory as $item) {
        //     $category= SubCategory::where('id',$item->id)->first();
        //     $category->delete();
        // }
        $category->delete();
        return redirect()->route('marquees.index')->with("message",'تم الحذف بنجاح'); 
    } 
}