@php  
    
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
							<!-- <h6 style="text-align: center; color: red;">انشر كتابك الرقمي بنفسك بخمسة دقائق كاتفاقية غير حصرية واحصل على 60% من المبيعات</h6> -->
							<h4 class="card-title text-center">{{__('home.sign in')}} </h4>


							@if(session()->has('message'))
				                @include('admin.includes.alerts.success')
				            @endif

				            @if(Session::has('errorss'))				              	
				               <span class="text-danger">{{Session::get('errorss')}}</span>
				            @endif 
				            <br><br>
							<form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('userlogin')}}">
                       				 @csrf
								<div class="form-group">
									<label for="email">{{__('home.email')}}</label>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" required="" autofocus="">
									@error('email')
			                          <strong>{{ $message }}</strong>
			                        @enderror
								</div>

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
									<label for="password">
										<a href="https://kutuphanah.com/pages/auth/forgot.html" class="float-left">
											
											{{__('home.forget')}}
										</a>
									</label>
									
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">{{__('home.sign in')}} </button>
								</div>
								<div class="mt-4 text-center">
									{{__('home.not hav acount')}}
									
									<a href="{{route('register.user')}}">
										{{__('home.create acount')}}
										 </a>
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




</body></html>