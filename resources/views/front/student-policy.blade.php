

@extends('layout.front_main')



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
@section('content') 

    <!-- start privacy policy -->
    <section class="form-section">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h5 class="text-dark font-weight-600">شروط المستخدم</h5>
                    <hr>

                    @if($langg == 'ar')
                        {!! $contact->agreements_student_ar !!}
                    @else
                        {!! $contact->agreements_student_en !!}
                    @endif




                </div>





            </div>
        </div>
    </section>
    <!-- end privacy policy -->
@endsection