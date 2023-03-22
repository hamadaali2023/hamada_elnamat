@extends('layout.web_main')
@section('content') 

@php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

@if($langg == 'ar')
   <style type="text/css">
    .book-title{
        text-align: right;
    }
    </style>

@endif
<h5 class="booksTitle"> </h5> 
<section >
    
        <div class="row col-md-12">
                <div class="col-md-4 ">    
                    <img src="{{asset('img/books/'.$details->photo) }}" class="img-fluid" alt="" 
                    style="height: 350px; width: 350px">
                </div>
                <div class="col-md-6 book-title" >                    
                        <p  class=" font-weight-bold"> {{$details->name}}</p>
                        <div class="mb-3">
                            <a style="font-size: 20px;">
                                <span class="">  المذاكرة وقوة الحفظ </span>
                            </a>
                        </div>
                        <div class="">
                            <h5 class="">{{$details->date}}</h5>
                        </div><span>السعر: {{$details->price}}دولار </span>
                         <br><br/>  
                        <form class="d-flex ">
                            <button id="addCart" class="btn btn-primary btn-md my-0 p" type="button" onclick="addToCart('607f581f512e813e30457542')">الاضافة الى السلة
                                    <i class="fas fa-shopping-cart ml-1"></i>
                            </button>
                            
                        </form>
                    
                </div>
        </div>
        <hr>
        <div class="row d-flex justify-content-center wow fadeIn">
            <div class="col-md-8 text-center">
                    <h4 class="my-4 h4"> وصف الكتاب </h4>                    
                    <p> 
                        {{$details->description}}
                    </p>
            </div>
        </div>
        <hr>
        <!--<div class="row d-flex justify-content-center wow fadeIn" id="author-info">-->
        <!--        <div class="col-md-6 text-center">-->
        <!--            <h4 class="my-4 h4"> معلومات عن الكاتب  </h4>-->
        <!--            <img class="my-4 h4" src="%D8%A7%D9%84%D9%85%D9%84%D8%AE%D8%B5%20%D9%81%D9%8A%20%D8%A7%D9%84%D9%86%D8%AD%D9%88%20%D9%88%D8%A7%D9%84%D8%B5%D8%B1%D9%81_files/product_003.htm">-->
        <!--            <p class="my-4 bold"> مجدي حجاج </p>-->
        <!--            <h5 class="my-4"> نبذه عن الكاتب </h5>-->
        <!--            <p class="my-4 bold"> أستاذ اللغة العربية والخط العربي. شاعر فصحى. مدقق لغوي. </p>-->
        <!--            <h5 class="my-4"> اعمال الكاتب </h5>-->
        <!--            <p class="my-4 bold">  </p>                    -->
        <!--        </div>-->
        <!--</div>-->
        <hr>
        <!--<div class="row d-flex justify-content-center wow fadeIn">-->
        <!--        <div class="col-md-6 text-center">-->
        <!--            <h4 class="my-4 h4"> كتب اخرى من الكاتب </h4>-->
        <!--            <ul>-->
        <!--                <li style="display:inline; "> <img style="height: 170px; width: 120px; cursor: pointer;" src="%D8%A7%D9%84%D9%85%D9%84%D8%AE%D8%B5%20%D9%81%D9%8A%20%D8%A7%D9%84%D9%86%D8%AD%D9%88%20%D9%88%D8%A7%D9%84%D8%B5%D8%B1%D9%81_files/magdyhagagmmgmail.jpg" onclick="viewBook('607f581f512e813e30457542')"> </li>                    </ul>-->
        <!--        </div>-->
                <!--Grid column-->
        <!--</div>-->
        <div class="row wow fadeIn">
        </div>
    
</section>




@endsection
