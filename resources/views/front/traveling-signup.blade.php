
    @extends('layout.front_main')
@section('content') 


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


@if($langg == 'ar')
   
@else
    <style type="text/css">
        .agree_inst{
            direction: ltr;
        }
    </style>
@endif
    <!-- start signup -->
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-5">
                    <h6> اصدار تأشيرة لدخول السعودية</h6>
                    <hr>
                    @if(session()->has('message'))
                      @include('admin.includes.alerts.success')
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
                    @if(Session::has('errorss'))
                     <div class="row mr-2 ml-2" style="background-color: #ff909f" >
                      <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error" style="color: #9f0c21;font-size: 13px">
                         {{Session::get('errorss')}}
                      </button>
                     </div>
                     @endif
                     
                    <!-- <div class="row " >
                        <div class="col-md-5">
                            <a href="{{route('instructor-signup')}}">
                            <button style="background: #F44A4A;color:#fff; "type="text" class="btn btn-lg  btn-outline-danger " id="type-error">
                                 تسجيل مدرب جديد
                            </button> 
                            </a>
                        </div>&nbsp;&nbsp;&nbsp;
                        <div class="col-md-5">
                            <a href="{{route('student-signup')}}">
                                <button style="border: 1px solid #F44A4A; padding-left: 37px;padding-right: 33px;" type="text" class="btn btn-lg  btn-outline-danger mb-2" id="type-error" >
                             تسجيل متدرب
                                </button>
                            </a>    
                        </div>
                     </div> -->
                   


                    <form method="POST" action="{{route('register-new-traveling')}}" enctype="multipart/form-data">
                                @csrf
                            <!--<input type="hidden" name="type" value="instructor">    -->
                            
                        <div class="form-group">
                             <!--<p class="text-small mb-2"> <span class="font-weight-bold  text-danger">Note:</span> Type your full name as you wish to print the certificates later, it cannot be modified after subscribing</p> -->
                            <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{__('front.full name')}}">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{__('front.email')}}" >
                        </div>

                        

                        <div class="form-group">
                            <i class="fa fa-phone icon"></i>
                            <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{__('front.phone')}}">
                        </div>
                        
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit"  >ارسال</button>
                      
                    </form>
                   
            </div>
        </div>
    </section>



@endsection
