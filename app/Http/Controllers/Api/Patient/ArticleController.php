<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
//use App\Http\Requests\AircraftRequest;

use DB;
class ArticleController extends Controller
{
     use GeneralTrait;

    public function index()
    {
        $articles = Article::selection()->get();
        return $this -> returnData('articles',$articles);
        // $articles=Article::all();
        // foreach ($articles as $item) {
            
        //     $item->doctorname= Doctor::where('id',$item->doctorId)->first('name')->name;
          
        // }
        // return view('admin.articles.all',compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }
    

    public function store(Request $request)
    {
        $file_extension = $request -> file('image') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/article';
        $request-> file('image') ->move($path,$file_name);

        $ghgth = new Article;
        $ghgth->author    = $request->author;
        $ghgth->title_ar    = $request->title_ar;
        $ghgth->title_en  = $request->title_en;
        $ghgth->description_ar  = $request->description_ar;
        $ghgth->description_en  = $request->description_en;
        $ghgth->image    = $file_nameone;
        $ghgth->save();
        return redirect()->back()->with("message",'تمت الإضافة بنجاح'); 
    }

    
    public function edit(Article $article)
    {
        return view('admin.articles.edit',compact('article'));
    }

    public function update(Request $request)
    {
         // $userId = 1;
         $edit = Article::findOrFail($request->id);
         $edit->title_ar    = $request->title_ar;
         $edit->title_en  = $request->title_en;
         $edit->description_ar    = $request->description_ar;
         $edit->description_en  = $request->description_en;
        
         if($file=$request->file('image'))
         {
            $file_extension = $request -> file('image') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/article';
            $request-> file('image') ->move($path,$file_name);

            $edit->image  =$file_nameone;
         }else{
            $edit->image  = $request->url; 
         }
         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect()->route('articles.index')->with("message", 'تم التعديل بنجاح'); 
    }

    public function destroy(Request $request)
    {

        $delete = Article::findOrFail($request->id);
        $delete->delete();
            return redirect()->route('articles.index')->with("message",'تم الحذف بنجاح');

        return response()->json(['message' => 'User status updated successfully.']);

        
    } 
}
