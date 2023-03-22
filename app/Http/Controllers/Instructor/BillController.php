<?php


namespace App\Http\Controllers\Instructor;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Wallet;
use App\Transaction;
use App\Instructor;
use App\Country;
use DateTime;
use Carbon\Carbon;
use App\View;
use App\Straight;
use App\Course;
use App\Certificate;
// use App\Transfer;
use Auth;
class BillController extends Controller
{
    public function __construct()
    {
        $this->middleware(Auth::guard('instructors')->user());
    }
    public function index()
    {
        $userid = Auth::guard('instructors')->user();
    // 	$bills=Transaction::where('instructor_id',$userid->id)->where('transferTo','!=',0)->get();
    	$bills=Transaction::where('instructor_id',$userid->id)->orderBy('id', 'DESC')->get();
        $user_wallet= Wallet::where('user_id',$userid->id)->first();
        $instructors=Instructor::where('type','instructor')->get();
        foreach ($bills as $item) {
            $user= Instructor::where('id',$item->instructor_id)->first();
            // $user_wallet= Wallet::where('user_id',$item->instructor_id)->first();
            // if($user_wallet){
            //     $item->user_wallet=$user_wallet->total;
            // }
            
            $certificate= Certificate::where('transaction_id',$item->id)->first();
            if($certificate){
                if($certificate->course_id){
                    $course= Course::where('id',$certificate->course_id)->first();
                    $item->course=$course;
                }elseif($certificate->live_id){
                    $course= Straight::where('id',$certificate->live_id)->first();
                    $item->course=$course;
                }else{
                    $item->course='';
                }
            }
            $country= Country::where('id',$user->countryId)->first();
            $user->country=$country->name;
            $item->user=$user;
        }
        // dd($bills);
        return view('instructor.bills.all',compact('bills','instructors','user_wallet'));
    }
    
    


    public function transfers()
    {
        $userid = Auth::guard('instructors')->user();
        $transfers=Transaction::where('user_id',$userid->id)->where('transfers','!=',0)->get();

        // $transfers=Transfer::where('user_id',$userid->id)->get();
        foreach ($transfers as $item) {
            $user= Instructor::where('id',$item->user_id)->first();
            $item->user=$user;
        }
        $instructors=Instructor::where('type','instructor')->get();
        
        return view('instructor.bills.transfers',compact('transfers','instructors'));
    }
    
    public function create()
    {
        //
    }

    
    // public function SendBalance(Request $request)
    // {
    //     $mytime = Carbon::now('egypt');
    //     $todayDate = $mytime->toDateString();

    //     $time = new DateTime();
    //     $time->modify('+3 hours');
    //     $timenow=$time->format("h:i");
    //     $length = count($request->user_id);
    //     if($length > 0)
    //     {
    //         for($i=0; $i<$length; $i++)
    //         {  
    //             $walletId=Wallet::where('user_id',$request->user_id[$i])->first();
    //             $instructor_balance=Transaction::where('user_id',$request->user_id[$i])->latest()->first();
    //             $balance=$instructor_balance->balance - $request->transferTo;
    //             $transaction = new Transaction;
    //             $transaction->walletId    = $walletId->id;
    //             $transaction->user_id    = $request->user_id[$i];
    //             $transaction->balance    = $balance;
    //             $transaction->transferTo    = $request->transferTo;
    //             $transaction->report    = $request->report;
    //             $transaction->date    = $todayDate;
    //             $transaction->time    = $timenow;
    //             $transaction->save();
    //         }
    //     }
    //     // toastr()->success(trans('messages.success'));
    //     return redirect()->back()->with("message", 'تم الإضافة بنجاح');
    // }

    // public function videoViewsAndBalanceInstructor()
    // {
    //     $instructors =Instructor::where('type','instructor')->get();
        
    //     foreach($instructors as $item){
    //         // $item->instructor= Instructor::where('id',$item->userId)->first();
    //         $videoviews =View::where('userId',$item->id)->sum('watchtime');

    //         if($videoviews){
    //             $item->videoviews=$videoviews;
    //         }else{
    //             $item->videoviews=0;
    //         }

    //         $instructor_balance=Transaction::where('user_id',$item->id)->latest()->first();
    //         // if($videoviews){
    //         //     $item->videoviews=$videoviews;
    //         // }else{
    //         //     $item->videoviews=0;
    //         // }
    //         $item->instructor_balance=$instructor_balance->balance;
    //     }  
    //     // dd($instructors); 
    //     return view('instructor.videoviews.all',compact('instructors'));
    // }
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
