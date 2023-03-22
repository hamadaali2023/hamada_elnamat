
@extends('layout.instructor.main')
@section('content') 

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة فيديو جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الفيديوهات
                            </li>
                          </ol> 
                        </div>
                        

                      </div>
                      @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif
                    </div>
                   
    </div>


<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form"> </h4>
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
                <div class="card-content collpase show">
                  
              
                  <div class="card-body">
                    <form action="{{route('videos.store')}}" method="POST" 
                                      name="le_form"  enctype="multipart/form-data">
                                      @csrf
                                      <div class="row form-row">
                                        <div class="form-group col-12 col-sm-6">
                                            <label>الكورس</label>
                                            <input type="text"  class="form-control" value="{{$courses->title}}" disabled>
                                            <input type="hidden" name="courseId" class="form-control" value="{{$courses->id}}">
                                              @error('courseId')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
                                         
                                          <div class="form-group col-12 col-sm-6">
                                              <label>عنوان الدرس</label>
                                              <input type="text" name="name" class="form-control " id="nameId">
                                              <span id="nameError" style="color: red;"></span>
                                               @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                              @enderror
                                             <!--  <input type="text" name="name" class="form-control nameId"  >
                                              @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                              @enderror -->
                                              <span id="nameError" style="color: red;"></span>
                                          </div>
                                          <!-- <div class="form-group col-12 col-sm-6">
                                              <label>ضع رابط الفيديو</label>
                                              <input type="file" name="url" class="form-control" value="{{old('url')}}" required accept=".AVI,.MOV,.MP4,.WMV,.FLV,.3GP,.Vob,.mkv,.mts,.srt,.swf,.vob,.m4v">
                                              @error('url')
                                                <span class="text-danger">{{$message}}</span>
                                              @enderror
                                          </div> -->





                                          <div class="form-group col-12 col-sm-6">
                                              <label> تحميل الفيديو الذي يخص هذا الدرس ويجب أن يكون الأمتداد من نوع (.MP4,.FLV,.ogg,.webm.)  </label>
                                               <input type="file" name="file" id="fileId" onchange="saveVideo(fileId,'1','videopath','progress-bar1','hidden1','videovalue','videotime','videosize')" class="form-control fileId" accept=".MP4,.FLV,.ogg,.webm,.mov">
                                              @error('url')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>

                                          <div class="col-md-12 hidden1" id="hidden1" >
                                            <video controls="controls" id="videopath" width="200">
                                               <source  src="" type="video/mp4">
                                            </video> 
                                            <input type="hidden" name="videovalue" class="videovalue" id="videovalue">
                                            <input type="hidden" name="videotime" class="videotime" id="videotime" >
                                            <input type="hidden" name="videosize" class="videosize" id="videosize" >
                                          </div> 
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                              <div class="progress prog1">
                                                <div class="progress-bar progress-bar1 prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="color: #FF4961; padding-right: 23px;padding-left: 23px" id="upload-error">  </div>
                                        <br>
                                          
                                          
                                          <!--<div class="form-group col-sm-6 ">-->
                                          <!--        <label>ارفاق فيديو </label>-->
                                          <!--        <input type="file" name="url" class="form-control">-->
                                              
                                          <!--    @error('url')-->
                                          <!--      <span class="text-danger">{{$message}}</span>-->
                                          <!--  @enderror-->
                                          <!--</div>-->
                                          
                                          
                                      </div><br>
                                      <button type="submit" class="btn btn-primary btn-block" onclick="return Validateallinput()">حفظ </button>
                                  
                                      <div class="loader-wrapper">
                                        <div class="loader-container">
                                          <div class="ball-spin-fade-loader loader-blue">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                          </div>
                                        </div>
                                    </div>

                                  </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    
 <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

<script> 
    $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getchapter')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['chapter_name']} - ${element['id']} 
                            </option>`);
                        });
                    }
                });
            });
        });

    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var cat_id = button.data('catid') 
        var modal = $(this)
        modal.find('.modal-body #cat_id').val(cat_id);
    })

 $('.loader-container').hide();
 $('.hidden1').hide();

function saveVideo(fileId,id,videopath,progres,hiddenclassss,videovalue,videotime,videosize){
    $(function () {
        $.ajaxSetup({
          headers: {'X-CSRF-Token': '{{csrf_token()}}'}
        });

        var photo = $(fileId)[0].files[0];
        var formData = new FormData();
        formData.append('file', photo);
        formData.append('id', id);
        $.ajax({
          // start for progress par
            xhr: function() {
              var xhr = new window.XMLHttpRequest();

              xhr.upload.addEventListener("progress", function(evt) {
                if (evt.lengthComputable) {
                  var percentComplete = evt.loaded / evt.total;
                  percentComplete = parseInt(percentComplete * 100);

                  $('.'+progres).width(percentComplete+'%');
                  $('.'+progres).html(percentComplete+'%');

                }
              }, false);

              return xhr;
            },
          // end for progress par

            url: "{{route('savevideo')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // console.log('ffffffsaid');
                // console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<'+hiddenclassss);
                //  var div = document.getElementById(hiddenclassss);
                // div.classList.remove(hiddenclassss);
                $('.'+hiddenclassss).show();
                $('#'+videopath).attr('src', "https://www.elnamat.com/assets_admin/img/courses/videos/"+ data);
                document.getElementById(videovalue).value = data;
                var getVieovalue = document.getElementById(videopath);
                getVieovalue.onloadedmetadata = function() {
                    var onevide=Math.round(this.duration / 60);  
                    document.getElementById(videotime).value = onevide;
                };
                var videokb= photo.size/1024;
                var videomb=videokb/1024;
                var videosizee=Math.round(videomb, 1);
                document.getElementById(videosize).value =videosizee ;
                document.getElementById(fileId).value = 'video.png';
              // $('#'+videovalue).append('eeeeeee');
            }
        })
    })
  }




// function fileValidation(){
//     var fileInput = document.getElementById("fileId");
//     var filePath = fileInput.value;
    
//     var allowedExtensions = /(\.MP4|\.FLV|\.ogg|\.webm)$/i;
//     if(!allowedExtensions.exec(filePath)){
//         alert(' ويجب أن يكون الأمتداد من نوع (.MP4,.FLV,.ogg,.webm.) فقط.');
//         fileInput.value = '';
//         return false;
//     }
    
// }

function Validateallinput() {
  
    var nameId = document.getElementById("nameId");
    var nameError = document.getElementById("nameError");

    var fileId = document.getElementById("fileId");
    // var fileError = document.getElementById("fileError");

    var videovalue = document.getElementById("videovalue");
    var videotime = document.getElementById("videotime");

    
        if (nameId.value == "") {
             nameError.innerHTML = "ادخل عنوان الفيديو";
            // titleid.focus(); 
            return false;
        }
        nameError.innerHTML = "";
    
        if (fileId.value == "") {
            $('#upload-error').empty();
            $('#upload-error').append(`<div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong> </strong>
                                <p>يرجى إرفاق فيديو </p>
                              </div><br><br>`);
            fileId.focus(); 
            return false;
        }
        
        var filePath = fileId.value;
        var allowedExtensions = /(\.MP4|\.FLV|\.ogg|\.webm|\.mov)$/i;
        if(!allowedExtensions.exec(filePath)){
            $('#upload-error').append(`<div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong> </strong>
                                <p> يجب أن يكون الأمتداد من نوع (.MP4,.FLV,.ogg,.webm.)فقط </p>
                              </div>`);
           
            fileId.value = '';
            fileId.focus(); 
            return false;
        }
        
        
      
        if (videovalue.value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                
                                <p>يرجى الإنتظار حتي يتم التحميل</p>
                              </div>`);
            videovalue.focus(); 
            return false;
        }else{
            fileId.value= null;
        }
        
        if (videotime.value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                
                                <p>يرجى الإنتظار حتي يتم التحميل</p>
                              </div>`);
            videotime.focus(); 
            return false;
        }else{
            fileId.value= null;
        }
        

    
    $('.loader-container').show();
    // return false;
  }    




</script> 
    @toastr_js
    @toastr_render
@endsection