 @if(Session::has('message'))

    <div class="alert alert-success" id="alert">
        <strong>Success:</strong> {{Session::get('message')}}
    </div>

@elseif(session('error'))
    <div class="alert alert-danger" id="alert">
        
        <strong>Error:</strong>{{Session::get('error')}}
    </div>
@endif


 @if(isset($messagesssss))
                <div class="alert alert-success">
                    {{ $messagesssss }}
                </div>
            @endif 

             @if (session('message'))
            <div class="alert alert-success">
            {{ session('message') }}
            </div>
          @endif
ssss

         <form action="{{route('sliderss.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
                             
                                <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                            </form>