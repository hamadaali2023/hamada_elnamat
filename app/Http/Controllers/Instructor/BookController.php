<?php

namespace App\Http\Controllers\Instructor;
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
class BookController extends Controller
{
    
    public function index(Request $request)
    {

        // $user = Auth::guard('students')->user();
        // dd(Auth::guard('instructors')->user()->name);

        $categories=Category::all();
       
        
        if(isset($request->searchname)){
            $books=Story::where('name', $request->searchname)->paginate(8);
        }else{
            $books=Story::paginate(8);
        }
        
        return view('instructor.books.books',compact('books','categories'));
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
        $this->validate( $request,[          
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                'countryId'=>'required',
                'name'=>'required',
                'price'=>'required',
                'date'=>'required',
                'pages'=>'required',
                'licensing_authority'=>'required',
                'isbn_num'=>'required',
                'license_number'=>'required',
                'License_year'=>'required',
                'description'=>'required',
                'meta_key'=>'required',
                'photo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'

            ],
            [
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                'countryId'=>'required',
                'name'=>'required',
                'price'=>'required',
                'date'=>'required',
                'pages'=>'required',
                'licensing_authority'=>'required',
                'isbn_num'=>'required',
                'license_number'=>'required',
                'License_year'=>'required',
                'description'=>'required',
                'meta_key'=>'required',
                'photo.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
                'file.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',

            ]
        );

        $add= new Story;
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/books';
            $request-> file('photo') ->move($path,$file_name);
            $add->photo  = $file_nameone;
        }else{
            $add->photo  = "books1.jpeg";
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
            $add->file  = "books1.pdf"; 
        }
       
        $instructorId = Auth::guard('instructors')->user()->id;   
        // dd($userid);
        $add->userId  = $instructorId;
        $add->categoryId  = $request->categoryId;
        $add->subCategoryId  = $request->subCategoryId;
        // $add->languageId  = $request->languageId;
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

        // dd($book);

        return view('instructor.books.edit',compact('story','categories','subcategory','country','city'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
        $this->validate( $request,[          
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                'countryId'=>'required',
                'name'=>'required',
                'price'=>'required',
                'date'=>'required',
                'pages'=>'required',
                'licensing_authority'=>'required',
                'isbn_num'=>'required',
                'license_number'=>'required',
                'License_year'=>'required',
                'description'=>'required',
                'meta_key'=>'required',
                'photo' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'

            ],
            [
                'categoryId'=>'required',
                'subCategoryId'=>'required',
                'countryId'=>'required',
                'name'=>'required',
                'price'=>'required',
                'date'=>'required',
                'pages'=>'required',
                'licensing_authority'=>'required',
                'isbn_num'=>'required',
                'license_number'=>'required',
                'License_year'=>'required',
                'description'=>'required',
                'meta_key'=>'required',
                'photo.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
                'file.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',

            ]
        );

        $edit= new Story;
        if($file=$request->file('photo'))
        {
            $file_extension = $request -> file('photo') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/books';
            $request-> file('photo') ->move($path,$file_name);
            $edit->photo  = $file_nameone;
        }else{
            $edit->photo  = $edit->photo;
        }

        if($file=$request->file('file'))
        {
            $file_extension = $request -> file('file') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'img/books';
            $request-> file('file') ->move($path,$file_name);
            $edit->file  = $file_nameone;
        }else{
            $edit->file  = $edit->file ; 
        }
       
        $instructorId = Auth::guard('instructors')->user()->id;   
        // dd($userid);
        $edit->userId  = $instructorId;
        $edit->categoryId  = $request->categoryId;
        $edit->subCategoryId  = $request->subCategoryId;
        // $add->languageId  = $request->languageId;
        $edit->countryId  = $request->countryId;
        $edit->name  = $request->name;
        $edit->price   = $request->price;
        $edit->date  = $request->date;
        $edit->pages  = $request->pages;
        $edit->licensing_authority  = $request->licensing_authority;
        $edit->isbn_num  = $request->isbn_num;
        $edit->license_number  = $request->license_number;
        $edit->License_year  = $request->License_year;
        $edit->description  = $request->description;
        $edit->meta_key  = $request->meta_key;
        
        $edit->slug =Str::slug($request->name, '-', Null);
         // SlugService::createSlug(Book::class, 'slug', $this->make_slug($request->name));


        $edit->save();
        toastr()->success(trans('messages.success'));
        return redirect()->back()->with("message", 'تم تعديل بنجاح'); 


         
    }

    
    public function destroy(Request $request)
    {
        $delete = Story::findOrFail($request->id);
        $delete->delete();
            return redirect('instructor/stories')->with("message",'تم الحذف بنجاح');    }
}
