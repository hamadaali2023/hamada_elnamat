@extends('layout.front_main')
@section('content') 
    <br><br><br>
    <!--   <section class="featured-courses">`-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-12">-->
    <!--                <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">-->
    <!--                </h6>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--                @if(!$consultings->isEmpty())-->
    <!--                     @foreach ($consultings as $_item)-->
    <!--                        <div class="col-14 col-lg-3 col-md-6">-->
    <!--                        <div class="featured-courses">-->
    <!--                            <a href="{{url('lives/'.$_item->slug)}}">-->
    <!--                                <img src="{{asset('assets_admin/img/consultings/'.$_item->image) }}" class="img-fluid">-->
    <!--                            </a>-->
    <!--                            <a href="{{url('lives/'.$_item->slug)}}">-->
    <!--                                <div class="bg-light">-->
    <!--                                    <p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p>-->
    <!--                                    <div class="featured-date mb-2">-->
    <!--                                        <i class="fas fa-calendar-alt"></i>-->
    <!--                                        <span>مدة الاستشارة: {{$_item->duration}} دقيقة</span>-->
    <!--                                    </div>-->
    <!--                                    <div class="featured-date mb-2">-->
    <!--                                         <i class="fas fa-money-bill-alt"></i>-->
    <!--                                        <span>1000 EGP</span> -->
    <!--                                    </div>-->
    <!--                                                                    </a>-->

    <!--                                    <div class="row">-->
    <!--                                        <div class="col-7">-->
    <!--                                            <div class="mb-2">-->
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
    <!--                                        <div class="col-5">-->
    <!--                                            <div class="featured-buttons mb-4">-->
    <!--                                                <form action="{{route('user.addfavorite')}}" method="POST">-->
    <!--                                                    @csrf-->
    <!--                                                    <input type="hidden" name="courseId" value="{{$_item->id}}"> -->
    <!--                                                    <button type="submit">-->
    <!--                                                        @if($_item->user_favorite == 'true')-->
    <!--                                                            <a href="#" class="fav-icon"><i class="fas fa-heart"></i></a>-->
    <!--                                                        @else            -->
    <!--                                                           <i class="fas fa-heart pr-2"></i>-->
    <!--                                                        @endif-->
    <!--                                                    </button>-->
    <!--                                                </form>-->
    <!--                                                </div>-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                        </div>-->
    <!--                        </div>-->
    <!--                    @endforeach-->
    <!--                    @else-->
    <!--                        <p class="#course- text-extra-dark-gray font-weight-600 title-bg text_center" >-->
    <!--                           حالياً لا يوجد دورات في هذا الاختصاص ،،،،  انتظر سوف يتم اضافة دورات لهذا الاختصاص قريباً-->
    <!--                        </p>-->
    <!--                    @endif-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    </div>-->
    <!--</section>-->
    

<!--//////////////////////////////////////////////////////-->
<!--///////////////////////////////////////////////////////-->


    
  <link rel="stylesheet" href="{{asset('front/css/search.css')}}" />


    <section class="courses-banner" style="height:258px;padding-top:120px;">
        <div class="container">
            <div class="row">
                <form method="GET" action="get-search-course" >
                    <fieldset>
                        <legend>الاستشارات </legend>
                    </fieldset>
                </form>
            </div>
        </div>
    </section>


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

    <section class="courses-slider">
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
                    
                    <ul class="nav nav-tabs  text-uppercase text-small text-center font-weight-600 justify-content-center">
                        
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryنفسية" data-toggle="tab"  id="نفسية" onClick="getcourses(this.id)">نفسية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryتربوية" data-toggle="tab"  id="تربوية" onClick="getcourses(this.id)">تربوية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryأسرية" data-toggle="tab"  id="أسرية" onClick="getcourses(this.id)">أسرية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryإدارية ومالية" data-toggle="tab"  id="إدارية ومالية" onClick="getcourses(this.id)">إدارية ومالية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryقانونية" data-toggle="tab"  id="قانونية" onClick="getcourses(this.id)">قانونية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryتنمية بشرية " data-toggle="tab"  id="تنمية بشرية" onClick="getcourses(this.id)">تنمية بشرية
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryتغذية ورجيم" data-toggle="tab"  id="تغذية ورجيم" onClick="getcourses(this.id)">تغذية ورجيم
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryبحث علمي" data-toggle="tab"  id="بحث علمي" onClick="getcourses(this.id)">بحث علمي
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#categoryتقنية وفنية" data-toggle="tab"  id="تقنية وفنية" onClick="getcourses(this.id)">تقنية وفنية
                            </a>
                        </li>
                         
                    </ul>
                    <!-- end tab navigation -->
                </div>
            </div>

            <div class="mt-4">
                <div class="tab-content">                    
                    <!-- start tab content -->
                    <div class="tab-pane med-text fade in active show" id="tab_sec1">
                        <div class="row featured-courses" id="courses">
                            
                            <!-- @foreach ($consultings as $_item)
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



@if(!$consultings->isEmpty())  
     <section class="featured-courses">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                          <!--الاستشارات المضافة حديثا-->
                          جميع الاستشارات
                    </h6>
                </div>
            </div>
       
            <div class="row">
                @foreach ($consultings as $_item)
                    <div class="col-md-3">
                        <div class="featured-courses featured-courses-home consulting-section">
                            <a href="{{url('consultings/'.$_item->id)}}">
                                <img src="{{asset('assets_admin/img/consultings/'.$_item->image) }}" class="img-fluid">
                            </a>
                                <div class="bg-light">
                                    <a href="{{url('consultings/'.$_item->id)}}">
                                        <p class="text-dark font-weight-bold mb-2">  {{ $_item->title }}</p>
                                    </a>
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span><b>مدة الاستشارة:</b> {{$_item->duration}} دقيقة</span>
                                    </div>
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i> 
                                        <span>
                                            @if($_item->price !=0)
                                            <b> رسوم الاستشارة :</b> {{$_item->price}} دولار
                                            @else
                                             <b>رسوم الاستشارة: </b> 
                                                مجاني
                                            @endif
                                        </span> 
                                    </div>
                                    <div class="featured-date mb-2">
                                        <i class="fas fa-user"></i>
                                        <span>
                                            <b> المدرب الخبير:</b>
                                        {{$_item->instructor->name}} </span>
                                    </div>

                                       
                                       
                                    </div>
                                
                                <!-- end features box item -->
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
          
    </section>
@endif
 
    
   

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
        <script type="text/javascript">

            function getcourses(categoryId)
            {
                    // alert(categoryId);
                    
                    // var query = $(this).val(); 
                    console.log(categoryId);
                    $.ajax({
                        url:"{{ route('getconsultings') }}",
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
                                    if(element['price']==0){
                                        var price='مجاني';
                                    }else{
                                        var price=element['price'];
                                    }
                                    var courserate=element['rate'];
                                    console.log("hamada "+courserate); 
                                    $('#courses').append(`
                                        <div class="col-12 col-lg-3 col-md-6">
                                            <a href="consultings/${element['id']}">
                                                <img src="assets_admin/img/consultings/${element['image']}" class="img-fluid">
                                            </a>
                                            <a href="consultings/${element['id']}">
                                                <div class="bg-light">

                                                    <p class="text-dark font-weight-bold mb-2"> ${element['title']}</p>

                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>مدة الاستشارة:${element['duration']} دقيقة</span>
                                                    </div>
                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-money-bill-alt"></i> 
                                                        <span>
                                                       
                                                             رسوم الاستشارة:
                                                             ${price}
                                                            دولار
                                                        </span> 
                                                    </div> 
                                                    

                                          </a>
    

                                    <div class="row">
                                            
                                            <div class="col-7">
                                                
                                                 
                                                
                                            </div>
                                            
                                            <div class="col-5">
                                                 
                                         
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



