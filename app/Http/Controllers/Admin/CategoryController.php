<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use App\SubCategory;
class CategoryController extends Controller
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
        $categories=Category::all();
        return view('admin.categories.all',compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    

    
    public function store(Request $request)
    {

        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
            ]
        );

        // $file_extension = $request -> file('icon') -> getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $file_nameone = $file_name;
        // $path = 'assets_admin/img/categories';
        // $request-> file('icon') ->move($path,$file_name);

        $add = new Category;
        $add->title    = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $add->num= $request->num;
        // $add->icon    = $file_nameone;
        // if($request->top !=''){
        //     $add->top    = $request->top;
        //  }
        $add->save();


 
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
                // 'icon' => 'required|max:10000|mimes:jpeg,jpg,png,gif|'
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>' يرجى ادخال اسم التخصص انجليزي ',
                // 'icon.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
            ]
        );


        $edit = Category::findOrFail($request->id);
        $edit->title  = ['ar' => $request->name_ar, 'en' => $request->name_en];
        
        if($request->num !=''){
            $edit->num    = $request->num;
         }else{
            $edit->num    = $edit->num;
         }
        //  if($request->top !=''){
        //     $edit->top    = $request->top;
        //  }else{
        //     $edit->top    = 0;
        //  }
         
        //  if($file=$request->file('icon'))
        //  {
        //     $file_extension = $request -> file('icon')->getClientOriginalExtension();
        //     $file_name = time().'.'.$file_extension;
        //     $file_nameone = $file_name;
        //     $path = 'assets_admin/img/categories';
        //     $request-> file('icon') ->move($path,$file_name);

        //     $edit->icon  =$file_nameone;
        //  }else{
        //     $edit->icon  = $edit->icon; 
        //  }
         $edit->save();
        // $category = Speciality::findOrFail($request->id);
        // $category->update($request->all());
        return redirect()->route('categories.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        
            $category = Category::findOrFail($request->id);
            // $subcategory=SubCategory::where('id',$category->categoryId)->get();
            // foreach ($subcategory as $item) {
            //     $category= SubCategory::where('id',$item->id)->first();
            //     $category->delete();
               
            // }
             $category->delete();
             return redirect()->route('categories.index')->with("message",'تم الحذف بنجاح'); 
    } 
}