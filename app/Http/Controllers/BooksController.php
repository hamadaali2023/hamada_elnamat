<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Story;
use App\Category;

use App\SubCategory;
use App\Country;
use App\City;
use App\ChildCategory;

use Illuminate\Http\Request;
use App\Jobs\SendFileJob;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use DB;
use Auth;
class BooksController extends Controller
{
    //  public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        // dd(php_ini_loaded_file());
        // dd(ini_get('post_max_size'));

        $categories=Category::all();
        $books=Story::all();
        $books=Story::all();

        $countries=Country::all();


        return view('instructor.books.all',compact('books','categories','countries'));
    }

    public function getSubCategory($id){
        echo json_encode(DB::table('sub_categories')->where('categoryId', $id)->get());
    }

    public function getChildCategory($id){
        echo json_encode(DB::table('child_categories')->where('subCategoryId', $id)->get());
    }

    public function create()
    {
        $categories=Category::all();
        $books=Story::all();
        return view('instructor.books.create',compact('books','categories'));
    }

    public function store(Request $request)
    {

        $add= new Story;
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('photo') ->move($path,$file_name);
            $add->photo  = $file_nameone;
        }else{
            $add->photo  = "profile_image.png"; 
        }

        if($file=$request->file('file'))
        {
            $file_extension = $request -> file('file') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('file') ->move($path,$file_name);
            $add->file  = $file_nameone;
        }else{
            $add->file  = "profile_image.png"; 
        }
       
        $add->instructorId  = Auth::user()->id;
        $add->categoryId  = $request->categoryId;
        $add->subCategoryId  = $request->subCategoryId;
        $add->countryId  = $request->countryId;
        $add->name  = $request->name;
        $add->price   = $request->price;
        $add->date  = $request->date;
        $add->pages  = $request->pages;
        $add->licensing_authority  = $request->licensing_authority;
        $add->isbn_num  = $request->isbn_num;
        $add->license_number  = $request->license_number;
        $add->License_year  = $request->License_year;
        $add->description  = $request->description;
        $add->meta_key  = $request->meta_key;
        
        $add->slug =Str::slug($request->name, '-', Null);
         // SlugService::createSlug(Book::class, 'slug', $this->make_slug($request->name));


        $add->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    
    public function edit(Story $story)
    {
        $categories=Category::all();
        $subcategory=SubCategory::all();
        $country=Country::all();
        $city=City::all();

        // dd($story);

        return view('instructor.books.edit',compact('story','categories','subcategory','country','city'));
    }

    

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'name_ar'=>'required',
                'name_en'=>'required',
            ],
            [
                'name_ar.required'=>'يرجى ادخال اسم التخصص عربي',
                'name_en.required'=>'يرجى ادخال اسم التخصص عربي',
            ]
        );


         $edit = Story::findOrFail($request->id);
         $edit->name  = ['ar' => $request->name_ar, 'en' => $request->name_en];
         $edit->save();
        return redirect()->route('countries.index')->with("message", 'تم التعديل بنجاح'); 
    }

    
    public function destroy(Request $request)
    {
        $delete = Story::findOrFail($request->id);
        $delete->delete();
            return back()->with("message",'تم الحذف بنجاح');    }
}
