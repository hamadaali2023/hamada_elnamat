<?php

use Illuminate\Support\Facades\Route;

// هن اللوجن مش شغاله عشان ملف الروت الجديد لا يعم مع اللوجن

// عند اضافه معلومات البنك

// اسم الفرع من ابنك  (اسم الرفعي اللي تم فيه فتح الحساب )
// اسم الشخص 
// سويفت كود 


// عند اضافه رقم ترخيص الكتاب 
// ف الكتب رقم الفسح

// السعر من ٢ الي ٩ ويجب ان تكون دنيماكيك



####  admin #######################
Auth::routes();
  Route::get('admin-login', 'Auth\LoginController@LoginAdmin')->name('admin-login');

		Route::group(['middleware' => 'auth', 'namespace' => 'Admin','prefix' => 'admin'], function () {
		    
		    Route::resource('roles','RoleController');
		    Route::resource('users','UserController');
		    Route::resource('sliders','SliderController');
		    Route::resource('subscription_values','SubscriptionValuesController');
		    
		    Route::post('settings/update','ProfileController@updateSettings');
		    Route::resource('dashboard','DashBoardController');
		    Route::resource('countries','CountryController');
		    Route::resource('cities','CityController');
		    Route::resource('categories','CategoryController');
		    Route::resource('subcategory','SubCategoryController');
		    Route::resource('childcategory','ChildCategoryController');

		    Route::resource('courses','CourseController');
		    
		    Route::post('student-change-password', 'StudentController@studentChangePassword');

		    
		    Route::post('courses/update/status', 'CourseController@updateStatus')->name('courses.update.status');
            Route::get('getsubcategory/{id}','CourseController@getSubCategory');
            Route::get('course-edit/{id}', 'CourseController@courseEdit');
            Route::post('course-update','CourseController@courseUpdate')->name('course-update');
            Route::get('course-filter', 'CourseController@courseFilter')->name('course-filter');
            
            
            
            
            
            Route::resource('curriculums','CurriculumController');
		    Route::get('recycless-curriculums','CurriculumController@recyclessCurriculums');
		    Route::get('recycless-courses','CurriculumController@recyclessCourses');
		    
		    
		    Route::post('curriculums/update/status', 'CurriculumController@updateStatus')->name('curriculum.update.status');
            Route::get('curriculum-edit/{id}', 'CurriculumController@curriculumEdit');
            Route::post('curriculum-update','CurriculumController@curriculumUpdate')->name('curriculum-update');
            Route::get('curriculum-filter', 'CurriculumController@curriculumFilter')->name('curriculum-filter');
            Route::post('destroy-curriculum', 'CurriculumController@destroycurriculum')->name('destroy-curriculum');
            
            Route::get('curriculum-videos/{id}','CurriculumVideoController@curriculumVideos');
		    Route::post('curriculum-video-delete','CurriculumVideoController@destroy')->name('curriculum-video-delete');
		    
            
            
            
		    Route::get('instructor/update/status', 'InstructorController@updateStatus')->name('instructor.update.status');
		    Route::get('instructor/update/suspended', 'InstructorController@updateSuspended')->name('instructor.update.suspended');
		    Route::get('instructor/update/blocked', 'InstructorController@updateBlocked')->name('instructor.update.blocked');

            
		    Route::resource('instructors','InstructorController');
		    Route::get('instructor-filter', 'InstructorController@instructorFilter')->name('instructor-filter');
		    
		    Route::get('all-emails','InstructorController@allEmails');
		    Route::get('all-students-emails','StudentController@allStudentsEmails');
		   
		    
		    Route::get('instructor-notifaction', 'InstructorController@instructorNotifaction')->name('instructor-notifaction');
        	Route::post('instructor-send-notifaction', 'InstructorController@instructorSendNotifaction')->name('instructor-send-notifaction');
    
        Route::post('one-instructor-notifaction', 'InstructorController@oneInstructorNotifaction')->name('one-instructor-notifaction');

            Route::get('wallet-user-balance/{id}','BillController@walletUserBalance');
            Route::get('get-course-name/{id}','BillController@getCourseName');
            Route::get('get-live-name/{id}','BillController@getLiveName');



		    // Route::resource('subscriptions','SubscriptionController');
		    Route::get('students/active', 'SubscriptionController@studentsActive');
		    
		    Route::get('students/notactive', 'SubscriptionController@studentsNotctive');
		    Route::get('students/live-joined/{id}', 'SubscriptionController@liveJoined');
            Route::get('students/livejoined/status', 'SubscriptionController@updateStatus')->name('students.livejoined.status');
            
            Route::get('students/need-to-pay', 'SubscriptionController@needToPay');
            Route::get('students/remove-subscription', 'SubscriptionController@removeSubscription')->name('students.remove-subscription');
            
            Route::get('students/need-to-pay-sub-curriculums', 'SubscriptionController@needToPaySubCurriculums');
            Route::get('students/remove-subscription-curriculums', 'SubscriptionController@removeSubscriptionCurriculums')->name('students.remove-subscription-curriculums');
            
            
            Route::get('user-certificate','StudentController@userCertificate');
             
            Route::get('students/active-curriculas', 'SubscriptionController@studentsActiveCurriculas');
            Route::get('students/notactive-curriculas', 'SubscriptionController@studentsNotActiveCurriculas');
             
            
		    Route::get('instructor-profile/{instructorId}', 'InstructorController@profile');
		    Route::post('instructor/bank/store','InstructorController@updateBankDetails')->name('instructor.bank.store');
		    Route::post('destroy-course', 'InstructorController@destroyCourse')->name('destroy-course');
		    
		    Route::post('destroy-course-live', 'InstructorController@destroyCourseLive')->name('destroy-course-live');
		    Route::resource('lives','LiveCourseController');
		    Route::post('live-courses-update-status', 'LiveCourseController@updateStatus')->name('live-courses-update-status');
            Route::get('live-course-filter', 'LiveCourseController@courseFilter')->name('live-course-filter');
            Route::get('straights/{id}/edit','LiveCourseController@straightsEdit');
            Route::post('straights/update','LiveCourseController@update')->name('straights-update');
            Route::post('straights/delete','LiveCourseController@destroy')->name('straights-delete');


            Route::post('destroy-consulting', 'InstructorController@destroyCourseConsulting')->name('destroy-course-consulting');
		  //  Route::resource('consultings','ConsultingController');
		    Route::get('consultings','ConsultingController@index');
		    Route::post('consulting-courses-update-status', 'ConsultingController@updateStatus')->name('consulting-update-status');
            Route::get('consulting-course-filter', 'ConsultingController@courseFilter')->name('consulting-course-filter');
            Route::get('consultings/{id}/edit','ConsultingController@consultingsEdit');
            Route::post('consultings/update','ConsultingController@update')->name('consultings-update');
            Route::post('consultings/delete','ConsultingController@destroy')->name('consultings-delete');
            
            Route::get('students/consulting-joined/{id}', 'ConsultingController@consultingJoined');
            Route::get('students/consulting-joined/status', 'ConsultingController@consultingStatus')->name('students.consultingjoined.status');
            




		    Route::post('instructor-update','InstructorController@updateProfile');
		    Route::get('allvideos/{id}','VideoController@allvideoss');
		    Route::post('video-delete','VideoController@destroy')->name('video-delete');
		    
		    Route::get('allsessions/{id}','SessionssController@allsessions');
		    Route::post('sessions-destroy','SessionssController@destroy')->name('sessions-destroy');
		    
		    // Route::resource('students','StudentController');
		    
		    Route::get('student-profile/{id}', 'StudentController@profile');
		    Route::post('student-profile','StudentController@updateProfile');
		    
		    Route::resource('instructors','InstructorController');
		    Route::get('student-notifaction', 'StudentController@studentNotifaction')->name('student-notifaction');
        Route::post('student-send-notifaction', 'StudentController@studentSendNotifaction')->name('student-send-notifaction');

		  	// Route::resource('advisors','AdvisorController');
		  	// Route::get('advisor-profile/{id}', 'AdvisorController@profile');

		    // Route::get('about', 'ProfileController@about'); 
		    // Route::get('contact', 'ProfileController@contact');
		  Route::get('bills', 'BillController@index');
		  Route::get('search_date', 'BillController@searchDate')->name('search_date');
		 
		 
		  
		  Route::post('add-subscriptions', 'BillController@addSubscriptions')->name('add-subscriptions');
		  Route::post('add-subscriptions-curriculums', 'BillController@addSubscriptionsCurriculums')->name('add-subscriptions-curriculums');
		  Route::post('buy-course-certificat', 'BillController@buyCourseCertificat')->name('buy-course-certificat');
		  Route::post('buy-live-certificat', 'BillController@buyLiveCertificat')->name('buy-live-certificat');
            
		  Route::post('send_balance', 'BillController@SendBalance')->name('send.balance');
		  Route::post('send-balance-to-all-istructor', 'BillController@SendBalanceToAllIstructor')->name('send-balance-to-all-istructor');
         
        Route::post('send-balance-to-teacher', 'BillController@SendBalanceToTeacher')->name('send-balance-to-teacher');


		  Route::get('transfers', 'BillController@transfers')->name('transfers'); 
		  Route::post('send-to-bank', 'BillController@SendToBank')->name('send-to-bank');


		  Route::get('withdrawals', 'BillController@withdrawals')->name('withdrawals'); 
		  Route::post('send-withdrawals', 'BillController@SendWithdrawals')->name('send-withdrawals');
		  

		 
		  Route::get('video_views_and_balance_instructor', 'BillController@videoViewsAndBalanceInstructor');
		  Route::get('less_than', 'BillController@lessThan')->name('less_than');  
		  Route::get('bigger_than', 'BillController@biggerThan')->name('bigger_than'); 
		  
		Route::get('video_views_and_balance_teacher', 'BillController@videoViewsAndBalanceTeacher');
        Route::get('less_than_teacher', 'BillController@lessThanTeacher')->name('less_than_teacher');  
		Route::get('bigger_than_teacher', 'BillController@biggerThanTeacher')->name('bigger_than_teacher'); 
		 


  		Route::get('getsubcategory/{id}', 'ChildCategoryController@getsubcategory');


		Route::get('settings', 'ProfileController@settings');   
		Route::post('settings/update','ProfileController@updateSettings');
		
		Route::get('all-admin-video', 'ProfileController@allAdminVideo');   
		Route::post('all-admin-video-add','ProfileController@addAdminVideo')->name('all-admin-video-add');
		Route::post('deleteadminvideo','ProfileController@deleteAdminVideo')->name('deleteadminvideo');

		
		Route::get('certificate', 'ProfileController@certificatePrice');   
		Route::post('certificate_price/update','ProfileController@updateCertificatePrice');
        
        Route::get('contact', 'ProfileController@contact');
        Route::post('settings/contactdata','ProfileController@updateContactData');

        Route::get('privacy', 'ProfileController@privacy');
        Route::post('settings/privacy','ProfileController@updatePrivacy');
        
        Route::get('agreements', 'ProfileController@agreements');
        Route::post('update/agreements','ProfileController@updateAgreement');

        Route::get('agreement_student', 'ProfileController@agreement_student');
        Route::post('update/agreement_student','ProfileController@updateAgreement_student');


        Route::get('terms', 'ProfileController@terms');
        Route::post('update/terms','ProfileController@updateTerms');


        Route::get('return_policy', 'ProfileController@return_policy');
        Route::post('update/return_policy','ProfileController@updateReturn_policy');
        
        Route::get('cancellation-policy', 'ProfileController@cancellation_policy');
        Route::post('update/cancellation-policy','ProfileController@updateCancellationPolicy');

        Route::get('delivery-policy', 'ProfileController@delivery_policy');
        Route::post('update/delivery-policy','ProfileController@updateDeliveryPolicy');
        
		    Route::get('profile', 'ProfileController@index');
		    Route::post('profile/update','ProfileController@updateProfile');
		    Route::post('user/changepassword', 'ProfileController@changePassword')->name('user.changepassword');
		    
	    Route::get('/admin', function () {
			    return "iuhiuhhkj";
		});

		Route::group(['prefix' => 'student'],function (){
				Route::get('/users', function () {
				    return "iuhiuhhkj";
				});
		});		
		
		
		
        Route::resource('branches','BranchController');
        
        Route::resource('materials','MaterialController');
        
        Route::resource('marquees','MarqueeController');
});







 ###################### user-status ##############################
        // Route::post('users/status/{id}', 'UsersController@updateStatus')->name('users/status/{id}');
        

        ###################### admin-profile ##############################
       





