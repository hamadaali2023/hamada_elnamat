

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
    <!-- start contact -->
    <section class="form-section contact-form">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <h6>{{__('front.Keep touch')}}</h6>
                    <hr>
                     @if (session('message'))
                <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>خطا</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
            @endif

                    <!-- <form> -->
                    <form action="{{route('send_report')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf    

                        <div class="row">

                            <div class="col-md-6">
                            
                                <div class="form-group">
                                    <input  name="name" type="text" class="form-control" placeholder="الاسم">
                                </div>
                            </div>

                            <div class="col-md-6">
                            
                                <div class="form-group">
                                    <input  name="subject" type="text" class="form-control" placeholder="الموضوع">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" placeholder="البريد الإلكتروني">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input name="mobile" type="text" class="form-control" placeholder="أدخل رقم الهاتف مع رمز الدولة">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                   <textarea name="report" class="form-control" cols="30" rows="7">أكتب رسالتك</textarea>
                                </div>
                            </div>

                        </div>
                        

                        

                      
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold">إرسال الرسالة</button>
                    </form>
                </div>
                <div class="col-md-4">
                    <h6>{{__('front.contact information')}}</h6>
                    <hr>
                    <div class="row"><i class="fas fa-envelope"></i>&nbsp; {{$contact->email}}</div>
                    <br>
                    <div class="row"> <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;  {{$contact->phone}}</div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- end contact -->

@endsection