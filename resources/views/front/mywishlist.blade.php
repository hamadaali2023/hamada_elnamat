@extends('layout.front_main')
@section('content') 
    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600"> {{__('front.my wishlist')}}</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start My Wishlist -->


    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">

                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">

                         <p class="text-bold-500 text-dark text-extra-large mb-2 mt-3">{{$user->name}}</p>

                        <p class="text-medium2">{{$user->email}}</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        
                        <!-- <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart "></i> My Wishlist
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user "></i> My Profile
                        </a> -->

                        <!-- <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-chalkboard-teacher "></i> Become an Instructor
                        </a>
 -->
                        <!-- <a class="profile-links" href="{{url('bank-details')}}">
                            <i class="fas fa-money-check "></i> Bank Details
                        </a> -->
                        <a class="profile-links" href="{{url('/')}}">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>

                         <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart " ></i> {{__('front.my wishlist')}}
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user "></i> {{__('front.my profile')}}
                        </a>

                        <a class="profile-links" href="{{url('my-certificates')}}">
                            <i class="fas fa-chalkboard-teacher "></i> {{__('front.my certificates')}}
                        </a>
                        <!-- <a class="profile-links" href="mycourses.html">
                            <i class="fas fa-video "></i> {{__('front.pay method')}}
                        </a> -->
                       <a class="profile-links" href="{{url('renew_cancel')}}">
                            <i class="fas fa-money-check "></i> {{__('front.Renew or cancel or remove')}}
                        </a>
                        <a class="profile-links" href="{{url('student-password')}}">
                            <i class="fas fa-money-check "></i> تغيير كلمة المرور
                        </a>
                        <!--  <a class="profile-links" href="{{url('remove_acount')}}">
                            <i class="fas fa-money-check "></i> إزالة الحساب
                        </a> -->
                    </div>
                </aside>
                    <!-- start My Wishlist -->
                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                                {{__('front.my wishlist')}}</h6>        
                        </div>
                    </div>
                    <div class="row featured-courses">
                        <!-- start features box item -->
                        @foreach ($favorites as $_item)
                            <div class="col-12 col-lg-4 col-md-6">

                                <a href="{{url('courses/'.$_item->course->slug.'/'.$_item->course->id)}}">
                                        <img src="{{asset('assets_admin/img/courses/'.$_item->course->image) }}" class="img-fluid">
                                </a>
                                <a href="{{url('courses/'.$_item->course->slug.'/'.$_item->course->id)}}">
                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> {{ $_item->course->title }}  </p>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->course->date}}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>{{$_item->course->duration}} {{__('front.hours')}}</span>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-10">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                            <div class="col-2">
                                                
                                                <form action="{{route('user.addfavorite')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="courseId" value="{{$_item->course->id}}">   
                                                        <button type="submit" class="course-heart-icon">
                                                            <i class="fas fa-heart pr-2" style="color:red"></i>
                                                        </button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                </a>
                               <!--  <div class="row text-center">
                                    <div class="col-6">
                                        <i class="fas fa-heart pr-2" style="color:#ff8000"></i>
                                        <a href="#" class="btn header-btn">Subscribe</a>
                                    </div>
            
                                    <div class="col-6">
                                        <a href="#" class="btn header-btn">Remove</a>
                                    </div>
                                </div> -->
                                <!-- <div class="row mt-3 justify-content-center text-center">
                                    <div class="col-6">
                                        <i class="fas fa-heart pr-2" style="color:#ff8000"></i>
                                        <a href="#" class="btn header-btn">Subscribe</a>
                                    </div>
            
                                    <div class="col-6">
                                        <a href="#" class="btn header-btn">Remove</a>
                                    </div>
                                </div> -->

                            </div>
                        @endforeach
                        <!-- end features box item -->
                    </div>

                    </main>

                        <!-- end My Wishlist -->



                </div>

                </div>

                </section>


@endsection