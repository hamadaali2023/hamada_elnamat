


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

    <!-- start Terms of use -->
    <section class="form-section">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h5 class="text-dark font-weight-600">{{__('front.terms of User')}}</h5>
                    <hr>
                    @if($langg == 'ar')
                        {!!$contact->terms_ar!!}
                        <!-- {!! $contact->terms_ar !!} -->
                    @else
                        <!--  {!! $contact->terms_en !!} -->
                        {{!!$contact->terms_en !!}
                    @endif
                </div>





            </div>
        </div>
    </section>
    <!-- end Terms of use -->


    @endsection