

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
                        <form action="{{route('courses.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                          @csrf
                          <div class="row form-row">
                            <div class="form-group col-md-6 col-sm-6">
                              <label>التخصص</label>
                              <select name="categoryId" class="form-control select2-diacritics "  placeholder="Select Category" id="get_sub_category_name">
                                <option  value=""  selected>اختار</option>  
                                @foreach ($categories as $_item) 
                                <option value="{{$_item->id}}" {{ old('categoryId') == $_item->id ? "selected" : "" }}>{{$_item->title}}
                                </option>
                                @endforeach
                              </select>
                              @error('categoryId')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                              <span id="categoryError" style="color: red;"></span>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">               
                                <label>التخصص الفرعي</label>
                                <select name="subCategoryId" class="form-control formselect"  id="get_sub_category" >
                                    <option  value="" selected>اختار </option>  
                                </select>
                                <span id="subcategoryError" style="color: red;"></span>
                            </div>
                
                            <!--  <div class="form-group col-md-4 col-sm-6">               -->
                            <!--        <label>التخصص المستوى الثالث</label>-->
                            <!--       <select name="childCategoryId" class="form-control formselect"  id="get_child_category">-->
                            <!--              <option  disabled selected>اختار </option>  -->
                            <!--    </select>-->
                            <!--  </div>-->
                            <!--</div>-->
                            <div class="form-group col-md-6 col-sm-6">
                              <label>عنوان الدورة عربي</label>
                              <input type="text" name="title" class="form-control " id="titleid" >
                                @error('title')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="titleError" style="color: red;"></span>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                              <label>عنوان الدورة انجليزي</label>
                              <input type="text" name="title_ar" class="form-control " id="titlearid" >
                                @error('title_ar')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="titlearError" style="color: red;"></span>
                            </div>
                            <!--<div class="form-group col-md-4 col-sm-6">-->
                            <!--  <label>مستوي الكورس</label>-->
                            <!--  <input type="text" name="level" class="form-control" value="{{old('level')}}" id="levelid">-->
                            <!--  @error('level')-->
                            <!--    <span class="text-danger">{{$message}}</span>-->
                            <!--  @enderror-->
                            <!--  <span id="levelError" style="color: red;"></span>-->
                            <!--</div>-->
          <!--                  <div class="form-group col-md-4 col-sm-6">               -->
               <!--       <label>مستوى الكورس</label>-->
               <!--      <select name="level" class="form-control formselect"  id="levelid">-->
              <!--              <option   value=""  selected>حدد مستوى الكورس </option>-->
              <!--              <option  value="مبتدئ">مبتدئ </option>-->
                <!--    <option  value="متقدم">متقدم </option>-->
                <!--  </select>-->
                <!--  @error('level')-->
          <!--                          <span class="text-danger">{{$message}}</span>-->
          <!--                      @enderror-->
          <!--                      <span id="levelError" style="color: red;"></span>-->
                <!--</div>-->
                            <div class="form-group col-md-12 col-sm-6">
                                  <label> وصف طويل ( أهداف و محتويات الدورة ، الفئة المستهدفة ) </label>
                                  <!--<input type="text" name="detail" class="form-control" value="{{old('detail')}}" id='detailid'>-->
                                  <textarea name="detail"  cols="30" rows="4"  class="form-control ckeditor" id='detailid'>{{old('detail')}}</textarea>

                                  @error('detail')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="detailError" style="color: red;"></span>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>وصف قصير</label>
                                <textarea name="short_detail"  cols="30" rows="2"  class="form-control ckeditor" id='short_detailid'>{{old('short_detail')}}</textarea>
                                <!--<input type="text" name="short_detail" class="form-control"  id='short_detailid'>-->
                                @error('short_detail')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="short_detailError" style="color: red;"></span>
                            </div>
                           
                            <div class="form-group col-md-6 col-sm-6">
                                <label>المتطلبات للدورة </label>
                                <textarea name="requirement"  cols="30" rows="2"  class="form-control ckeditor" id="requirementid">{{old('requirement')}}</textarea>
                                  <!--<input type="text" name="requirement" class="form-control" id="requirementid">-->
                                  @error('requirement')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="requirementError" style="color: red;"></span>
                            </div>
                            <!--<div class="form-group col-md-4 col-sm-6">-->
                            <!--    <label>مدة الكورس</label>-->
                            <!--    <input type="number" name="duration" class="form-control" id="durationid" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">-->
                            <!--    @error('duration')-->
                            <!--      <span class="text-danger">{{$message}}</span>-->
                            <!--    @enderror-->
                            <!--    <span id="durationError" style="color: red;"></span>-->
                            <!--</div>-->
                            <div class="form-group col-md-12 col-sm-6">
                                <label for="projectinput9">ضع كلمات تصف الدورة من أجل محركات البحث</label>
                                <!--<input type="text" name="meta_key" class="form-control" id="metakeyid" placeholder="مثال:  التنمية البشرية ، تطوير الذات ، التفكير">-->
                                <textarea name="meta_key" cols="30" rows="2"  class="form-control ckeditor"  placeholder="مثال:  التنمية البشرية ، تطوير الذات ، التفكير" id="metakeyid">{{old('meta_key')}}</textarea>

                                <!--<textarea id="projectinput9" rows="1" class="form-control" id="metakeyid" name="meta_key" >{{old('meta_key')}}</textarea>-->
                                  @error('meta_key')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                <span id="metakeyError" style="color: red;"></span>
                            </div>
                            <!-- <div class="form-group col-md-4 col-sm-6 ">
                                <label for="projectinput9">شرح للسيرش انجن</label>
                                <textarea id="projectinput9" rows="1" class="form-control" id="meta_descid" name="meta_desc" >{{old('meta_desc')}}</textarea>
                                @error('meta_desc')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="meta_descError" style="color: red;"></span>
                            </div> -->
                            <div class="form-group col-md-12 col-sm-6 ">
                                <label>صورة العرض يجب أن يكون حجم صورة العرض ( العرض 1280 الطول 720  بيكسل ) ، صورة العرض هي بوست غلاف دورتك والذي يظهر بالصفحة الرئيسية ، لا تضع كلمات على الصورة ، فقط ضع صورة أو تصميم مناسب لموضوع دورتك لجذب انتباه الطلاب المشتركين</label>
                                <input type="file" name="imagee" id="imageeid" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
                                @error('imagee')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="imageeError" style="color: red;"></span>
                            </div>
                          </div>
                          <div class="col-md-12"><hr/></div>

                          <div class="col-md-2">
                            <a href="#Save-btn-scroll" onclick="addVideo()" class="btn btn-primary btn-block">إضافة درس أخر </a>
                          </div>
                          <div class="education-info" id="addvideo">
                              <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
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
                                              <input type="file" name="file" id="video1" onchange="saveVideo(video1,'1','videopath1','progress-bar1','hidden1','videovalue1','videotime1','videosize1')" class="form-control fileId" accept=".MP4,.FLV,.ogg,.webm,.mov">
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

  <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<><<<><<<><><<ff -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<[[[[[[[[[>>>   -->




<script>
		$(document).ready(function () {
		    
			$('#get_sub_category_name').on('change', function () {
	        	console.log("welcome sub"); 
	        	let id = $(this).val();
	        		console.log(id); 
	        		console.log(id); 
			    $.ajax({
				    type: 'GET',
				    url: "{{url('instructor/getsubcategory')}}/"+id,
				    success: function (response) {
				        console.log("welcome subxxx"); 
				        var response = JSON.parse(response)
				        console.log(response);   
					    $('#get_sub_category').empty();
					    $('#get_sub_category').append(`<option  value="" selected>اختار </option>`);
					    response.forEach(element => {
					        console.log(element['title']['en']);   
					        $('#get_sub_category').append(`<option value="${element['id']}">
					        ${element['title']['ar']} - ${element['id']} 
					        </option>`);
					    });
					}
				});
			});
			
			
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
			
			
			$('#get_sub_category').on('change', function () {
	        	console.log("welcome sub"); 
	        	
	        	let id = $(this).val();
			    $.ajax({
				    type: 'GET',
				    url: "{{url('instructor/getchildcategory')}}/"+id,
				    success: function (response) {
				        var response = JSON.parse(response)
				        console.log(response);   
					    $('#get_child_category').empty();
					    $('#get_child_category').append(`<option value="0" disabled selected>Select </option>`);
					    response.forEach(element => {
					    	console.log(element['id']);
					    	console.log(element['title']['ar']);
					        $('#get_child_category').append(`<option value="${element['id']}">
					        ${element['title']['ar']}
					        </option>`);
					    });
					}
				});
			});
			
			
			
			
			
			
			
	    });

	</script>


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

            url: "{{route('savevideo')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('ffffffsaid');
                console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<'+hiddenclassss);
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
    
    var titleid = document.getElementById("titleid");
    var titleError = document.getElementById("titleError");
    
    var titlearid = document.getElementById("titlearid");
    var titlearError = document.getElementById("titlearError");
    

    // var levelid = document.getElementById("levelid");
    // var levelError = document.getElementById("levelError");

    var short_detailid = document.getElementById("short_detailid");
    var short_detailError = document.getElementById("short_detailError");

    var detailid = document.getElementById("detailid");
    var detailError = document.getElementById("detailError");

    var requirementid = document.getElementById("requirementid");
    var requirementidError = document.getElementById("requirementError");

    // var durationid = document.getElementById("durationid");
    // var durationError = document.getElementById("durationError");
 
    var metakeyid = document.getElementById("metakeyid");
    var metakeyError = document.getElementById("metakeyError");

    // var metadescid = document.getElementById("meta_descid");
    // var metadescError = document.getElementById("meta_descError");

    var imageeid = document.getElementById("imageeid");
    var imageeidError = document.getElementById("imageeidError");
    
    if (categoryid.value == "") {
        categoryError.innerHTML = "يرجى ادخال المستوى الرئيسي";
            // titleid.focus(); 
            return false;
    }
    categoryError.innerHTML = "";
    
    if (subcategoryid.value == "") {
        subcategoryError.innerHTML = "يرجي إدخال المستوى الفرعي";
            // titleid.focus(); 
            return false;
    }
    subcategoryError.innerHTML = "";
    
    
    
    if (titleid.value == "") {
        titleError.innerHTML = "يرجى كتابة العنوان";
            // titleid.focus(); 
            return false;
    }
    titleError.innerHTML = "";
    
    if (titlearid.value == "") {
        titlearError.innerHTML = "يرجى كتابة العنوان انجليزي";
            // titleid.focus(); 
            return false;
    }
    titlearError.innerHTML = "";

    
    if (detailid.value == "") {
        detailError.innerHTML = " يرجى كتابة وصف للدورة ";
            // titleid.focus(); 
            return false;
    }
    detailError.innerHTML = "";
    
    if (short_detailid.value == "") {
        short_detailError.innerHTML = "يرجى ادخال تفاصيل قصيرة للدورة";
            // titleid.focus(); 
            return false;
    }
    short_detailError.innerHTML = "";
    
    if (requirementid.value == "") {
        requirementError.innerHTML = "يرجى ادخال متطلبات للدورة";
            // titleid.focus(); 
            return false;
    }
    requirementError.innerHTML = "";

    if (metakeyid.value == "") {
        metakeyError.innerHTML = "يرجى كتابة كلمات دلالية عن للدورة";
            // titleid.focus(); 
            return false;
    }
    metakeyError.innerHTML = "";
    
    
    
    // if (metadescid.value == "") {
    //     metadescError.innerHTML = "يرجى كتابة العنوان";
    //         // titleid.focus(); 
    //         return false;
    // }
    // metadescError.innerHTML = "";
    
    
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
    <!--@toastr_js-->
    <!--@toastr_render-->
@endsection
             
<!-- 200 مقدم
400 عند الانتهاد من  التطبيق اندرويد و ios
100  عند الانتهاد من لوحة التحكم
100 بعد رفع التطبيق --> 