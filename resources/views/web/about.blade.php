@extends('layout.web_main')
@section('content') 

@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $langg=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $langg=app()->getLocale();
    }

@endphp 
        

@if($langg == 'ar')
    <style type="text/css">
        #privacy, #about{
            text-align: right; 
        }     
    </style>
@else
@endif



<section id="about">
    <div class="container">
        <div data-aos="zoom-out">
                <!--<h2> عن منصة كوتبانه</h2>-->
        </div>
        <div class="row">
            <div class="col-lg-8">
                @if($langg == 'ar')
                    {!! $contact->description_ar !!}
                @else
                    {!! $contact->description_en !!}
                @endif

            </div>
            <div class="col-lg-4 order-1 order-lg-2 about-img">
                    <img src="{{asset('web/asset/books.jpeg')}}">
                    <!-- <video controls="controls" width="400">
                        <source src="%D8%B9%D9%86%20%D9%83%D9%88%D8%AA%D8%A8%D8%A7%D9%86%D9%87_files/vidohelp.mp4" type="video/mp4">
                    </video>  -->
                
            </div>
        </div>
    </div>
</section>
@endsection
