
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
                            <li><a href="#">Courses</a></li>
                            <li><a href="#">{{$category->title}}</a></li>
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

                    <p>Created by <a href="#" class="instructor_link">{{$user->name}}</a> 
                        <span class="text-small text-light">( {{$country->nicename}})</span></p>

                    <span class="mr-5"><i class="fas fa-exclamation-circle"></i> Last updated {{$details->updated_at}}</span>

                    <!-- <span><i class="fas fa-globe"></i> English</span> -->

                    <p class="mt-4">
                        <a href="#" class="btn btn-outline-light mr-2"> <i class="fas fa-heart"></i> Wishlist</a>

                        <a href="#" class="btn btn-outline-light mr-2"> <i class="fas fa-share"></i> Share</a>

                        <a href="#" class="btn btn-outline-light">Gift this course</a>

                    </p>


                </div>

                <div class="col-md-3 course-details-white">

                    <div class="image-container2 popup-gallery">
                        <!-- <a class="video" href="https://www.youtube.com/watch?v=WvhQhj4n6b8"> -->
                        <a class="video" href="http://localhost:8000/assets_admin/img/courses/videos/20211020144524.mp4">   

                            <div class="image-overlay">
                                <h6><i class="fas fa-play-circle"></i></h6>
                                <p>Preview this course</p>

                            </div>

                            <img src="{{asset('assets_admin/img/courses/'.$details->image) }}">
                        </a>
                    </div>
                    <div class="course-desc" id="course-desc">
                        <h5>1000 $  <small>monthly</small></h5> 
                        <p class="text-danger"><i class="fas fa-stopwatch"></i> 2 days left at this price!
                        </p>
                        @if($subscriptions==null)
                              <a href="#" class="btn header-btn w-100">Subscribe to watch all course</a>
                        @else
                              <p class="btn header-btn w-100">subscriber</p>
                        @endif
                      

                        <ul class="p-0 pt-4">
                            <h6>This subscription includes:</h6>
                            <li class="row">
                                <div class="col-1"><i class="fab fa-youtube"></i></div>
                                <div class="col-10">
                                    <p>Watch all the courses on the platform at any time and without limits </p>
                                </div>
                            </li>
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
                            <li class="row">
                                <div class="col-1"><i class="fas fa-infinity"></i></div>
                                <div class="col-10">
                                    <p>Course duration {{$details->duration}} hours</p>
                                </div>
                            </li>
                           
                            <li class="row">
                                <div class="col-1"><i class="fas fa-certificate"></i></div>
                                <div class="col-10">
                                    <p> Certificate of completion</p>
                                </div>
                            </li>
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
                        <h6>Requirements
                        </h6>

                        <ul class="pl-4">
                            <li>{{$details->requirement}}
                                

                            </li>
                        </ul>
                    </div>








                    <div class="col-12 mt-5">
                        <h6 class="mb-2">Course Content</h6>

                        <small>4 sections • 4 lectures • 00h 33m total length
                        </small>

                        <div class="accordion course-content mt-3" id="accordionExample">

                            


                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <ul class="list-group">
                                        @foreach ($videos as $key =>$video)
                                        <li class="list-group-item">
                                            <a href="#" data-toggle="modal"
                                                          data-target="#large{{$key}}" onClick="viewvideo('myvideo{{$key}}',{{$video->id}},{{$user->id}})">
                                                <div class="row">

                                                    <div class="col-9 main-color">
                                                        <p> <i class="fas fa-play-circle pr-2"></i> Oracle Database
                                                            tutorials 1 </p>
                                                    </div>

                                                    <div class="col-3 text-right">
                                                        <p>6 min</p>
                                                    </div>

                                                </div>
                                            </a>
                                        </li>
                                        <div class="modal fade text-left" id="large{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
                                                          aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <video id="myvideo{{$key}}" controls  width="300">
                                                                <source src="{{asset('assets_admin/img/courses/'.$video->url) }}" type="video/mp4" >
                                                            </video>        
                                                        <div id="timeee"></div>
                                                            <div id="video_counter"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>


                          
                          






                        </div>

                    </div>








                    <div class="col-12 mt-5">
                        <h6 class="mb-2">Course Content</h6>
                        <small>4 sections • 4 lectures • 00h 33m total length
                        </small>
                       <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($videos as $key =>$video)
                                       

                                            <li class="list-group-item">
                                                <a href="#">
                                                    <div class="row">
                                                        
                                                        <a  class="btn btn-outline-success block btn-lg" data-toggle="modal"
                                                          data-target="#large{{$key}}" onClick="viewvideo('myvideo{{$key}}',{{$video->id}},{{$user->id}})">
                                                           {{$video->name}}
                                                        </a>
                                                        <div class="modal fade text-left" id="large{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
                                                          aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                              <div class="modal-content">
                                                                <video id="myvideo{{$key}}" controls  width="300">
                                                                  <source src="{{asset('assets_admin/img/courses/'.$video->url) }}" type="video/mp4" >
                                                                </video>
                                                                
                                                                <div id="timeee"></div>
                                                                <div id="video_counter"></div>
                                                              </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                  
                                </div>
                        
                        

                    </div>

                    <div class="col-12 mt-5">
                        <h6>Description
                        </h6>

                        <p>{{$details->detail}}
                           

                        </p>
                    </div>

                    <div class="col-12 mt-5">
                        <h6>Recently Added Courses

                        </h6>

                        
                        @foreach($recently_courses as $key =>$_item)
                        <div class="row mb-4">

                            <div class="col-lg-7 col-md-6 col-12">
                                <div class="row">

                                    <div class="col-lg-4 col-sm-4 col-5">
                                        <div class="course-img">
                                            <a href="#">
                                                <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-8 col-7">
                                        <div class="course-name">
                                            <a href="#">
                                                {{$_item->title}}
                                            </a>
                                        </div>
                                        <div class="course-update">Last Updated {{$_item->date}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-1 col-4">
                                <div class="course-user">
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-user"></i></li>
                                        <li>0</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-4">

                                <div class="course-currency text-right">
                                    <ul class="list-unstyled">
                                        <li class="rate">500 L.E</li>
                                        <li class="rate"><s>1000 L.E</s></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-2 col-4">
                                <div class="course-rate text-right">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="heart">
                                                <!-- <a href="#" title="heart">
                                                    <i class="far fa-heart"></i>
                                                </a> -->
                                                <form action="{{route('user.addfavorite')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="courseId" value="{{$_item->id}}">   
                                                        <button type="submit" style="background: white; border: white;">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="col-12 mt-5">
                        <h6>About the Instructor

                        </h6>

                        <div class="row">
                            <div class="col-md-2 mb-4">
                                <img src="{{asset('img/profiles/'.$user->photo) }}" class="rounded-circle instructor-img">
                            </div>
                            <div class="col-md-10">
                                <h6 class="font-weight-normal mb-2"><a href="#" class="main-color">{{$user->name}}
                                    </a></h6>
                                <p class="font-weight-bold  text-dark mb-2">About the Instructor
                                </p>
                                <p>
                                    {{$user->detail}} 

                                </p>
                            </div>
                        </div>

                        <!-- <div class="row justify-content-center">
                            <a href="#"><i class="fas fa-flag"></i> Report</a>
                        </div> -->
                    </div>
                </main> 
            </div>
        </div>
    </section>


    <script type="text/javascript">
        var userid=0;
        var videoid=0;
        var watchtime=0;
        function viewvideo(videoId,id,userid) {

            var videoElement = document.getElementById(videoId);
            var totalTimePlayed = 0;
            var lastUpdatedTime = 0;

            videoElement.addEventListener("timeupdate", function(event){
                var newTime = videoElement.currentTime;
                var timeDiff = newTime - lastUpdatedTime;
                console.log(videoElement.duration+'>>>>>');
                
                if (timeDiff > 0) {
                    totalTimePlayed += timeDiff;
                    document.getElementById("video_counter").innerText = totalTimePlayed;
                }
                lastUpdatedTime = newTime;
               
                    
                var watchtime = parseInt(videoElement.currentTime / 60);   
                console.log(watchtime);    
                document.getElementById("timeee").innerHTML= Math.round(videoElement.currentTime);
                
                $.ajaxSetup({
                  headers: {'X-CSRF-Token': '{{csrf_token()}}'}
                });
                var formData = new FormData();
                // formData.append('chapterid', chapterid);
                formData.append('videoid', id);
                formData.append('watchtime', watchtime);
                formData.append('userid', userid);
                $.ajax({
                    url: "{{route('save_new_whach')}}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                      console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<');
                    }
                })

            });
        }



        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            
            $.ajax({
                    type: 'GET',
                    url: "{{url('allwatch')}}/",
                    success: function (response) {
                        console.log(response);   
                    }
            });

        });
        
    </script>
    <!-- end course details -->
@endsection
