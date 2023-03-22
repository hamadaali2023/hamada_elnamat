
<!-- 
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
    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <h6> {{__('front.sign up and start learning')}}</h6>
                    <hr>
                    @if(session()->has('message'))
                      @include('admin.includes.alerts.success')
                    @endif
                    <div class="row mr-2 ml-2" >
                     <button style="background: #F44A4A;color:#fff;margin-left: 10px;
    margin-right: 30px;" type="text" class="btn btn-lg  btn-outline-danger mb-2" id="type-error">
                         تسجيل مدرب
                      </button>
                      <button style="border: 1px solid #F44A4A;margin-left: 10px;
    margin-right: 20px;" type="text" class="btn btn-lg  btn-outline-danger mb-2" id="type-error">
                         تسجيل طالب
                      </button>
                     </div>
                    @if(Session::has('errorss'))
                    <div class="row mr-2 ml-2" >
                      <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error">
                         {{Session::get('errorss')}}
                      </button>
                     </div>
                     @endif


                    <form method="POST" action="{{route('create.acount')}}" enctype="multipart/form-data">
                                @csrf
                        <div class="form-group">
                             <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{__('front.full name')}}">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="{{__('front.email')}}">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="{{__('front.password')}}">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                            <input type="password" class="form-control" placeholder="{{__('front.confirm password')}}">
                        </div>

                        <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                            <select name="countryId" class="form-control"  >
                                <option  disabled selected>{{__('front.select country')}}</option>  
                                @foreach ($countries as $_item) 
                                <option value="{{$_item->id}}">{{$_item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <i class="fas fa-lock icon"></i>
                            <select name="type" class="form-control">
                                <option  disabled selected>{{__('front.select type')}}</option>  
                                <option value="student">{{__('front.student')}}</option>
                                <option value="instructor">{{__('front.instructor')}}</option>
                                
                            </select>
                        </div>

                        <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <div class="col-10 pl-0" >
                                       <a href="#" class="main-color" onclick="show_all();" style="color: #337ab7 !important"> أوافق على اتفاقية المؤلف </a>  

                                </div>
                            </div>
                        </div>
                        <div class="modal-content" id="agreementshow" style="    display: none;">
                           
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
                        
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" onclick="return Validateallinput()" >{{__('front.sign up')}}</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <p> {{__('front.dont have account')}}<a href="{{url('login/user')}}" class="main-color font-weight-bold">{{__('front.log in')}}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

    <script type="text/javascript">
        function show_all()
        {
            document.getElementById('agreementshow').style.display = '';
        };
        function Validateallinput() {
            console.log("welcome suddb");
            var agreeError = document.getElementById("agreeError");
            if (!document.getElementById('agreeID').checked) {
                agreeError.innerHTML = "يجب الموافقةعلى الشروط والاحكام ";
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
 -->