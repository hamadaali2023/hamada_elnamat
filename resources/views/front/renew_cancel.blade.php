@extends('layout.front_main')
@section('content') 

    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">

                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">

                         <p class="text-bold-500 text-dark text-extra-large mb-2 mt-3">
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
    <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">

        <section class="form-section form-section-edit mt-0 pt-0" style="text-align: right;">
            <div class="container">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                 @if(Session::has('errorss'))   
                    <div class="alert alert-danger mb-2" role="alert">
    					{{Session::get('errorss')}}
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
                        
                <div class="row justify-content-center">
                   
                
                
                
                
                
                <div class="col-12 col-md-9">
                    <h6>
                        {{__('front.pay sub or renew sub')}}
                    </h6>
                    <hr>
                    <div class="row mb-3  mr-2">   
                        <ul>
                             @if($user->status =="1")
                                 <li><p> تم الإشتراك بالفعل اشتراكك جاري حتى تاريخ :
                                    @if($user->subscription_type=="شهري")
                                        {{$transaction->created_at->addMonth(1)->format('d-m-Y')}}
                                    @elseif($user->subscription_type=="free")
                                        {{$user->created_at->addDay(1)->format('d-m-Y')}}
                                    @else
                                        {{$transaction->created_at->addYear(1)->format('d-m-Y')}}    
                                    @endif
                                 </p></li>
                            @else
                                <li><p> عزيزي المتدرب تستطيع تجديد الاشتراك أو عمل اشتراك جديد من أجل مشاهدة جميع الدورات المنشورة على المنصة والدورات التي تضاف خلال فترة الاشتراك، ويمكنك الحصول على شهادات تدريب للدورات التي تتم مشاهدتها ضمن رسوم اضافية </p></li>
                                <form method="POST" action="{{route('renew-subscrip')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type" value="student">      
                                    <div class="form-group">
                                        <p>بعد دفع قيمة الاشتراك سوف تستطيع مشاهدة جميع الدورات كاملة بأي وقت وبلا حدود وحسب فترة الاشتراك</p>
                                        <p><strong>حدد نوع الإشتراك</strong></p>
                                        @foreach ($subscription_type as $key=>$item)
                                            @if($item->type !="عام دراسي")
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="subtype" id="flexRadioDefault{{$key+1}}"
                                                    {{($item->type == $user->subscription_type ? ' checked' : '') }}  value="{{$item->type}}">
                                                    <label class="form-check-label" for="flexRadioDefault{{$key+1}}">&nbsp;
                                                    <!--أشتراك -->
                                                    <!--{{$item->type}}-->
                                                    <!--{{$item->value}}-->
                                                    <!-- دولار-->
                                                    
                                                      {{$item->value}}
                                                      دولار اشتراك  
                                                      {{$item->type}}
                                     
                                              </label>
                                            </div>
                                             @endif
                                        @endforeach
                                    </div>
                                    <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit"  >{{__('front.next')}}</button>
                                </form>
                            @endif            
                        </ul>  
                    </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                        

            </div>
        </section>




        

    </main>
    </div>
    </div>
</section>
 <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- end login -->

@endsection