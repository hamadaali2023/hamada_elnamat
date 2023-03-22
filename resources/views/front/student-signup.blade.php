
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

                <div class="col-md-6">
                    <h6> {{__('front.sign up new acount')}}</h6>
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
                            <a href="{{route('student-signup')}}">
                            <button style=" background: #F44A4A;color:#fff; padding-left: 37px;padding-right: 33px;" type="text" class="btn btn-lg  btn-outline-danger mb-2" id="type-error" >
                             تسجيل متدرب
                            </button></a>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                       <div class="col-md-5">
                            <a href="{{route('instructor-signup')}}">
                            <button style="border: 1px solid #F44A4A; "type="text" class="btn btn-lg  btn-outline-danger " id="type-error">
                             تسجيل مدرب جديد
                            </button> 
                        </div>
                        

                    </div> -->

                    <form method="POST" action="{{route('create.acount')}}" enctype="multipart/form-data">
                                @csrf
                            <input type="hidden" name="type" value="student">      
                            <span><span class="font-weight-bold  text-danger">{{__('front.note')}} </span>{{__('front.note text')}}</span>
                        <div class="form-group">
                             <!--<p class="text-small mb-2"> <span class="font-weight-bold  text-danger">{{__('front.note')}}</span> {{__('front.note text')}}</p> -->
                            
                            <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="{{__('front.first_name')}}">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="{{__('front.last_name')}}">
                        </div>
                        
                        <div class="form-group">
                            <i class="fas fa-user icon"></i>
                            <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" placeholder="{{__('front.full_name')}}">
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
                            <i class="fa fa-phone icon"></i>
                            <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="{{__('front.phone')}}">
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
                         <div class="form-group">
                            <!--<i class="fas fa-user icon"></i>-->
                            <i class="fas fa-city icon"></i>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}" placeholder="{{__('front.city')}}">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-location-arrow fa-6 icon"></i>
                            <input type="text" class="form-control" name="state" value="{{ old('state') }}" placeholder="{{__('front.state')}}">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-street-view fa-6 icon"></i>
                            
                            <input type="text" class="form-control" name="street1" value="{{ old('street1') }}" placeholder="{{__('front.street1')}}">
                        </div>
                       
                         <div class="form-group">
                             
                             <i class="fas fa-map-pin fa-xl fa-fw icon"></i> 
                            <input type="number" class="form-control" name="postal_code" value="{{ old('postal_code') }}" placeholder="{{__('front.postal code')}}">
                        </div>
                        
                        <!--<div class="form-group">-->
                        <!--    <div class="form-check">-->
                        <!--      <input class="form-check-input"  type="radio" name="coursestype" id="flexRadioDefault4"  onchange="checkeCourse(this)" value="course">-->
                        <!--      <label class="form-check-label" for="flexRadioDefault4" style="font-weight: 400 !important;">-->
                        <!--       &nbsp;-->
                        <!--      الاشتراك في الدورات المسجلة-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--    @foreach ($subscription_type as $key=>$item)-->
                        <!--        @if($item->type =="عام دراسي")-->
                        <!--            <div class="form-check">-->
                        <!--                <input type="hidden" name="sub_curriculas" value="{{$item->value}}"> -->
                        <!--              <input class="form-check-input" type="radio" name="coursestype" id="flexRadioDefault3"  onchange="checkeCurriculas(this)" value="curriculums">-->
                        <!--              <label class="form-check-label" for="flexRadioDefault3" style="font-weight: 400 !important;">&nbsp;-->
                        <!--                الاشتراك بمواد التوجيهي للفصلين حتى نهاية العام الحالي بقيمة  -->
                        <!--                ({{$item->value}})-->
                        <!--                دولار-->
                        <!--              </label>-->
                        <!--            </div>-->
                        <!--        @endif-->
                        <!--    @endforeach-->
                        <!--    <div class="form-check">-->
                        <!--      <input class="form-check-input"  type="radio" name="coursestype" id="flexRadioDefault5"  onchange="checkeNormal(this)" value="normal">-->
                        <!--      <label class="form-check-label" for="flexRadioDefault5" style="font-weight: 400 !important;">-->
                        <!--       &nbsp;-->
                        <!--      انشاء حساب من أجل الاستفادة من الدورات الاونلاين والاستشارات-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--<div class="form-group subscription-course">-->
                        <!--    <p>بعد دفع قيمة الاشتراك سوف تستطيع مشاهدة جميع الدورات كاملة بأي وقت وبلا حدود وحسب فترة الاشتراك</p>-->
                        <!--    <p><strong>حدد فترة الاشتراك</strong></p>-->
                        <!--    <div class="form-check">-->
                        <!--                  <input class="form-check-input" type="radio" name="subtype" id="flexRadioDefault6"-->
                        <!--                    value="free">-->
                        <!--              <label class="form-check-label" for="flexRadioDefault6" style="font-weight: 400 !important;">&nbsp;-->
                        <!--               مجاناً  لمدة اسبوع-->
                        <!--              </label>-->
                        <!--            </div>-->
                            
                            
                            
                            
                        <!--    @foreach ($subscription_type as $key=>$item)-->
                        <!--        @if($item->type !="عام دراسي")-->
                        <!--            <div class="form-check">-->
                        <!--                  <input class="form-check-input" type="radio" name="subtype" id="flexRadioDefault{{$key+1}}"-->
                        <!--                  {{($key+1 == 1 ? ' checked' : '') }}  value="{{$item->type}}">-->
                        <!--              <label class="form-check-label" for="flexRadioDefault{{$key+1}}" style="font-weight: 400 !important;">&nbsp;-->
                                       
                        <!--                 {{$item->value}}-->
                        <!--                 دولار اشتراك  -->
                        <!--                 {{$item->type}}-->
                                         
                        <!--              </label>-->
                        <!--            </div>-->
                        <!--        @endif-->
                        <!--    @endforeach-->
                            <!--<div class="form-check">-->
                            <!--  <input class="form-check-input"  type="radio" name="subtype" id="flexRadioDefault2" value="{{$item->value}}">-->
                            <!--  <label class="form-check-label" for="flexRadioDefault{{$key+1}}">-->
                            <!--   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; اشتراك سنوي سبعين (70)دولار-->
                            <!--  </label>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--<div class="form-group subscription-curriculas">-->
                        <!--    <p>بعد دفع قيمة الاشتراك سوف تستطيع مشاهدة جميع الدورات كاملة بأي وقت وبلا حدود وحسب فترة الاشتراك</p>-->
                        <!--    <p><strong>حدد الفرع</strong></p>-->
                        <!--    @foreach ($branches as $key=>$branch)-->
                               
                        <!--            <div class="form-check">-->
                        <!--                <input class="form-check-input" type="radio" name="branch_id" id="flexRadioDefault{{$key+1}}"-->
                        <!--                  {{($key+1 == 1 ? ' checked' : '') }}  value="{{$branch->id}}">-->
                        <!--                <label class="form-check-label" for="flexRadioDefault{{$key+1}}" style="font-weight: 400 !important;">&nbsp;-->
                                       
                        <!--                فرع {{$branch->name}}    -->
                                         
                        <!--              </label>-->
                        <!--            </div>-->
                                
                        <!--    @endforeach-->
                        <!--</div>-->
                        <div class="form-group mt-4 mb-4">

                            <div class="row">
                                <p>بالضغط على زر التسجيل انت توافق علي <a href="{{url('policy')}}" style="color: #337ab7 !important"> سياسة الخصوصية</a> و<a href="{{url('student-policy')}}" style="color: #337ab7 !important"> شروط الاستخدام </a></p>
                            </div>
                        </div>


                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit"  >{{__('front.sign up')}}</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <p> {{__('home.hav acount')}} <a href="{{url('login/user')}}" class="main-color font-weight-bold">{{__('front.log in')}}</a>
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
                agreeError.innerHTML = "يجب الموافقة على إتفاقية الطالب ";
                return false;
            }
            agreeError.innerHTML = "";
            return true;
            
        }
    </script>
    
    <script>
        $('.subscription-course').hide(); 
        $('.subscription-curriculas').hide();
        function checkeCourse(element) {
            
            if(element.checked) {
                 console.log(element.value);
                 $('.subscription-course').show();
                 $('.subscription-curriculas').hide(); 
                // document.getElementById("flexRadioDefault4").checked = true;
            }else{
                $('.subscription-course').hide(); 
                // document.getElementById("flexRadioDefault4").checked = false;
                
                
            }
        }
        function checkeNormal(element) {
            if(element.checked) {
                 console.log(element.value);
                 $('.subscription-course').hide(); 
                 $('.subscription-curriculas').hide();
                // document.getElementById("flexRadioDefault4").checked = true;
            }else{
                $('.subscription-course').hide(); 
                // document.getElementById("flexRadioDefault4").checked = false;
            }
        }
        
        function checkeCurriculas(element) {
            
            if(element.checked) {
                console.log('checkeLive');
                $('.subscription-course').hide(); 
                $('.subscription-curriculas').show();
                // document.getElementById("agreem_checked").checked = true;
            }else{ 
                $('.subscription-curriculas').hide(); 
            }
        }
        
    </script>

@endsection




                        <!-- <div class="form-group mt-4 mb-4">
                            <div class="row">
                                <div class="col-10 pl-0" >
                                       <a href="#" class="main-color" onclick="show_all();" style="color: #337ab7 !important"> أوافق على اتفاقية المستخدم </a>  
                                </div>
                            </div>
                        </div> -->
                        <!-- <div class="modal-content" id="agreementshow" style="    display: none;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! $contact->agreements_student_ar !!}
                                بالضغط على زر التسجيل انت توافق علي شروط الاستخدام و سياسة الخصوصية
                                <p>بالضغط على زر التسجيل انت توافق علي <a href="{{url('policy')}}" style="color: blue"> سياسة الخصوصية</a> و شروط الاستخدام</p>
                                <div class="checkbox agree_inst">
                                    <input type="checkbox" id="agreeID" onchange="activateButton(this)"> 
                                    <label><span style="padding: 5px;color: blue">موافقة</span></label>
                                </div>
                            </div>
                        </div>
                        <span id="agreeError" style="color: red;"></span>
                        <br /> <br /> -->
                       <!-- 
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" onclick="return Validateallinput()" >{{__('front.sign up')}}</button> -->



<!--<div class="form-group">-->
                        <!--    <p>بعد دفع قيمة الاشتراك سوف تستطيع مشاهدة جميع الدورات كاملة بأي وقت وبلا حدود وحسب فترة الاشتراك</p>-->
                        <!--    <p><strong>حدد نوع الإشتراك</strong></p>-->
                        <!--    @foreach ($subscription_type as $key=>$item)-->
                        <!--    <div class="form-check">-->
                        <!--          <input class="form-check-input" type="radio" name="subtype" id="flexRadioDefault{{$key+1}}"-->
                        <!--          {{($key+1 == 1 ? ' checked' : '') }}  value="{{$item->value}}">-->
                        <!--      <label class="form-check-label" for="flexRadioDefault{{$key+1}}">&nbsp;-->
                        <!--        أشتراك -->
                        <!--        {{$item->type}}-->
                        <!--        {{$item->value}}-->
                        <!--         دولار-->
                        <!--      </label>-->
                        <!--    </div>-->
                        <!--    @endforeach-->
                        <!--</div>-->
