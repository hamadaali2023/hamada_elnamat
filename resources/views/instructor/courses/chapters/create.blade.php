
@extends('layout.instructor.main')
@section('content') 
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  

  <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
        <div class="row breadcrumbs-top d-inline-block">
          <div class="breadcrumb-wrapper col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">الكورسات</li>
            </ol> 
          </div>
          @if(session()->has('message'))
            @include('admin.includes.alerts.success')
          @endif
        </div>
      </div>     
  </div>
<style type="text/css">
  .hidden1{
    /*display: none;*/
  }
</style>
  <section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                    <form action="{{route('chapters.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics courseId" placeholder="Select Category" >
                              <option  disabled selected value="selected">حدد الكورس</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" >{{$_item->title}}</option>
                              @endforeach
                            </select>
                            <span id="courseError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control chapternameId" value="{{old('chapter_name')}}">
                            <span id="chapternameError" style="color: red;"></span>  
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control chapternumberId" value="{{old('short_number')}}">
                              <span id="chapternumberError" style="color: red;"></span>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <a href="#" onclick="addVideo()" class="btn btn-primary btn-block">إضافة فيديو </a>
                        </div>
                        <div class="education-info" id="addvideo">
                          <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                            <div class=" col-md-12">
                                <div class="row form-row">
                                  <div class=" col-md-4">
                                    <div class="form-group">
                                      <label>عنوان الفيديو</label>
                                      <input type="text" name="name[]" class="form-control nameId">
                                      <span id="nameError" style="color: red;"></span>
                                    </div> 
                                  </div>
                                  <div class=" col-md-4">
                                    <div class="form-group">
                                      <label>ارفق الفيديو</label>
                                      <input type="file" name="file" id="video1" onchange="saveVideo(video1,'1','videopath1','progress-bar1','hidden1','videovalue1')" class="form-control fileId">
                                      <span id="fileError" style="color: red;"></span>
                                    </div> 
                                  </div>
                                </div>
                                <div class=" row form-row">
                                   
                                  <div class="col-md-4 hidden1" id="hidden1" >
                                      <video controls="controls" id="videopath1" width="200">
                                          <source  src="" type="video/mp4">
                                      </video> 
                                     <input type="hidden" class="videovalue" id="videovalue1" >
                                  </div> 
                                  <div class="col-md-4 ">
                                    <div class="form-group">
                                      <div class="progress prog1">
                                        <div class="progress-bar progress-bar1 prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12" style="padding-right: 23px;padding-left: 23px" id="upload-error">
                         
                        </div>
                        <br>
                       

                      <div class="form-group col-12 col-sm-12">
                          <button type="submit" class="btn btn-primary btn-block" onclick="return Validateallinput()">حفظ </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
  </section>
    <?php 
       $videos=session()->get('videos_sessions');
    ?>

  <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<><<<><<<><><<ff -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<[[[[[[[[[>>>   -->
<script>

  let videoid = 1;
   $('.hidden1').hide();
  function saveVideo(video,id,videopath,progres,hiddenclassss,videovalue){
    $(function () {
        $.ajaxSetup({
          headers: {'X-CSRF-Token': '{{csrf_token()}}'}
        });

        var photo = $(video)[0].files[0];
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
              console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<'+hiddenclassss);
              //  var div = document.getElementById(hiddenclassss);
              // div.classList.remove(hiddenclassss);
              $('.'+hiddenclassss).show();
              $('#'+videopath).attr('src', "/assets_admin/img/courses/videos/"+ data);
              // document.getElementById('videopath1').value = "hamadaalil";
              document.getElementById(videovalue).value = data;
              // $('#'+videovalue).append('eeeeeee');
            }
        })
    })
  }




 /// remove video from list and session
  function removevideo(videoId,id) {
      var myobj = document.getElementById(videoId);
      myobj.remove();
      if(confirm("Are you sure")) {
        $.ajax({
              type: 'GET',
              url: "{{url('removeVideoSessionItem')}}/"+id,
              success: function (response) {
                console.log(response+'nnnnnnn>>>>>>>>');   
            }
        });
      } 
  }
    
    

  function addVideo(){
        videoid += 1;
        
        const itemid = Math.random();
        $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;margin: 24px;">
                             
                            <div class="col-md-12 ">
                               
                              <div class="row form-row">
                                  <div class=" col-md-4">
                                    <div class="form-group">
                                      <label>عنوان الفيديو</label>
                                      <input type="text" name="name[]"  class="form-control nameId">
                                      <span id="nameError" style="color: red;"></span>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>ارفق الفيديو</label>                  
                                      <input type="file" name="file" id="video${videoid}" onchange="saveVideo(video${videoid},'${videoid}','videopath${videoid}','progress-bar${videoid}','hidden${videoid}','videovalue${videoid}')" class="form-control fileId">
                                      <span id="fileError" style="color: red;"></span>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id,'${videoid}')"><i class="far fa-trash-alt"></i>X</a>
                                  </div>
                              </div>
                            
                              
                              <div class=" row form-row">
                                  <div class="col-md-4 hidden${videoid} id="hidden${videoid}">
                                      <video controls="controls" id="videopath${videoid}" width="200">
                                        <source  src="" type="video/mp4">
                                      </video> 
                                       <input type="hidden" class="videovalue" id="videovalue${videoid}" value="">
                                  </div> 
                                  <div class="col-md-4 ">
                                    <div class="form-group">
                                      <div class="progress prog1">
                                        <div class="progress-bar progress-bar${videoid} prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <hr/>
                              </div>
                          </div>
                          </div>`); 
        $('.hidden'+videoid).hide(); 
  }
  
  function Validateallinput() {
    
    var courseId = document.getElementsByClassName('courseId')[0];
    var courseError = document.getElementById("courseError");

    var chapternameId = document.getElementsByClassName('chapternameId')[0];
    var chapternameError = document.getElementById("chapternameError");

    var chapternumberId = document.getElementsByClassName('chapternumberId')[0];
    var chapternumberError = document.getElementById("chapternumberError");
    console.log(courseId.value);
    if (courseId.value==null || courseId.value == "" || courseId.value =='selected') {
        courseError.innerHTML = "يرجى تحديد الكورس  <b>";
        courseId.focus(); 
        return false;
    }
    courseError.innerHTML = "";

    if (chapternameId.value ==null || chapternameId.value == "") {
        chapternameError.innerHTML = "ادخل عنوان الفيديو  <b>";
        chapternameId.focus(); 
        return false;
    }
    chapternameError.innerHTML = "";
    
    if(chapternumberId.value ==null || chapternumberId.value == "") {
      chapternumberError.innerHTML = "ادخل عنوان الفيديو  <b>";
      chapternumberId.focus(); 
      return false;
    }
    chapternumberError.innerHTML = "";

    var nameId = document.querySelectorAll(".nameId");
    var nameError = document.getElementById("nameError");
    let fileId = document.querySelectorAll(".fileId");
    var fileError = document.getElementById("fileError");
    let videovalue = document.querySelectorAll(".videovalue");
    
    for (let i = 0; i < nameId.length; i++) {

      if (nameId[i].value == "") {
        // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
        $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>ادخل عنوان الفيديو </p>
                          </div>`);
        nameId[i].focus(); 
        return false;
      }
      nameError.innerHTML = "";

      if (fileId[i].value == "") {
        // fileError[i].innerHTML = "ارفق الفيديو  <b>";
        $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>يرجى إرفاق فيديو </p>
                          </div>`);
        fileId[i].focus(); 
        return false;
      }
      fileError[i].innerHTML = "";
      
      if (videovalue[i].value == "") {
        $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>يرجى الإنتظار حتي يتم التحميل</p>
                          </div>`);
        videovalue[i].focus(); // focuses on that particular input
        return false;
      }

    }
    return false;
  }      
  


</script>
    @toastr_js
    @toastr_render
@endsection
             
