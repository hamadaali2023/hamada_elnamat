<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Material;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;

class MaterialController extends Controller
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
        $materials=Material::all();
        
        return view('admin.materials.all',compact('materials'));
    }


    public function create()
    {
        return view('admin.materials.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name'=>'required',
            ],
            [
                'name.required'=>'يرجى ادخال عنوان الفرع',
            ]
        );

        $add = new Material;
        $add->name    = $request->name;
        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function edit(Branch $branch)
    {
        return view('admin.materials.edit',compact('branch'));
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


        $edit = Material::findOrFail($request->id);
        $edit->name  =  $request->name;
        
      
         $edit->save();
        
        return redirect()->route('materials.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        
            $category = Material::findOrFail($request->id);
            // $subcategory=SubCategory::where('id',$category->categoryId)->get();
            // foreach ($subcategory as $item) {
            //     $category= SubCategory::where('id',$item->id)->first();
            //     $category->delete();
               
            // }
             $category->delete();
             return redirect()->route('materials.index')->with("message",'تم الحذف بنجاح'); 
    } 
}