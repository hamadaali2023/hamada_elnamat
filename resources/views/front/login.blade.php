@extends('layout.front_main')
@section('content') 
<!--<script src="https://raw.githubusercontent.com/biggora/device-uuid/master/lib/device-uuid.min.js"></script>-->

<!--<script>-->
<!--var du = new DeviceUUID().parse();-->
<!--console.log(du);-->
<!--var uuid = new DeviceUUID().get();-->
<!--console.log(uuid);-->
<!--</script>-->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <h6>{{__('front.log in to your account')}}</h6>
                    <hr>


                    <!-- <a href="#">

                        <div class="social-link facebook-link mb-3">
                            <i class="fab fa-facebook-f pr-3"></i>
                            <span>Continue with Facebook</span>
                        </div>
                    </a>


                    <a href="#">
                        <div class="social-link gmail-link mb-3">
                            <i class="fab fa-google pr-3"></i>
                            <span>Continue with Google</span>
                        </div>
                    </a>

                    <a href="#">
                        <div class="social-link gmail-link mb-3">
                            <i class="fab fa-apple pr-3"></i>
                            <span>Continue with Apple</span>
                        </div>

                    </a> -->
                    @if(session()->has('message'))
                                @include('admin.includes.alerts.success')
                            @endif

                            @if(Session::has('errorss'))                                
                               <span class="text-danger">{{Session::get('errorss')}}</span>
                            @endif 
                            <br><br>
                    <form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('userlogin')}}">
                         @csrf
                        <div class="form-group d-flex">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="{{__('front.email')}}">
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group d-flex">
                            <i class="fas fa-lock icon" onclick="myFunction()"></i>
                            <input type="password" name="password" class="form-control" id="user-password" placeholder="{{__('front.password')}}">
                            @error('password')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>


                        <div class="form-group ">
                           

                            <a href="{{url('forgot/password')}}" class=" ">{{__('front.forget your password')}}</a>
                        </div>    
                        <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">{{__('front.log in')}} </button>
                                </div>
                        <!-- <button type="submit" class="w-100 btn header-btn text-large font-weight-bold">Log In</button> -->


                    </form>

                    <hr>
                    <div class="text-center">

                        <p> {{__('front.dont have account')}}<a href="{{url('student-signup')}}" class="main-color font-weight-bold">{{__('front.sign up')}}</a>
                        </p>

                    </div>



                </div>





            </div>
        </div>
    </section>
    <!-- end login -->


<script>
    function myFunction() {
      var x = document.getElementById("user-password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
@endsection