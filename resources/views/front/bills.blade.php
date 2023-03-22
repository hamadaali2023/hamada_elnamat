@extends('layout.front_main')
@section('content') 

    <!-- start banner  -->
    <section class="parallax banner">
        <div class="container">
            <div class="row justify-content-center">

                <h3 class="text-white font-weight-600">{{__('front.my profile')}}</h3>

            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start My Profile -->
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <aside class="col-12 col-lg-3 float-left">
                    <div class="bg-light p-3 pt-4 mb-3 bg-white text-center">
                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">
                        <div class="image-upload">
                            <label for="file-input">
                                <i class="fas fa-pen"></i>
                            </label>
                            <input id="file-input" type="file" />
                        </div>
                        <p class="text-bold-500 text-dark text-extra-large mb-3">{{$user->name}}</p>
                        <p class="text-medium2">u{{$user->email}}</p>
                    </div>
                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">


                        <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart pr-2"></i> {{__('front.my wishlist')}}
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user pr-2"></i> {{__('front.my profile')}}
                        </a>

                        <a class="profile-links" href="{{url('my-certificates')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> {{__('front.my certificates')}}
                        </a>
                        <a class="profile-links" href="mycourses.html">
                            <i class="fas fa-video pr-2"></i> {{__('front.pay method')}}
                        </a>
                        <a class="profile-links" href="{{url('bank-details')}}">
                            <i class="fas fa-money-check pr-2"></i> {{__('front.Renew or cancel')}}
                        </a>
                         <a class="profile-links" href="{{url('user_bills')}}">
                            <i class="fas fa-money-check pr-2"></i> كشف حسابي
                        </a>
                    </div>



                </aside>

                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5">

                    <div class="form-section form-section-edit">
                        كشف حساب
                        <h6>

                        </h6>
                        <hr>
                        <p>تم الإشتراك بتاريخ : </p>
                        <p>نوع الإشتراك : </p>
                        <p>موعد تجديد الإشتراك : </p>
                        

                        



                    </div>

                </main>

            </div>
        </div>
    </section>
    <!-- end My Profile -->


@endsection