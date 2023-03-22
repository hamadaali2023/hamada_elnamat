@extends('layout.front_main')
@section('content') 
    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">شهاداتي الاونلاين</h3>

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

                         <p class="text-bold-500 text-dark text-extra-large mb-2 mt-3">
                             @if($user->full_name != "null")
                                {{ $user->full_name }}
                            @else
                                {{ $user->name }}
                            @endif
                         </p>

                        <p class="text-medium2">{{$user->email}}</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        <a class="profile-links" href="{{url('/')}}">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                        <!--<a class="profile-links" href="{{url('my-wishlist')}}">-->
                        <!--    <i class="fas fa-heart"></i> {{__('front.my wishlist')}}-->
                        <!--</a>-->
                       

                       
                        <!--<a class="profile-links" href="{{url('renew_cancel')}}">-->
                        <!--    <i class="fas fa-money-check"></i> {{__('front.Renew or cancel or remove')}}-->
                        <!--</a>-->
                        <a class="profile-links" href="{{url('renew_subscrip_curriculas')}}">
                            <i class="fas fa-money-check"></i> {{__('front.Renew or cancel curriculas')}}
                        </a>
                        <!--<a class="profile-links" href="{{url('remove_acount')}}">-->
                        <!--    <i class="fas fa-money-check"></i> {{__('front.remove acount')}}-->
                        <!--</a>-->
                         <a class="profile-links" href="{{url('my-certificates')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> {{__('front.course certificates')}}
                        </a>
                        <a class="profile-links" href="{{url('my-live-certificates')}}">
                            <i class="fas fa-video pr-2"></i> {{__('front.live certificates')}}
                        </a> 
                        <a class="profile-links" href="{{url('my-lives')}}">
                            <i class="fas fa-money-check "></i> دوراتي الاونلاين
                        </a>
                         <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user"></i> {{__('front.my profile')}}
                        </a>
                         <a class="profile-links" href="{{url('student-password')}}">
                            <i class="fas fa-money-check"></i> تغيير كلمة المرور
                        </a>
                        <div class=" bg-light text-center mt-2 pt-2 pb-2">
                                <a class="dropdown-item main-color font-weight-600 text-medium" href="{{ route('signoutinstructors') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    {{__('front.logout')}}
                                </a>
                                <form id="logout-form" action="{{ route('signoutinstructors') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </div>
                    </div>
                </aside>
                    <!-- start My Wishlist -->
                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                                {{__('front.live certificates')}}</h6> 
                            <p>تستطيع الحصول على الشهادات للدورات التي حضرتها كاملة ، ورسوم كل شهادة هو ({{$contactInfo->live_certificate}} دولار) </p>
                            <!--<p>تستطيع فقط الحصول على الشهادات للدورات التي قمت بمشاهدتها بشكل كامل ، رسوم كل شهادة هو 5 دولار</p>-->
                                   
                        </div>
                    </div>
                    <div class="row featured-courses">
                        <!-- start features box item -->
                        @foreach ($lives as $_item)
                            <div class="col-12 col-lg-4 col-md-6">
                                <a href="{{url('lives/'.$_item->live->slug)}}">
                                    <img src="{{asset('assets_admin/img/livecourses/'.$_item->live->image) }}" class="img-fluid">
                                </a>
                                
                                    <div class="bg-light">
                                        <a href="{{url('lives/'.$_item->slug)}}">
                                        <p class="text-dark font-weight-bold mb-2"> {{ $_item->live->title }}  </p>
                                         </a>
                                       <!--  <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                           
                                        </div> -->
                                        <div class="featured-date mb-2">
                                            <!--@if($_item->certificate == null)-->
                                            <!--    <a href="{{url('get-checkout/live-certificate/'.$_item->live->id)}}" class="w-100 btn header-btn text-medium font-weight-600" target="_blank"> -->
                                            <!--        الحصول على الشهادة-->
                                            <!--    </a>-->
                                            <!--@else-->
                                            <!--    <a href="{{url('print-live-certificates/'.$_item->live->id)}}" class="w-100 btn header-btn text-medium font-weight-600" target="_blank"> -->
                                            <!--        تحميل الشهادة-->
                                            <!--    </a>-->
                                                
                                            <!--@endif-->
                                            
                                            
                                             @if($_item->status == 1)
                                                @if($_item->certificate == null)
                                                    <a href="{{url('get-checkout/live-certificate/'.$_item->live->id)}}" class="w-100 btn header-btn text-medium font-weight-600" target="_blank"> 
                                                        الحصول على الشهادة
                                                    </a>
                                                @else
                                                    <a href="{{url('print-live-certificates/'.$_item->live->id)}}" class="w-100 btn header-btn text-medium font-weight-600" target="_blank"> 
                                                        تحميل الشهادة
                                                    </a>
                                                @endif    
                                            @else
                                                <button class="w-100 btn header-btn text-medium font-weight-600"  > 
                                                    الحصول على الشهادة
                                                </button>
                                            @endif
                                        </div>
            
                                      
                                    </div>
                               
                                <div class="row mt-3 justify-content-center text-center">
                                    <div class="col-6">
                                        <!-- <a href="#" class="btn header-btn">Subscribe</a> -->
                                    </div>
            
                                    <!-- <div class="col-6">
                                        <a href="#" class="btn header-btn">Remove</a>
                                    </div> -->
                                </div>
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