
@extends('layout.instructor.main')
@section('content')	

@toastr_css


    <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">الفيديوهات</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>
                            </li>                            
                            <li class="breadcrumb-item active">الفيديوهات
                            </li>
                          </ol> 
                        </div>
                      </div>
                    </div>
                    <!-- <div class="content-header-right col-md-6 col-12">
                      <div class="dropdown float-md-right">
                           <a href="{{route('videos.create')}}"  class="btn btn-primary float-right mt-2">أضافة فيديو جديد</a>
                      </div>
                    </div> -->
                     
                    @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
                    @endif

                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>خطا</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
    </div>
 










    <section id="keytable">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">{{$course->title}}</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <p class="card-text"></p>
                    <table id="table" class="table table-bordered">
                      <thead>
                        <tr>
                            <th class="text-center">#</th>
                          <th>الفيديو</th>
                                <th>اسم الفيديو </th>
                                <!--<th> الكورس </th>-->
                                <th>الوقت بالدقيقه</th>
                                <th>حجم الملف</th>

                                <th class="text-center">العمليات</th>
                        </tr>
                      </thead>
                      <tbody id="tablecontents">
                        @foreach($videos as $key =>$_item)
            	            <tr class="row1" data-id="{{ $_item->id }}">
            	                <td class="text-center">
            	                    <span  class="up-video">
            	                          <i class="la la-arrows-v" style="font-size: 30px;"></i>
                                        <span class="upvideo">اسحب الفيديو للاعلى أو للاسفل</span>
            	                    </span>
            	                </td>
            	                <td>
                                    <video controls="controls" width="100">
                                        <source src="{{asset('assets_admin/img/curriculums/videos/'.$_item->url) }}" type="video/mp4">
                                    </video>
                                </td>
                                <td>{{$_item->name}}</td>                                                
                                <!--<td>{{ $_item->course->title}}</td> -->
                                <td>{{$_item->videotime}} </td> 
                                <td>{{$_item->videosize}} MB</td> 
                                         
                                <td class="text-center">
                                    <div class="actions">
                                    <a class="btn btn-sm bg-success-light edit-course" data-toggle="modal" data-target="#view{{$_item->id}}">
				                        <button type="button" class="btn btn-outline-success "><i class="la la-eye"></i></button>
	                                </a>
                                    <a href="{{route('curricul_video.edit',$_item->id)}}"  >
                                        <button type="button" class="btn btn-outline-success " ><i class="la la-edit"></i></button>
                                    </a>
                                    <a data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete">
                                       <button type="button" class="btn btn-outline-danger "><i class="la la-trash-o"></i></button>
                                    </a>
                                    </div>
                                </td>
            	              
            	              
            	            </tr>
            	            <div class="modal fade" id="view{{$_item->id}}" aria-hidden="true" role="dialog">
                        				<div class="modal-dialog modal-dialog-centered" role="document" >
                    					    <div class="modal-content" style="border: 0px solid rgba(0, 0, 0, 0.2)!important;background-color: #ffffff00 !important;">
                                                <div class="modal-header">
                                                    <!-- <h5 class="modal-title">اضافة تخصص</h5> -->
                                                    <style type="text/css">
                                                        .close {   
                                                            color: #fff;
                                                            font-size: 2.5rem !important;
                                                            font-weight: 100 !important;
                                                            text-shadow: 0 1px 0 #ffffff !important;
                                                            opacity: 0.9 !important;
                                                        }
                                                        /*.modal-content {*/
                                                        /*   border: 0px solid rgba(0, 0, 0, 0.2)!important;*/
                                                        /*   background-color: #ffffff00 !important;*/
                                                        /*}*/
                                                    </style>
                                                    <button onclick = "closevideo('myvideo{{$key}}','large{{$key}}')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>


                                    			<!--<div class="modal-body" style="width:auto;" >-->
                                    			    <video id="myvideo{{$key}}" controls="controls" width="500">
                                                        <source src="{{asset('assets_admin/img/curriculums/videos/'.$_item->url) }}" type="video/mp4">
                                                    </video>
                                    			<!--</div>-->
                                    		</div>
                                    	</div>
                                    </div>
                        @endforeach
                      </tbody>                  
                    </table>
                    
                    
                </div>
                </div>
                </div>
              </div>
            </div>
        
        <div class="modal fade" id="delete" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">  

                        <div class="modal-body">
                            <div class="form-content p-2">
                                <h4 class="modal-title">حذف !</h4>
                                    <p class="mb-4">هل انت متأكد من حذف هذا العنصر</p>
                                                                    <div class="row text-center">
                                                                        <div class="col-sm-3">
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <form method="post" action="{{route('curricul_video.destroy','test')}}">
                                                                                 @csrf
                                                                                 @method('delete')
                                                                                 <input type="hidden" name="id" id="cat_id">
                                                                                <button type="submit" class="btn btn-primary">حذف </button>
                                                                            </form>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                </div>
        </div> 
        
        
    </section>
     <!--<script src="http://code.jquery.com/jquery-3.4.1.js"></script>-->





<script> 
        
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var cat_id = button.data('catid') 
        var modal = $(this)
        modal.find('.modal-body #cat_id').val(cat_id);
    })




    function closevideo(videoclose,idmodall){
        event.preventDefault();
        var closev = document.getElementById(videoclose);
        // console.log(videoclose);
        // $('#'+idmodall).modal('hide');
        closev.pause();
        // console.log(idmodall);
        
        // alert("The button was pressed");
    };  
</script> 


    <script type="text/javascript">
      $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
           update: function() {
               sendOrderToServer();
           }
        });

        function sendOrderToServer() {
            var myorder = [];
            var myorders=[
                {
                    "id": 130,
                    "position":1
                },
                {
                    "id": 131,
                    "position":2
                }
            ]
            // console.log("my roow table");
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                myorder.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });
            console.log("my roow tableeee");
            // console.log(myorder);
            
            
            
            
            // $.ajax({
            //         type: 'GET',
            //         url: "{{url('instructor/videosortable')}}",
            //         success: function (response) {
            //             console.log(response);
            //         }
            //     });
            
            
            $.ajax({
                type: "POST", 
                // dataType: "json", 
                url: "{{ url('api/videosortable-curriculums') }}",
                data: {
                    myorder: myorder,
                    _token: token
                },
                success: function(response) {
                    
                    // console.log("response");
                    if (response.status == "success") {
                      console.log(response);
                    } else {
                      console.log(response);
                    }
                }
            });
        }
      });
    </script>




<style>
    .up-video {
      position: relative;
      display: inline-block;
    }

    .up-video .upvideo {
      visibility: hidden;
      width: 75px;
      font-size: 11px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .up-video:hover .upvideo {
      visibility: visible;
    }

    /*//////////////*/
</style>




    @toastr_js
    @toastr_render
@endsection