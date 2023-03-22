
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
                    <h6> سجل وابدأ العمل معنا</h6>
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
                   


                    <form method="POST" action="{{route('register-new-instructor')}}" enctype="multipart/form-data">
                                @csrf
                            <input type="hidden" name="type" value="instructor">    
                             <span><span class="font-weight-bold  text-danger">{{__('front.note')}} </span>{{__('front.note text')}}</span>
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
                            
                            <i class="fas fa-lock icon" onclick="myFunction()"></i>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="{{__('front.password')}}" id="user-password">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-lock icon" onclick="myFunction()"></i>

                            <input type="password" name="confirm_password" id="user-password-confirm" class="form-control" placeholder="{{__('front.confirm password')}}">
                        </div>

                        <div class="form-group">
                             <i class="fa fa-map-marker icon"></i>
                            <select name="countryId" class="form-control"  >
                                <option  disabled selected>{{__('front.select country')}}</option>  
                                @foreach ($countries as $_item) 
                                <option value="{{$_item->id}}">{{$_item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                            <select name="type" class="form-control">
                                <option  disabled selected>{{__('front.select type')}}</option>  
                                <option value="student">{{__('front.student')}}</option>
                                <option value="instructor">{{__('front.instructor')}}</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <i class="fa fa-phone icon"></i>
                            <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{__('front.phone')}}">
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                               <!--  <div class="col-10 pl-0" > -->
                                    <p>بالضغط على زر التسجيل انت توافق علي <a href="{{url('policy')}}" style="color: #337ab7 !important" target="_blank"> سياسة الخصوصية</a> و <a href="{{url('instuctor-policy')}}" target="_blank" style="color: #337ab7 !important">إتفاقية المدرب</a></p>
                                <!-- </div> -->
                            </div>
                        </div>
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit"  >{{__('front.sign up')}}</button>
                       <!--  <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <div class="col-10 pl-0" >
                                       <a href="#" class="main-color" onclick="show_all();" style="color: #337ab7 !important"> أوافق على اتفاقية المدرب </a>  
                                </div>
                            </div>
                        </div>
                        <div class="modal-content" id="agreementshow" style="    display: none;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! $contact->agreements_ar !!}
                                <div class="checkbox agree_inst">
                                    <input type="checkbox" id="agreeID" onchange="activateButton(this)"> 
                                    <label><span style="padding: 5px;color: blue">موافقة</span></label>
                                </div>
                            </div>
                        </div>
                        <span id="agreeError" style="color: red;"></span>
                        <br /></br>
                        
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" onclick="return Validateallinput()" >{{__('front.sign up')}}</button> -->


                    </form>
                    <hr>
                    <div class="text-center">
                        <p>{{__('home.hav acount')}} <a href="{{url('login/user')}}" class="main-color font-weight-bold">{{__('front.log in')}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end signup -->
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>


<script>
    function myFunction() {
      var x = document.getElementById("user-password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }

       var x = document.getElementById("user-password-confirm");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>


    <script type="text/javascript">
        function show_all()
        {
            document.getElementById('agreementshow').style.display = '';
        };
        function Validateallinput() {
            console.log("welcome suddb");
            var agreeError = document.getElementById("agreeError");
            if (!document.getElementById('agreeID').checked) {
                agreeError.innerHTML = "يجب الموافقة على إتفاقية المدرب ";
                return false;
            }
            agreeError.innerHTML = "";
            return true;
            
        }
    </script>
    
    <script>
        function activateButton(element) {
            if(element.checked) {
                document.getElementById("agreem_submit").disabled = false;
                document.getElementById("agreem_checked").checked = true;
            }else{
                document.getElementById("agreem_submit").disabled = true;
                document.getElementById("agreem_checked").checked = false;
            }
        }
    </script>

@endsection
