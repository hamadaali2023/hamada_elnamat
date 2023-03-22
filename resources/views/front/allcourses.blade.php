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


    
    
       <section class="featured-courses">`
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        <!-- Featured Categories -->
                    </h6>
                </div>
            </div>
            <div class="row">
                    @if(!$courses_result->isEmpty())
                         @foreach ($courses_result as $_item)
                            <div class="col-14 col-lg-3 col-md-6">
                            <div class="featured-courses">
                                <!-- start features box item -->
                                <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">
                                    <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">
                                </a>
                                <a href="{{url('courses/'.$_item->slug.'/'.$_item->id)}}">
                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->instructor->name}}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                           <!--  <i class="fas fa-money-bill-alt"></i>
                                            <span>1000 EGP</span> -->
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
                                                                <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>
                                                                
                                                            @else            
                                                               <i class="fas fa-heart pr-2"></i>
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
                        @else
                            <p class="#course- text-extra-dark-gray font-weight-600 title-bg text_center" >
                               <!--No Results Courses-->
                               حالياً لا يوجد دورات في هذا الاختصاص ،،،،  انتظر سوف يتم اضافة دورات لهذا الاختصاص قريباً
                            </p>
                        @endif
            </div>
        </div>
        </div>
    </section>
    <!-- <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                        Results Courses
                    </h6>

                </div>
            </div>
            <div class="row">
                <div class="swiper-slider-clients swiper-container">
                    <div class="swiper-wrapper">
                        @if(!$courses_result->isEmpty())
                         @foreach ($courses_result as $_item)
                        <div class="swiper-slide">
                            <div class="featured-courses">
                                <a href="{{url('courses/'.$_item->slug)}}">
                                    <img src="{{asset('assets_admin/img/courses/'.$_item->image) }}" class="img-fluid">
                                </a>
                                <a href="{{url('courses/'.$_item->slug)}}">
                                    <div class="bg-light">
                                        <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->date}}</span>
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
                        @endforeach
                        @else
                            <p class="#course- text-extra-dark-gray font-weight-600 title-bg text_center" >
                               No Results Courses
                            </p>
                        @endif                       
                    </div>
                    <div class="swiper-pagination d-none"></div>
                    <div class="swiper-button-next slider-long-arrow-white"></div>
                    <div class="swiper-button-prev slider-long-arrow-white"></div>
                </div>
            </div>
        </div>
    </section> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    		
            
            
            
           
        </script>
@endsection

