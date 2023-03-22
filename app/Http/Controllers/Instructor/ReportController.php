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
class ReportController extends Controller
{

	public function sales(Request $request)
    {
        // $categories=Category::all();
        // if(isset($request->searchname)){
        //     $books=Story::where('name', $request->searchname)->paginate(8);
        // }else{
        //     $books=Story::paginate(8);
        // }
    	 $books=Story::paginate(8);
        return view('instructor.report.sales',compact('books','categories'));
    }
    public function transfers(Request $request)
    {
        // $categories=Category::all();
        // if(isset($request->searchname)){
        //     $books=Story::where('name', $request->searchname)->paginate(8);
        // }else{
        //     $books=Story::paginate(8);
        // }
    	 $books=Story::paginate(8);
        return view('instructor.report.transfers',compact('books','categories'));
    }
    public function statistics(Request $request)
    {
        // $categories=Category::all();
        // if(isset($request->searchname)){
        //     $books=Story::where('name', $request->searchname)->paginate(8);
        // }else{
        //     $books=Story::paginate(8);
        // }
         
        return view('instructor.report.statistics');
    }
}