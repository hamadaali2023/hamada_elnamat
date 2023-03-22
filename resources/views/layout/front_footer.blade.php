 <!-- start footer -->

    <!--<footer class="footer-classic-dark bg-white pb-3 pt-3 mt-5">-->


    <!--    <div class="footer-widget-area">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
                    <!-- start about -->
    <!--                <div class="col-lg-4 col-md-6 widget">-->
    <!--                    <a href="{{url('/')}}" title="" class="logo">-->
    <!--                        <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">-->
    <!--                    </a>-->
    <!--                    <p>-->
    <!--                        @if($langg == 'ar')-->
    <!--                            {!! Str::limit($contact->description_ar, 260 ) !!}-->
    <!--                        @else-->
    <!--                             {!! Str::limit($contact->description_en,260 ) !!}-->
    <!--                        @endif-->
    <!--                    </p>-->
                        
    <!--                    <form action="{{route('search-certificate')}}" method="get" name="le_form"  enctype="multipart/form-data">-->
    <!--                        @csrf    -->
    <!--                        <div class="row">-->
    <!--                            <label> &nbsp;&nbsp; التأكد من صحة الشهادة</label>-->
    <!--                            <div class="col-md-9">-->
    <!--                                <div class="form-group">-->
    <!--                                    <input  name="serial_number" type="text" class="form-control" placeholder="أدخل رقم الشهادة" required>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-md-3">-->
    <!--                                <div class="form-group">-->
    <!--                                    <button type="submit" class="w-100 btn header-btn text-large font-weight-bold" style="line-height: 14px;">بحث</button>-->
    <!--                                </div>-->
    <!--                            </div>-->
                                
    <!--                        </div>-->
                            
    <!--                    </form>-->
    <!--                    @if (session('message'))-->
    <!--			            <div class="alert alert-success">-->
    <!--			                {{ session('message') }}-->
    <!--			            </div>-->
    <!--			        @endif-->
    			       
    <!--			        @if(Session::has('errorss'))   -->
    <!--                         <div class="alert alert-danger mb-2" role="alert">-->
    <!--							{{Session::get('errorss')}}-->
    <!--						</div>-->
    <!--                    @endif -->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
    <!--                </div>-->
                    <!-- end about -->
                   
    <!--                <div class="col-lg-5 offset-lg-1 col-md-6 widget">-->
    <!--                    <div class="widget-title">-->
                            <!-- {{__('front.menu')}} -->
    <!--                    </div>-->
    <!--                    <div class="row">-->
    <!--                        <div class="col-6">-->
    <!--                            <a href="{{url('about')}}" class="d-block mt-3">{{__('front.about us')}}</a>-->
    <!--                            <a href="{{url('contact')}}" class="d-block mt-3">{{__('front.contact us')}}</a>-->
    <!--                             <a href="{{url('instructor-signup')}}" class="d-block mt-3" style=" ">{{__('front.Join us trainers team')}}</a>-->
                                 <!--<a href="{{url('terms/conditions')}}" class="d-block mt-3">{{__('front.all-instructor')}}</a>-->
    <!--                             <a href="{{url('all-instructor')}}" class="d-block mt-3">{{__('front.all-instructor')}}</a>-->
    <!--                        </div>-->
    <!--                        <div class="col-6">-->
    <!--                            <a href="{{url('student-policy')}}" class="d-block mt-3">شروط المستخدم</a>-->
    <!--                            <a href="{{url('policy')}}" class="d-block mt-3">{{__('front.privacy policy')}}</a>-->
    <!--                            <a href="{{url('return-policy')}}" class="d-block mt-3">{{__('front.return policy')}}</a>-->
    <!--                            <a href="{{url('cancellation-policy')}}" class="d-block mt-3">{{__('front.cancellation policy')}}</a>-->
    <!--                            <a href="{{url('delivery-policy')}}" class="d-block mt-3">{{__('front.delivery policy')}}</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="col-lg-2 col-md-6 widget mt-5">-->
                        <!-- Default dropup button -->
                        <!-- <div class="btn-group dropup">
    <!--                        <button type="button" class="btn header-btn dropdown-toggle" data-toggle="dropdown"-->
    <!--                            aria-haspopup="true" aria-expanded="false">-->
    <!--                            {{__('front.language')}}-->
    <!--                        </button>-->
    <!--                        <div class="dropdown-menu p-2">-->
    <!--                            <p> <a href="{{url('lang/ar')}}" class="text-dark">{{__('home.ar')}} </a></p>-->
    <!--                            <p><a href="{{url('lang/en')}}" class="text-dark">{{__('home.en')}}</a></p>-->
    <!--                        </div><br>-->


    <!--                    </div> -->
    <!--                    <p>طرق الدفع</p>-->
                       
    <!--                    <div class="btn-group dropup" style="height: 40px !important;width: 148px;">-->
    <!--                        <img src="{{asset('assets_admin/img/settings/visa.jpg') }}" >&nbsp;&nbsp;-->
                            
    <!--                         <img src="{{asset('assets_admin/img/settings/master.jpg') }}" >-->
    <!--                    </div><br><br>-->
    <!--                    <p>تواصل إجتماعي</p>-->
                       
    <!--                    <div class="btn-group dropup" style="height: 30px !important;width: 168px;">-->
    <!--                        <a href="https://web.facebook.com/alnamattadreeb" target="_blank">-->
    <!--                        <img src="{{asset('assets_admin/img/settings/facebooke.jpeg') }}" width="32px" height="32px">&nbsp;&nbsp;&nbsp; -->
    <!--                        </a>-->
                            
    <!--                        <a href="https://www.youtube.com/channel/UC8CCovqjLOIM7isHyCmBYHQ" target="_blank">-->
    <!--                        <img src="{{asset('assets_admin/img/settings/youtube.png') }}" width="32px" height="32px">&nbsp;&nbsp;&nbsp; -->
    <!--                        </a>-->
                            
    <!--                        <img src="{{asset('assets_admin/img/settings/instgram.jpeg') }}" width="35px" height="35px">&nbsp;&nbsp;&nbsp;-->
                             
    <!--                        <a href="https://twitter.com/elnamat7" target="_blank">-->
    <!--                            <img src="{{asset('assets_admin/img/settings/twitter.png') }}" width="30px" height="30px">&nbsp;&nbsp;&nbsp;-->
    <!--                        </a>-->
                             
    <!--                        <a href="https://wa.me/+962795144553?text=%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85,%20%D8%B4%D8%A7%D9%87%D8%AF%D8%AA%20%D8%A7%D8%B9%D9%84%D8%A7%D9%86%20%D8%B9%D9%86%20%D9%85%D9%86%D8%B5%D8%A9%20%D8%A7%D9%84%D9%86%D9%85%D8%B7%20%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8%20%D8%A7%D9%88%D9%86%D9%84%D8%A7%D9%8A%D9%86%20%D8%8C%20%D8%A3%D8%B1%D9%8A%D8%AF%20%D9%85%D8%B9%D8%B1%D9%81%D8%A9%20%D8%A7%D9%84%D8%AA%D9%81%D8%A7%D8%B5%D9%8A%D9%84%20....." target="_blank">-->
    <!--                            <img src="{{asset('assets_admin/img/settings/whatsapp.jpeg') }}" width="35px" height="35px">-->
    <!--                        </a>-->
                             
    <!--                    </div><br><br>-->
                        <!--<div class="btn-group dropup" style="height: 40px !important;width: 148px;">-->
                        <!--      <img src="{{asset('assets_admin/img/settings/paypal.jpg') }}" >&nbsp;&nbsp;-->
                        <!--     <img src="{{asset('assets_admin/img/settings/american.jpg') }}">-->
                             
                        <!--</div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <div  class="container" style="text-align: center;padding-top: 15px;">-->
    <!--            <p>Copyright © 2022 by elnamat.com  All right reserved</p></div>-->
    <!--    </div>-->
        
    <!--    </div>-->


    <!--</footer>-->

    
    
     <footer class="footer-classic-dark bg-white pb-3 pt-3 mt-5">


        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <!-- start about -->
                    <div class="col-lg-4 col-md-6 widget">
                        <a href="{{url('/')}}" title="" class="logo">
                            <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">
                        </a>
                        <p>
                            @if($langg == 'ar')
                                {!! Str::limit($contact->description_ar, 95 ) !!}
                            @else
                                 {!! Str::limit($contact->description_en,100 ) !!}
                            @endif
                        </p>
                        
                        <!--<a href="#" data-toggle="modal" data-target="#exampleModal" class="btn header-btn font-weight-bold mb-4" >قراءة المزيد</a>-->
                        
                         <!-- Modal -->
                         <div class="team-section m-0">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                
                                        <div class="row">
                
                
                                            <div class="col-md-12">
                
                                                <div class="instructor-info">
                                                    <h4 class="team-title">
                                                        Dr. Hussni Al-Mestarihi
                                                    </h4>
                                                    <div class="team-department">
                                                        <ul>
                                                            <li>
                                                                Researcher & Intsructor in Human Development and Mental Health
                                                            </li>
                                                            <li>
                                                                University Professor
                                                            </li>
                                                            <li>
                                                                Chairman of the board of directors
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                
                
                                            </div>
                
                                        </div>
                
                                    </div>
                
                                </div>
                            </div>
                        </div>
                        </div>

                        
                        
                        <form action="#" method="get"  enctype="multipart/form-data">
                            <div class="row text-dark">
                                <!--<div class="col-12">-->
                                <!--      <b>خدماتنا للمتدرب  </b>  -->
                                <!--</div>-->
                                <div class="col-12">
                                    <label>التأكد من صحة الشهادة</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input  type="text" class="form-control" placeholder="أدخل رقم الشهادة" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn header-btn font-weight-bold" style="line-height: 14px;">بحث</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                        
                        
                    </div>
                    <!-- end about -->
                   
                    <div class="col-lg-5 offset-lg-1 col-md-6 widget">
                        
                        <div class="row">
                            <div class="col-6">
                                <a href="{{url('about')}}" class="d-block mt-3">{{__('front.about us')}}</a>
                                <a href="{{url('contact')}}" class="d-block mt-3">{{__('front.contact us')}}</a>
                                 <a href="{{url('instructor-signup')}}" class="d-block mt-3" style=" ">{{__('front.Join us trainers team')}}</a>
                                 <a href="{{url('all-teacher')}}" class="d-block mt-3" style=" ">معلمين التوجيهي</a>
                                 
                                 <a href="{{url('all-instructor')}}" class="d-block mt-3">{{__('front.all-instructor')}}</a>
                                 
                                
                                 
                                
                                
                                
                                
                                 
                                 
                            </div>
                            <div class="col-6">
                                <a href="{{url('student-policy')}}" class="d-block mt-3">شروط المستخدم</a>
                                <a href="{{url('policy')}}" class="d-block mt-3">{{__('front.privacy policy')}}</a>
                                <a href="{{url('return-policy')}}" class="d-block mt-3">{{__('front.return policy')}}</a>
                                <a href="{{url('cancellation-policy')}}" class="d-block mt-3">{{__('front.cancellation policy')}}</a>
                                <a href="{{url('delivery-policy')}}" class="d-block mt-3">{{__('front.delivery policy')}}</a>
                                <div class="profile-menu language-menu mt-1">
                                    <div class="dropdown">
                                        <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="font-size: 12px">
                
                                            @switch($langg) @case('fr')
                                                <!--<img src="{{asset('img/en.png')}}" width="10px" height="10px">-->
                                                {{__('home.en')}} 
                                            @break @case('ar')
                                                <!--<img src="{{asset('img/ar.png')}}" width="10px" height="10px">-->
                                                {{__('home.ar')}} 
                                            @break @default
                                                <!--<img src="{{asset('img/en.png')}}" width="10px" height="10px"> -->
                                                {{__('home.en')}} 
                                            @endswitch
                                        </button>
                                        <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                                            
                                            <a class="dropdown-item" href="{{url('lang/en')}}">
                                                <img src="{{asset('img/en.png')}}" width="10px" height="10px">
                                                {{__('home.en')}}
                                            </a>
                                            <a class="dropdown-item" href="{{url('lang/ar')}}">
                                                <img src="{{asset('img/ar.png')}}" width="10px" height="10x"> {{__('home.ar')}}
                                            </a>
                                        </div>
                                    </div>
                                </div> 
                                 <div class="dark-mode-btn dark-mode-btn-login d-md-flex mb-2 d-none">
                                    <input type="checkbox" class="checkbox" id="checkbox">
                                    <label for="checkbox" class="label">
                                        <i class="fas fa-moon"></i>
                                        <i class='fas fa-sun'></i>
                                        <div class='ball'>
                                    </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 widget">
                        
                        <p><b>
                            طرق الدفع
                            </b></p>
                       
                        <div class="btn-group dropup" style="height: 40px !important;width: 148px;">
                            <img src="{{asset('assets_admin/img/settings/visa.jpg') }}" >&nbsp;&nbsp;
                            <img src="{{asset('assets_admin/img/settings/master.jpg') }}" >
                            <img src="{{asset('assets_admin/img/settings/paypal.png') }}" style="height: 30px; width:80px;">
                        </div><br><br>
                        <p>تواصل إجتماعي</p>
                       
                        <div class="btn-group dropup" style="height: 30px !important;width: 168px;">
                            <a href="https://web.facebook.com/alnamattadreeb" target="_blank">
                            <img src="{{asset('assets_admin/img/settings/facebooke.jpeg') }}" width="32px" height="32px">&nbsp;&nbsp;&nbsp; 
                            </a>
                            
                            <a href="https://www.youtube.com/channel/UC8CCovqjLOIM7isHyCmBYHQ" target="_blank">
                            <img src="{{asset('assets_admin/img/settings/youtube.png') }}" width="32px" height="32px">&nbsp;&nbsp;&nbsp; 
                            </a>
                            
                            <img src="{{asset('assets_admin/img/settings/instgram.jpeg') }}" width="35px" height="35px">&nbsp;&nbsp;&nbsp;
                             
                            <a href="https://twitter.com/elnamat7" target="_blank">
                                <img src="{{asset('assets_admin/img/settings/twitter.png') }}" width="30px" height="30px">&nbsp;&nbsp;&nbsp;
                            </a>
                             
                            <a href="https://wa.me/+962795144553?text=%D8%A7%D9%84%D8%B3%D9%84%D8%A7%D9%85%20%D8%B9%D9%84%D9%8A%D9%83%D9%85,%20%D8%B4%D8%A7%D9%87%D8%AF%D8%AA%20%D8%A7%D8%B9%D9%84%D8%A7%D9%86%20%D8%B9%D9%86%20%D9%85%D9%86%D8%B5%D8%A9%20%D8%A7%D9%84%D9%86%D9%85%D8%B7%20%D9%84%D9%84%D8%AA%D8%AF%D8%B1%D9%8A%D8%A8%20%D8%A7%D9%88%D9%86%D9%84%D8%A7%D9%8A%D9%86%20%D8%8C%20%D8%A3%D8%B1%D9%8A%D8%AF%20%D9%85%D8%B9%D8%B1%D9%81%D8%A9%20%D8%A7%D9%84%D8%AA%D9%81%D8%A7%D8%B5%D9%8A%D9%84%20....." target="_blank">
                                <img src="{{asset('assets_admin/img/settings/whatsapp.jpeg') }}" width="35px" height="35px">
                            </a>
                             
                        </div><br><br>
                        
                        <!--<div class="btn-group dropup" style="height: 40px !important;width: 148px;">-->
                        <!--      <img src="{{asset('assets_admin/img/settings/paypal.jpg') }}" >&nbsp;&nbsp;-->
                        <!--     <img src="{{asset('assets_admin/img/settings/american.jpg') }}">-->
                             
                        <!--</div>-->
                </div>

            </div>
            <div  class="container" style="text-align: center;padding-top: 15px;">
                <p>Copyright © 2022 by elnamat.com  All right reserved</p></div>
        </div>
        
        </div>


    </footer>
     <script>




        const checkbox = document.getElementById('checkbox');

        var dark_mode_checked = sessionStorage.getItem('dark-mode-check');
        document.body.classList.toggle(dark_mode_checked);

        checkbox.addEventListener('change', () => {
            document.body.classList.toggle('dark-mode');
            var checkboxDarkmod = document.getElementById("checkbox");
            if (checkboxDarkmod.checked) {
                sessionStorage.setItem('dark-mode-check', 'dark-mode');
                document.body.classList.toggle(dark_mode_checked);


            } else {
                sessionStorage.setItem('dark-mode-check', 'notdarkmode');
                document.body.classList.toggle('dark-modeeeeee');

            }

        })
    </script>

    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="fas fa-arrow-up"></i></a>
    <!-- javascript libraries -->
    <script type="text/javascript" src="{{asset('front/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/bootstrap.bundle.js')}}"></script>
    <!-- menu navigation -->
    <script type="text/javascript" src="{{asset('front/js/bootsnav.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/jquery.nav.js')}}"></script>
    <!-- magnific-popup -->
    <script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- swiper carousel -->
    <script type="text/javascript" src="{{asset('front/js/swiper.min.js')}}"></script>
    <!-- main slider -->
    <script src="{{asset('front/js/slider.js')}}"></script>

    <!-- Data table -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    <!-- setting -->
    







     <!-- Data Tables -->
     <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
 

<script type="text/javascript" src="{{asset('front/js/main.js')}}"></script>








