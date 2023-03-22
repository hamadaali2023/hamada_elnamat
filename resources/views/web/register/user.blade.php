
@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $langg=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $langg=app()->getLocale();
    }
@endphp 

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title> {{__('home.register')}}</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}"  crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('web/asset/auth.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('web/asset/all.css')}}">
    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}">
    <link rel="Stylesheet" href="{{asset('web/asset/styles.css')}}" type="text/css">
	<style>
		.custom-file-label::after {
		   left: 0;
		   right: auto;
		   border-left-width: 0;
		   border-right: inherit;
	   }
	</style>
</head>

<body class="my-login-page" style="background-image: url(../../images/background.svg); background-size: cover; background-repeat: no-repeat;">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<h1 style="text-align: center; margin-top: 40px;">{{__('home.app title')}}</h1>
					<hr>
					<div class="card fat">
						<div class="card-body">
							<
							<h4 class="card-title text-center">  {{__('home.register')}}  </h4>
							@if(session()->has('message'))
			                  @include('admin.includes.alerts.success')
			                @endif

			              	@if(Session::has('errorss'))
			              	<div class="row mr-2 ml-2" >
			               	 <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error">
			                   {{Session::get('errorss')}}
			                </button>
			              </div>
			              @endif
							<form method="POST" class="my-login-validation text-right" novalidate="" action="{{route('register.user')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="form-group">
									<label for="name">{{__('home.name')}}</label>
									<input  type="text" class="form-control" name="name" value="{{ old('name') }}" required="" autofocus="">
								</div>

								<div class="form-group">
									<label for="email">{{__('home.email')}}</label>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required="">
								</div>
								<div class="form-group">
									<label for="password">{{__('home.password')}} </label>
									<div style="position:relative" id="eye-password-0">
										<input type="password" class="form-control" name="password" value="{{ old('password') }}" >
									</div>
								</div>	
								
								
								<div class="form-group">
									<label>{{__('home.phone')}} </label>
									<input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" 
									placeholder=" {{$tr->translate('رقم الجوال')}}" required="">
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" value="{{ old('agree') }}" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">
											<button type="button" class="btn btn-success openBtn">{{__('home.terms and condition')}} </button>
											{{__('home.agree')}} </label>
										<div class="modal fade" id="myModal" role="dialog">
    										<div class="modal-dialog">
       											<div class="modal-content">
            										<div class="modal-header">
               											<button type="button" class="close" data-dismiss="modal">×</button>
               											<h4 class="modal-title">{{__('home.terms and condition')}} </h4>
            										</div>
            									    
        									    </div>
    									    </div>
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block" id="savebtn" onclick="return checkRegisterForm()">
										تسجيل حساب
									</button>
								</div>
								<div class="mt-4 text-center">{{__('home.hav acount')}}
									 <a href="{{route('login.user')}}">{{__('home.sign in')}} </a>
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

	

	<script src="{{asset('web/asset/bootstrap_002.js')}}"  crossorigin="anonymous"></script>
		
		
	<script src="{{asset('web/asset/jquery.js')}}"></script>

	
	<script src="{{asset('web/asset/jquery-3.js')}}"  crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/popper.js')}}" crossorigin="anonymous"></script>
	<script src="{{asset('web/asset/bootstrap.js')}}"  crossorigin="anonymous"></script>
    <script src="{{asset('web/asset/author.js')}}"></script>



</body></html>