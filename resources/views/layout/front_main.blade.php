<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('layout.front_head')
</head>

 @php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

@if($langg == 'ar')
    <style type="text/css">
         
    </style>
@else
@endif


<body>
    
    <!--<div class="dark-mode-btn">-->
    <!--    <input type="checkbox" class="checkbox" id="checkbox">-->
    <!--        <label for="checkbox" class="label">-->
    <!--            <i class="fas fa-moon"></i>-->
    <!--            <i class='fas fa-sun'></i>-->
    <!--            <div class='ball'>-->
    <!--        </label>-->
    <!--    </div>-->
    <!--</div>-->


<!--// Dark Mode-->

    @if(!Request::is('login/user','instructor-signup','student-signup','register-users','traveling-signup'))
        <header>
                @include('layout.front_header')
        </header>   
    @endif 
    @yield('content')
    
    @if(!Request::is('login/user','create/acount','register-users','instructor-signup','traveling-signup'))
        @include('layout.front_footer')
    @endif
    
    @yield('hamada')
    
    
    
        
  
    
</body>

</html>