<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\ChildCategory;
use App\SubCategory;
use App\Category;
use Illuminate\Http\Request;
use DB;
class ChildCategoryController extends Controller
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
        $subcategory=SubCategory::all();
        $categories=Category::all();
        $childcategory=ChildCategory::all();
        return view('admin.childcategory.all',compact('categories','subcategory','childcategory'));
    }
    
    public function getsubcategory($id){
        echo json_encode(SubCategory::where('categoryId', $id)->get());
    }

    public function create()
    {
        return view('admin.subcategory.create');
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

        $add = new ChildCategory;
        $add->title    = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $add->categoryId    = $request->categoryId;
        $add->subCategoryId    = $request->subCategoryId;

        $add->save();
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }
    
    public function edit(ChildCategory $category)
    {
        return view('admin.childcategory.edit',compact('category'));
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

         $edit = ChildCategory::findOrFail($request->id);
         $edit->title  = ['ar' => $request->name_ar, 'en' => $request->name_en];
        
         // if($file=$request->file('icon'))
         // {
         //    $file_extension = $request -> file('icon')->getClientOriginalExtension();
         //    $file_name = time().'.'.$file_extension;
         //    $file_nameone = $file_name;
         //    $path = 'assets_admin/img/categories';
         //    $request-> file('icon') ->move($path,$file_name);

         //    $edit->icon  =$file_nameone;
         // }else{
         //    $edit->icon  = $edit->icon; 
         // }
         $edit->save();
        // $category = Speciality::findOrFail($request->id);
        // $category->update($request->all());
        return redirect()->route('childcategory.index')->with("message", 'تم التعديل بنجاح'); 
    }


    public function destroy(Request $request )
    {
        // $appointment=Doctor::where('specialityId',$request->id)->get(); 
        // if(count($appointment) == 0){
            $delete = ChildCategory::findOrFail($request->id);
            $delete->delete();
            return redirect()->route('childcategory.index')->with("message",'تم الحذف بنجاح'); 
        // }else{
        //    return redirect()->back()->with("error", 'غير مسموح حذف هذا العنصر'); 
        // }        
    } 
}
