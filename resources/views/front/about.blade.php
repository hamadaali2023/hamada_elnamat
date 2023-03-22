

@extends('layout.front_main')
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
     <!-- start banner -->
    <section class="about-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>من نحن</h2>
                </div>
            </div>
        </div>
    </section>
     <!-- end banner -->

    <!-- start about -->
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <img src="{{asset('front/img/about us.jpeg')}}" class="img-fluid">
                </div>

                <div class="col-md-6 mt-3">
                    <h6 class="font-weight-600 text-dark">{{__('front.about us')}}</h6>
                    @if($langg == 'ar')
                        {!! $contact->description_ar !!}
                    @else
                        {!! $contact->description_en !!}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- end about -->

@endsection