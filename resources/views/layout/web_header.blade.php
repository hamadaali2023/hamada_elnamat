
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

@php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 
   
@if($langg == 'ar')
    <style type="text/css">
        .dropdown-menu{
            text-align: right; 
        }     
    </style>
@else
@endif
<nav class="navbar  fixed-top navbar-expand-md navbar-light bg-white">
        <img class="img-fluid" alt="كوتبانه" id="logo" src="{{asset('web/asset/logf.jpeg')}}" style="width:10%"> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" onclick="toggleFun()" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse w-100 flex-md-column" id="navbarSupportedContent">
            <form class="form-inline mx-auto">
                <div class="input-group">
                    <div class="navbar-brand mx-auto d-flex flex-column justify-content-center">                                
                        <h3 class=" h3 text-center" style="font-family: Kufam, cursive;">  {{__('home.app title')}} </h3> 
                        <small id="navbarSupportedContent" class=" collapse navbar-collapse m-0 p-0 text-center navSmall" style="font-size: 10px; font-family: Kufam, cursive;">
                        {{__('home.app desc')}}

                        </small>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto small mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="btn btn-info btn-sm btn-rounded px-3 my-0 waves-effect waves-light" >
                          <i class="fas fa-home mr-2"> </i>

                             {{__('home.homepage')}}
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a href="{{url('about')}}" class="btn btn-info btn-sm btn-rounded px-3 my-0 waves-effect waves-light" >
                            <i class="fas fa-info-circle"> </i> 
                               
                              {{__('home.about')}}
                        </a>
                    </li>
                   
                    
                    <li class="nav-item ">
                        <a href="{{url('cart')}}" class="btn btn-info btn-sm btn-rounded px-3 my-0 waves-effect waves-light">
                            <i class="fas fa-shopping-cart" id="numberbooks">
                                ( <span style="color: red;">{{$cartcount}}
                                     </span>)
                            </i>
                             {{__('home.cart')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('login/user')}}" class="btn btn-danger btn-rounded btn-sm waves-effect waves-light auth-modal-toggle">
                           <i class="fas fa-lock mr-2"></i> 
                           {{__('home.login')}}
                         </a>
                    </li>
                     
                    <li class="nav-item ">                    
                       <a href="{{url('terms/conditions')}}" class="btn btn-info btn-rounded btn-sm waves-effect waves-light auth-modal-toggle">
                            <i class="fab fa-hire-a-helper"></i>
                            {{__('home.terms and condition')}}
                        </a>
                    
                    </li>

                    <!--<li class="nav-item pr-lg-5">    

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="flag-icon flag-icon-us"> </span> 
                                @switch($langg)
                                    @case('us')
                                            englieh
                                    @break
                                    @case('ar')
                                            arabic
                                    @break
                                    @default
                                            english                                      
                                @endswitch
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown09">                                
                                       <a class="dropdown-item" href="lang/ar"><span class="flag-icon flag-icon-ru"> </span>  ar</a>
                                        <a class="dropdown-item" href="lang/en"><span class="flag-icon flag-icon-ru"> </span>  en</a>
                            </div>

                        </li>

                        
                    </li>  
 -->

                    <ul class="navbar-nav ml-auto">
                        
                         
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php 
                                    $instructors=Auth::guard('instructors')->user();
                                    $students= Auth::guard('students')->user();
                                    
                                ?>
                                @if($instructors)

                                    <i class="fas fa-user"></i>  {{$instructors->name}}
                                
                                @elseif($students){
                                    <i class="fas fa-user"></i>  {{$students->name}}
                                @else
                                    <i class="fas fa-user"></i>{{__('home.my acount')}}  
                                @endif
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> 
                                @if($instructors)
                                    <a class="dropdown-item" href="{{url('/instructor/stories')}}">
                                        <!-- <i class="fas fa-user"></i> -->
                                       
                                        {{__('home.my acount')}} 
                                        <br>
                                        <a class="dropdown-item" href="{{ route('signoutinstructors') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fal fa-sign-out"></i>
                                        
                                         {{__('home.sign out')}} 
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                @elseif($students)
                                    <a class="dropdown-item" href="{{url('lang/en')}}">
                                        <!-- <i class="fas fa-user"></i> -->
                                       
                                        {{__('home.my acount')}}
                                        <br>
                                        <a class="dropdown-item" href="{{ route('signoutinstructors') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fal fa-sign-out"></i>
                                          {{__('home.sign out')}}   
                                          </a> 
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </a>
                                @else 
                                    <a class="dropdown-item" href="{{url('login/user')}}">
                                        <i class="fas fa-user"></i>
                                        {{__('home.sign in')}} 
                                     </a>   
                                @endif
                                
                                
                            </div>
                        </li>
                    </ul> 

                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @switch($langg)
                                    @case('fr')
                                        <img src="{{asset('img/en.png')}}" width="30px" height="20x"> 
                                        {{__('home.en')}} 
                                    @break

                                    @case('ar')
                                        <img src="{{asset('img/ar.png')}}" width="30px" height="20x"> {{__('home.ar')}} 
                                    @break
                                   
                                    @default
                                        <img src="{{asset('img/en.png')}}" width="30px" height="20x"> {{__('home.en')}} 
                                @endswitch
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> 
                           
                                <a class="dropdown-item" href="{{url('lang/en')}}">
                                    <img src="{{asset('img/en.png')}}" width="30px" height="20x"> - {{__('home.en')}}
                                </a>
                                <a class="dropdown-item" href="{{url('lang/ar')}}">
                                    <img src="{{asset('img/ar.png')}}" width="30px" height="20x"> - {{__('home.ar')}} 
                                </a>
                            </div>
                        </li>
                    </ul>  
                    
            </ul> 
            
                     
        </div>

        
    </nav><br><br>


                    
                    <!--{{__('home.hello')}}-->
                    <!--<ul class="navbar-nav mr-auto">-->
                    <!--    <div class="card-header">{{ trans('app.title') }} </div>-->
                    <!--</ul>   -->

 <script>
function toggleFun() {
   var element = document.getElementById("navbarSupportedContent");
   element.classList.toggle("show");
}
</script>