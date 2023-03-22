@extends('layout.front_main')
@section('content') 
    <link rel="stylesheet" href="{{asset('front/css/search.css')}}" />
<section class="courses-banner" >
    <div class="container">
        <div class="row">
            <form method="GET"  action="{{url('get-search-course')}}" >
                <fieldset>
                    <legend>الدورات المسجلة</legend>
                </fieldset>
                <div class="inner-form ">
                    <div class="select">
                         <select name="categoryId" id="get_sub_category_name">
                            <option selected disabled>التخصصات</option>
                            @foreach ($categories as $_item) 
                            <option value="{{$_item->id}}">{{$_item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="select">
                         <select name="subCategoryId" id="get_sub_category">
                            <option selected disabled>التخصصات الفرعية</option>
                            
                        </select>
                    </div>
                    <button type="submit">بحث</button>
                </div>
            </form>
        </div>
    </div>
</section>
    
        <!--<div class="row">-->
        <!--    <div class="col-12">-->
        <!--        <br><br>-->
        <!--        <h6 class="text-extra-dark-gray  title-bg">-->
        <!--            <center>-->
        <!--                للاشتراك في الدورات المسجلة-->
        <!--                @if($user)-->
        <!--                    <a href="{{url('renew_cancel')}}" style="color:#263e8d">اضغط هنا</a>-->
        <!--                @else-->
        <!--                      <a href="{{url('login/user')}}" style="color:#263e8d">اضغط هنا</a>-->
        <!--                @endif-->
        <!--            </center>-->
        <!--        </h6>-->
                
        <!--    </div>-->
        <!--</div> -->
    <marquee scrollamount="12" direction="right">
        <h1>   
            @foreach ($marquees as $marquee) 
                <font face="Andalus" size="3" style="color: #132972;
    font-family: Tajawal, sans-serif !important;
    font-weight: 600;">{{$marquee->name}}
                    </font>&nbsp;&nbsp;        
            @endforeach
            
        <h1/>
        
    </marquee>
    
    <!--@if(!$user)-->
    <!--    <div class="row">-->
    <!--        <div class="col-12">-->
    <!--            <br><br>-->
    <!--            <h6 class="text-extra-dark-gray  title-bg">-->
    <!--                <center>-->
    <!--                للاشتراك في الدورات المسجلة-->
    <!--                    <a href="{{url('login/user')}}" style="color:#263e8d">اضغط هنا</a>-->
                   
    <!--                </center>-->
    <!--            </h6>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--@elseif($user->type=="student") -->
    <!--    @if($user->status!=1) -->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <br><br>-->
    <!--                <h6 class="text-extra-dark-gray  title-bg">-->
    <!--                    <center>-->
    <!--                   للاشتراك في الدورات المسجلة-->
    <!--                        <a href="{{url('renew_cancel')}}" style="color:#263e8d">اضغط هنا</a>-->
    <!--                    </center>-->
    <!--                </h6>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    @endif    -->
    <!--@else-->
    
    <!--@endif-->
    
    
    <section class="featured-courses" style="padding: 20px 0px 0px 0px !important;">
        <div class="container">
            <!-- <div class="row">
                <div class="col-12">
                    <h6 class="text-extra-dark-gray font-weight-600 title-bg">
                         {{__('front.recently added courses')}}
                    </h6>

                </div>
            </div> -->


            <div class="row tab-style2 mt-2">
                <div class="col-12 p-0">
                    <!-- start tab navigation -->
                    <ul class="nav nav-tabs  text-uppercase text-small text-center font-weight-600 justify-content-center">
                        @foreach ($categories as $_item)
                        <li class="nav-item">
                            <a class="nav-link " href="#category{{$_item->title}}" data-toggle="tab" id="{{$_item->id}}" id="{{$_item->id}}" onClick="getcourses(this.id)">
                            {{$_item->title}}</a>
                        </li>
                        @endforeach 
                    </ul>
                    <!-- end tab navigation -->
                </div>
            </div>

            <div class="mt-4">
                <div class="tab-content">                    
                    <!-- start tab content -->
                    <div class="tab-pane med-text fade in active show" id="tab_sec1">
                        <div class="row featured-courses" id="courses">
                            
                            <!-- @foreach ($courses as $_item)
                            <!--    <div class="col-12 col-lg-3 col-md-6">-->
                            <!--        <a href="{{url('courses/'.$_item->slug)}}">-->
                            <!--            <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">-->
                            <!--        </a>-->
                            <!--        <a href="{{url('courses/'.$_item->slug)}}">-->
                            <!--            <div class="bg-light">-->
                            <!--                <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>-->
                            <!--                <div class="featured-date mb-2">-->
                            <!--                    <i class="fas fa-calendar-alt"></i>-->
                            <!--                    <span> {{$_item->date}} </span>-->
                            <!--                </div>-->
                            <!--                <div class="featured-date mb-2">-->
                            <!--                    <i class="fas fa-clock"></i>-->
                            <!--                    <span>{{$_item->duration}}  {{__('front.hours')}}</span>-->
                            <!--                </div>-->
                            <!--                <div>-->
                            <!--                    <span class="fa fa-star checked"></span>-->
                            <!--                    <span class="fa fa-star checked"></span>-->
                            <!--                    <span class="fa fa-star checked"></span>-->
                            <!--                    <span class="fa fa-star"></span>-->
                            <!--                    <span class="fa fa-star"></span>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        </a>-->
                            <!--    </div>-->
                            <!--@endforeach -->
                        </div>
                        <!-- <div class="row justify-content-center">
                            <a href="#" class="btn header-btn">View more</a>
                        </div> -->
                    </div><br>
                    <!-- end tab content -->
                </div>
            </div>
        </div>
    </section>
@if($user)   
@if($user->type=="student")
    <section class="featured-courses" style="padding: 20px 0px 0px 0px !important;" >
        <div class="container">
            @if(count($lastcourses) >0)  
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        الاستمرار  بمشاهدة الدورات الغير مكتمله 
                    </h6>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">
                        @foreach ($lastcourses as $_item)
                            <div class="swiper-slide">
                                <div class="featured-courses featured-courses-home">
                                    <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">
                                        <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">
                                    </a>
                                        <div class="bg-light">
                                            <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">
                                                <p class="text-dark font-weight-bold mb-2">  {{ $_item->title }}</p>
                                            </a>
                                            <div class="featured-date mb-2">
                                                <i class="fas fa-calendar-alt"></i>
                                                المدرب:<span>{{$_item->instructor->name}}</span>
                                            </div>
                                            <div class="featured-date mb-2">
                                                <!-- <i class="fas fa-money-bill-alt"></i> -->
                                                <!-- <span>{{$_item->duration}} {{__('front.hours')}}</span> -->
                                            </div>
                                            
                                            <div class="row">
                                                
                                                <div class="col-6">
                                                    
                                                     <div class="mb-2">
                                                @if($_item->rate >4)
                                                    @for ($i = 0; $i < $_item->rate; $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor 
                                                @elseif($_item->rate >3)
                                                    @for ($i = 0; $i < $_item->rate; $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor
                                                    <span class="fa fa-star"></span>  
                                                @elseif($_item->rate >2)
                                                    @for ($i = 0; $i < $_item->rate; $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                   
                                                @elseif($_item->rate >1)
                                                    @for ($i = 0; $i < $_item->rate; $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>  
                                                @elseif($_item->rate >0)
                                                    @for ($i = 0; $i < $_item->rate; $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>   
                                                @elseif($_item->rate ==0)
                                                    <span class="fa fa-star"></span>  
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>              
                                                @endif
                                            </div>
                                                    
                                                </div>
                                                
                                                <div class="col-6">
                                                     
                                             <div class="featured-buttons mb-4">
                                                @if($_item->check_last != null)
                                                    <form action="{{route('remove-contenue-watch')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="last_watch_id" value="{{$_item->check_last->id}}"> 
                                                        <button type="submit">
                                                            <a href="#" class="clear-icon"><i class="fas fa-times"></i></a>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{route('user.addfavorite')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="courseId" value="{{$_item->id}}"> 
                                                    <button type="submit">
                                                        @if($_item->user_favorite == 'true')
                                                            <i class="fas fa-heart pr-2"></i>
                                                        @else            
                                                           <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>
                                                        @endif
                                                    </button>
                                                </form>
                                                <!--<a href="#" class="clear-icon"><i class="fas fa-times"></i></a>-->
                                                <!--<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                                <!--<a href="#" class="share-icon"><i class="fas fa-share"></i></a>-->
                                            </div>
                                            
                                                    
                                                </div>
                                                
                                            </div>
    
                                           
                                           
                                        </div>
                                    
                                    <!-- end features box item -->
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section>
@endif
@endif


@if($user) 
@if($user->type=="student")
    <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                       الدورات المفضلة 
                    </h6>
                </div>
            </div>
            <div class="row">
                <div class="swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">
                         @foreach ($favorites as $_item)
                        <div class="swiper-slide">
                            <div class="featured-courses featured-courses-home">
                                <a href="{{url('courses/'.$_item->course->slug.'/'.$_item->course->id)}}">
                                    <img src="{{asset('assets_admin/img/courses/'.$_item->course->image) }}" class="img-fluid">
                                </a>
                                    <div class="bg-light">
                                        <a href="{{url('courses/'.$_item->course->slug.'/'.$_item->course->id)}}">
                                            <p class="text-dark font-weight-bold mb-2">  {{ $_item->course->title }}</p>
                                        </a>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->course->instructor->name}}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                            <!-- <i class="fas fa-money-bill-alt"></i> -->
                                            <!-- <span>{{$_item->duration}} {{__('front.hours')}}</span> -->
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-6">
                                                 <div class="mb-2">
                                            @if($_item->course->rate >4)
                                                @for ($i = 0; $i < $_item->course->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor 
                                            @elseif($_item->course->rate >3)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>  
                                            @elseif($_item->course->rate >2)
                                                @for ($i = 0; $i < $_item->course->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                               
                                            @elseif($_item->course->rate >1)
                                                @for ($i = 0; $i < $_item->course->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>  
                                            @elseif($_item->course->rate >0)
                                                @for ($i = 0; $i < $_item->course->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>   
                                            @elseif($_item->course->rate ==0)
                                                <span class="fa fa-star"></span>  
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>              
                                            @endif
                                        </div>
                                                
                                            </div>
                                            
                                            <div class="col-6">
                                                 
                                         <div class="featured-buttons mb-4">
                                           
                                            <form action="{{route('user.addfavorite')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="courseId" value="{{$_item->course->id}}"> 
                                                <button type="submit">
                                                    @if($_item->user_favorite == 'true')
                                                        <i class="fas fa-heart pr-2"></i>
                                                    @else            
                                                       <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>
                                                    @endif
                                                </button>
                                            </form>
                                            <!--<a href="#" class="clear-icon"><i class="fas fa-times"></i></a>-->
                                            <!--<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                            <!--<a href="#" class="share-icon"><i class="fas fa-share"></i></a>-->
                                        </div>
                                        
                                                
                                            </div>
                                            
                                        </div>

                                       
                                       
                                    </div>
                                
                                <!-- end features box item -->
                            </div>
                        </div>
                        @endforeach
                     
                     

                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section>
@endIf 
@endif



@if(!$new_courses->isEmpty())  
     <section class="featured-courses">
        <div class="container">
         
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                          الدورات المضافة حديثا
                    </h6>
                </div>
            </div>
       
            <div class="row" id="coursesmore">
               
                        <!-- @foreach ($new_courses as $_item)-->
                        <!--<div class="col-md-3">-->
                        <!--    <div class="featured-courses featured-courses-home">-->
                        <!--        <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">-->
                        <!--            <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">-->
                        <!--        </a>-->
                        <!--            <div class="bg-light">-->
                        <!--                <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">-->
                        <!--                    <p class="text-dark font-weight-bold mb-2">  {{ $_item->title }}</p>-->
                        <!--                </a>-->
                        <!--                <div class="featured-date mb-2">-->
                        <!--                    <i class="fas fa-calendar-alt"></i>-->
                        <!--                    <span>{{$_item->instructor->name}}</span>-->
                        <!--                </div>-->
                        <!--                <div class="featured-date mb-2">-->
                                            <!-- <i class="fas fa-money-bill-alt"></i> -->
                                            <!-- <span>{{$_item->duration}} {{__('front.hours')}}</span> -->
                        <!--                </div>-->
                                        
                        <!--                <div class="row">-->
                                            
                        <!--                    <div class="col-7">-->
                                                
                        <!--                         <div class="mb-2">-->
                        <!--                    @if($_item->rate >4)-->
                        <!--                        @for ($i = 0; $i < $_item->rate; $i++)-->
                        <!--                            <span class="fa fa-star checked"></span>-->
                        <!--                        @endfor -->
                        <!--                    @elseif($_item->rate >3)-->
                        <!--                        @for ($i = 0; $i < $_item->rate; $i++)-->
                        <!--                            <span class="fa fa-star checked"></span>-->
                        <!--                        @endfor-->
                        <!--                        <span class="fa fa-star"></span>  -->
                        <!--                    @elseif($_item->rate >2)-->
                        <!--                        @for ($i = 0; $i < $_item->rate; $i++)-->
                        <!--                            <span class="fa fa-star checked"></span>-->
                        <!--                        @endfor-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                                               
                        <!--                    @elseif($_item->rate >1)-->
                        <!--                        @for ($i = 0; $i < $_item->rate; $i++)-->
                        <!--                            <span class="fa fa-star checked"></span>-->
                        <!--                        @endfor-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>  -->
                        <!--                    @elseif($_item->rate >0)-->
                        <!--                        @for ($i = 0; $i < $_item->rate; $i++)-->
                        <!--                            <span class="fa fa-star checked"></span>-->
                        <!--                        @endfor-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>   -->
                        <!--                    @elseif($_item->rate ==0)-->
                        <!--                        <span class="fa fa-star"></span>  -->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>-->
                        <!--                        <span class="fa fa-star"></span>              -->
                        <!--                    @endif-->
                        <!--                </div>-->
                                                
                        <!--                    </div>-->
                                            
                        <!--                    <div class="col-5">-->
                                                 
                        <!--                 <div class="featured-buttons mb-4">-->
                                           
                        <!--                    <form action="{{route('user.addfavorite')}}" method="POST">-->
                        <!--                        @csrf-->
                        <!--                        <input type="hidden" name="courseId" value="{{$_item->id}}"> -->
                        <!--                        <button type="submit">-->
                        <!--                            @if($_item->user_favorite == 'true')-->
                        <!--                                <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                                        
                        <!--                            @else            -->
                        <!--                               <i class="fas fa-heart pr-2"></i>-->
                        <!--                            @endif-->
                        <!--                        </button>-->
                        <!--                    </form>-->
                                            <!--<a href="#" class="clear-icon"><i class="fas fa-times"></i></a>-->
                                            <!--<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                            <!--<a href="#" class="share-icon"><i class="fas fa-share"></i></a>-->
                        <!--                </div>-->
                                        
                                                
                        <!--                    </div>-->
                                            
                        <!--                </div>-->

                                       
                                       
                        <!--            </div>-->
                                
                                <!-- end features box item -->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--@endforeach-->

                    </div>
                
                </div>
          
    </section>
@endif

    <!-- start featured-courses -->
    <!--<section class="featured-courses">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">-->
    <!--                    {{__('front.featured courses')}}-->
    <!--                </h6>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="swiper-slider-clients swiper-container">-->
    <!--                <div class="swiper-wrapper">-->
    <!--                     @foreach ($courses as $_item)-->
    <!--                    <div class="swiper-slide">-->
    <!--                        <div class="featured-courses featured-courses-home">-->
    <!--                            <a href="{{url('courses/'.$_item->slug)}}">-->
    <!--                                <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">-->
    <!--                            </a>-->
    <!--                                <div class="bg-light">-->
    <!--                                    <a href="{{url('courses/'.$_item->slug)}}">-->
    <!--                                        <p class="text-dark font-weight-bold mb-2">  {{ $_item->title }}</p>-->
    <!--                                    </a>-->
    <!--                                    <div class="featured-date mb-2">-->
    <!--                                        <i class="fas fa-calendar-alt"></i>-->
    <!--                                        <span>{{$_item->date}}</span>-->
    <!--                                    </div>-->
    <!--                                    <div class="featured-date mb-2">-->
                                            <!-- <i class="fas fa-money-bill-alt"></i> -->
                                            <!-- <span>{{$_item->duration}} {{__('front.hours')}}</span> -->
    <!--                                    </div>-->
                                        
    <!--                                    <div class="row">-->
                                            
    <!--                                        <div class="col-6">-->
                                                
    <!--                                             <div class="mb-2">-->
    <!--                                        @if($_item->rate >4)-->
    <!--                                            @for ($i = 0; $i < $_item->rate; $i++)-->
    <!--                                                <span class="fa fa-star checked"></span>-->
    <!--                                            @endfor -->
    <!--                                        @elseif($_item->rate >3)-->
    <!--                                            @for ($i = 0; $i < $_item->rate; $i++)-->
    <!--                                                <span class="fa fa-star checked"></span>-->
    <!--                                            @endfor-->
    <!--                                            <span class="fa fa-star"></span>  -->
    <!--                                        @elseif($_item->rate >2)-->
    <!--                                            @for ($i = 0; $i < $_item->rate; $i++)-->
    <!--                                                <span class="fa fa-star checked"></span>-->
    <!--                                            @endfor-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
                                               
    <!--                                        @elseif($_item->rate >1)-->
    <!--                                            @for ($i = 0; $i < $_item->rate; $i++)-->
    <!--                                                <span class="fa fa-star checked"></span>-->
    <!--                                            @endfor-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>  -->
    <!--                                        @elseif($_item->rate >0)-->
    <!--                                            @for ($i = 0; $i < $_item->rate; $i++)-->
    <!--                                                <span class="fa fa-star checked"></span>-->
    <!--                                            @endfor-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>   -->
    <!--                                        @elseif($_item->rate ==0)-->
    <!--                                            <span class="fa fa-star"></span>  -->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>-->
    <!--                                            <span class="fa fa-star"></span>              -->
    <!--                                        @endif-->
    <!--                                    </div>-->
                                                
    <!--                                        </div>-->
                                            
    <!--                                        <div class="col-6">-->
                                                 
    <!--                                    <div class="featured-buttons mb-4">-->
    <!--                                        <form action="{{route('user.addfavorite')}}" method="POST">-->
    <!--                                            @csrf-->
    <!--                                            <input type="hidden" name="courseId" value="{{$_item->id}}"> -->
    <!--                                            <button type="submit">-->
    <!--                                                @if($_item->user_favorite == 'true')-->
    <!--                                                    qqq-->
    <!--                                                    <i class="fas fa-heart pr-2"></i>-->
    <!--                                                @else            -->
    <!--                                                    ddd-->
    <!--                                                   <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
    <!--                                                @endif-->
    <!--                                            </button>-->
    <!--                                        </form>-->
                                            <!--<a href="#" class="clear-icon"><i class="fas fa-times"></i></a>-->
                                            <!--<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                            <!--<a href="#" class="share-icon"><i class="fas fa-share"></i></a>-->
    <!--                                    </div>-->
                                        
                                                
    <!--                                        </div>-->
                                            
    <!--                                    </div>-->
    <!--                                </div>-->
                                
                                <!-- end features box item -->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    @endforeach-->
    <!--                </div>-->
    <!--                <div class="swiper-pagination d-none"></div>-->
    <!--                <div class="swiper-button-next slider-long-arrow-white"></div>-->
    <!--                <div class="swiper-button-prev slider-long-arrow-white"></div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!-- end featured-courses -->
    
    
    
    
    <!-- start Zoom Meetings -->
    <!-- <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Zoom Meetings</h6>

                </div>
            </div>
            <div class="row">
                <div class=" swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/word.jpg" class="img-fluid">
                                </a>
                                <a href="#">
                                    <div class="bg-light">

                                        <p class="text-dark font-weight-bold mb-2"> Introduction And WORD</p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>


                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/excel.webp" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Excel
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>


                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/PowerPoint.jpg" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> PowerPoint
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/access.png" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Access
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="img/courses/word.jpg" class="img-fluid">
                                </a>
                                <a href="#">
                                    <div class="bg-light">

                                        <p class="text-dark font-weight-bold mb-2"> Introduction And WORD</p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>


                            </div>
                        </div>


                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/excel.webp" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Excel
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>


                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="front/img/courses/PowerPoint.jpg" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> PowerPoint
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="#">
                                    <img src="img/courses/access.png" alt="">
                                </a>

                                <a href="#">

                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> Access
                                        </p>

                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>30 Jun</span>
                                        </div>


                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span>
                                        </div>

                                        <div>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>








                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end Zoom Meetings -->


    <!-- start Featured Categories -->
    <!-- <section class="featured-courses">`
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Featured Categories


                    </h6>

                </div>
            </div>

            <div class="row">

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Design</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Photography</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Health & Fitness</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Development</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>


                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Marketing</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Business</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>


                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Teaching</h6>

                            </div>

                            <img src="front/img/categories/development.jpg">
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-3 col-md-6">
                    <div class="image-container">
                        <a href="#">

                            <div class="image-overlay">
                                <h6>Office Productivity</h6>

                            </div>

                            <img src="front/img/categories/design.jpg">
                        </a>
                    </div>
                </div>



            </div>
        </div>


        </div>
    </section> -->
    <!-- end Featured Categories -->



    <!-- start  Trusted by companies -->
    <!-- <section>
        <div class="container text-center">
            <div class="row text-left">
                <div class="col-12 ">

                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Trusted by companies


                    </h6>

                </div>
            </div>
            <div class="row">
                <div class="swiper-slider-clients swiper-container black-move">
                    <div class="swiper-wrapper">
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-1.png" alt=""></a>
                        </div>
                       
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-2.png" alt=""></a>
                        </div>
                     
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-3.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-4.png" alt=""></a>
                        </div>
                       
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-5.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-6.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-7.png" alt=""></a>
                        </div>
                        
                        <div class="swiper-slide text-center"><a href="#"><img src="front/img/clients/logo-8.png" alt=""></a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- end  Trusted by companies -->
    
    
    <!--<section class="featured-courses" style="padding: 20px 0px 0px 0px !important;">-->
    <!--    <div class="container">-->
    <!--        <div class="mt-4">-->
    <!--            <div class="tab-content">                    -->
                    <!-- start tab content -->
    <!--                <div class="tab-pane med-text fade in active show" id="tab_sec1">-->
    <!--                    <div class="row featured-courses" id="coursesmore">-->
    <!--                    </div>-->
    <!--                </div><br>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
       var site_url = "{{ url('/') }}";   
       var page = 1;
       
       load_more(page);
    
       $(window).scroll(function() {
        //   if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            // console.log('ddddfflog');
          page++;
          load_more(page);
        //   }
        });

    function load_more(page){
        $.ajax({
          url: site_url + "/allbooksone?page=" + page,
          type: "get",
          datatype: "html",
          beforeSend: function()
          {
            $('.ajax-loading').show();
          }
        })
        .done(function(data)
        {          
            if(data.length == 0){
                $('.ajax-loading').html("No more records!");
                return;
            }
            $('.ajax-loading').hide();
            $("#coursesmore").append(data);






        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
          alert('No response from server');
        });
    }
</script>

        <script type="text/javascript">
            $(document).ready(function () {
		    
    			$('#get_sub_category_name').on('change', function () {
    	        	console.log("welcome sub"); 
    	        	let id = $(this).val();
    	        		console.log(id); 
    			    $.ajax({
    				    type: 'GET',
    				    url: "{{url('getsubcategory')}}/"+id,
    				    success: function (response) {
    				        console.log("welcome subxxx"); 
    				       
    				        var response = JSON.parse(response)
    				        //   console.log(id);
    					    $('#get_sub_category').empty();
    					   
    					   // $('#get_sub_category').append(`<option  value="" selected>اختار </option>`);
    					    response.forEach(elements => {
    					        
    					       // console.log(elements);
    					       // console.log('cccccccnnnnnn');
    					       // console.log(elements['title']['ar']); 
    					        
    					        $('#get_sub_category').append(`<option value="${elements['id']}">
    					        ${elements['title']['ar']} 
    					        </option>`);
    					    });
    					}
    				});
    			});
    		});	
    		
            function getcourses(categoryId)
            {
                    // alert(categoryId);
                    
                    // var query = $(this).val(); 
                    console.log(categoryId);
                    $.ajax({
                        url:"{{ route('getcoursesbycategory') }}",
                        type:"GET",
                        data:{'categoryId':categoryId},
                        success:function (response) {
                            console.log(response); 
                             console.log('fff');
                                $('#courses').empty();

                            
                            // console.log(response); 
                            if (response.length == 0) {
                                console.log("erfreferfrnono");
                                $('#courses').append(`
                                    <p class="" style="font-size: 15px;">لا يوجد نتائج مطابقة لهذا البحث     </p>
                                `);

                            }else {        
                                console.log("yes");
                            
                                response.forEach(element => {
                                    
                                    var courserate=element['rate'];
                                    console.log("hamada "+courserate); 
                                    $('#courses').append(`
                                        <div class="col-12 col-lg-3 col-md-6">
                                            <a href="courses/${element['slug']}/${element['id']}">
                                                <img src="assets_admin/img/courses/${element['image']}" class="img-fluid">
                                            </a>
                                            <a href="courses/${element['slug']}/${element['id']}">
                                                <div class="bg-light">

                                                    <p class="text-dark font-weight-bold mb-2"> ${element['title']}</p>

                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>${element['date']}</span>
                                                    </div>

                                          </a>
    

                                    <div class="row">
                                            
                                            <div class="col-7">
                                                
                                                 <div class="mb-2">
                                            @if($_item->rate >4)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor 
                                            @elseif($_item->rate >3)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>  
                                            @elseif($_item->rate >2)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                               
                                            @elseif($_item->rate >1)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>  
                                            @elseif($_item->rate >0)
                                                @for ($i = 0; $i < $_item->rate; $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>   
                                            @elseif($_item->rate ==0)
                                                <span class="fa fa-star"></span>  
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>              
                                            @endif
                                        </div>
                                                
                                            </div>
                                            
                                            <div class="col-5">
                                                 
                                         <div class="featured-buttons mb-4">
                                           
                                            <form action="{{route('user.addfavorite')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="courseId" value="{{$_item->id}}"> 
                                                <button type="submit">
                                                    @if($_item->user_favorite == 'true')
                                                        <i class="fas fa-heart pr-2"></i>
                                                    @else            
                                                       <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>
                                                    @endif
                                                </button>
                                            </form>
                                            <!--<a href="#" class="clear-icon"><i class="fas fa-times"></i></a>-->
                                            <!--<a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
                                            <!--<a href="#" class="share-icon"><i class="fas fa-share"></i></a>-->
                                        </div>
                                        
                                                
                                            </div>
                                            
                                        </div>

                                                 

                                                </div>
                                        </div>

                                        
                                    `);
                                    
                                });
                            }
                            // $('#searchbooks').html(data);
                        }
                    })
               
                    
            }
            
            
           
        </script>
        
        
        




@endsection


