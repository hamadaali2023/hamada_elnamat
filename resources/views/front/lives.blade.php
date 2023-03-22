@extends('layout.front_main')
@section('content') 
    <!-- start featured-courses -->
    <br><br><br>

  <link rel="stylesheet" href="{{asset('front/css/search.css')}}" />


    <section class="courses-banner" style="height:258px;padding-top:120px;">

        <div class="container">

            <div class="row">
                <form method="GET"  action="get-search-course" >
                    <fieldset>
                        <legend>الدورات الأون لاين</legend>
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
                    @if(!$straights->isEmpty())
                         @foreach ($straights as $_item)
                            <div class="col-14 col-lg-3 col-md-6">
                            <div class="featured-courses">
                                <!-- start features box item -->
                                <a href="{{url('lives/'.$_item->slug.'/'.$_item->id)}}">
                                    <img src="{{asset('assets_admin/img/livecourses/'.$_item->image) }}" class="img-fluid">
                                </a>
                               
                                    <div class="bg-light">
                                         <a href="{{url('lives/'.$_item->slug.'/'.$_item->id)}}"><p class="text-dark font-weight-bold mb-2"> {{$_item->title}}</p></a>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>{{$_item->date}}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                        <i class="fas fa-money-bill-alt"></i> 
                                        <span>
                                            @if($_item->price !=0)
                                            <b> رسوم الدورة :</b> {{$_item->price}} دولار
                                            @else
                                             <b>رسوم الدورة: </b> 
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
    
@endsection

