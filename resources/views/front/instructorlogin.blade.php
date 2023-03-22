@extends('layout.front_main')
@section('content') 

    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <h6>Log in to your account</h6>
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
                    <form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('instructor_login')}}">
                         @csrf
                        <div class="form-group d-flex">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email">
                            @error('email')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group d-flex">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @error('password')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <a href="{{url('forgot/password')}}" class=" ">Forget your password ?</a>
                        </div>    
                        <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">{{__('home.sign in')}} </button>
                                </div>
                        <!-- <button type="submit" class="w-100 btn header-btn text-large font-weight-bold">Log In</button> -->


                    </form>

                    <hr>
                    <div class="text-center">

                        <p>Don't have an account ? <a href="signup.html" class="main-color font-weight-bold">Sign Up</a>
                        </p>

                    </div>



                </div>





            </div>
        </div>
    </section>
    <!-- end login -->

@endsection