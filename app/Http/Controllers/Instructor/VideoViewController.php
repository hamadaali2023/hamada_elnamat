<?php

namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;
use App\View;
use App\Course;

use App\Instructor;
use Illuminate\Http\Request;
use Auth;
use App\Video;
use App\Curricula_View;
use App\Curricul_Video;
use App\Curriculum;
use App\Material;
class VideoViewController extends Controller
{
    
    public function index()
    {
        $userid = Auth::guard('instructors')->user();      
        $videoviewss =View::where('userId',$userid->id)->where('watchtime','!=',0)->get();
        $videoviews=[];
        foreach ($videoviewss as $item) {
            $video= Video::where('id',$item->videoId)->first();
            if($video){
                $item->video=$video;
                $item->course= Course::where('id',$video->courseId)->first();
                $item->instructor= Instructor::where('id',$item->studentId)->first();
                $videoviews[]=$item;
            }
        }
        return view('instructor.videoviews.all',compact('videoviews'));
    }
    
    public function indexCurriculums()
    {
        $userid = Auth::guard('instructors')->user();      
        $videoviewss =Curricula_View::where('userId',$userid->id)->where('watchtime','!=',0)->get();
        $videoviews=[];
        foreach ($videoviewss as $item) {
            $video= Curricul_Video::where('id',$item->videoId)->first();
            if($video){
                $item->video=$video;
                $course= Curriculum::where('id',$item->courseId)->first();
                $item->course=$course;
                $item->instructor= Instructor::where('id',$item->studentId)->first();
                $item->material= Material::where('id',$course->material_id)->first();
                $videoviews[]=$item;
            }
        }
        // dd($videoviews);
        return view('instructor.videoviews.all_curriculum',compact('videoviews'));
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
