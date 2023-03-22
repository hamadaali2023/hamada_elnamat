@extends('layout.front_main')
@section('content') 
    <link rel="stylesheet" href="{{asset('front/css/search.css')}}" />
<section class="courses-banner" >
    <div class="container">
        <div class="row">
            <form method="GET"  action="{{url('get-search-curriculums')}}" >
                <fieldset>
                    <legend> التوجيهي الأردني</legend>
                </fieldset>
                <div class="inner-form ">
                    <div class="select">
                         <select name="branch_id" >
                            <option selected disabled>الفروع</option>
                            @foreach ($branches as $_item) 
                            <option value="{{$_item->id}}">{{$_item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="select">
                         <select name="classroom" >
                            <option selected disabled>الفصل</option>
                            <option value="1">الفصل الاول</option>
                            <option value="2">الفصل الثاني</option>
                        </select>
                    </div>
                    <button type="submit">بحث</button>
                </div>
            </form>
        </div>
    </div>
</section>
     <!--&& $user->type=="student"-->
     <!--@if($user)-->
     <!--                       <a href="{{url('renew_subscrip_curriculas')}}" style="color:#263e8d">اضغط هنا</a>-->
     <!--               @else-->
     <!--                   <a href="{{url('login/user')}}" style="color:#263e8d">اضغط هنا</a>-->
     <!--               @endif-->
     <marquee  scrollamount="12"  direction="right">
        <h1>   
            @foreach ($marquees as $marquee) 
                <font face="Andalus" size="3" style="color: #132972;
    font-family: Tajawal, sans-serif !important;
    font-weight: 600;">
                    {{$marquee->name}}
                    </font>&nbsp;&nbsp;        
            @endforeach
            
            <!--<font face="Andalus" size="3" color=brwon> التفكير السلبي، الذكاء العاطفي، ريادة الاعمال، المشاريع، ادارة المشاريع، المشاريع الاستثمارية، كيف تربح المال، العلاج النفسي، العلاج المعرفي، العلاج السلوكي، تنمية بشرية، التنمية البشرية، تنمية المهارات، مهارات النجاح، مهارات سوق العمل، طلاب، تعليم، تدريب، تدرب، تعلم، تدريب المدربين، اعداد المعلمين، شهادات معتمدة، شهادات حضور، شهادات انجاز,منصة النمط</font>&nbsp;&nbsp;-->
            
        <h1/>
        
    </marquee>
    
    <!--<marquee behavior="scroll" direction="right" scrollamount="12">Little Fast Scrolling</marquee>-->
    @if(!$user)
        <div class="row">
            <div class="col-12">
                
                <h6 class="text-extra-dark-gray  title-bg">
                    <center>
                    للاشتراك في التوجيهي الأردني
                        <a href="{{url('login/user')}}" style="color:#263e8d">اضغط هنا</a>
                   
                    </center><br>
                    <center>
                    للتعرف على المعلمين
                        <a href="{{url('all-teacher')}}" style="color:#263e8d">اضغط هنا</a>
                   
                    </center>
                </h6>
            </div>
        </div>
    @elseif($user->type=="student") 
        @if($user->status_teacher!=1) 
            <div class="row">
                <div class="col-12">
                    
                    <h6 class="text-extra-dark-gray  title-bg">
                        <center>
                        للاشتراك في التوجيهي الأردني
                            <a href="{{url('renew_subscrip_curriculas')}}" style="color:#263e8d">اضغط هنا</a>
                        </center>
                    </h6>
                </div>
            </div>
        @endif    
    @else
    
    @endif
     <!--<div class="row">-->
     <!--       <div class="col-12">-->
                
     <!--           <h6 class="text-extra-dark-gray  title-bg">-->
                   
     <!--               <center>-->
     <!--               للتعرف على المعلمين-->
     <!--                   <a href="{{url('all-teacher')}}" style="color:#263e8d">اضغط هنا</a>-->
                   
     <!--               </center>-->
     <!--           </h6>-->
     <!--       </div>-->
     <!--   </div>-->
    <section class="featured-courses"  style="padding: 20px 0px 0px 0px !important;">
        <div class="container">


            <div class="row tab-style2 mt-2">
                <div class="col-12 p-0">
                    <!-- start tab navigation -->
                    <ul class="nav nav-tabs  text-uppercase text-small text-center font-weight-600 justify-content-center">
                        @foreach ($branches as $branche)
                        <li class="nav-item">
                            <a class="nav-link " href="#category{{$branche->name}}" data-toggle="tab" id="{{$branche->id}}" onClick="getcourses(this.id)">
                            {{$branche->name}}</a>
                        </li>
                         @endforeach 
                    </ul>
                    <!-- end tab navigation -->
                </div>
            </div>

            <div class="mt-4">
                <div class="tab-content">                    
                    <!-- start tab content -->
                    <div class="tab-pane med-text fade in active show" id="tab_sec1">
                        <div class="row featured-courses" id="courses">
                            
                        </div>
                        <!-- <div class="row justify-content-center">
                            <a href="#" class="btn header-btn">View more</a>
                        </div> -->
                    </div><br>
                    <!-- end tab content -->
                </div>
            </div>
        </div>
    </section>



@if($curriculums!=null)  
     <section class="featured-courses" style="padding: 20px 0px 0px 0px !important;">
        <div class="container">
         
            <div class="row">
                <div class="col-12">
                    <h6 class="#course- text-extra-dark-gray font-weight-600 title-bg">
                         المناهج الاردنية
                    </h6>
                </div>
            </div>
       
            <div class="row">
               
                         @foreach ($curriculums as $_item)
                        <div class="col-md-3">
                            <div class="featured-courses featured-courses-home">
                                <a href="{{url('curriculums/'.$_item->id)}}">
                                    <img src="{{asset('assets_admin/img/curriculums/'.$_item->image) }}" class="img-fluid">
                                </a>
                                    <div class="bg-light">
                                        <a href="{{url('curriculums/'.$_item->id)}}">
                                            <p class="text-dark font-weight-bold mb-2">  {{ $_item->material->name }}</p>
                                        </a>
                                        <!--<div class="featured-date mb-2">-->
                                        <!--    <i class="fas fa-calendar-alt"></i>-->
                                        <!--    <span>{{$_item->date}}</span>-->
                                        <!--</div>-->
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-user"></i>
                                            <span>
                                                <b> المعلم :</b>
                                            <!--{{$_item->instructor->name}} -->
                                            {!! Str::limit($_item->instructor->name, 20 ) !!}</span>
                                        </div>
                                        <div class="featured-date mb-2">
                                            <i class="fas fa-money-bill-alt"></i> 
                                            <span>
                                               
                                                <b> الفصل الدراسي :</b> 
                                                @if($_item->classroom ==1)     
                                                    الاول
                                                @else
                                                    الثاني
                                                @endif
                                            </span> 
                                        </div>
                                        <div class="featured-date mb-2">
                                             <i class="fas fa-money-bill-alt"></i> 
                                             <span>
                                                 <b> الفرع :</b>
                                                 @foreach ($_item->branch as $branch)
                                                    @if($branch)
                                                    {{$branch->name}} 
                                                    @else 
                                                    
                                                    @endif
                                                 @endforeach
                                                 </span> 
                                        </div>
                                        
                                        
                            </div>
                            <!-- end features box item -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
    </section>
@endif
   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         
        <script type="text/javascript">
            $(document).ready(function () {
		    
    			$('#get_sub_category_name').on('change', function () {
    	        	console.log("welcome sub"); 
    	        	let id = $(this).val();
    	        		console.log(id); 
    			    $.ajax({
    				    type: 'GET',
    				    url: "{{url('getsubcategory')}}/"+id,
    				    success: function (response) {
    				        console.log("welcome subxxx"); 
    				       
    				        var response = JSON.parse(response)
    				        //   console.log(id);
    					    $('#get_sub_category').empty();
    					   
    					   // $('#get_sub_category').append(`<option  value="" selected>اختار </option>`);
    					    response.forEach(elements => {
    					        
    					       // console.log(elements);
    					       // console.log('cccccccnnnnnn');
    					       // console.log(elements['title']['ar']); 
    					        
    					        $('#get_sub_category').append(`<option value="${elements['id']}">
    					        ${elements['title']['ar']} 
    					        </option>`);
    					    });
    					}
    				});
    			});
    		});	
    		
            function getcourses(branchId)
            {
                    // alert(categoryId);
                    
                    // var query = $(this).val(); 
                    console.log(branchId);
                    $.ajax({
                        url:"{{ route('get-curriculums') }}",
                        type:"GET",
                        data:{'branchId':branchId},
                        success:function (response) {
                            console.log(response); 
                             console.log('fff');
                                $('#courses').empty();

                            
                            // console.log(response); 
                            if (response.length == 0) {
                                console.log("erfreferfrnono");
                                $('#courses').append(`
                                    <p class="" style="font-size: 15px;">لا يوجد نتائج مطابقة لهذا البحث     </p>
                                `);

                            }else {        
                                console.log("yes");
                            
                                response.forEach(element => {
                                    
                                    console.log("hamada "+element['id']); 
                                    
                                    if(element['classroom'] ==1) {    
                                        var classroom ='الاول';
                                    }else{
                                        var classroom ='الثاني' ;
                                    }
                                    
                                    // for (const branch of element['branch']) { 
                                    //     console.log(branch['name']+'branchhamada');
                                    // }
                                    
                                   
                                                             
                                                    
                                    $('#courses').append(`
                                        <div class="col-12 col-lg-3 col-md-6">
                                            <a href="curriculums/${element['id']}">
                                                <img src="assets_admin/img/curriculums/${element['image']}" class="img-fluid">
                                            </a>
                                            <a href="curriculums/${element['id']}">
                                                <div class="bg-light">
                                                    <p class="text-dark font-weight-bold mb-2"> ${element['material']['name']}</p>

                                                    
                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-user"></i>
                                                        <span>
                                                            <b> المعلم :</b>
                                                        ${element['instructor']['name']}</span>
                                                    </div>
                                                    
                                                    
                                                    <div class="featured-date mb-2">
                                                        <i class="fas fa-money-bill-alt"></i> 
                                                        <span>
                                                           
                                                            <b> الفصل الدراسي :</b> 
                                                            ${classroom}
                                                        </span> 
                                                    </div>
                                                    
                                                    <div class="featured-date mb-2">
                                                         <i class="fas fa-money-bill-alt"></i> 
                                                        <span>
                                                             <b> الفرع :</b>
                                                             ${element['branch']['name']}
                                                        </span> 
                                                    </div>
                                                    
                                                    
                                                    
                                                </div>
                                            </a>
                                        </div>
                                    `);
                                    
                                });
                            }
                            // $('#searchbooks').html(data);
                        }
                    })
               
                    
            }
            
            
           
        </script>
        
        
        




@endsection


