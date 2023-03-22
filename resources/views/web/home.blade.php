@extends('layout.web_main')
@section('content')	
@php  
    
    
    if(session()->get('locale')){
       
        $langg=session()->get('locale');
    }else{
        
        $langg=app()->getLocale();
    }
@endphp 

    <style type="text/css">
        @if($langg == 'ar')
        #latest-books{
            text-align: right;
        }
        @endif
    </style>

    <h5 class="booksTitle" style="margin-top: 23px;"> </h5> 
        <nav class="navbar navbar-expand-lg navbar-light" id="category" style="margin-bottom: 26px;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNavvv" onclick="togglecat()" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column" id="basicExampleNavvv">
                <!-- Links -->
                <ul class="navbar-nav mx-auto" style="padding-bottom: 1em;">
                    @foreach ($categories as $_item)
                        <li class="nav-item" id="vvv">
                            <button type="button" class="btn btn-outline-secondary" id="{{$_item->id}}" onClick="getbooke(this.id)">
                                <span>{{$_item->title}}</span>     
                            </button>
                        </li>
                    @endforeach   
                      
                    <!-- <script type="text/javascript">
                        function reply_click(clicked_id)
                        {
                            alert(clicked_id);
                        }
                    </script> -->
                    <li class="nav-item active">
                        <button type="button" class="btn btn-outline-secondary" id="0" onClick="getbooke(this.id)">  
                            <h6>
                            
                             {{__('home.all')}}</h6>   
                        </button>
                    </li>
                </ul>

                <div class="navbar-nav flex-row mb-2 mr-auto w-100">
                    <form class="form-inline my-2 my-lg-0 w-100">                        
                        <input type="search" class="form-control mr-sm-2 w-100" name="country" placeholder="{{__('home.search')}}" aria-label="Search" id="country" style="width: 300px; display:block;">
                        <!-- <select class="date-own form-control mr-sm-2 w-100" style="width: 300px; display:none;" id="year"> <option value="2021" selected="selected">2021</option></select> -->
                    </form>
                    <!-- <div class="form-group my-2 my-lg-0 w-25" style="margin-right: 10px;">
                        <select name="sort" id="sort" class="form-control" onchange="changeInput(this);">
                            <option disabled="disabled" selected="selected">بحث حسب </option>
                            <option value="0"> الكتاب </option>
                            <option value="1"> الكاتب </option>
                            <option value="2"> السنة </option>
                        </select>
                    </div> -->
                </div>
            </div>
        </nav>
        <h6 class="my-4  heading" id="latest-books">
            {{__('home.latest books')}} 
        </h6>
        <div id="allBooks">

            @foreach ($books as $_item)
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('book/'.$_item->slug)}}">
                        <img style="height: 200px; width: 100%;" src="{{asset('img/books/'.$_item->photo) }}">
                        <div class="title-text">
                            <h5 class="card-title"> {{$_item->name}}</h5>
                            <p class="card-text">{{$_item->instructor->name}}</p>
                            <p class="card-text">{{$_item->date}}</p>
                        </div>
                        <div class="price">{{$_item->price}} $ </div>
                        </a>
                        <div class="addCart">
                            <form action="{{route('user.cart')}}" method="POST">
                                @csrf
                                <input type="hidden" name="courseId" value="{{$_item->id}}">   
                                    <button id="addCart" type="submit" class="btn btn-info btn-circle btn-lg">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            @endforeach                     
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
        <script type="text/javascript">

            function getbooke(categoryId)
            {
                    // alert(categoryId);
                    
                    // var query = $(this).val(); 
                    console.log("response");
                    $.ajax({
                        url:"{{ route('getbookbycategory') }}",
                        type:"GET",
                        data:{'categoryId':categoryId},
                        success:function (response) {
                            console.log(response); 
                                $('#allBooks').empty();
                            
                            console.log(response); 
                            if (response.length == 0) {
                                console.log("erfreferfrnono");
                                $('#allBooks').append(`
                                    <p class="" style="font-size: 15px;">لا يوجد نتائج مطابقة لهذا البحث     </p>
                                `);

                            }else {        
                                console.log("yes");
                            
                                response.forEach(element => {
                                    $('#allBooks').append(`
                                        <div class="card" >    
                                         <div class="card-body" ><a href="book/${element['slug']}">
                                        <img style="height: 200px; width: 100%;" src="img/books/${element['photo']}">
                                        <div class="title-text">

                                            <h5 class="card-title">${element['name']}</h5>
                                            <p class="card-text">${element['instructor']['name']}</p>
                                            <p class="card-text">${element['date']}</p>
                                        </div>
                                        <div class="price">${element['price']} $ </div>
                                         </a>
                                        <div class="addCart">
                                             <form action="{{route('user.cart')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="courseId" value="${element['id']}">
                                                <button id="addCart" type="submit" class="btn btn-info btn-circle btn-lg">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                       
                                        </div>
                                         </div>
                                         </div>
                                    `);
                                    
                                });
                            }
                            
                            // $('#searchbooks').html(data);
                        }
                    })
               
                    
            }
            $(document).ready(function () {


                $('#country').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                        url:"{{ route('searchbook') }}",
                        type:"GET",
                        data:{'country':query},
                        success:function (response) {
                            console.log(response); 
                                $('#allBooks').empty();
                            
                            console.log(response); 
                            if (response.length == 0) {
                                console.log("erfreferfrnono");
                                $('#allBooks').append(`
                                    <p class="">لا يوجد نتائج مطابقة لهذا البحث </p>
                                `);

                            }else {        
                                console.log("yes");
                            
                                response.forEach(element => {
                                    $('#allBooks').append(`
                                        <div class="card" >    
                                         <div class="card-body" ><a href="book/${element['slug']}">
                                        <img style="height: 200px; width: 100%;" src="img/books/${element['photo']}">
                                        <div class="title-text">

                                            <h5 class="card-title">${element['name']}</h5>
                                            <p class="card-text">${element['instructor']['name']}</p>
                                            <p class="card-text">${element['date']}</p>
                                        </div>
                                        <div class="price">${element['price']} $ </div>
                                         </a>
                                        <div class="addCart">
                                             <form action="{{route('user.cart')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="courseid" value="${element['id']}">
                                                <button id="addCart" type="submit" class="btn btn-info btn-circle btn-lg">
                                                    <i class="fas fa-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                       
                                        </div>
                                         </div>
                                         </div>
                                    `);
                                    
                                });
                            }
                            




                            // $('#searchbooks').html(data);
                        }
                    })
                });
            });
        </script>
         
@endsection


<script>
function togglecat() {
   var element = document.getElementById("basicExampleNavvv");
   element.classList.toggle("show");
}
</script>