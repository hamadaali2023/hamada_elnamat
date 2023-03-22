

@extends('layout.instructor.main')
@section('content') 
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  

  <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">إضافة دورة جديدة</h3><br>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>
            </li>
            <li class="breadcrumb-item active">الدورات
            </li>
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
                      @if($userid->suspended ==1)
                        <form action="{{route('curriculums.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                          @csrf
                          <div class="row form-row">
                                <div class="form-group col-md-6 col-sm-6">
                                    <label> اختر المنهج </label>
                                    <select name="title" class="form-control formselect"  id="get_title">
                                        <option value="" selected>اختار </option>
                                        <option value="المنهج الاردن"
                                        {{ old('title') == 'المنهج الاردن' ? "selected" : "" }}>
                                             المنهج الاردني
                                        <!--<option value="2" {{ old('classroom') == '2' ? "selected" : "" }}> -->
                                    </option>
                                    </select>
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <span id="titleError" style="color: red;"></span>
                                </div>



                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>حدد فرع او أكثر</label>
                                        <select name="branch_id[]" required class="select2 form-control" multiple="multiple" id="get_sub_category_name">
                                             <option    disabled>اختار</option>
                                            @foreach ($branches as $_item)
                                                <option value="{{$_item->id}}" {{ old('branch_id') == $_item->id ? "selected" : "" }}>{{$_item->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <span id="categoryError" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label>اختر المادة</label>
                                    <select name="material_id" class="form-control formselect"  id="get_sub_category" >
                                        <option  value="" selected>اختار </option>
                                        @foreach ($materials as $_item)
                                            <option value="{{$_item->id}}" {{ old('material_id') == $_item->id ? "selected" : "" }}>{{$_item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <span id="subcategoryError" style="color: red;"></span>
                                </div>



                                <!--<div class="form-group col-md-6 col-sm-6">-->
                                <!--    <label>حدد فرع او أكثر</label>-->
                                <!--    <select name="branch_id[]" class="form-control select2-diacritics "  placeholder="Select Category" id="get_sub_category_name" multiple>-->
                                <!--        <option  value=""  selected>اختار</option>  -->
                                <!--        @foreach ($branches as $_item) -->
                                <!--            <option value="{{$_item->id}}" {{ old('branch_id') == $_item->id ? "selected" : "" }}>{{$_item->name}}-->
                                <!--            </option>-->
                                <!--        @endforeach-->
                                <!--    </select>-->
                                <!--    @error('branch_id')-->
                                <!--        <span class="text-danger">{{$message}}</span>-->
                                <!--    @enderror-->
                                <!--    <span id="categoryError" style="color: red;"></span>-->
                                <!--</div>-->

                                <div class="form-group col-md-6 col-sm-6">
                                    <label> اختر الفصل الدراسي </label>
                                    <select name="classroom" class="form-control formselect"  id="get_classroom">
                                        <option value="" selected>اختار </option>
                                        <option value="1" {{ old('classroom') == '1' ? "selected" : "" }}>الفصل الاول
                                        <option value="2" {{ old('classroom') == '2' ? "selected" : "" }}>الفصل الثاني
                                    </option>
                                    </select>
                                    @error('classroom')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <span id="classroomError" style="color: red;"></span>
                                </div>
                            </div>


                            <div class="form-group col-md-12 col-sm-6 ">
                                <label>صورة العرض يجب أن يكون حجم صورة العرض ( العرض 1280 الطول 720  بيكسل ) ، صورة العرض هي بوست غلاف دورتك والذي يظهر بالصفحة الرئيسية ، لا تضع كلمات على الصورة ، فقط ضع صورة أو تصميم مناسب لموضوع دورتك لجذب انتباه الطلاب المشتركين</label>
                                <input type="file" name="imagee" id="imageeid" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
                                @error('imagee')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="imageeError" style="color: red;"></span>
                            </div>
                          <div class="col-md-12"><hr/></div>

                          <div class="col-md-2">
                            <a href="#Save-btn-scroll" onclick="addVideo()" class="btn btn-primary btn-block">إضافة درس أخر </a>
                          </div>
                          <div class="education-info" id="addvideo">
                              <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;" >
                                <div class="row form-row col-md-12">
                                    <div class=" col-md-6">
                                      <div class=" col-md-12">
                                        <div class="form-group">
                                          <label> عنوان الدرس</label>
                                          <input type="text" name="name[]" class="form-control nameId">
                                          <span id="nameError" style="color: red;"></span>
                                        </div> 
                                      </div>
                                     
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class=" col-md-12">
                                            <div class="form-group">
                                              <label>  تحميل الفيديو الذي يخص هذا الدرس ويجب أن يكون الأمتداد من نوع (.MP4,.FLV,.ogg,.webm.) </label>
                                              <input type="file" name="file" id="video1" onchange="saveVideo(video1,'1','videopath1','progress-bar1','hidden1','videovalue1','videotime1','videosize1')" class="form-control fileId" >
                                              <span id="fileError" style="color: red;"></span>
                                            </div> 
                                        </div>
                                         
                                        <div class="col-md-12 hidden1" id="hidden1" >
                                            <video controls="controls" id="videopath1" width="200">
                                               <source  src="" type="video/mp4">
                                            </video> 
                                            <input type="hidden" name="videovalue[]" class="videovalue" id="videovalue1" >
                                            <input type="hidden" name="videotime[]" class="videotime" id="videotime1" >
                                            <input type="hidden" name="videosize[]" class="videosize" id="videosize1" >
                                        </div> 
                                        <div class="col-md-12 ">
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
                          <div class="col-md-12" style="color: #FF4961; padding-right: 23px;padding-left: 23px" id="upload-error">  </div>
                          <br>
                           

                          <div class="form-group col-12 col-sm-12">
                              <button type="submit" id="Save-btn-scroll" class="btn btn-primary btn-block" onclick="return Validateallinput()">حفظ </button>
                              
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

                          </div>
                        </form>
                        @else
                    <!-- <div class="alert alert-warning mb-2" role="alert">
                      <strong>لا يمكنك إضافة دورات جديدة ! </strong><br> تم تعليق حسابك لأنك غير متبع معايير المنصة يرجى التواصل مع الإدارة
                    </div> -->
                   
                      <div class="bs-callout-danger callout-border-left mt-1 p-1">
                            <strong>لا يمكنك إضافة دورات جديدة !</strong>
                            <p>تم تعليق حسابك لأنك غير متبع معايير المنصة يرجى التواصل مع الإدارة.</p>
                        </div>
                  @endif
                      </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
  </section>
    <?php
       $videos=session()->get('videos_sessions');
    ?>


 <script src="{{asset('admin/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('admin/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>



<script>
    $('.loader-container').hide();
  let videoid = 1;
   $('.hidden1').hide();

  function saveVideo(video,id,videopath,progres,hiddenclassss,videovalue,videotime,videosize){
    $(function () {
        $.ajaxSetup({
          headers: {'X-CSRF-Token': '{{csrf_token()}}'}
        });

        var photo = $(video)[0].files[0];
    //   var photoooo = $(video)[0].files[0].size;
    //   console.log(photoooo);
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

            url: "{{route('curriculas-savevideo')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {

                console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<'+hiddenclassss);
                //  var div = document.getElementById(hiddenclassss);
                // div.classList.remove(hiddenclassss);
                $('.'+hiddenclassss).show();
                $('#'+videopath).attr('src', "https://www.elnamat.com/assets_admin/img/curriculums/videos/"+ data);
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
              document.getElementById(video).value = 'video.png';
              // $('#'+videovalue).append('eeeeeee');
            }
        });

    });


  }




 /// remove video from list and session

  function removevideo(videoId,id) {
      var myobj = document.getElementById(videoId);
      myobj.remove();
      if(confirm("Are you sure")) {
        $.ajax({
              type: 'GET',
              url: "{{url('curriculas-removeVideoSession')}}/"+id,
              success: function (response) {
                console.log(response+'nnnnnnnremovv>>>>>>>>');
            }
        });
      }
  }



  function addVideo(){
        videoid += 1;

        const itemid = Math.random();
        $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;margin: 24px;">
                            <div class="row form-row col-md-12 ">

                              <div class="col-md-6" >

                                  <div class=" col-md-12">
                                    <div class="form-group">
                                      <label>عنوان الدرس</label>
                                      <input type="text" name="name[]"  class="form-control nameId">
                                      <span id="nameError" style="color: red;"></span>
                                    </div>
                                  </div>

                              </div>
                              <div class="col-md-6">
                                <div class=" row form-row">
                                  <div class="col-md-10">
                                      <div class="form-group">
                                        <label>  تحميل الفيديو الذي يخص هذا الدرس ويجب أن يكون الأمتداد من نوع(.MP4,.FLV,.ogg,.webm.) </label>
                                        <input type="file" name="file" id="video${videoid}" onchange="saveVideo(video${videoid},'${videoid}','videopath${videoid}','progress-bar${videoid}','hidden${videoid}','videovalue${videoid}','videotime${videoid}','videosize${videoid}')" class="form-control fileId" accept=".MP4,.FLV,.ogg,.webm,.mov">
                                        <span id="fileError" style="color: red;"></span>
                                      </div>
                                  </div>
                                  <div class="col-md-2">
                                      <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                      <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id,'${videoid}')"><i class="far fa-trash-alt"></i>X</a>
                                  </div>
                                </div>
                                <div class="col-md-12 hidden${videoid}" id="hidden${videoid}">
                                      <video controls="controls" id="videopath${videoid}" width="200">
                                        <source  src="" type="video/mp4">
                                      </video>
                                       <input type="hidden" name="videovalue[]" class="videovalue" id="videovalue${videoid}" >
                                       <input type="hidden" name="videotime[]" class="videotime" id="videotime${videoid}" >
                                       <input type="hidden" name="videosize[]" class="videosize" id="videosize${videoid}" >

                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                      <div class="progress prog1">
                                        <div class="progress-bar progress-bar${videoid} prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                      </div>
                                    </div>
                                </div>
                              </div>

                            </div>
                          </div>`);
        $('.hidden'+videoid).hide();
  }

  function Validateallinput() {


    var categoryid = document.getElementById("get_sub_category_name");
    var categoryError = document.getElementById("categoryError");

    var subcategoryid = document.getElementById("get_sub_category");
    var subcategoryError = document.getElementById("subcategoryError");

    var get_classroom = document.getElementById("get_classroom");
    var classroomError = document.getElementById("classroomError");


    var get_name = document.getElementById("get_title");
    var nameError = document.getElementById("titleError");


    // var levelid = document.getElementById("levelid");
    // var levelError = document.getElementById("levelError");


    var imageeid = document.getElementById("imageeid");
    var imageeidError = document.getElementById("imageeidError");


    if (get_name.value == "") {
        nameError.innerHTML = "يرجى اختيار  المنهج ";
            return false;
    }
    nameError.innerHTML = "";

       if(subcategoryid.value == "") {
        subcategoryError.innerHTML = "يرجى أختيار المادة";
            // titleid.focus();
            return false;
    }
    subcategoryError.innerHTML = "";


    if (categoryid.value == "") {
        categoryError.innerHTML = "يرجى اختيار فرع أو أكثر";
            // titleid.focus();
            return false;
    }
    categoryError.innerHTML = "";



    if (get_classroom.value == "") {
        classroomError.innerHTML = "يرجى اختيار الفصل الدراسي ";
            // titleid.focus();
            return false;
    }
    classroomError.innerHTML = "";




    if (imageeid.value == "") {
        imageeError.innerHTML = " يرجى إضافة صورة للدورة";
            // titleid.focus();
            return false;
    }
    imageeError.innerHTML = "";




    var allowedExtensionsImage = /(\.JPEG|\.JPG|\.PNG|\.GIF|\.TIF|\.TIFF)$/i;
    if(!allowedExtensionsImage.exec(imageeid.value)){
        imageeError.innerHTML = "  يجب أن يكون الأمتداد من نوع (.JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF)   فقط" ;

        imageeid.value = '';
        // imageeid.focus();
        return false;
    }
     imageeError.innerHTML = "";





    var nameId = document.querySelectorAll(".nameId");
    var nameError = document.getElementById("nameError");
    let fileId = document.querySelectorAll(".fileId");
    var fileError = document.getElementById("fileError");
    let videovalue = document.querySelectorAll(".videovalue");

    let videotime = document.querySelectorAll(".videotime");


    for (let i = 0; i < nameId.length; i++) {

        if (nameId[i].value == "") {
             $('#upload-error').empty();
        // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
        $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong></strong>
                            <p>ادخل عنوان الفيديو </p>
                          </div>`);
            nameId[i].focus();
            return false;
        }


        if (fileId[i].value == "") {
            $('#upload-error').empty();

            $('#upload-error').append(`<div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong></strong>
                                <p>يرجى إرفاق فيديو </p>
                              </div>`);
            fileId[i].focus();
            return false;
        }


        var filePath = fileId[i].value;
        var allowedExtensions = /(\.MP4|\.FLV|\.ogg|\.webm|\.mov)$/i;
        if(!allowedExtensions.exec(filePath)){
            $('#upload-error').append(`<div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong> </strong>
                                <p> يجب أن يكون الأمتداد من نوع (.MP4,.FLV,.ogg,.webm.)فقط </p>
                              </div>`);

            fileId[i].value = '';
            fileId[i].focus();
            return false;
        }



        if (videovalue[i].value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong></strong>
                                <p>يرجى الإنتظار حتي يتم التحميل</p>
                              </div>`);
            videovalue[i].focus();
            return false;
        }

        if (videotime[i].value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong></strong>
                                <p>يرجى الإنتظار ثواني حتي يتم التحميل</p>
                              </div>`);
            videotime[i].focus();
            return false;
        }

    }
    for (let i = 0; i < nameId.length; i++) {

        if (videovalue[i].value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong></strong>
                                <p>يرجى الإنتظار حتي يتم التحميل</p>
                              </div>`);
            videovalue[i].focus();
            return false;
        }else{
            fileId[i].value= null;
        }

        if (videotime[i].value == "") {
             $('#upload-error').empty();
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                                <strong></strong>
                                <p>يرجى الإنتظار ثواني حتي يتم التحميل</p>
                              </div>`);
            videotime[i].focus();
            return false;
        }else{
            fileId[i].value= null;
        }

    }

    // for (let i = 0; i < nameId.length; i++) {
    //     fileId[i].value= null;

    // }
    $('.loader-container').show();
    // return false;
  }



</script>
<script>
		$(document).ready(function () {

// 			$('#get_sub_category_name').on('change', function () {
// 	        	console.log("welcome sub");
// 	        	let id = $(this).val();
// 	        		console.log(id);
// 	        		console.log(id);
// 			    $.ajax({
// 				    type: 'GET',
// 				    url: "{{url('instructor/getsubcategory')}}/"+id,
// 				    success: function (response) {
// 				        console.log("welcome subxxx");
// 				        var response = JSON.parse(response)
// 				        console.log(response);
// 					    $('#get_sub_category').empty();
// 					    $('#get_sub_category').append(`<option  value="" selected>اختار </option>`);
// 					    response.forEach(element => {
// 					        console.log(element['title']['en']);
// 					        $('#get_sub_category').append(`<option value="${element['id']}">
// 					        ${element['title']['ar']} - ${element['id']}
// 					        </option>`);
// 					    });
// 					}
// 				});
// 			});


// 			$('#get_sub_category_name').on('change', function () {
// 	       // 	console.log("welcome sub");

// 	        	let id = $(this).val();
// 			    $.ajax({
// 				    type: 'GET',
// 				    url: "{{url('instructor/getsubcategory')}}/"+id,
// 				    success: function (response) {
// 				        var response = JSON.parse(response)
// 				        // console.log(response);
// 					    $('#get_sub_category').empty();
// 					    $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
// 					    response.forEach(element => {
// 					   // 	console.log(element['id']);
// 					   // 	console.log(element['title']['ar']);
// 					        $('#get_sub_category').append(`<option value="${element['id']}">
// 					        ${element['title']['ar']}
// 					        </option>`);
// 					    });
// 					}
// 				});
// 			});


// 			$('#get_sub_category').on('change', function () {
// 	        	console.log("welcome sub");

// 	        	let id = $(this).val();
// 			    $.ajax({
// 				    type: 'GET',
// 				    url: "{{url('instructor/getchildcategory')}}/"+id,
// 				    success: function (response) {
// 				        var response = JSON.parse(response)
// 				        console.log(response);
// 					    $('#get_child_category').empty();
// 					    $('#get_child_category').append(`<option value="0" disabled selected>Select </option>`);
// 					    response.forEach(element => {
// 					    	console.log(element['id']);
// 					    	console.log(element['title']['ar']);
// 					        $('#get_child_category').append(`<option value="${element['id']}">
// 					        ${element['title']['ar']}
// 					        </option>`);
// 					    });
// 					}
// 				});
// 			});







	    });

	</script>
    <!--@toastr_js-->
    <!--@toastr_render-->
@endsection

<!-- 200 مقدم
400 عند الانتهاد من  التطبيق اندرويد و ios
100  عند الانتهاد من لوحة التحكم
100 بعد رفع التطبيق -->
