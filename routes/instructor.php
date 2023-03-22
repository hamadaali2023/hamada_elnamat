<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

// هن اللوجن مش شغاله عشان ملف الروت الجديد لا يعم مع اللوجن


		// Route::get('departments/{id}/edit', 'DocumentController@edit');
		// Route::get('departments', 'DocumentController@update');
		Route::get('files/create', 'DocumentController@create');
		Route::post('files', 'DocumentController@store');
		Route::get('files', 'DocumentController@index');

		Route::post('files/{id}', 'DocumentController@show');
		Route::post('file/download/{file}', 'DocumentController@download');





// start livewire route

	// Route::view('booksss','livewire.index');

// end livewire route


 ###################### user-status ##############################
        // Route::post('users/status/{id}', 'UsersController@updateStatus')->name('users/status/{id}');

        ###################### admin-profile ##############################
       

Route::post('savevideo', 'Instructor\CourseController@addvideostore')->name('savevideo');
Route::get('removeVideoSessionItem/{id}', 'Instructor\CourseController@removeVideoSessionItem');


Route::post('curriculas-savevideo', 'Instructor\CurriculumController@addvideostore')->name('curriculas-savevideo');
Route::get('curriculas-removeVideoSession/{id}', 'Instructor\CurriculumController@removeVideoSession');




// start group hamada
// Route::group(['middleware' => 'vendor'], function () {
// });
// end group hamada 

//  $vendor_authtt= Auth::guard('vendor')->user();
//  if(!$vendor_authtt){
            
//      return redirect(url('vendor/login'));
//  }

Route::group(['middleware' => 'checkInstructor','namespace' => 'Instructor','prefix' => 'instructor'], function () {
    
    
    Route::get('indexxx','CurriculumController@indexxx');
	
	
	Route::get('getsubcategory/{id}','CourseController@getSubCategory');
	Route::get('getchildcategory/{id}','CourseController@getChildCategory');

    Route::resource('students','StudentController');
    Route::resource('dashboard','DashBoardController');


    // Route::middleware(['checkInstructor'])->group(function(){

        Route::resource('stories','BookController');
    // });
    
    // Route::post('add-video-to-session', 'ProgressBarController@addVideoToSession');

    Route::get('bills', 'BillController@index');

    Route::get('video_views', 'VideoViewController@index');   
    Route::get('video_views_curriculums', 'VideoViewController@indexCurriculums');   
    
    Route::post('remove-acount','ProfileController@removeAcount')->name('remove-acount');

    
    Route::resource('straights','LiveCourseController');    
    Route::get('live-joined/{id}', 'LiveCourseController@liveJoined');
    
    Route::resource('consultings','ConsultingController');    
    Route::get('consulting-joined/{id}', 'ConsultingController@consultingJoined');
     Route::post('consulting-update-status', 'ConsultingController@updateStatus')->name('consulting-update-status');
    
    // Route::resource('straights','LiveCourseController');
    Route::resource('courses','CourseController');
    Route::resource('chapters','ChapterController');
    Route::resource('videos','VideoController');
    
    // Route::get('videosortable','VideoController@updateSort')->name('videosortable');
    Route::get('allvideos/{id}','VideoController@allvideoss');
    Route::get('addvideos/{id}','VideoController@addvideos');

    Route::get('allsessions/{id}','SessionssController@allsessions');
    Route::get('addsessions/{id}','SessionssController@addsessions');


    Route::resource('sessions','SessionssController');
    Route::get('getchapter/{id}','BookController@getchapter');

    Route::get('transfers', 'BillController@transfers')->name('transfers'); 

    Route::get('report/sales','ReportController@sales');
    Route::get('report/transfers','ReportController@transfers');
    Route::get('report/statistics','ReportController@statistics');
   	Route::get('getbook/{id}', 'BookController@getbook');

    Route::get('profile', 'ProfileController@index');
    Route::get('print-certificates', 'ProfileController@printCertificates');

    Route::get('bankdetails', 'ProfileController@bankDetails');
    Route::get('western-info', 'ProfileController@westernInfo');
    Route::post('update-western-info', 'ProfileController@updateWesternInfo')->name('update-western-info');
    
    Route::post('bankdetails','ProfileController@updateBankDetails')->name('bankdetails');
   	Route::get('getcity/{id}', 'ProfileController@getCity');

    Route::post('profile/update','ProfileController@updateProfile');
    Route::post('profile/update/documents','ProfileController@updateDocuments');

    Route::post('profile/update/certificates','ProfileController@updateCertificates');

    Route::post('profile/update/cv','ProfileController@updateCv');

    
    Route::resource('curriculums','CurriculumController');
    Route::resource('curricul_video','VideoCurriculumController');
    Route::get('allvideos/curriculums/{id}','VideoCurriculumController@allvideoss');
    Route::get('addvideos/curriculums/{id}','VideoCurriculumController@addvideos');
    // hamadas
    
    Route::post('user/changepassword', 'ProfileController@changePassword')->name('user.changepassword');
    
    Route::get('instructional-video', 'ProfileController@instructionalVideo');	
	Route::get('agreements', 'ProfileController@agreements')->name('agreements');	
    Route::get('terms/conditions', 'ProfileController@termsConditions')->name('terms-conditions');       	
});	


