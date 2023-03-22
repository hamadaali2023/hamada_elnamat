

@extends('layout.front_main')
@section('content') 


    <?php
        $createCertificateRenew= Session::get('payCreateOrCertificateOrRenew');
    ?>
    <!-- start contact -->
    <section class="form-section contact-form" style="direction: ltr">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h6>إتمام عملية الدفع</h6>
                    <p>تستطيع اتمام عملية الدفع اذا كان لديك بطاقة بنكية من نوع فيزا كارد أو ماستر كارد صادرة من أحدى الدول التالية فقط : الاردن ، السعودية ، قطر ، البحرين ، الكويت، سلطنة عمان، الامارات العربية المتحدة، مصر ، فلسطين ، تونس ، المغرب ، العراق</p>
                    <p> من أي مكان في العالم paypal أو عن طريق </p>                    
                    <!--<div class="form-group">-->
                    <!--    <div class="form-check">-->
                    <!--        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>-->
                    <!--        <label class="form-check-label" for="flexRadioDefault1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; اشتراك شهري سبعة (7)دولار-->
                    <!--        </label>-->
                    <!--    </div>-->
                    <!--    <div class="form-check">-->
                    <!--          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >-->
                    <!--        <label class="form-check-label" for="flexRadioDefault2">-->
                    <!--           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; اشتراك سنوي سبعين (70)دولار-->
                    <!--        </label>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <hr>
                    <div id="">
                        <script src="https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId={{$res['id']}}"></script>
                        <form action="{{route('checkout')}}" class="paymentWidgets" data-brands="VISA MASTER PAYPAL"></form>
                    </div>
                    
                </div>
                 
            </div>
            <div class="row justify-content-center">
                 <div class="col-md-8">
                     <hr/>
                     <img src="{{asset('assets_admin/img/settings/zaincash.png') }}" width="105px">
                    <p>
                          للدفع من داخل الاردن عن طريق زين كاش على الرقم: 0795144553
                    <br>
                        بعد اتمام الدفع ارسل اسمك وبريدك الالكتروني واتس اب على نفس الرقم لتفعيل الحساب
                    </p>
                    
                 </div>
            </div>
            <div class="row justify-content-center">
                 <div class="col-md-8">
                    <hr/>
                     <img src="{{asset('assets_admin/img/settings/vodafoncash.png') }}" width="105px">
                    <p>
                        للدفع من داخل مصر عن طريق فودافون كاش على الرقم: 01003975502
                    <br>
                         بعد اتمام الدفع ارسل اسمك وبريدك الالكتروني واتس اب على رقم (0795144553)  لتفعيل الحساب
                    </p>
                 </div>
                
            </div>
            
        </div>
    </section>
        <!-- end contact -->


@endsection

@section('hamada')

    <script>
        // $(document).on('click', '#checkout', function (e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: 'get',
        //         url: "",
        //         data: {
        //             price: $('#price').text(),
        //         },
        //         success: function (data) {

        //             if (data.status == true) {
        //                 console.log('truuuu');
        //                 $('#showPayForm').empty().html(data.content);
        //             } else {
        //                 console.log('falseee');
        //             }
        //         }, error: function (reject) {
        //         }
        //     });
        // });
    </script>
@stop