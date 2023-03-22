<!-- start navigation -->

<?php
        use App\Instructor;
        use App\Notification;
           $useridd = Auth::guard('instructors')->user();
            if($useridd){
                $count=0;
                $not=Notification::where('notifiable_id',$useridd->id)->get(); 
                foreach ($not as $item) {
                    if($item->read_at ==''){
                        $count +=1;
                    }else{
                        $count +=0;
                    }
                } 
        
                if($useridd){
        
                    $notifications= Instructor::with(array('unreadnotifications'=>function($query){
                            $useridd = Auth::guard('instructors')->user()->id;
                            $query->where('notifiable_id',$useridd);
                    }))->get();
                    view()->share('notifications', $notifications);
                }
            }
        
        ?>




    @php if(session()->get('locale')){ $langg=session()->get('locale'); }else{ $langg=app()->getLocale(); } @endphp @if($langg
    == 'ar')
    <style type="text/css">
    </style>
    @else @endif

    <?php 
                    $instructors=Auth::guard('instructors')->user();  
                ?> @if($instructors)
    <nav class="navbar navbar-default bootsnav navbar-top header-dark background-transparent white-link navbar-expand-lg">
        <div class="container nav-header-container">
            <!-- start logo -->
            <div class="col-auto pl-lg-0">
                <a href="{{url('/')}}" title="" class="logo">
                    <!-- <h1>Online Courses </h1> -->
                    <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">
                </a>
            </div>
            <!-- end logo -->
            <div class=" accordion-menu pr-2 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-start" id="navbar-collapse-toggle-1">
                    

                    <ul id="accordion" class="nav navbar-nav no-margin #course- text-normal">
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('/')}}"  >
                                <p style="    margin: 1px 0;color: #000;" >الرئيسية</p>
                            </a>
                        </li> 
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('about')}}"  >
                                <p style="    margin: 1px 0;color: #000;" >{{__('front.about us')}}</p>
                            </a>
                        </li>
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('contact')}}"  >
                                <p style="    margin: 1px 0;color: #000;" >{{__('front.contact us')}}</p>
                            </a>
                        </li>
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('consultings')}}"  >
                                <p style="    margin: 1px 0;color: #000;" >الاستشارات</p>
                            </a>
                        </li>
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('lives-courses')}}"  >
                                <p style="    margin: 1px 0;color: #000;" >{{__('front.live courses')}}</p>
                            </a>
                        </li>
                        
                        
                        
                        <li class="dropdown simple-dropdown">
                            <a href="/" class=" dropdown-toggle" data-toggle="dropdown" aria-hidden="true"> {{__('front.courses')}} </a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                           

                            <ul class="dropdown-menu " role="menu">
                                @foreach ($allcategories as $_item)
                                <li class="dropdown simple-dropdown main-course">
                                    <a class="dropdown-toggle" href="{{url('category/'.$_item->id)}}">
                                        {{$_item->title}} @if($langg == 'ar')
                                        <i class="fas fa-angle-left dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        @else
                                        <i class="fas fa-angle-right dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        @endif
                                    </a>

                                    <ul class="dropdown-menu sub-course" role="menu">
                                        @foreach ($_item->subcategorye as $sub)
                                        <li class="dropdown simple-dropdown">
                                            <a href="{{url('subcategory/'.$sub->id)}}">
                                                {{$sub->title}} 
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>

                                </li>
                                @endforeach

                            </ul>
                        </li>
                        <!--<div class="header-search-div d-lg-none d-md-block d-block">-->
                        <!--    <form method="get" action="{{url('searchcourse')}}" class="header-search">-->
                        <!--        <input placeholder="ابحث عن الدورات" class="header-search-input">-->
                        <!--        <button type="submit" class="header-search-submit">-->
                        <!--            <i class="fas fa-search"></i>-->
                        <!--        </button>-->
                        <!--    </form>-->
                        <!--</div>-->
                       
                        <!--<button class="btn btn-transparent " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"-->
                        <!--    aria-expanded="false">-->
                        <!--    @if($instructors->photo)-->
                                <!--<img src="{{asset('img/profiles/'.$instructors->photo) }}" alt=""> -->
                        <!--        <a class="dropdown-item" href="{{url('instructor/dashboard')}}">-->
                        <!--            لوحة التحكم-->
                        <!--        </a>-->
                        <!--    @else-->
                        <!--        <a class="dropdown-item" href="{{url('instructor/dashboard')}}">-->
                        <!--            لوحة التحكم    -->
                        <!--        </a>-->
                                <!--<img src="{{asset('img/profile_image.png') }}" class="profile-img">-->
                        <!--    @endif-->

                        <!--</button>-->
                       
                    </ul>

                    <!--<div class="header-search-div">-->

                    <!--    <form method="get" action="{{url('searchcourse')}}" class="header-search">-->
                    <!--        <input placeholder="ابحث عن الدورات" name="title" class="header-search-input">-->
                    <!--        <button type="submit" class="header-search-submit">-->
                    <!--            <i class="fas fa-search"></i>-->
                    <!--        </button>-->
                    <!--    </form>-->

                    <!--</div>-->


                </div>
            </div>
            <div class="col-auto d-flex home-index-div">
                <!--<a href="{{url('/')}}" class="home-icon d-lg-flex d-block mr-2 mt-2">-->
                <!--    <i class="fas fa-home"></i>-->
                <!--    <p class="btn btn-transparent mb-0">الرئيسية</p>-->
                    
                <!--</a>-->
                

                
                <div class="profile-menu  dashboard-menu-icon profile-menu-div-index">

                    <div class="dropdown">
                        <a class="dropdown-item" style="color: #16181b;
    text-decoration: none;
    background-color: #f8f9fa;" href="{{url('instructor/dashboard')}}">
                        <button class="btn btn-transparent " 
                            aria-expanded="false">
                                    لوحة التحكم
                        </button>
                        </a>
                        <!--<div class="dropdown-menu pb-0 " aria-labelledby="dropdownMenuButton">-->
                        <!--    <div class="pl-3 pr-3 pt-2 pb-1">-->
                        <!--    @if($instructors->photo)-->
                                <!--<img src="{{asset('img/profiles/'.$instructors->photo) }}" class="profile-img"> -->
                        <!--    @else-->
                                <!--<img src="{{asset('img/profile_image.png') }}" class="profile-img"> -->
                        <!--    @endif-->
                                <!--<span class="text-medium2 pl-2"> {{$instructors->name}} </span>-->

                        <!--    </div>-->
                            <!--<hr> -->
                        <!--    @if($instructors->type=="instructor")-->
                        <!--    <a class="dropdown-item" href="{{url('instructor/dashboard')}}">-->
                        <!--        <i class="fas fa-user pr-2"></i>&nbsp;{{__('front.instructor dashboard')}}-->
                        <!--    </a>-->
                        <!--    @else-->
                            <!--<a class="dropdown-item" href="{{url('my-wishlist')}}">-->
                            <!--    <i class="fas fa-heart padding-icon"></i>&nbsp;{{__('front.my wishlist')}}-->
                            <!--</a>-->
                        <!--    <a class="dropdown-item" href="{{url('my-profile')}}">-->
                        <!--        <i class="fas fa-user padding-icon"></i>&nbsp;{{__('front.instructor dashboard')}}-->
                        <!--    </a>-->
                        <!--    @endif-->

                        <!--    <div class=" bg-light text-center mt-2 pt-2 pb-2">-->
                        <!--        <a class="dropdown-item main-color font-weight-600 text-medium" href="{{ route('signoutinstructors') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">-->
                        <!--            <i class="fa fa-sign-out"></i>-->
                        <!--            {{__('front.logout')}}-->
                        <!--        </a>-->
                        <!--        <form id="logout-form" action="{{ route('signoutinstructors') }}" method="POST" class="d-none">-->
                        <!--            @csrf-->
                        <!--        </form>-->
                        <!--    </div>-->


                        <!--</div>-->
                    </div>

                </div>
                 @if($useridd->type == "student")
                <div class="notification dropdown d-lg-flex d-block">
                    <a class="dropdown-toggle mr-4  main-color text-extra-large" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="number">{{$count}}</span>
                    </a>
                    <div class="dropdown-menu pb-0 text-right" aria-labelledby="dropdownMenuButton">
                        <div class=" pb-1">
                            <span class="pl-2"> الإشعارات </span>
                            @foreach ($notifications as $_item) @foreach ($_item->unreadnotifications as $_items)
                            <div class="bg-light p-2">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{asset('img/profiles//'.$_item->photo) }}" class="img-fluid">
                                    </div>
                                    <div class="col-8 pl-0">
                                        <p class="text-small">
                                            {{$_items->data['title']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach @endforeach
                        </div>
                        <!-- <hr>
                                    <div class=" bg-light text-center pb-2">
                                        <a class="dropdown-item main-color font-weight-600 text-medium" href="#">
                                            Clear all
                                        </a>
                                    </div> -->
                    </div>
                </div>
                <!--<a href="{{url('my-wishlist')}}" class="wishlist-icon d-lg-flex d-block mr-2  main-color text-extra-large">-->
                <!--    <i class="far fa-heart"></i>-->
                <!--</a>-->
                @endif
                <!--<div class="profile-menu language-menu mt-1">-->

                <!--    <div class="dropdown">-->
                <!--        <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"-->
                <!--            aria-expanded="false" style="font-size: 12px">-->
                            <!-- <img src="{{asset('img/profiles/'.$instructors->photo) }}" alt=""> -->
                <!--            @switch($langg) @case('fr')-->
                <!--            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} @break @case('ar')-->
                <!--            <img src="{{asset('img/ar.png')}}" width="10px" height="10px"> {{__('home.ar')}} @break @default-->
                <!--            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} @endswitch-->
                <!--        </button>-->
                <!--        <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">-->
                <!--             <a class="dropdown-item" href="{{url('my-wishlist')}}">-->
                <!--                                <i class="fas fa-heart pr-2"></i> My Wishlist-->
                <!--                            </a> -->
                <!--            <a class="dropdown-item" href="{{url('lang/en')}}">-->
                <!--                <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}}-->
                <!--            </a>-->
                <!--            <a class="dropdown-item" href="{{url('lang/ar')}}">-->
                <!--                <img src="{{asset('img/ar.png')}}" width="10px" height="10x"> {{__('home.ar')}}-->
                <!--            </a>-->
                <!--        </div>-->
                <!--    </div>-->

                <!--</div>-->

                <div class="dark-mode-btn dark-mode-btn-login">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" class="label">
                        <i class="fas fa-moon"></i>
                        <i class='fas fa-sun'></i>
                        <div class='ball'>
                    </label>
                    </div>
                </div>
            </div>

    </nav>
    @else
    <nav class="navbar navbar-default bootsnav navbar-top header-dark background-transparent white-link navbar-expand-lg">
        <div class="container nav-header-container">
            <!-- start logo -->


          
            <div class="pl-lg-0">
                <a href="{{url('/')}}" title="" class="logo">
                    <!--  <h1>Online Courses</h1> -->
                    <img src="{{asset('assets_admin/img/settings/'.$contact->logo) }}" width="175px">
                </a>
            </div>
            <!-- end logo -->
 
            <div class=" accordion-menu pr-2 pr-md-3">
                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar-collapse-toggle-1">
                    <span class="sr-only">toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-start" id="navbar-collapse-toggle-1">
                    <ul id="accordion" class="nav navbar-nav no-margin #course- text-normal">
                        <li class="col-auto pl-lg-0">
                            <a href="{{url('lives-courses')}}"  >
                                <!--  <h1>Online Courses</h1> -->
                                <p style="    margin: 1px 0;color: #000;" >{{__('front.live courses')}}</p>
                            </a>
                        </li> 
                        
                        <li class="dropdown simple-dropdown">
                            <a href="/" class="dropdown-toggle" data-toggle="dropdown" aria-hidden="true">{{__('front.courses')}} </a>
                            <i class="fas fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                            <!-- start sub menu -->
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($allcategories as $_item)
                                <li class="dropdown simple-dropdown">
                                    <a class="dropdown-toggle"  href="{{url('category/'.$_item->id)}}">
                                        {{$_item->title}} @if($langg == 'ar')
                                        <i class="fas fa-angle-left dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        @else
                                        <i class="fas fa-angle-right dropdown-toggle" data-toggle="dropdown" aria-hidden="true"></i>
                                        @endif
                                    </a>
                                    @if(count($_item->subcategorye) != 0)
                                    <ul class="dropdown-menu" role="menu">
                                            
                                        @foreach ($_item->subcategorye as $sub)
                                        <li class="dropdown simple-dropdown">
                                            <a href="{{url('subcategory/'.$sub->id)}}">
                                                {{$sub->title}}
                                                <!--@if($langg == 'ar')-->
                                                <!--    <i class="fas fa-angle-left dropdown-toggle"-->
                                                <!--    data-toggle="dropdown" aria-hidden="true"></i>-->
                                                <!--@else-->
                                                <!--     <i class="fas fa-angle-right dropdown-toggle"-->
                                                <!--    data-toggle="dropdown" aria-hidden="true"></i>-->
                                                <!--@endif    -->
                                            </a>
                                            <!--@if(count($sub->childcategory) != 0)-->
                                            <!--<ul class="dropdown-menu" role="menu">-->
                                            <!--    @foreach ($sub->childcategory as $child)-->
                                            <!--    <li class="dropdown">-->
                                            <!--        <a class="dropdown-toggle" data-toggle="dropdown" href="{{url('childcategory/'.$_item->id)}}">-->
                                            <!--            {{$child->title}}</a>-->
                                            <!--    </li>-->
                                            <!--     @endforeach -->
                                            <!--</ul>-->
                                            <!--@endif-->

                                        </li>

                                        @endforeach

                                    </ul>@endif

                                </li>
                                @endforeach

                            </ul>
                        </li>

                        <li class="d-lg-none d-md-block d-block">
                            <a href="{{url('register-users')}}">
                                <i class="fas fa-user pr-1 pt-2"></i> {{__('front.sign up')}}</a>
                        </li>

                        <li class="d-lg-none d-md-block d-block">
                            <a href="{{url('login/user')}}">
                                <i class="fas fa-sign-in-alt pr-1 pt-2"></i> {{__('front.log in')}}</a>
                        </li>

                        <div class="header-search-div d-lg-none d-md-block d-block">
                            <form method="get" action="{{url('searchcourse')}}" class="header-search">
                                <input placeholder=" ابحث عن الدورات المسجلة " class="header-search-input">
                                <button type="submit" class="header-search-submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- <a href="#" class="btn header-btn  d-lg-none d-md-block d-block">Subscribe</a> -->

                    </ul>

                    <div class="header-search-div">

                        <form method="get" action="{{url('searchcourse')}}" class="header-search">
                            <input placeholder=" ابحث عن الدورات المسجلة " class="header-search-input">
                            <button type="submit" class="header-search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                    </div>


                </div>
            </div>
            <div class="col-auto pr-lg-0 d-flex mb-2">
                <a href="{{url('/')}}" class="d-flex mr-2 mt-3 main-color text-extra-large">
                    <i class="fas fa-home"></i>
                </a>
                <a href="{{url('register-users')}}" class="btn header-btn2 mr-2"> {{__('front.sign up')}}</a>

                <a href="{{url('login/user')}}" class="btn header-btn2 mr-2">{{__('front.log in')}}</a>
                <div class="profile-menu mt-1">

                    <div class="dropdown">
                        <button class="btn btn-transparent dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" style="font-size: 12px">
                            @switch($langg) @case('fr')
                            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} @break @case('ar')
                            <img src="{{asset('img/ar.png')}}" width="10px" height="10px"> {{__('home.ar')}} @break @default
                            <img src="{{asset('img/en.png')}}" width="10px" height="10px"> {{__('home.en')}} @endswitch
                        </button>
                        <div class="dropdown-menu pb-0" aria-labelledby="dropdownMenuButton">
                            <!-- <a class="dropdown-item" href="{{url('my-wishlist')}}">
                                                    <i class="fas fa-heart pr-2"></i> My Wishlist
                                                </a> -->
                            <a class="dropdown-item" href="{{url('lang/en')}}">
                                <img src="{{asset('img/en.png')}}" width="10px" height="10px"> - {{__('home.en')}}
                            </a>
                            <a class="dropdown-item" href="{{url('lang/ar')}}">
                                <img src="{{asset('img/ar.png')}}" width="10px" height="10x"> - {{__('home.ar')}}
                            </a>
                        </div>
                    </div>

                </div>

                <div class="dark-mode-btn">
                    <input type="checkbox" class="checkbox" id="checkbox">
                    <label for="checkbox" class="label">
                        <i class="fas fa-moon"></i>
                        <i class='fas fa-sun'></i>
                        <div class='ball'>
                    </label>
                    </div>

                </div>

                <!--// Dark Mode-->





                <!-- <a href="#" class="btn header-btn">Subscribe</a> -->


            </div>


    </nav>
    @endif

    <!-- end navigation -->


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