
<!--    @extends('layout.front_main')-->
<!--@section('content') -->


<!--@php  -->
<!--    use Stichoza\GoogleTranslate\GoogleTranslate;-->
    
<!--    if(session()->get('locale')){-->
<!--        $tr = new GoogleTranslate(session()->get('locale')); -->
<!--        $langg=session()->get('locale');-->
<!--    }else{-->
<!--        $tr = new GoogleTranslate(app()->getLocale()); -->
<!--        $langg=app()->getLocale();-->
<!--    }-->
<!--@endphp -->


<!--@if($langg == 'ar')-->
   
<!--@else-->
<!--    <style type="text/css">-->
<!--        .agree_inst{-->
<!--            direction: ltr;-->
<!--        }-->
<!--    </style>-->
<!--@endif-->
<!--    <section class="form-section">-->
<!--        <div class="container">-->
<!--            <div class="row justify-content-center">-->

<!--                <div class=" col-md-12">-->
<!--                    <h12> {{__('front.sign up and start learning')}}</h6>-->
<!--                    <hr>-->
<!--                    <form method="post" action="{{url('send-info')}}" enctype="multipart/form-data">-->
<!--                                @csrf-->
                              
<!--                            <input type="hidden" name="courseId"  value="{{ $courses->id }}">-->
<!--                        <div class="row">-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.first_name')}}</label>-->
<!--                            <input type="text" class="form-control"  value="{{ $user->first_name }}" placeholder="{{__('front.first_name')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>-->
                        
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.last_name')}}</label>-->
<!--                                <input type="text" class="form-control" value="{{ $user->last_name }}" placeholder="{{__('front.last_name')}}" >    -->
<!--                            </div>-->
<!--                        </div>    -->
                       
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.email')}}</label>-->
<!--                            <input type="email" value="{{ $user->email }}" class="form-control" placeholder="{{__('front.email')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>-->
                       
<!--                       <div class="col-md-4"> -->
<!--                        <div class="form-group">-->
<!--                            <label >{{__('front.select country')}}</label>-->
<!--                            <select name="countryId" class="form-control"  disabled>-->
<!--                                <option  disabled selected>{{__('front.select country')}}</option>  -->
<!--                                @foreach ($countries as $_item) -->
<!--                                <option value="{{$_item->id}}"  {{  ($user->countryId == $_item->id ? ' selected' : '') }}>{{$_item->name}}</option>-->
                                                                
<!--                                @endforeach-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4"> -->
<!--                            <div class="form-group">-->
<!--                                 <label >{{__('front.city')}}</label>-->
<!--                                <input type="text" class="form-control" value="{{ $user->city }}" placeholder="{{__('front.city')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.state')}}</label>-->
<!--                                <input type="text" class="form-control"  value="{{ $user->state }}" placeholder="{{__('front.state')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.street1')}}</label>-->
<!--                                <input type="text" class="form-control" value="{{ $user->street1 }}" placeholder="{{__('front.street1')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-md-4">-->
<!--                            <div class="form-group">-->
<!--                                <label >{{__('front.street1')}}</label>-->
<!--                                <input type="number" class="form-control" value="{{ $user->postal_code }}" placeholder="{{__('front.postal code')}}" disabled>-->
<!--                            </div>-->
<!--                        </div>    -->
<!--                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4"   >{{__('front.next')}}</button>-->
<!--                    </form>-->
<!--                    <hr>-->
                   
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
   



<!--@endsection-->
