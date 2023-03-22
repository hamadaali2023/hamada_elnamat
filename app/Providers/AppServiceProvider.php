<?php

namespace App\Providers;
use App\Cart;
use Illuminate\Support\ServiceProvider;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Auth;
use App\ContactInfo;
use App\Category;

use App\Instructor;
use App\Notification;
use App\SubCategory;
use App\User;
use App\ChildCategory;
use App\View;
use App\LastCoursesWatch;
class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // if(session()->get('locale')){
        //         $tr = new GoogleTranslate(session()->get('locale')); 
        //         $langg=session()->get('locale');
        // }else{
        //         $tr = new GoogleTranslate(app()->getLocale()); 
        //         $langg=app()->getLocale();
        // }
         
        // view()->share('tr', $tr);
        // view()->share('langg', $langg);

        // start notification
        $count=0;
        $not=Notification::get(); 
        foreach ($not as $item) {
            if($item->read_at ==''){
                $count +=1;
            }else{
                $count +=0;
            }
        } 
        view()->share('count', $count);

        $notifications= Instructor::with(array('unreadnotifications'=>function($query){
                                    $query;
                                }))->get();
        // dd($notifications);
        view()->share('notifications', $notifications);
        // end notification

        $cartcount=0;
        $studentid   = Auth::guard('instructors')->user();   
        if($studentid){
            $cont = Cart::where('userId',$studentid->id);
            $cartcount = $cont->count();
           // dd($total_row);
           view()->share('cartcount', $cartcount);
        }
        view()->share('cartcount', $cartcount);
        
        $cont = ContactInfo::first();
        view()->share('contact', $cont);

      
        $allcategories=Category::all()->sortBy('num');
        foreach ($allcategories as $item) {            
            $subcategory= SubCategory::where('categoryId',$item->id)->get();
            $item->subcategorye= $subcategory;
            foreach ($subcategory as $sub) { 
                $childcategory= ChildCategory::where('subCategoryId',$sub->id)->get();
                
                $sub->childcategory=$childcategory;
            }
        }
        
        // {{dd($allcategories)}}
        view()->share('allcategories', $allcategories);
        
        
                
               
    //   return redirect('/allwatch');
    }
}
