
@extends('layout.front_main')
@section('content') 

    <section class="parallax course-details">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="breadcrumb mt-4 pt-1">
                        <!-- start breadcrumb -->
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">online</a></li>
                            <!--<li><a href="#" class="main-color"></a></li>-->
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h2>
                        {{$details->title}}
                        <!-- 2021 Complete Python Bootcamp From Zero to Hero in Python -->
                    </h2>
                    <p>
                        {{$details->short_detail}}
                    </p>
                    <div class="mb-3">
                        <button class="btn btn-best text-capitalize mr-2">Bestseller </button>
                        <span class="pr-1"> {{$rate}} </span>
                        @for ($i = 0; $i < $rate; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor 
                        
                        <!--<span class="fa fa-star"></span>
                        <span class="fa fa-star"></span> -->
                    </div>

                    <p>{{__('front.created by')}} <a href="#" class="instructor_link">{{$instructor->name}}</a> 
                        <span class="text-small text-light">( {{$country->nicename}})</span></p>

                    <span class="mr-5"><i class="fas fa-exclamation-circle"></i>{{__('front.last updated')}} {{$details->updated_at}}</span>

                    <!-- <span><i class="fas fa-globe"></i> English</span> -->

                    <p class="mt-4">
                        <a href="#" class="btn btn-outline-light mr-2"> <i class="fas fa-heart"></i> Wishlist</a>

                        <a href="#" class="btn btn-outline-light mr-2"> <i class="fas fa-share"></i> Share</a>

                        <a href="#" class="btn btn-outline-light">Gift this course</a>

                    </p>


                </div>

                <div class="col-md-3 course-details-white">

                    <!--<div class="image-container2 popup-gallery">-->
                        <!-- <a class="video" href="https://www.youtube.com/watch?v=WvhQhj4n6b8"> -->
                        <!--<a class="video" href="http://localhost:8000/assets_admin/img/courses/videos/20211020144524.mp4">   -->

                        <!--    <div class="image-overlay">-->
                        <!--        <h6><i class="fas fa-play-circle"></i></h6>-->
                        <!--        <p>Preview this course</p>-->

                        <!--    </div>-->

                            <!--<img src="{{asset('assets_admin/img/livecourses/'.$details->image) }}">-->
                        <!--</a>-->
                    <!--</div>-->
                    <div class="image-container2 ">
                        <!-- <a class="video" href="https://www.youtube.com/watch?v=WvhQhj4n6b8"> -->
                        <!-- <a class="video" href="http://localhost:8000/assets_admin/img/courses/videos/20211020144524.mp4">    -->
                            <!-- <div class="image-overlay">
                                <h6><i class="fas fa-play-circle"></i></h6>
                                <p>Preview this course</p>
                            </div> -->
                            <img src="{{asset('assets_admin/img/consultings/'.$details->image) }}">
                        <!-- </a> -->
                    </div>
                    <div class="course-desc" id="course-desc">
                        <!--<h5>{{$details->price}} $  <small></small></h5> -->
                        <!--<p class="text-danger"><i class="fas fa-stopwatch"></i> 2 days left at this price!</p>-->
                        <!--@if($subscriptions==null)-->
                         @if (session('signinsucces'))
    			            <div class="alert alert-success">
    			                {{ session('signinsucces') }}
    			            </div>
    			        @endif
    			        
    			        @if($user)
        			        @if($user->type =="student")
            			        @if($details->price!=0)
                                    <a href="{{url('get-checkout/consultings/'.$details->id)}}" class="btn header-btn w-100">احجز موعد للاستشارة</a>
                                @else
                                    <a href="{{url('consulting-joine/consultings/'.$details->id)}}" class="btn header-btn w-100">احجز موعد للاستشارة</a>
                                @endif
                            @else
                                  <a href="{{url('login/user')}}" class="btn header-btn w-100">احجز موعد للاستشارة</a>
                            @endif
                        @else
                              <a href="{{url('login/user')}}" class="btn header-btn w-100">سجل في هذه الدورة</a>
                        @endif    
                        <!--<a href="#" class="btn header-btn w-100">احجز موعد للاستشارة</a>-->

                        <!--@else-->
                        <!--      <p class="btn header-btn w-100">subscriber</p>-->
                        <!--@endif-->
                      

                        <ul class="p-0 pt-4">
                            <!--<h6>This subscription includes:</h6>-->
                            <li class="row">
                                <div class="col-1"><i class="fab fa-youtube"></i></div>
                                <div class="col-10">
                                    <p>مدة الاستشارة : 
                                    {{$details->duration}} دقيقة</p>
                                </div>
                            </li>
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="far fa-file"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p> تاريخ بداية الدورة : {{$details->date}}</p>-->
                            <!--    </div>-->
                            <!--</li> -->
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="far fa-file"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p>وقت الدورة : {{$details->time}} مساءً بتوقيت الاردن</p>-->
                            <!--    </div>-->
                            <!--</li> -->
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="far fa-file"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        @if($details->payed==0)-->
                            <!--            <p>رسوم التسجيل ف هذه الدورة : مجاني</p>-->
                            <!--        @else-->
                            <!--            <p>رسوم التسجيل ف هذه الدورة : {{$details->price}}</p>-->
                            <!--        @endif-->
                            <!--    </div>-->
                            <!--</li> -->

                            <li class="row">
                                <div class="col-1"><i class="fas fa-code"></i></div>
                                <div class="col-10">
                                    @if($details->price==0)
                                        <p>  رسوم الاستشارة : مجاني</p>
                                    @else
                                        <p> رسوم الاستشارة :
                                        {{$details->price}} دولار</p>
                                    @endif
                                </div>
                            </li>
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="fas fa-infinity"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p>شهادة إنجاز</p>-->
                            <!--    </div>-->
                            <!--</li>-->
                           
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="fas fa-certificate"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p> Certificate of completion</p>-->
                            <!--    </div>-->
                            <!--</li>-->
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start course details -->
    <section class="overview-section">
        <div class="container">
            <div class="row">

                <main class="col-12 col-lg-9 right-sidebar md-margin-60px-bottom  pl-0 md-no-padding-right">

                    <!-- <div class="col-12 bg-light border p-4">
                        <h6>What you'll learn </h6>
                        <ul class="list-unstyled">
                            <div class="row">

                                <li class="col-md-6 pb-2">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                        <div class="col-md-10">
                                            Learn to use Python professionally, learning both Python 2 and Python 3!
                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-6 pb-2"> <i class="far fa-check-circle"></i> Learn advanced Python
                                    features, like the collections module and how to work with timestamps!
                                </li>
                                <li class="col-md-6 pb-2"><i class="far fa-check-circle"></i> Understand complex topics,
                                    like decorators.
                                </li>
 


                            </div>
                        </ul>
                    </div> -->
                    <div class="col-12 mt-5">
                        <h6>{{__('front.short description')}}
                        </h6>

                        <ul class="pl-4">
                            <li>{{$details->short_detail}}</li>
                        </ul>
                    </div>
                    <div class="col-12 mt-5">
                        <h6>موضوعات الاستشارة</h6>
                        <p>{{$details->mahawir}}</p>
                    </div>




                   
                   

                    <!--<div class="col-12 mt-5">-->
                    <!--    <h6>{{__('front.target group')}}</h6>-->
                    <!--    <p>{{$details->target_group}}</p>-->
                    <!--</div>-->
                    <!--@if( !empty($details->meeting_url))-->
                    <!--    <div class="col-12 mt-5">-->
                    <!--        <h6>رابط حضور الدورة</h6>-->
                    <!--        <p>{{$details->meeting_url}}</p>-->
                    <!--    </div>-->
                    <!--@endif-->
                    <!--<div class="col-12 mt-5">-->
                    <!--    <h6>Recently Added Courses-->

                    <!--    </h6>-->

                        
                    <!--    @foreach($recently_courses as $key =>$_item)-->
                    <!--    <div class="row mb-4">-->

                    <!--        <div class="col-lg-7 col-md-6 col-12">-->
                    <!--            <div class="row">-->

                    <!--                <div class="col-lg-4 col-sm-4 col-5">-->
                    <!--                    <div class="course-img">-->
                    <!--                        <a href="#">-->
                    <!--                            <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}">-->
                    <!--                        </a>-->
                    <!--                    </div>-->
                    <!--                </div>-->

                    <!--                <div class="col-lg-6 col-sm-8 col-7">-->
                    <!--                    <div class="course-name">-->
                    <!--                        <a href="#">-->
                    <!--                            {{$_item->title}}-->
                    <!--                        </a>-->
                    <!--                    </div>-->
                    <!--                    <div class="course-update">Last Updated {{$_item->date}}</div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--        <div class="col-lg-2 col-md-1 col-4">-->
                    <!--            <div class="course-user">-->
                    <!--                <ul class="list-unstyled">-->
                    <!--                    <li><i class="fa fa-user"></i></li>-->
                    <!--                    <li>0</li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-2 col-md-3 col-4">-->

                    <!--            <div class="course-currency text-right">-->
                    <!--                <ul class="list-unstyled">-->
                    <!--                    <li class="rate">500 L.E</li>-->
                    <!--                    <li class="rate"><s>1000 L.E</s></li>-->

                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--        <div class="col-lg-1 col-md-2 col-4">-->
                    <!--            <div class="course-rate text-right">-->
                    <!--                <ul class="list-unstyled">-->
                    <!--                    <li>-->
                    <!--                        <div class="heart">-->
                                                <!-- <a href="#" title="heart">
                    <!--                                <i class="far fa-heart"></i>-->
                    <!--                            </a> -->-->
                    <!--                            <form action="{{route('user.addfavorite')}}" method="POST">-->
                    <!--                                @csrf-->
                    <!--                                <input type="hidden" name="courseId" value="{{$_item->id}}">   -->
                    <!--                                    <button type="submit" style="background: white; border: white;">-->
                    <!--                                        <i class="far fa-heart"></i>-->
                    <!--                                    </button>-->
                                                    
                    <!--                            </form>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                </ul>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    @endforeach-->

                    <!--</div>-->
                    
                    
                     <div class="col-12 team-section instructor-course-div">
                        
                          <h6>{{__('front.about the instructor')}}

                        </h6>

                        
                        <div class='row'>

                            <div class="col-md-3">
                                                                                    <a href="#" data-toggle="modal" data-target="#exampleModal">

                            
                            <img src="{{asset('img/profiles/'.$instructor->photo) }}" alt="">
                                                                                </a>


                            </div>
                            
                            <div class="col-md-9">
                                                        <div class="team-item_info">

                            <div class="team-item_titles">
                                <h4 class="team-title">
                                    <!--Dr. Hussni Al-Mestarihi-->
                                    {{ $instructor->name }} 
                                </h4>
                                <div class="team-department">
                                    <!--Researcher & Intsructor in Human Development and Mental Health-->
                                    
                                    {!! Str::limit($instructor->detail, 350 ) !!}
                                </div>
                                <a href="#" class="read-more-btn" data-toggle="modal" data-target="#exampleModal">Read More
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>

                            </div>
                        </div>
                        

                        

                    









        <!-- Modal -->
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

                            <div class="col-md-3">
                                <img src="{{asset('img/profiles/'.$instructor->photo) }}" alt="">
                            </div>

                            <div class="col-md-9">

                                <div class="instructor-info">
                                    <h4 class="team-title">
                                        <!--Dr. Hussni Al-Mestarihi-->
                                        {{ $instructor->name }} 
                                    </h4>
                                    <div class="team-department">
                                        {!! $instructor->detail !!} 
                                        <!--<ul>-->
                                        <!--    <li>-->
                                        <!--        Researcher & Intsructor in Human Development and Mental Health-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        University Professor-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        Chairman of the board of directors-->
                                        <!--    </li>-->
                                        <!--    <li>-->
                                        <!--        Author,-->
                                        <!--        <b>he has authored several books, including:</b>-->

                                        <!--        <ul>-->
                                        <!--            <li>-->
                                        <!--                Book ( Don't Be Afraid )-->
                                        <!--                <br>-->
                                        <!--                <small>The book guides you to ways Overcoming various fears and breaking-->
                                        <!--                    the barrier of fear-->
                                        <!--                </small>-->
                                        <!--                <a href="https://www.smashwords.com/books/view/1112136" target="_blank" class="btn btn">-->
                                        <!--                    Buy the book - PDF Format-->
                                        <!--                </a>-->
                                        <!--            </li>-->

                                        <!--            <li>-->
                                        <!--                Book (From Passion to Goal)-->
                                        <!--                <br>-->
                                        <!--                <small>The book guides you how to identify your talent and passion and how-->
                                        <!--                    to invest them to achieve Success-->
                                        <!--                </small>-->
                                        <!--                <a href="https://www.smashwords.com/books/view/1010475" target="_blank" class="btn btn">-->
                                        <!--                    Buy the book - PDF Format-->
                                        <!--                </a>-->
                                        <!--            </li>-->

                                        <!--            <li>-->
                                        <!--                Book ( My psychological state is very bad )-->
                                        <!--                <br>-->
                                        <!--                <small>-->
                                        <!--                    The book guides you through waysGet rid of the bad psychological state and reach happiness and inner peace-->
                                        <!--                </small>-->
                                        <!--                <br>-->
                                        <!--                <a href="https://www.smashwords.com/books/view/1066148" target="_blank" class="btn btn">-->
                                        <!--                    Buy the book - PDF Format-->
                                        <!--                </a>-->
                                        <!--            </li>-->

                                        <!--        </ul>-->
                                        <!--    </li>-->
                                        <!--</ul>-->
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

                    

                    <!--<div class="col-12 mt-5">-->
                    <!--    <h6>{{__('front.about the instructor')}}-->

                    <!--    </h6>-->

                    <!--    <div class="row">-->
                    <!--        <div class="col-md-2 mb-4">-->
                    <!--            <img src="{{asset('img/profiles/'.$instructor->photo) }}" class="rounded-circle instructor-img">-->
                    <!--        </div>-->
                    <!--        <div class="col-md-10">-->
                    <!--            <h6 class="font-weight-normal mb-2"><a href="#" class="main-color">{{$instructor->name}}-->
                    <!--                </a></h6>-->
                    <!--            <p class="font-weight-bold  text-dark mb-2">{{__('front.about the instructor')}}-->
                    <!--            </p>-->
                    <!--            <p>-->
                    <!--                {!! $instructor->detail !!} -->

                    <!--            </p>-->
                    <!--        </div>-->
                    <!--    </div>-->

                        
                    <!--</div>-->
                </main> 
            </div>
        </div>
    </section>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">

        // $('#myvideooooo').attr('src', "/assets_admin/img/courses/videos/");
       

        // var userid=0;
        // var videoid=0;
        // var watchtime=0;
       


        
    </script>
    <!-- end course details -->
@endsection
