<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['api'], 'namespace' => 'Api'], function () {
    Route::post('videosortable','HomeController@videosortable');
    Route::post('videosortable-curriculums','HomeController@videosortableCurriculums');

//   Route::group(['middleware' => ['api','changeLanguage','checkDoctor:patient-api'], 'namespace' => 'Api'], function () {
   
    // Route::group(['middleware' => ['auth:patient-api','changeLanguage'], 'namespace' => 'Api'], function () {

  	Route::post('login', 'HomeController@login');
  	Route::post('register', 'HomeController@register');
    
    Route::get('contactinfo', 'HomeController@contactInfo');
    Route::get('all-courses', 'HomeController@allcourses');
    Route::get('allcourses-lives', 'HomeController@allcoursesLive');
    Route::post('change_password', 'HomeController@change_password');
    Route::post('forgetpassword', 'HomeController@forgetPassword');

    
    Route::group(['prefix' => 'instructor'],function (){
        Route::get('instructor-data', 'InstructorController@getInstructorData');
        Route::get('mycourses', 'InstructorController@myCourses');
        // Route::post('change_password', 'PatientAuthController@change_password');
        // Route::post('forgetpassword', 'PatientAuthController@forgetPassword');
        // Route::post('home', 'HomeController@index');
        // Route::post('sliders', 'HomeController@sliders');
        // Route::post('addrate', 'HomeController@addRate');
        
       
        // Route::post('register', 'PatientAuthController@register');
        
        // Route::post('getpatient', 'PatientAuthController@getPatient');
        
        // Route::post('removefavorite', 'HomeController@removeFavorite');
        // Route::post('countries', 'HomeController@Countries'); 
        // Route::post('cities', 'HomeController@Cities'); 
        // Route::post('appointmentstatus', 'HomeController@appointmentStatus');



    });
    Route::group(['prefix' => 'student'],function (){
        Route::post('course-joined', 'StudentController@coursesJoined');
        Route::get('mycourses-joind', 'StudentController@myCourses');
        Route::post('add-rate', 'StudentController@addRate');
        Route::post('add-rate-course-live', 'StudentController@addRateCourseLive');
        Route::post('session-status', 'StudentController@sessionStatus');
        // Route::post('change_password', 'PatientAuthController@change_password');
        // Route::post('forgetpassword', 'PatientAuthController@forgetPassword');
        // Route::post('home', 'HomeController@index');
        // Route::post('sliders', 'HomeController@sliders');
        // Route::post('addrate', 'HomeController@addRate');
        
       
        // Route::post('register', 'PatientAuthController@register');
        
        // Route::post('getpatient', 'PatientAuthController@getPatient');
        
        // Route::post('removefavorite', 'HomeController@removeFavorite');
        // Route::post('countries', 'HomeController@Countries'); 
        // Route::post('cities', 'HomeController@Cities'); 
        // Route::post('appointmentstatus', 'HomeController@appointmentStatus');



    });
});    