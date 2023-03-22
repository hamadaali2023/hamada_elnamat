<!-- @php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>{{__('home.sign in')}} </title>
	<link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}"  crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('web/asset/auth.css')}}">
	<link rel="stylesheet" href="{{asset('web/asset/all.css')}}">
    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}">
    <link rel="Stylesheet" type="text/css" href="{{asset('web/asset/styles.css')}}">

</head>

<body class="my-login-page" style="background-image: url(web/images/background.svg); background-size: cover;">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<h1 style="text-align: center; margin-top: 40px;">{{__('home.app title')}}</h1>
					<hr>
					<div class="card fat">
						<div class="card-body">
							

							@if(session()->has('message'))
				                @include('admin.includes.alerts.success')
				            @endif

				            @if(Session::has('errorss'))				              	
				               <span class="text-danger">{{Session::get('errorss')}}</span>
				            @endif 
				            <br><br>
							<form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('reset-user-password.post')}}">
                       				 @csrf
								<input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group">
									
									<div style="position:relative" id="eye-password-0">
										<label for="email">{{__('home.password')}}</label>
										<input  type="password" class="form-control @error('password') is-invalid @enderror" name="password"  style="padding-right: 60px;">										
							    	</div>

							    	@error('password')
			                                <strong>{{ $message }}</strong>
			                        @enderror
								   
								</div>
								<div class="form-group">
									
									<div style="position:relative" id="eye-password-0">
										<label for="email">{{__('home.password')}}</label>
										<input  type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  style="padding-right: 60px;">										
							    	</div>

							    	@error('password_confirmation')
			                                <strong>{{ $message }}</strong>
			                        @enderror
								   
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">{{__('home.save change')}} </button>
								</div>
								
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright © 2020 — كوتبانه
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('web/asset/jquery-3.js')}}"  crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/popper.js')}}" crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/bootstrap.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('web/asset/author.js')}}"></script>




</body></html> -->

@extends('layout.front_main')
@section('content') 

    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <h6>{{__('front.forget pass')}}</h6>
                    <hr>

                    
                    @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
                    @endif

                    @if(Session::has('errorss'))                                
                        <span class="text-danger">{{Session::get('errorss')}}</span>
                    @endif 
                    
                    <br><br>
                  
						@if(session()->has('message'))
				                @include('admin.includes.alerts.success')
				            @endif

				            @if(Session::has('errorss'))				              	
				               <span class="text-danger">{{Session::get('errorss')}}</span>
				            @endif 
				            <br><br>
							<form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('reset-user-password.post')}}">
                       				 @csrf
								<input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group">
									
									<div style="position:relative" id="eye-password-0">
										<label for="email">{{__('front.new password')}}</label>
										<input  type="password" class="form-control @error('password') is-invalid @enderror" name="password"  style="padding-right: 60px;">										
							    	</div>

							    	@error('password')
			                                <strong>{{ $message }}</strong>
			                        @enderror
								   
								</div>
								<div class="form-group">
									
									<div style="position:relative" id="eye-password-0">
										<label for="email">{{__('front.confirm password')}}</label>
										<input  type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  style="padding-right: 60px;">										
							    	</div>

							    	@error('password_confirmation')
			                                <strong>{{ $message }}</strong>
			                        @enderror
								   
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">حفظ التغيير </button>
								</div>
								
							</form>







                </div>





            </div>
        </div>
    </section>
    <!-- end login -->

@endsection