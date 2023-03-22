<?php

use Illuminate\Support\Facades\Route;

use App\Subscription;

use App\User;
use App\View;
use App\Curricula_View;
use App\Course;
use App\LastCoursesWatch;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
  Route::get('/allbooks', 'FrontKutuphanahController@loadMore');

  Route::get('/allbooksone', 'FrontKutuphanahController@loadMoreone');


// <script>
  

    Route::get('traveling-signupp', 'Auth\InstructorLoginController@travelingSignup')->name('traveling-signup');
    Route::post('register-new-traveling', 'Auth\InstructorLoginController@registerTraveling')->name('register-new-traveling');

    Route::get('travel-user-token/{token}', 'Auth\InstructorLoginController@travelUserTokenGet')->name('travel-user-token');
    
    Route::post('travel-user-data', 'Auth\InstructorLoginController@travelData')->name('travel-user-data');
    Route::get('user-show-data/{id}', 'Auth\InstructorLoginController@userShowData')->name('user-show-data');    
    Route::get('travel-user-done/{id}', 'Auth\InstructorLoginController@travelUserdone')->name('travel-user-done');    
        
// // Dark Mode
// const checkbox = document.getElementById('checkbox');

// var dark_mode_checked= sessionStorage.getItem('dark-mode-check');
// document.body.classList.toggle(dark_mode_checked);

// checkbox.addEventListener('change', ()=>{
//         document.body.classList.toggle('dark-mode');
//         var checkboxDarkmod = document.getElementById("checkbox");
//     if (checkboxDarkmod.checked) {
//         sessionStorage.setItem('dark-mode-check','dark-mode');
//         document.body.classList.toggle(dark_mode_checked);
        

//     } else {
//         sessionStorage.setItem('dark-mode-check','notdarkmode');
//         document.body.classList.toggle('dark-modeeeeee');
        
//     }
  
// })


// </script>

// const checkbox = document.getElementById('checkbox');

// checkbox.addEventListener('change', ()=>{  
   
//     var checkboxDarkmod = document.getElementById("checkbox");
//     if (checkboxDarkmod.checked) {
//         sessionStorage.setItem('dark-mode-checked','dark-mode');
//         alert(sessionStorage.getItem('dark-mode-checked'));
//         document.body.classList.toggle('dark-mode');
//         alert("checkd.");
//     } else {
//         sessionStorage.setItem('dark-mode-checked','dark-mode');
//         alert(sessionStorage.getItem('dark-mode-checked'));
//         alert("You didn't check it! Let me check it for you.");
//     }
  
// })

// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.gmail.com
// MAIL_PORT=465
// MAIL_USERNAME=contactinfo@elnamat.com
// MAIL_PASSWORD=contac.1.1
// MAIL_ENCRYPTION=ssl
// MAIl_NAME=kutuphanah
// MAIL_FROM_NAME="Courses"
// MAIL_FROM_ADDRESS=Courses@Courses.info

// MAIL_DRIVER=smtp 
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=465 
// MAIL_USERNAME=ff1b1940e14729
// MAIL_PASSWORD=9bfc1f5813d2b5 

// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=465
// MAIL_USERNAME=d128de067f5683 
// MAIL_PASSWORD=7f1b5974985ef7 
// MAIL_FROM_ADDRESS=from@example.com
// MAIL_FROM_NAME=Example

// MAIL_MAILER=smtp
// MAIL_HOST=smtp.mailtrap.io
// MAIL_PORT=465
// MAIL_USERNAME=d128de067f5683
// MAIL_PASSWORD=7f1b5974985ef7
// MAIL_ENCRYPTION=


// i have problem in my acount . I can not login to my acount


// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.gmail.com
// MAIL_PORT=465
// MAIL_USERNAME=said5050info@gmail.com
// MAIL_PASSWORD=hamada3020.1.1
// MAIL_ENCRYPTION=ssl
// MAIl_NAME="صحتي وجمالي"
// MAIL_FROM_NAME="صحتي وجمالي"
// MAIL_FROM_ADDRESS=info@beautiheath.com

// MAIL_DRIVER=smtp
// MAIL_HOST=smtp.gmail.com
// MAIL_PORT=465
// MAIL_USERNAME=said5050info@gmail.com
// MAIL_PASSWORD=hamada3020.1.1
// MAIL_ENCRYPTION=ssl
// MAIl_NAME="صحتي وجمالي"
// MAIL_FROM_NAME="صحتي وجمالي"
// MAIL_FROM_ADDRESS=info@beautiheath.com



// HOM HOMS
// 2242005HOMS66M

// Route::get('/home-user', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
use App\Http\Controllers\SocialShareButtonsController;
Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

Route::get('user_bills', 'FrontKutuphanahController@userBills');
Route::get('online-user', 'UserController@index');


// Route::get('checkout', 'PaymentProviderController@index')->name('checkout');
// Route::get('get-checkout', 'PaymentProviderController@getCheckOutId')->name('get-checkout');



Route::post('send_report', 'FrontKutuphanahController@send_report')->name('send_report');



// Route::get('said/{lang}', function ($lang) {
//     App::setlocale($lang);
//             session()->put('locale', $lang);

//     return view('welcome');
// });

Route::get('allwatchsss', function () {
    // $studentid = Auth::guard('instructors')->user();
    // $views = View::where('videoid',27)->where('studentId',$studentid->id)->first();
  $videos_sessions = session()->get('cart');
      if(session('cart')){
          $videos=session()->get('cart');          
          $items=[];
          foreach($videos as $id => $_item){
              $cars = array("watchtime"=>$_item['watchtime']);
              $items[]= $cars;
          }
          dd($items);
          foreach($items as $i => $item){     
              dd( $item['watchtime']);
          }
      }
});

Route::get('uniqiddfg', function () {
    $cer_uniqid=uniqid();
    dd($uif);
});
Route::get('allview', function () {
    
    $videos=session()->get('cart');
            dd($videos);
    dd(session('cart'));
});

Route::get('allwatch_curriculums', function () {
    
    // $videos=session()->get('cartCurriculums');
    //         dd($videos);
    // $studentid = Auth::guard('instructors')->user();
    // echo $studentid->id;
    // dd(session('cart'));
    if(session('cartCurriculums')){
        
            $videos=session()->get('cartCurriculums');
            // dd($videos);
            $items=[];
            foreach($videos as $id => $_item){
                $cars = array("userid"=>$_item['userid'],
                              "videoid"=>$_item['videoid'],
                              "watchtime"=>$_item['watchtime'],
                              "courseId"=>$_item['courseId']);
                $items[]= $cars;
            }

            foreach($items as $i => $item){    
                $studentid = Auth::guard('instructors')->user();
                $views = Curricula_View::where('videoid',$item['videoid'])->where('studentId',$studentid->id)->first();
                
                if($studentid){
                    if($studentid->status_teacher==1){
                        
                        if(!$views){
                            // dd($videos);
                            $add_video = new Curricula_View;
                            $add_video->userId  = $item['userid'];
                            $add_video->videoId = $item['videoid'];
                            $add_video->watchtime = $item['watchtime'];
                            $add_video->watchtime2 = $item['watchtime'];
                            $add_video->courseId = $item['courseId'];
                          
                            $add_video->studentId = $studentid->id;
                            $add_video->save(); 
                        }else{
                            // dd($videos);
                            if($views->watchtime < $item['watchtime']){
                              $views->userId  = $item['userid'];
                              $views->courseId = $item['courseId'];
                              $views->videoId = $item['videoid'];
                              $views->watchtime = $item['watchtime'];
                              $views->watchtime2 = $item['watchtime'];
                              $views->studentId = $studentid->id;
                              $views->save(); 
                            }else{
                                // dd($item['watchtime']);
                            }  
                        }
                        
                        // $checklast = LastCoursesWatch::where('course_id',$item['courseId'])->where('user_id',$studentid->id)->first();
                        // if(!$checklast){
                        //     $Lastwatch  = new LastCoursesWatch;
                        //     $Lastwatch->user_id    = $studentid->id;
                        //     $Lastwatch->course_id    = $item['courseId'];
                        //     $Lastwatch->save();
                        // }
                       
                    }
                }
            }
    }
    session()->forget('cartCurriculums');
    
});
Route::get('allwatch', function () {
    
    //  session()->forget('cart');
    // $studentid = Auth::guard('instructors')->user();
    // echo $studentid->id;
    // dd(session('cart'));
    if(session('cart')){
        
            $videos=session()->get('cart');
            // dd($videos);
            $items=[];
            foreach($videos as $id => $_item){
                $cars = array("userid"=>$_item['userid'],
                              "videoid"=>$_item['videoid'],
                              "watchtime"=>$_item['watchtime'],
                              "courseId"=>$_item['courseId']);
                $items[]= $cars;
            }

            foreach($items as $i => $item){    
                $studentid = Auth::guard('instructors')->user();
                $views = View::where('videoid',$item['videoid'])->where('studentId',$studentid->id)->first();
                
                if($studentid){
                    
                        
                        if(!$views){
                            // dd($videos);
                            $add_video = new View;
                            $add_video->userId  = $item['userid'];
                            $add_video->videoId = $item['videoid'];
                            $add_video->watchtime = $item['watchtime'];
                            $add_video->watchtime2 = $item['watchtime'];
                            $add_video->courseId = $item['courseId'];
                          
                            $add_video->studentId = $studentid->id;
                            $add_video->save(); 
                        }else{
                            // dd($videos);
                            if($views->watchtime < $item['watchtime']){
                              $views->userId  = $item['userid'];
                              $views->courseId = $item['courseId'];
                              $views->videoId = $item['videoid'];
                              $views->watchtime = $item['watchtime'];
                              $views->watchtime2 = $item['watchtime'];
                              $views->studentId = $studentid->id;
                              $views->save(); 
                            }else{
                                // dd($item['watchtime']);
                            }  
                        }
                        
                        $checklast = LastCoursesWatch::where('course_id',$item['courseId'])->where('user_id',$studentid->id)->first();
                        if(!$checklast){
                            $Lastwatch  = new LastCoursesWatch;
                            $Lastwatch->user_id    = $studentid->id;
                            $Lastwatch->course_id    = $item['courseId'];
                            $Lastwatch->save();
                        }
                      
                }
            }
    }
    session()->forget('cart');
    // $videos=session()->get('cart'); 
    // session()->put('cart', $videos);
    // return Response()->json('lll');
})->name('allwatch');


	Route::get('getsubcategory/{id}','FrontKutuphanahController@getSubCategory');
	Route::get('get-search-course','FrontKutuphanahController@getSearchCourse');
    Route::get('get-search-curriculums','FrontKutuphanahController@getSearchCurriculums');

Route::get('course-more', 'FrontKutuphanahController@courseMore');

Route::get('all-instructor', 'FrontKutuphanahController@allInstructor');
Route::get('all-teacher', 'FrontKutuphanahController@allTeacher');


Route::post('save_new_whach', 'FrontKutuphanahController@saveNewWhach')->name('save_new_whach');
Route::post('save_new_whach_curriculums', 'FrontKutuphanahController@saveNewWhachCurriculums')->name('save_new_whach_curriculums');


Route::get('/file-upload', 'ProgressBarController@index');

Route::post('/upload-doc-file','ProgressBarController@uploadToServer');

Route::post('ajax-image-upload', 'ProgressBarController@store');

// Route::post('savevideo', 'ProgressBarController@addvideostore');

// Route::get('/contact-form','AjaxSubmitController@Create')->name('ajax.form');
Route::post('contact-formstore','ProgressBarController@StoreData')->name('ajax.formStore');
Auth::routes();




// start livewire route
  Route::view('add_parent','livewire.show_Form');
  Route::view('validd','livewire.validd');
// end livewire route



Route::get('lang/{locale}', 'LocalizationController@index');

// Route::get('/activation/users/{token}', 'Auth\RegisterController@instructorActivation');
// Route::get('/activated', function () {
//     return view('emails.activated');
// });
##### start kutpana  ######################
Route::get('register-users', function () {
    return view('front.signup');
});
  

    Route::get('login/user', 'Auth\UserLoginController@UserLogin')->name('login.user');
    Route::post('userlogin', 'Auth\UserLoginController@LoginUser')->name('userlogin');
    
    
    Route::get('forgot/password', 'Auth\UserLoginController@forgotPassword');
    Route::post('forgot/password', 'Auth\UserLoginController@submitForgot')->name('forgot.password.post');
        
    Route::get('reset-user-password/{token}', 'Auth\UserLoginController@resetUserPasswordGet')->name('reset-user-password');
    Route::post('reset-user-password', 'Auth\UserLoginController@resetUserPasswordPost')->name('reset-user-password.post');
        
        
        
  Route::post('signoutotudent', 'Auth\UserLoginController@signOutStudent')->name('signoutotudent');
  Route::post('signoutinstructors', 'Auth\UserLoginController@signOutInstructors')->name('signoutinstructors');

  
  Route::get('instructor-signup', 'Auth\InstructorLoginController@instructorSignup')->name('instructor-signup');
  Route::get('student-signup', 'Auth\InstructorLoginController@studentSignup')->name('student-signup');
  Route::get('/activation/users/{token}', 'Auth\InstructorLoginController@instructorActivation');

  Route::post('create/acount', 'Auth\InstructorLoginController@registerNewUser')->name('create.acount');

  Route::post('register-new-instructor', 'Auth\InstructorLoginController@registerNewInstructor')->name('register-new-instructor');


    Route::post('remove/acount','FrontKutuphanahController@removeAcountPost')->name('remove.acount');
    
    Route::post('cancellation/acount','FrontKutuphanahController@cancellationAcountPost')->name('cancellation.acount');


  
    Route::get('/home', 'FrontKutuphanahController@index')->name('home');
    Route::get('/courses', 'FrontKutuphanahController@courses');

    Route::get('/', 'FrontKutuphanahController@index');
    Route::get('category/{id}', 'FrontKutuphanahController@categoryId');
    Route::get('subcategory/{id}', 'FrontKutuphanahController@subcategoryId');
    Route::get('childcategory/{id}', 'FrontKutuphanahController@childcategoryId');
    Route::get('searchcourse', 'FrontKutuphanahController@searchcourse');

    Route::get('getcounrty/{id}', 'Auth\RegisterController@getCountry');

    Route::get('getconsultings', 'FrontKutuphanahController@getConsultings')->name('getconsultings');

    Route::get('getcoursesbycategory', 'FrontKutuphanahController@getcoursesbycategory')->name('getcoursesbycategory');
    
    Route::get('get-curriculums', 'FrontKutuphanahController@getCurriculums')->name('get-curriculums');

    Route::get('searchbook', 'FrontKutuphanahController@searching')->name('searchbook');



  Route::get('courses/{slug}/{id}', 'FrontKutuphanahController@coursesDetails');
  
  
  Route::get('lives-courses', 'FrontKutuphanahController@livesCourses');
  Route::get('lives/{slug}/{id}', 'FrontKutuphanahController@livesDetails');
  
    Route::get('my-live-certificates', 'FrontKutuphanahController@liveCertificates');
    Route::get('my-lives', 'FrontKutuphanahController@myLives');
    Route::get('url-meeting-not-found/{id}', 'FrontKutuphanahController@urlMeetingNotFound');
    Route::get('print-live-certificates/{slug}', 'FrontKutuphanahController@printLiveCertificates');
        
  
    Route::get('consultings', 'FrontKutuphanahController@consultings');
    Route::get('consultings/{slug}', 'FrontKutuphanahController@consultingDetails');



//   Route::get('become-instructor', 'FrontKutuphanahController@becomeInstructor');
//   Route::post('become-instructor-update', 'FrontKutuphanahController@updatebecomeInstructor')->name('become-instructor-update');


        

        Route::get('get-checkout', 'PaymentProviderController@getCheckOutId')->name('get-checkout');
        Route::get('get-checkout/{typeCourse}/{id}', 'PaymentProviderController@getCheckOutIdCertificate');
        
        Route::get('checkout', 'PaymentProviderController@checkout')->name('checkout');
        Route::get('courses-joine/{typeCourse}/{id}', 'FrontKutuphanahController@coursesJoine');
        
        Route::get('consulting-joine/{typeCourse}/{id}', 'FrontKutuphanahController@consultingJoine');

        Route::get('search-certificate', 'FrontKutuphanahController@searchCertificate')->name('search-certificate');

        Route::group(['middleware' => 'checkStudent'], function () {
        
        // Route::get('payment_info/{slug}', 'FrontKutuphanahController@paymentInfo')->name('payment-info');
        
        // Route::get('send-info/{slug}', 'FrontKutuphanahController@sendInfouser');
        
        
       
        Route::get('student-password', 'FrontKutuphanahController@studentPassword');
        Route::post('student-change-password', 'FrontKutuphanahController@studentChangePassword')->name('student-change-password');

        Route::post('user/addfavorite', 'FrontKutuphanahController@userAddFavorite')->name('user.addfavorite');
        Route::get('user/addfavoritemore', 'FrontKutuphanahController@userAddFavorite')->name('user.addfavoritemore');
        
        Route::post('remove-contenue-watch', 'FrontKutuphanahController@RemoveContenueWatch')->name('remove-contenue-watch');
        
        Route::post('user/add-rate', 'FrontKutuphanahController@userAddRate')->name('user.add-rate');

        Route::get('my-wishlist', 'FrontKutuphanahController@mywishlist');
         
        Route::get('my-certificates', 'FrontKutuphanahController@myCertificates');
        Route::get('print-certificates/{slug}', 'FrontKutuphanahController@printCertificates');
        
        
        
        
        
        Route::get('renew_cancel', 'FrontKutuphanahController@renewCancel');
        Route::post('renew-subscrip', 'FrontKutuphanahController@renewSubscrip')->name('renew-subscrip');
        
        Route::get('renew_subscrip_curriculas', 'FrontKutuphanahController@renewSubCurriculas');
        Route::post('renew-subscrip-curriculas', 'FrontKutuphanahController@renewSubscripCurriculas')->name('renew-subscrip-curriculas');
        
        
        Route::get('remove_acount', 'FrontKutuphanahController@removeAcount');
        
        Route::post('updatebankdetails', 'FrontKutuphanahController@updateBankDetails')->name('updatebankdetails');
        
        Route::get('my-profile', 'FrontKutuphanahController@myprofile');
          
        Route::post('updateprofile', 'FrontKutuphanahController@updateProfile')->name('updateprofile');

    });
  
 
 

 
  Route::post('new-subscription', 'FrontKutuphanahController@newSubscription')->name('new-subscription');

  Route::get('about', 'FrontKutuphanahController@about');

  Route::get('policy', 'FrontKutuphanahController@return_policy');


  Route::get('teslive', 'FrontKutuphanahController@teslive');

  Route::get('search', 'FrontKutuphanahController@search');

    
  Route::get('terms/conditions', 'FrontKutuphanahController@termsconditions')->name('terms.conditions');
  Route::get('agreements', 'FrontKutuphanahController@agreements')->name('agreements');
  Route::get('return-policy', 'FrontKutuphanahController@returnPolicy')->name('return-olicy');
  Route::get('cancellation-policy', 'FrontKutuphanahController@cancellationPolicy')->name('cancellation-policy');
  Route::get('delivery-policy', 'FrontKutuphanahController@deliveryPolicy')->name('delivery-policy');
  Route::get('instuctor-policy', 'FrontKutuphanahController@instuctorPolicy')->name('instuctor-policy');
  Route::get('student-policy', 'FrontKutuphanahController@studentPolicy')->name('student-policyy');
  
  
  Route::get('contact', 'FrontKutuphanahController@contact')->name('contact');
  
  
  
    Route::get('curriculums', 'FrontKutuphanahController@curriculums');
    Route::get('curriculums/{id}', 'FrontKutuphanahController@curriculasDetails');

##### end kutpana  ######################





