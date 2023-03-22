<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\SubscriptionValue;
use Gate;

class SubscriptionValuesController extends Controller
{
    
    public function index()
    {   
        $subscription_values = SubscriptionValue::all();
        return view('admin.subscription_value.all',compact('subscription_values'));
    }
    public function store(Request $request)
    {
        
        
        $add = new SubscriptionValue;
        $add->type    = $request->type;
        $add->value    = $request->value;
       
        $add->save();
        
        return redirect()->back()->with("message", 'تم الإضافة بنجاح'); 
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        // dd($request->id);
        
    //   $this->validate( $request,[          
    //             'type'=>'required',
    //             'value'=>'required',
    //             // 'icon' => 'required|max:10000|mimes:jpeg,jpg,png,gif|'
    //         ],
    //         [
    //             'type.required'=>'يرجى ادخال اسم التخصص عربي',
    //             'value.required'=>' يرجى ادخال اسم التخصص انجليزي ',
    //             // 'icon.required'=>' يرجي إختيار صورة jpeg,jpg,png,gif ',
    //         ]
    //     );


         $edit = SubscriptionValue::findOrFail($request->id);
         
         if(isset($request->type)){
             $edit->type  = $request->type;
         }else{
             $edit->type  = $edit->type;
         }
         $edit->value    = $request->value;
        
         $edit->save();
        
        return back()->with("message", 'تم التعديل بنجاح'); 
    
    }

    public function destroy(Request $request)
    {
        $category = SubscriptionValue::findOrFail($request->id);
        $category->delete();
         return redirect()->back()->with("message", 'تم الحذف بنجاح');
    }
}
