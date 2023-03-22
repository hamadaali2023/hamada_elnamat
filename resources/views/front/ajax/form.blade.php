@section('main') 


    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData['id']}}"></script>
    <form action="{{route('checkout')}}" class="paymentWidgets" data-brands="VISA MASTER"></form>
 
@endsection