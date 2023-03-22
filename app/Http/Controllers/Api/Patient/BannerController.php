<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
class BannerController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $pannars=Banner::all();
        return $this -> returnData('pannars',$pannars);
    }

    public function create()
    {
        return view('admin.pannars.create');
    }
    

    public function store(Request $request)
    {
        $file_extension = $request -> file('pannar') -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $file_nameone = $file_name;
        $path = 'assets_admin/img/pannars';
        $request-> file('pannar') ->move($path,$file_name);

        $ghgth = new Banner;
        
        $ghgth->pannar    = $file_nameone;
        $ghgth->save();
        return redirect()->back()->with("message", 'تمت الإضافة بنجاح'); 
    }

    
    public function edit(Banner $banner)
    {
        return view('admin.pannars.edit',compact('banner'));
    }

    public function update(Request $request)
    {
        $edit = Banner::findOrFail($request->id);
         
        
         if($file=$request->file('pannar'))
         {
            $file_extension = $request -> file('pannar') -> getClientOriginalExtension();
            $file_name = time().'.'.$file_extension;
            $file_nameone = $file_name;
            $path = 'assets_admin/img/pannars';
            $request-> file('pannar') ->move($path,$file_name);

            $edit->pannar  =$file_nameone;
         }else{
            $edit->pannar  = $request->url; 
         }
         $edit->save();


        // $category = Speciality::findOrFail($request->id);

        // $category->update($request->all());
       
        return redirect()->route('pannars.index')->with("message", 'تم التعديل بنجاح'); 
    }

   public function destroy(Request $request )
    {
        $delete = Banner::findOrFail($request->id);
        $delete->delete();
            return redirect()->route('pannars.index')->with("message",'تم الحذف بنجاح');

       

        
    } 
}
