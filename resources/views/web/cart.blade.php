@extends('layout.web_main')
@section('content')
@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $locale=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $locale=app()->getLocale();
    }
@endphp 
    <style type="text/css">
        @if($locale == 'ar')
            .containerwow{
                text-align: right;
            }
        @endif
    </style>
    <main class="" id="cart">
        <div class="containerwow fadeIn" style="padding-top: 1.5em;">
            <h3 class="my-5 h3 text-center">الدفع</h3>
            <div class="row">
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <form id="payment-form" action="process_payment.php" accept-charset="UTF-8" method="POST" class="card-body text-right">
                            <div id="card-element">
                                <div class="field-row my-4">
                                   <img src="asset/logo_band_colored2x.png" height="30px"><br>
                            </div>
                                <div class="field-row my-4">
                                    <label>الاسم الموجود على البطاقة</label> <span id="card-holder-name-info" class="info"></span><br>
                                    <input class="form-control" type="text" id="name" name="name" required="">
                                </div>
                                
                                <div class="field-row my-4">
                                    <label>رقم البطاقة</label> <span id="card-number-info" class="info"></span><br>
                                    <input type="text" class="form-control" id="card-number" name="cardnumber" required="">
                                </div>
                                <div class="field-row my-4">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="contact-row cvv-box">
                                                <label>CVC</label> <span id="cvv-info" class="info"></span><br>
                                                <input class="form-control" type="text" name="source[cvc]" id="cvc" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>(شهر) تاريخ انتهاء البطاقة</label>
                                            <input type="text" class="form-control" name="source[month]" id="month" placeholder="MM" required="">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>(سنة) تاريخ انتهاء البطاقة</label>
                                            <input type="text" class="form-control" name="source[year]" id="year" placeholder="YY" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="field-row my-4" dir="rtl">
                                    <label>الايميل</label> <span id="email-info" class="info"></span><br>
                                    <input type="email" id="email" class="form-control" name="email" required="">
                                </div>                                                             
                                
                                <hr>
                                <div id="card-errors" role="alert"></div>
                                <div>
                                    <button type="submit" class="btn btn-primary form-control my-4" id="buttontn" disabled="disabled"> تأكيد </button>
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4 class="modal-title">  </h4>
                                                    </div>
                                                    <div class="modal-body">  شكرا لثقتكم </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal"> المزيد من الكتب</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div id="loader" class="text-center d-none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="0">
                                <input type="hidden" name="callback_url" value="https://www.my-store.com/payments_redirect">
                                <input type="hidden" name="publishable_api_key" value="`your publishable api key here`">
                                <input type="hidden" name="source[type]" value="creditcard">
                                <input type="hidden" name="description" value="Order id 1234 by guest">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 mb-4" >
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">السلة</span>
                        <span class="badge badge-primary badge-pill">2</span>
                    </h4>
                    <ul class="list-group mb-3 z-depth-1">
                        @foreach ($carts as $_item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{$_item->book->name}}</h6><br>

                                <!-- <p class="my-0"> {{$_item->category->title}}</p> -->
                                <h6 class="">السعر : {{$_item->book->price}}</h6>
                            </div>
                           
                            <div class="row">
                                <span class="delete">
                                <form method="post" action="{{route('cart.delete')}}">
                                    @csrf
                                        <input type="hidden" name="id" value="{{$_item->id}}" >
                                            <button  type="submit" class="btn ">
                                                <i class="far fa-trash-alt"></i> 
                                            </button>
                                </form>
                            </span>  
                            </div>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>السعر الاجمالي (دولار)</span>
                            <p id="total"> {{$sum}} </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
   
    
@endsection