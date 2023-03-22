<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
class ProgressBarController extends Controller
{
    public function index()
    {
        return view('fileupload');
    }
 
    public function uploadToServer(Request $request)
    {
       $request->validate([
          'file' => 'required',
       ]);
       $name = time().'.'.request()->file->getClientOriginalExtension();
       // $request->file->move(public_path('uploads'), $name);
       // $file = new Image;
       // $file->name = $name;
       // $file->save();
  
        return response()->json(['success'=>'Successfully uploaded.']);
    }

    
    public function store(Request $request)
    {
        $file = new Image;
        if ($files = $request->file('file')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/');
            $files->move($destinationPath, $profileImage);
            $file->name = $profileImage;
        }
        
        // if ($request->hasFile('file')) {
        //       $photo = $request->file('file');
        //       $fileName = date('YmdHis') . "." . $photo->getClientOriginalExtension();
        //       $request->file('file')->move(public_path('uploads'), $fileName);
        //       // $file->name = $fileName;
        //   }

        $file->save();
        $allvideo=$file->name;
        return Response()->json($allvideo);
    }

    public function addvideostore(Request $request)
    {

        $file = new Image;
        if ($files = $request->file('file')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/');
            $files->move($destinationPath, $profileImage);
            $file->name = $profileImage;
        }
        
        // if ($request->hasFile('file')) {
        //       $photo = $request->file('file');
        //       $fileName = date('YmdHis') . "." . $photo->getClientOriginalExtension();
        //       $request->file('file')->move(public_path('uploads'), $fileName);
        //       // $file->name = $fileName;
        //   }

        $file->save();
        $allvideo=$file->name;
        $ddff='gggg';
        return Response()->json($ddff);
    }


    public function StoreData(Request $request){
      
      $arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true);
      return Response()->json($arr);
    }
}
