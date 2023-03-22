<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\Story;
use App\Category;   
use Hash;
use Auth;
class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkStudent');
    }
    public function index()
    {
        // $user = Auth::guard('students')->user();
        // dd(Auth::guard('students')->user()->name);
        // dd($user->email);
        $carts= Cart::where('studentId',$user->id)->get();
        // $cartsssss= Story::where('id',$carts->courseId)->sum('price');
        // dd($cartsssss);
        $sum=0;
        foreach ($carts as $item) {       
            $cartsssss= Story::where('id',$item->courseId)->sum('price');   
            $sum+= $cartsssss;
            $item->cartsssss= Story::where('id',$item->courseId)->sum('price');
            $bookid= Story::where('id',$item->courseId)->first();

            $item->book= Story::where('id',$item->courseId)->first();
            $item->category= Category::where('id',$bookid->categoryId)->first();
        }
        // dd($sum);
        return view('web.cart',compact('carts','sum'));
    }

    

    public function addtocart(Request $request)
    {
        if(Auth::guard('students')->user()==null){
            return redirect('login/user')->with("message", 'تم الاضافة'); 
        }else{
            $cart_check=Cart::where('courseId',$request->courseId)->first();
            // dd($cart_check);
            if($cart_check){
                return redirect()->back(); 
            }else{
                $user = Auth::guard('students')->user();
                $add = new Cart;
                $add->courseId    = $request->courseId;
                $add->studentId    = $user->id;
                $add->save();
                return redirect()->back()->with("message", 'تم الاضافة');
            }
            
        }
        


    }
    public function show(Cart $cart)
    {
        //
    }

    public function edit(Cart $cart)
    {
        //
    }

    public function update(Request $request, Cart $cart)
    {
        //
    }

    public function destroy(Request $request)
    {
        $delete = Cart::findOrFail($request->id);
        $delete->delete();
            return back()->with("message",'تم الحذف بنجاح');    
    }
}
