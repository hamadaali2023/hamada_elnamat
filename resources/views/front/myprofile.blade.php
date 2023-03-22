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
                        <p class="text-bold-500 text-dark text-extra-large mb-3">
                            <!--{{$user->name}}-->
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

                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5">

                    <div class="form-section form-section-edit">
                      
                        <h6>
                              {{__('front.Personal Information')}}
                        </h6>
                        <hr>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>خطا</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                          <form action="{{route('updateprofile')}}" method="POST" 
                                    name="le_form"  enctype="multipart/form-data">
                                    @csrf



                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__('front.name')}}</label>
                                        <input type="text" name="name" class="form-control" value="{{$user->full_name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> {{__('front.email')}}</label>
                                        <input type="text" disabled class="form-control" value="{{$user->email}}" disabled>
                                    </div>
                                </div>                                
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> {{__('front.phone')}}</label>
                                        <input type="text" name="mobile" class="form-control" value="{{$user->mobile}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> {{__('front.dateOfBirth')}}</label>
                                        <input type="date" name="dateOfBirth" class="form-control" value="{{$user->dateOfBirth}}">
                                        
                                    </div>
                                </div>
                            </div>

                            <!--<div class="row mb-3">-->
                            <!--    <div class="col-md-12">-->
                            <!--        <div class="form-group">-->
                            <!--            <label>{{__('front.address')}}</label>-->
                            <!--            <input type="text" name="address" class="form-control" value="{{$user->address}}">-->
                            <!--        </div>-->
                            <!--    </div>-->
                                
                            <!--</div>-->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__('front.photo')}}</label>
                                        <input type="file" name="photo" class="form-control" value="{{$user->address}}">
                                        
                                    </div>
                                </div>
                                
                            </div>

                            <!-- <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country:</label>
                                        <select class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State:</label>
                                        <select  class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City:</label>
                                        <select  class="form-control" name="" id="">
                                            <option value="">Cairo</option>
                                            <option value="">United States</option>
                                        </select>
                                    </div>
                                </div>

                               

                            </div> -->

                            <!-- <div class="row mb-3">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Author Bio</label>
                                        <textarea rows="5" name="detail" class="form-control">{{$user->detail}}
                                            </textarea>
                                    </div>
                                </div>

                            </div> -->

               
                            <div class="row mb-3 justify-content-end mr-2">

                                <button type="submit" class="btn header-btn text-medium font-weight-600">
                                {{__('front.save change')}}  
                                </button>
                            </div>





                        </form>



                    </div>

                </main>

            </div>
        </div>
    </section>
    <!-- end My Profile -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
		$(document).ready(function () {
		    
		
			
			$.ajax({
                    type: 'GET',
                    url: "{{url('/allwatch')}}",
                    success: function (response) {
                        console.log(response);   
                    }
            });

			
			
			
			
	    });

	</script>

@endsection