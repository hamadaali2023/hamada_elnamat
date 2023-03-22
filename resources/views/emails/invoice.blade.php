<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}

<style>
    body {
    background: grey;
    margin-top: 120px;
    margin-bottom: 120px;

}
.bg-dark {
    background-color: #007bff!important;
}
@media print {
 /* styles go here */
 .row1{
    
 }
 .text-light ,.print,.PDF{
    display: none;

 }
 .card{

 }

}

@media (min-width: 768px)
{
    .container {
    max-width: 720px;
}
.col-md-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}

}
@media (min-width: 576px)
{
.container {
    max-width: 720px;
}
}
.text-right {
    text-align: right!important;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}
.p-4 {
    padding: 1.5rem!important;
}
.bg-dark {
    background-color: #007bff!important;
}
.text-white {
    color: #fff!important;
}
.pl-5, .px-5 {
    padding-left: 3rem!important;
}
.pb-3, .py-3 {
    padding-bottom: 1rem!important;
}
.pt-3, .py-3 {
    padding-top: 1rem!important;
}
.text-light {
    color: #f8f9fa!important;
}

.mb-5, .my-5 {
    margin-bottom: 3rem!important;
}
.mt-5, .my-5 {
    margin-top: 3rem!important;
}
.small, small {
    font-size: 80%;
    font-weight: 400;
}
.font-weight-bold {
    font-weight: 700!important;
}
.mb-1, .my-1 {
    margin-bottom: .25rem!important;
}

.pr-5, .px-5 {
    padding-right: 3rem!important;
}
.p-4 {
    padding: 1.5rem!important;
}
.d-flex {
    display: -ms-flexbox!important;
    display: flex!important;
}
.flex-row-reverse {
    -ms-flex-direction: row-reverse!important;
    flex-direction: row-reverse!important;
}

.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
.pb-5, .py-5 {
    padding-bottom: 3rem!important;
}
.p-0 {
    padding: 0!important;
}
.p-5 {
    padding: 3rem!important;
}
.mb-5, .my-5 {
    margin-bottom: 3rem!important;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
  
   
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div  class="row p-5">
                        <div style="    background: #0b88ee !important;" class="col-md-6">
                            <img style=" max-width: 148px;" src="{{url('account/images/slider/'.$logo->logo) }}">
                        </div>

                        <div style="    background: #0b88ee !important;" class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">فاتوره :#{{ $order->id }}</p>
                        <p style="color: #f1f4f7!important;" class="text-muted">التاريخ:  <?php $Day=date("Y/m/d"); ?> {{$Day }}
                        </div>
                    </div>
                    
                     

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                       

                        <div class="col-md-6 ">
                         
                            <p>QR Code</p>
                            <img src= "{{ asset('/storage/app/public/'.$order->QR) }}" alt="QR Image">
                        </div>
                        <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-4">تفاصيل العميل</p>
                                <p class="mb-1">{{ $order->User->name }}</p>
                                <p>{{ $order->User->email }}</p>
                                <p class="mb-1">{{ $order->User->address }}</p>
                                <p class="mb-1">{{ $order->User->phone }}</p>
                            </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table style="direction: rtl;" class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">رقم التسلسل</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">المنتج</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">الكمية</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">سعر الواحد</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">أجمالى السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordersItems as $i=>$ordersItem)
                                    <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{$ordersItem->product->products_title}}</td>
                                            <td>{{$ordersItem->Quentity}}</td>
                                            <td>{{$ordersItem->product->products_price}}</td>
                                            <td>{{$ordersItem->price}}</td>
                                        </tr>
                                        
                                    @endforeach
                                   
                                   
                                  
                                </tbody>
                            </table>

                            <h3 class="text-center">  مصاريف الشحن :{{ $order->delivery_Price }} دينار ليبى</h3>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2"> أجمالى الدفع</div>
                            <div class="h2 font-weight-light">{{ $order->delivery_Price+$order->TotalPrice }} دينار ليبى</div>
                        </div>

                        

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">أجمالى المنتجات</div>
                            <div class="h2 font-weight-light">{{ $order->TotalPrice }} دينار ليبى</div>
                        </div>

                        <img style=" max-width: 148px;     position: absolute;
                        left: 20px;" src="{{url('account/images/slider/'.$logo->logo) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://maojod.com/">http://maojod.com/</a></div>

</div>




<!-- jQuery 2.2.3 -->
<script src="{{ URL::asset('account/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

{{-- <script src="{{ URL::asset('js/jquery-3.3.1.js')}}"></script> --}}
<!-- Bootstrap 3.3.6 -->
<script src="{{ URL::asset('account/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('account/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('account/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>


<script >
  
        $('.print').click(function(){
            window.print();
    })


    $('.PDF').click(function(){
        let doc = new jsPDF('p','pt','a4');

        doc.addHTML(document.body,function() {
            doc.save('invoice.pdf');
        });
    })

   
    
</script>


