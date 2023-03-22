<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\User;
use App\Instructor;  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        // dd(date('d.m.Y', strtotime($day->date)));
        // dd($request->visitor()->visit());
        // dd($request->ip());
        $users = Instructor::select("*")
                        ->whereNotNull('last_seen')
                        ->orderBy('last_seen', 'DESC')
                        ->paginate(10);
          
        return view('users', compact('users'));
        
        
        
        
        
    }
}