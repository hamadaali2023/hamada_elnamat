

@extends('layout.front_main')
@section('content') 
    <?php 
        $user_auth=Auth::guard('instructors')->user();  
        
    ?>
    <section class="parallax course-details" >
        <div class="container">
           
       
            <div class="row">
                <div class="col-md-8">
                    <div class="breadcrumb mt-4 pt-1">
                        <!-- start breadcrumb -->
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">curriculums</a></li>
                            <!--<li><a href="#"></a></li>-->
                            <!--<li><a href="#" class="main-color"></a></li>-->
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                    <h2>
                        <!--{{$details->title}} - {{$details->id}}-->{{$details->material->name}}
                        <!-- 2021 Complete Python Bootcamp From Zero to Hero in Python -->
                    </h2>
                    <p>
                        <!--{{$details->short_detail}}-->
                    </p>
                    <div class="mb-3">
                        <button class="btn btn-best text-capitalize mr-2">Bestseller </button>
                        <span class="pr-1"> {{$rate}} </span>

                        <!-- @for ($i = 0; $i < $rate; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor  -->


                        @if($rate >4)
                            @for ($i = 0; $i < $rate; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor 
                        @elseif($rate >3)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>  
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>  
                        @elseif($rate >2)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                           
                        @elseif($rate >1)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>  
                        @elseif($rate >0)
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>   
                        @elseif($rate ==0)
                            <span class="fa fa-star"></span>  
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>              
                        @endif


                    </div>
                    <p > {{__('front.created by')}}<a href="#" class="instructor_link" style="color:#fff;text-decoration: auto;" > {{$instructor->name}} </a> 
                        <span class="text-small text-light"> ( {{$instructor->nationality}}) </span></p>
                    <span class="last-updated-span"><i class="fas fa-exclamation-circle"></i>{{__('front.last updated')}}
                     {{ Str::words($details->updated_at, 1,'')}}</span>
                    <!-- <span><i class="fas fa-globe"></i> English</span> -->
                    
                    <div class="d-flex mt-4 course-detail-btn">
                        
                         <p class="mt-4">
                        
                        <form action="{{route('user.addfavorite')}}" method="POST">
                            @csrf
                            <input type="hidden" name="courseId" value="{{$details->id}}">  
                            @if($favorite_check)
                                <input type="submit" class="btn btn-outline-light" name="" value="{{__('front.remove_wishlist')}}">
                            @else
                                <input type="submit" class="btn btn-outline-light" name="" value="{{__('front.wishlist')}} ">
                            @endif
                        </form>
                       
                        <a href="#" data-toggle="modal" data-target="#user_share"  class="btn btn-outline-light"> <i class="fas fa-share"></i>{{__('front.share')}} </a>
                        @if($user_auth)
                            @if($user_auth->type == 'student')
                                @if($totalpercent > 20)
                                    <a href="#" data-toggle="modal" data-target="#user_rate"  class="user_rate btn btn-outline-light">إضافة تقييم </a>
                                @endif    
                            @endif
                        @else
                            <!--<a href="{{url('login/user')}}" class="user_rate btn btn-outline-light">إضافة تقييم </a>-->
                        @endif
                    </p>
                        
                    </div>
                    
                   
                    <!--<p class="mt-4">-->
                        
                        <!--<a href="#" class="btn btn-outline-light mr-2"> <i class="fas fa-heart"></i> {{__('front.wishlist')}}</a>-->
                        
                        <!--<form action="{{route('user.addfavorite')}}" method="POST">-->
                        <!--    @csrf-->
                        <!--    <input type="hidden" name="courseId" value="{{$details->id}}">   -->
                        <!--    <input type="submit" class="btn btn-outline-light mr-2" name="" value="{{__('front.wishlist')}} ">-->
                        <!--</form>-->

                        <!--<a href="#" data-toggle="modal" data-target="#user_share"  class="btn btn-outline-light mr-2"> <i class="fas fa-share"></i>{{__('front.share')}} </a>-->

                        <!--@if($user_auth)-->
                        <!--    <a href="#" data-toggle="modal" data-target="#user_rate"  class="user_rate btn btn-outline-light">إضافة تقييم </a>-->
                        <!--@else-->
                        <!--    <a href="{{url('login/user')}}" class="user_rate btn btn-outline-light">إضافة تقييم </a>-->
                        <!--@endif-->

                    <!--</p>-->
                    
                   
                    <div class="modal fade" id="user_share" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document" >
                            <div class="modal-content" >
                            
                                <div class="modal-body">
                                    <div class="form-content p-2">
                                    <p class="mb-5 text-center" style="color: #212121;font-size: 15px;">شارك مع أصدقائك</p>
                                    <?php 
                                    
                                         $shareComp = \Share::page(
                                            'https://elnamat.com/courses/'.$details->slug)
                                        ->facebook()
                                        ->twitter()
                                        ->linkedin()
                                        ->telegram()
                                        ->whatsapp()        
                                        ->reddit();
                                    ?>
                                    {!! $shareComp !!}
                                    <style>
                                        div#social-links {
                                            margin: 0 auto;
                                            max-width: 500px;
                                        }
                                        div#social-links ul li {
                                            display: inline-block;
                                        }          
                                        div#social-links ul li a {
                                            padding: 20px;
                                            border: 1px solid #ccc;
                                            margin: 1px;
                                            font-size: 25px;
                                            color: #222;
                                            background-color: #ccc;
                                        }
                                    </style>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="user_rate" aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document" >
                            <div class="modal-content" style="color: #212121;font-size: 15px;">
                            
                                <div class="modal-body">
                                    <div class="form-content p-2">
                                   
                                    @if($user_auth)    
                                        @if($user_rate =='true')
                                            <center><p>قمت بالتقييم سابقا لا يجوز التقييم مرة اخرى</p></center>
                                        @else
                                             <link rel="stylesheet" type="text/css" href="{{asset('assets-rate/css/font-awesome.min.css')}}">
                                            <link rel="stylesheet" type="text/css" href="{{asset('assets-rate/css/style.css')}}">
                   
                                            <form action="{{url('user/add-rate')}}" method="post">
                                                    @csrf
                                                    <div class="comment-form-rating">
                                                        <span>ضع تقييمك</span>
    
                                                        <p class="stars" style="padding:20px">
                                                            <label for="rated-1"></label>
                                                            <input type="radio" id="rated-1" name="rating" value="1">
                                                            <label for="rated-2"></label>
                                                            <input type="radio" id="rated-2" name="rating" value="2">
                                                            <label for="rated-3"></label>
                                                            <input type="radio" id="rated-3" name="rating" value="3">
                                                            <label for="rated-4"></label>
                                                            <input type="radio" id="rated-4" name="rating" value="4" checked="checked">
                                                            <label for="rated-5"></label>
                                                            <input type="radio" id="rated-5" name="rating" value="5" >
                                                        </p>
                                                    </div>
                                                     
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <!-- <label></label> -->
                                                            <input type="text" name="comment" class="form-control" placeholder="أكتب ملاحظة">
                                                        </div>
                                                    </div>   
                                                    <input type="hidden" name="courseId" value="{{$details->id}}">                                    
                                                    <div class="col-md-12 ">
                                                        <button type="submit" class="btn header-btn text-medium font-weight-600">
                                                            ارسال التقييم 
                                                        </button>   
                                                    </div>     
                                            </form>
                                            
                                        @endif
                                    @else   
                                        <p>يجب تسجيل الدخول</p>
                                        <div class="text-center">
                                            <p> يجب  <a href="{{url('login/user')}}" class="main-color font-weight-bold">{{__('front.log in')}}</a>
                                            </p>
                                        </div>
                                    @endif    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-3 course-details-white">
                    <div class="image-container2 ">
                        <!-- <a class="video" href="https://www.youtube.com/watch?v=WvhQhj4n6b8"> -->
                        <!-- <a class="video" href="http://localhost:8000/assets_admin/img/courses/videos/20211020144524.mp4">    -->
                            <!-- <div class="image-overlay">
                                <h6><i class="fas fa-play-circle"></i></h6>
                                <p>Preview this course</p>
                            </div> -->
                            <img src="{{asset('assets_admin/img/curriculums/'.$details->image) }}">
                        <!-- </a> -->
                    </div>

                   
                    @if(!$user_auth)
                    <div class="course-desc" id="course-desc">
                        <!-- <h5>1000 $  <small>{{__('front.monthly')}}</small></h5>  -->
                            <a href="#" class="btn header-btn w-100">اشترك لمشاهدة مواد التوجيهي </a>
                        
                        <ul class="p-0 pt-4">
                            <h6>{{__('front.this subscription includes')}}</h6>
                             <li class="row">
                                <div class="col-1"><i class="fas fa-certificate"></i></div>
                                <div class="col-10">
                                    <p> مشاهدة مواد التوجيهي للفصلين بفرع معين حتى نهايه العام الدراسي</p>
                                </div>
                            </li>
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="fab fa-youtube"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p>{{__('front.Watch all the courses on the platform at any time and without limits')}}</p>-->
                            <!--    </div>-->
                            <!--</li>-->
                            <!-- <li class="row">
                                <div class="col-1"><i class="far fa-file"></i></div>
                                <div class="col-10">
                                    <p>14 articles</p>
                                </div>
                            </li> -->

                           <!--  <li class="row">
                                <div class="col-1"><i class="fas fa-code"></i></div>
                                <div class="col-10">
                                    <p>19 coding exercises</p>
                                </div>
                            </li> -->
                            <!--<li class="row">-->
                            <!--    <div class="col-1"><i class="fas fa-infinity"></i></div>-->
                            <!--    <div class="col-10">-->
                            <!--        <p> {{__('front.course duration')}} {{$details->duration}} {{__('front.hours')}}</p>-->
                            <!--    </div>-->
                            <!--</li>-->
                           
                           
                        </ul>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- end banner -->


    <!-- start course details -->
    <section class="overview-section" >
        <div class="container">
            <div class="row">

                <main class="col-12 col-lg-9 right-sidebar md-margin-60px-bottom  pl-0 md-no-padding-right">

                    <div class="col-12 bg-light border p-4">
                        <h6>تفاصيل المادة </h6>
                        <ul class="list-unstyled">
                            <div class="row">

                                <li class="col-md-6 pb-2">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <i class="far fa-check-circle"></i>
                                        </div>
                                        <div class="col-md-10">  اسم المادة: 
                                            {{$details->material->name}}
                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-6 pb-2"> <i class="far fa-check-circle"></i>
                                    الفرع : 
                                    @foreach ($details->branch as $key =>$item)
                                        @if($item)
                                            {{$item->name}}
                                        @endif 
                                    @endforeach
                                </li>
                                <li class="col-md-6 pb-2"><i class="far fa-check-circle"></i>
                                     الفصل الدراسي :
                                     @if($details->classroom ==1)     
                                                    الاول
                                                @else
                                                    الثاني
                                                @endif
                                </li>
 


                            </div>
                        </ul>
                    </div>
                    
                   



                    <div class="col-12 mt-5">
                        <h6 class="mb-2">{{__('front.course content')}}</h6>
                        <small> {{$video_count}} محاضرة - 
                             @if($video_count <= 1)
                                <span id="totalcoursevideo">{{$cours_time}} دقيقة</span>
                            @else
                                <span id="totalcoursevideo">{{$cours_time}} دقائق</span>
                            @endif
                        </small>
                        <div class="accordion course-content mt-3" id="accordionExample">
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($videos as $key =>$video)
                                        <li class="list-group-item">
                                            <a href="#" data-toggle="modal" data-target="#large{{$key}}" onClick="viewvideo('myvideo{{$key}}',{{$video->id}},{{$instructor->id}},'hidden_message{{$key}}','video_error_message{{$key}}')">
                                                <div class="row">
                                                    <div class="col-9 main-color">
                                                        <p> <i class="fas fa-play-circle pr-2"></i> {{$video->name}}</p>
                                                    </div>
                                                   
                                                        <video style="display: none;" id="videoPlayerNew{{$key}}"   
                                                         preload="none" 
                                                        poster="anyimage.jpg"
                                                        controls  controlsList="nodownload" 
                                                        oncontextmenu="return false;"
                                                        >
                                                          <source src="{{asset('assets_admin/img/curriculums/videos/'.$video->url) }}" type="video/mp4">
                                                        </video>
                                                       
                                                    <div class="col-3 text-right">
                                                         @if($video->videotime <= 1)
                                                            <p id="videoduration{{$key}}">{{$video->videotime}} دقيقة</p>
                                                        @else
                                                            <p id="videoduration{{$key}}">{{$video->videotime}} دقائق</p>
                                                        @endif
                                                    </div>

                                                </div>
                                            </a>

                                        </li>
                                       
                                        <div class="modal fade text-left" id="large{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"   aria-hidden="true">
                                            <div class="modal-dialog modal-lg " role="document" >
                                                
                                                <div class="modal-content " >
                                                    <div  style="color: white; font-size: 18px; font-weight: 900;">
                                                        <!-- <input id="button" type="submit" name="button" onclick="closevideo('myvideo{{$key}}');" value="X"/> -->
                                                        <button class="text-primary" onclick = "closevideo('myvideo{{$key}}','large{{$key}}','hidden_message{{$key}}','video_error_message{{$key}}')">X</button>
                                                    </div>
                                                    <video id="myvideo{{$key}}"   width="300"  
                                                    preload="none" 
                                                    poster="anyimage.jpg"
                                                    controls  controlsList="nodownload" 
                                                    oncontextmenu="return false;"> 
                                                        <!-- <source src="https://kutuphanah.com/academy//assets_admin/img/courses/videos/20211023053825.mp4#t=512.336217" type="video/mp4" > -->
                                                        <source src="" type="video/mp4" >
                                                    </video>        
                                                    <!-- <div id="timeee"></div>
                                                    <div id="video_counter"></div> -->
                                                    <div class="hidden_message{{$key}}" id="video_error_message{{$key}}" style="display:none;text-align: right;padding: 18px;color: rgb(209 4 4);font-size: larger;"></div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        @endforeach
                                        <!--  <video id="myvideooooo" controls  width="300">
                                                                <source src="" type="video/mp4" >
                                                            </video>   -->
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
        <style type="text/css">
     .edit-course {
      position: relative;
      display: inline-block;
    }

    .edit-course .editcourse {
      visibility: hidden;
      width: 75px;
      font-size: 10px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .edit-course:hover .editcourse {
      visibility: visible;
    }
    .modal-content {
        /*background-color: #fff0 !important;*/
        border: 0px !important;
    }
</style>

                    <!--<div class="col-12 mt-5">-->
                    <!--    <h6>{{__('front.description')}}-->
                    <!--    </h6>-->
                    <!--    <p>{{$details->detail}}-->
                    <!--    </p>-->
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
                                    {{$instructor->name}}
                                </h4>
                                <div class="team-department">
                                     {!! Str::limit($instructor->detail, 350 ) !!}
                                </div>
                                <a href="#" class="read-more-btn" data-toggle="modal" data-target="#exampleModal">Read More
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </div>
                        </div>
                            </div>
                        </div>
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
                                        {{$instructor->name}}
                                    </h4>
                                    <div class="team-department">
                                        {!! $instructor->detail !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                </main> 
            </div>
        </div>
    </section>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

    // $(document).bind("contextmenu",function(e) {
    //     e.preventDefault();
    // });

    function closevideo(videoclose,idmodall){
    event.preventDefault();
    var closev = document.getElementById(videoclose);
    // console.log(videoclose);
    $('#'+idmodall).modal('hide');
    closev.pause();
    // console.log(idmodall);
    
    // alert("The button was pressed");
};  
        var totalcourse = 0;
        var totalpercent= 0;
        var totalcoursesss =0;
        @foreach($videos as $key =>$item )
            var myVideo = document.getElementById("videoPlayerNew{{$key}}");
            $('#myvideo{{$key}}').attr('src', "{{asset('assets_admin/img/curriculums/videos/'.$item->url) }}"+'#t={{ $item->vid_views }}');
        @endforeach
        
        function viewvideo(videoId,id,userid,hidden_message,video_error_message) {
            $('.'+hidden_message).hide();
            
            var videoElement = document.getElementById(videoId);
            var totalTimePlayed = 0;
            var lastUpdatedTime = 0;

            videoElement.addEventListener("timeupdate", function(event){
                var newTime = videoElement.currentTime;
                var timeDiff = newTime - lastUpdatedTime;
                console.log(videoElement.duration +'bbbmmmmmm>>>>>');
                console.log(videoElement.currentTime+'>>>>>vvvv');
                
                var watchtime = parseInt(videoElement.currentTime); 
                 console.log(watchtime+'watchhhhh');
                
                if(watchtime >= 1){
                    if(videoId =="myvideo0" || videoId =="myvideo1" ){
                        
                    }else{    
                        var video = document.getElementById("myVideoPlayer");
                       
                        @if($curricul_branch_sub=='true')
                        
                      
                        @elseif($curricul_branch_sub=="null")
                            videoElement.pause();
                            document.getElementById(video_error_message).innerText = 'انت غير مشترك في هذا الفرع....    يجب عليك الذهاب للفرع التي قمت بالاشتراك به لمشاهده جميع الفيديوهات كاملة';
                            document.getElementById(video_error_message).style.display = 'block';
                        @elseif($curricul_branch_sub=="nulll" )
                            videoElement.pause();
                            document.getElementById(video_error_message).innerText = 'انت غير مشترك ....    يجب عليك عمل اشتراك  لمشاهده جميع الفيديوهات كاملة';
                            document.getElementById(video_error_message).style.display = 'block';
                        @endif
                    }    
                    
                   
                    
                    
                    
                    
                }else{
                    // $('.'+hidden_message).hide();
                    document.getElementById(video_error_message).style.display = 'none';
                }
                $.ajaxSetup({
                  headers: {'X-CSRF-Token': '{{csrf_token()}}'}
                });
                var formData = new FormData();
                formData.append('videoid', id);
                formData.append('watchtime', watchtime);
                formData.append('userid', userid);
                formData.append('courseId', "{{ $details->id }}");
                $.ajax({
                    url: "{{route('save_new_whach_curriculums')}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                      console.log(data+'hamadadata>>>>>>>>>>>>>>>>>>>>><<<<'+id);
                    }
                })

            });
        }
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            $.ajax({
                    type: 'GET',
                    url: "{{url('allwatch_curriculums')}}/",
                    success: function (response) {
                        console.log(response);   
                    }
            });

        });
        
        
        
        
    </script>
    
    <!-- end course details -->
@endsection
