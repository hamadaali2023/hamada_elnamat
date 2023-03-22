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
      <h5 class="booksTitle"> </h5> 
        <section id="privacy" class=" " dir="rtl">        
            
        <div class=" text-center">
            <!--<h1>سياسة الخصوصية</h1>-->
        </div>
        <div class="container">
      
            <!--<p>  </p><h5> التزامات حسابك </h5> <p></p>-->
             @if($langg == 'ar')
                    {!! $contact->privacy_ar !!}
                @else
                    {!! $contact->privacy_en !!}
                @endif
            
        </div>

    </section>

@endsection
