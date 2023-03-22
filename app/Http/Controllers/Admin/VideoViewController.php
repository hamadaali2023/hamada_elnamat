<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\View;
use App\Instructor;
use Illuminate\Http\Request;

class VideoViewController extends Controller
{
    
    public function index()
    {
        $instructors =Instructor::where('type','instructor')->get();
        
        foreach($instructors as $item) {            
            // $item->instructor= Instructor::where('id',$item->userId)->first();
            $videoviews =View::where('userId',$item->id)->sum('watchtime');
            if($videoviews){
                $item->videoviews=$videoviews;
            }else{
                $item->videoviews=0;
            }
            // $item->watchtimew= View::where('userId',$item->userId)->sum('watchtime');
        }  
        // dd($instructors); 
        return view('admin.videoviews.all',compact('instructors'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(About $about)
    {
        //
    }

    public function edit(About $about)
    {
        //
    }

    public function update(Request $request, About $about)
    {
        //
    }

    public function destroy(About $about)
    {
        //
    }
}
