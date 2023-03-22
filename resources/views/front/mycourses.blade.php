@extends('layout.front_main')
@section('content') 


    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">My Courses</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->



    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">



                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="img/instructor.jpg" class="img-thumbnail profile-img-edit">

                        <p class="text-bold-500 text-dark text-extra-large mb-2 mt-3">{{$user->name}}</p>

                        <p class="text-medium2">{{$user->email}}</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        
                        <!-- <a class="profile-links" href="mycourses.html">
                            <i class="fas fa-video pr-2"></i> My Courses
                        </a> -->
                        <a class="profile-links" href="{{url('/')}}">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                        <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart pr-2"></i> My Wishlist
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user pr-2"></i> My Profile
                        </a>

                        <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> Become an Instructor
                        </a>

                        <a class="profile-links" href="{{url('bank-details')}}">
                            <i class="fas fa-money-check pr-2"></i> Bank Details
                        </a>
                    </div>



                </aside>


                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">


                        <!-- start My Courses -->

                        <div class="mb-4">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                                        My Courses</h6>
                
                                </div>
                            </div>
                                <div class="row featured-courses">
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                                        <a href="#">
                                            <img src="img/courses/word.jpg" class="img-fluid">
                                        </a>
                                        <a href="#">
                                            <div class="bg-light">
                
                                                <p class="text-dark font-weight-bold mb-2"> Introduction And WORD</p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                
                                        <a href="#">
                                            <img src="img/courses/excel.webp" alt="">
                                        </a>
                
                                        <a href="#">
                
                                            <div class="bg-light">
                                                <p class="text-dark font-weight-bold mb-2"> Excel
                                                </p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                
                                        <a href="#">
                                            <img src="img/courses/PowerPoint.jpg" alt="">
                                        </a>
                
                                        <a href="#">
                
                                            <div class="bg-light">
                                                <p class="text-dark font-weight-bold mb-2"> PowerPoint
                                                </p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                
                                        <a href="#">
                                            <img src="img/courses/access.png" alt="">
                                        </a>
                
                                        <a href="#">
                
                                            <div class="bg-light">
                                                <p class="text-dark font-weight-bold mb-2"> Access
                                                </p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                                    
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                
                                        <a href="#">
                                            <img src="img/courses/PowerPoint.jpg" alt="">
                                        </a>
                
                                        <a href="#">
                
                                            <div class="bg-light">
                                                <p class="text-dark font-weight-bold mb-2"> PowerPoint
                                                </p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                                    <!-- start features box item -->
                                    <div class="col-12 col-lg-4 col-md-6">
                
                                        <a href="#">
                                            <img src="img/courses/access.png" alt="">
                                        </a>
                
                                        <a href="#">
                
                                            <div class="bg-light">
                                                <p class="text-dark font-weight-bold mb-2"> Access
                                                </p>
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>30 Jun</span>
                                                </div>
                
                
                                                <div class="featured-date mb-2">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                    <span>1000 EGP</span>
                                                </div>
                
                                                <div>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                
                                            </div>
                                        </a>
                                    </div>
                                    <!-- end features box item -->
                
                
                                </div>
                        </div>
              

                            <!-- end My Courses -->


                                <!-- start Zoom Meetings -->
                                <div class="mb-4">
                <div class="row">
                    <div class="col-12">
                        <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                            Zoom Meetings</h6>
    
                    </div>
                </div>
                    <div class="row featured-courses">
                        <!-- start features box item -->
                        <div class="col-12 col-lg-4 col-md-6">
                            <a href="#">
                                <img src="img/courses/word.jpg" class="img-fluid">
                            </a>
                            <a href="#">
                                <div class="bg-light">
    
                                    <p class="text-dark font-weight-bold mb-2"> Introduction And WORD</p>
    
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>30 Jun</span>
                                    </div>
    
    
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i>
                                        <span>1000 EGP</span>
                                    </div>
    
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
    
                                </div>
                            </a>
                        </div>
                        <!-- end features box item -->
    
    
                    </div>

                    </div>
        
        <!-- end Zoom Meetings -->


                    

                </main>


                </div>

                </div>

                </section>




@endsection