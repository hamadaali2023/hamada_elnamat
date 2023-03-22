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
    <section id="privacy" class="" >
        @if($langg == 'ar')
            {!! $contact->return_ar !!}
        @else
            {!! $contact->return_en !!}
        @endif
    </section>

@endsection

