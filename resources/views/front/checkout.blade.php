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
    <section class="form-section contact-form" style="direction: ltr">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h6>دفع الاشتراك الشهري</h6>
                    <hr>
                     <div class="col-md-12 mb-4">
                                <h6>اختر وسيله الدفع المناسبه</h6>
                                @if(isset($success))
                                   <div class="alert alert-success text-center">
                                          تم الدفع بنجاح
                                   </div>
                                @endif
                                @if(isset($fail))
                                    <div class="alert alert-danger text-center">
                                        فشلت عملية الدفع
                                    </div>
                                @endif
                            </div>
                    <!-- <button type="submit" class="w-100 btn header-btn text-large font-weight-bold">
                            <a href="{{route('get-checkout')}}"
                               role="button" class="btn btn-success px-3 waves-effect waves-light"> شراء المنتج
                            </a>
                        </button> -->


                        
                    <!-- <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="الاسم الموجود على البطاقة">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="رقم البطاقة">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="CVC">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="(سنة) تاريخ انتهاء البطاقة">
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-4">
                                <h6>اختر وسيله الدفع المناسبه</h6>
                                <div id="showPayForm"></div>
                                @if(isset($success))
                                   <div class="alert alert-success text-center">
                                          تم الدفع بنجاح
                                   </div>
                                @endif

                                @if(isset($fail))
                                    <div class="alert alert-danger text-center">
                                        فشلت عملية الدفع
                                    </div>
                                @endif
                            </div>

                        </div>
                        <button type="submit" class="w-100 btn header-btn text-large font-weight-bold">
                            <a id="checkout" 
                            href="{{route('get-checkout')}}"
                               role="button" class="btn  btn-success px-3 waves-effect waves-light"> شراء المنتج
                            </a>
                        </button>
                        
                    </form> -->
                </div>
            </div>
        </div>
    </section>
        <!-- end contact -->
@endsection

@section('hamada')

    <script>
        $(document).on('click', '#checkout', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{route('get-checkout')}}",
                data: {
                    price: $('#price').text(),
                },
                success: function (data) {

                    if (data.status == true) {
                        console.log('truuuu');
                        $('#showPayForm').empty().html(data.content);
                    } else {
                        console.log('falseee');
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop