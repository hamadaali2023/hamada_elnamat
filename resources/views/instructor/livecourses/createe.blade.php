

@extends('layout.instructor.main')
@section('content') 
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  

  <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block">إضافة دورة مباشرة (اونلاين)</h3><br>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>
            </li>
            <li class="breadcrumb-item active">الدورات الاونلاين
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
                    <form action="{{route('straights.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                      @csrf
                      <div class="row form-row">
                          <div class="form-group col-md-4 col-sm-6">
                            <label>عنوان الدورة</label>
                            <input type="text" name="title" class="form-control" value="{{old('title')}}" id="titleid">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="titleError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-md-4 col-sm-6">
                            <label>وصف قصير </label>
                            <input type="text" name="short_detail" class="form-control" value="{{old('short_detail')}}" id="short_detailid">
                            @error('short_detail')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="short_detailError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-md-4 col-sm-6">
                            <label>وصف طويل للكورس</label>
                            <input type="text" name="detail" class="form-control" value="{{old('detail')}}" id="detailid">
                            @error('detail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="detailError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>تاريخ بداية الكورس </label>
                              <input type="date" name="date" class="form-control" value="{{old('date')}}" id="dateid">
                              @error('date')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                              <span id="dateError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-md-6 col-sm-6">
                            <label>تاريخ نهاية الكورس </label>
                            <input type="date" name="endDate" class="form-control" value="{{old('endDate')}}" id="endDateid">
                            @error('endDate')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="endDateError" style="color: red;"></span>
                          </div>                      
                          <div class="form-group col-md-6 col-sm-6">
                            <label>مدة الكورس (ساعة)</label>
                            <input type="text" name="duration" class="form-control" value="{{old('duration')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" id="durationid">
                            @error('duration')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="durationError" style="color: red;"></span>
                          </div>
                          <div class="form-group col-md-6 col-sm-6">                                   
                          <label>حدد الكورس مجاني ام مدفوع</label>
                            <select name="payed" class="form-control formselect" id="payedId">
                              <option value="0" {{ old('payed') == "0" ? "selected" : "" }}>مجاني</option>  
                              <option value="1" {{ old('payed') == "1" ? "selected" : "" }}>مدفوع</option>   
                            </select>
                            <!--   @error('payed')-->
                            <!--       <span class="text-danger">{{$message}}</span>-->
                            <!--@enderror-->
                          </div>
                          <div class="form-group col-12 col-sm-6">
                            <label>السعر (دولار)</label>
                            <input type="text" name="price" class="form-control" id="priceId" value="{{old('price')}}" disabled>
                          </div>
                          <div class="form-group col-sm-6 ">
                            <label>صورة العرض </label>
                            <input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF" id="imageid">
                            <span id="imageError" style="color: red;"></span>
                          </div>
                      </div>
                      <div class="col-md-12"><hr/></div>
                    
                        <div class="col-md-12">
                            <p>يرجى تقسيم الكورس إلى عدة مجموعات من المحاضرات وإدخال البيانات المطلوبة</p>
                        </div>
                      <div class="col-md-3">
                        <a href="#" onclick="addVideo()" class="btn btn-primary btn-block">إضافة بيانات محاضره جديدة</a>
                      </div>
                      <div class="col-md-12">
                        <p>يرجى تقسيم الكورس إلى عدة مجموعات من المحاضرات وإدخال البيانات المطلوبة</p>
                      </div>
                      <div class="education-info" id="addvideo">
                          <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                            <div class="row form-row col-md-12">
                                <div class="form-group col-md-12 col-sm-6">
                                  <label> عنوان المحاضرة</label>
                                  <input type="text" name="sessiontitle[]" class="form-control sessiontitleid" value="{{old('sessiontitle')}}" id="sessiontitleid">
                                  @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="sessiontitleError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-md-4 col-md-4">
                                  <label> تاريخ المحاضرة</label>
                                  <input type="date" name="sessiondate[]" class="form-control sessiondateid" value="{{old('sessiondate')}}" id="sessiondateid">
                                    @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="sessiondateError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-md-4 col-md-4">
                                    <label> وقت المحاضرة </label>
                                    <input type="time" name="time[]" class="form-control timeid" value="{{old('time')}}" id="timeid">
                                    @error('time')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="timeError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-md-4 col-md-4">
                                  <label> مدة المحاضرة (دقيقة) </label>
                                    <input type="number" name="sessionduration[]" class="form-control sessiondurationid" value="{{old('sessionduration')}}" id="sessiondurationid" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    @error('duration')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="sessiondurationError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-12"></hr></div>   
                                <div class="form-group col-12 col-md-12">
                                    <label> يرجى إضافة بيانات الزوم قبل موعد المحاضرة ب 15 دقيقة </label>
                                </div>   
                                <div class="form-group col-12 col-md-4">
                                  <label> الرابط </label>
                                  <input type="text" name="url[]" class="form-control urlid" value="{{old('url')}}" id="urlid">
                                  @error('url')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="urlError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label> كلمة المرور</label>
                                  <input type="text" name="meeting_password[]" class="form-control meeting_passwordid" value="{{old('meeting_password')}}" id="meeting_passwordid">
                                  @error('meeting_password')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="meeting_passwordError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label>meeting Id </label>
                                  <input type="text" name="meeting_id[]" class="form-control meeting_idid" value="{{old('meeting_id')}}" id="meeting_idid">
                                  @error('meeting_id')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="meeting_idError" style="color: red;"></span>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-12" style="color: #FF4961; padding-right: 23px;padding-left: 23px" id="upload-error">  </div>
                      <br>
                       

                      <div class="col-12 col-md-12">
                        <div class="form-group col-12 col-md-4">
                          <button type="submit" class="btn btn-primary btn-block" onclick="return Validateallinput()">حفظ </button>
                         </div> 
                        <div class="loader-wrapper col-md-4" >
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
                  </div>
                </div>
              </div>
            </div>
          </div>
  </section>
    <?php 
       $videos=session()->get('videos_sessions');
    ?>

<script>
    $('.loader-container').hide();
  let videoid = 1;
   $('.hidden1').hide();
  



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
                              <div class="col-md-11">
                                    <div class="form-group">
                                      <label> عنوان المحاضرة</label>
                                      <input type="text" name="sessiontitle[]" class="form-control sessiontitleid" value="{{old('sessiontitle')}}" id="sessiontitleid">
                                      @error('sessiontitle')
                                      <span class="text-danger">{{$message}}</span>
                                      @enderror
                                       <span id="sessiontitleError" style="color: red;"></span>
                                    </div>
                              </div>
                              <div class="col-md-1">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id,'${videoid}')"><i class="far fa-trash-alt"></i>X</a>
                              </div>

                              <div class="row col-md-11">
                               <div class="form-group col-md-4 col-md-4">
                                  <label> تاريخ المحاضرة</label>
                                  <input type="date" name="sessiondate[]" class="form-control sessiondateid" value="{{old('sessiondate')}}" id="sessiondateid">
                                    @error('date')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="sessiondateError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-md-4 col-md-4">
                                    <label> وقت المحاضرة </label>
                                    <input type="time" name="time[]" class="form-control timeid" value="{{old('time')}}" id="timeid">
                                    @error('time')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="timeError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-md-4 col-md-4">
                                  <label> مدة المحاضرة (دقيقة) </label>
                                    <input type="number" name="sessionduration[]" class="form-control sessiondurationid" value="{{old('sessionduration')}}" id="sessiondurationid" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                    @error('duration')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="sessiondurationError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-12"></hr></div>   
                                <div class="form-group col-12 col-md-12">
                                    <label> يرجى إضافة بيانات الزوم قبل موعد المحاضرة ب 15 دقيقة </label>
                                </div>   
                                <div class="form-group col-12 col-md-4">
                                  <label> الرابط </label>
                                  <input type="text" name="url[]" class="form-control urlid" value="{{old('url')}}" id="urlid">
                                  @error('url')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="urlError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label> كلمة المرور</label>
                                  <input type="text" name="meeting_password[]" class="form-control meeting_passwordid" value="{{old('meeting_password')}}" id="meeting_passwordid">
                                  @error('meeting_password')
                                  <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="meeting_passwordError" style="color: red;"></span>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                  <label>meeting Id </label>
                                  <input type="text" name="meeting_id[]" class="form-control meeting_idid" value="{{old('meeting_id')}}" id="meeting_idid">
                                  @error('meeting_id')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                  <span id="meeting_idError" style="color: red;"></span>
                                </div>

                              </div>
                            </div>
                          </div>`); 
        $('.hidden'+videoid).hide(); 
  }
  
  function Validateallinput() {
    
    
    var titleid = document.getElementById("titleid");
    var titleError = document.getElementById("titleError");

    var short_detailid = document.getElementById("short_detailid");
    var short_detailError = document.getElementById("short_detailError");

    var detailid = document.getElementById("detailid");
    var detailError = document.getElementById("detailError");

    var dateid = document.getElementById("dateid");
    var dateError = document.getElementById("dateError");

    var endDateid = document.getElementById("endDateid");
    var endDateError = document.getElementById("endDateError");

    var durationid = document.getElementById("durationid");
    var durationError = document.getElementById("durationError");


    var imageid = document.getElementById("imageid");
    var imageError = document.getElementById("imageError");

    if (titleid.value == "") {
        titleError.innerHTML = "يرجى كتابة العنوان";
            // titleid.focus(); 
            return false;
    }
    titleError.innerHTML = "";

    

    if (short_detailid.value == "") {
        short_detailError.innerHTML = "يرجى ادخال وصف قصير";
        // titleid.focus(); 
        return false;
    }
    short_detailError.innerHTML = "";

   
    if (detailid.value == "") {
        detailError.innerHTML = "يرجى ادخال  وصف طويل للكورس";
        // titleid.focus(); 
        return false;
    }
    detailError.innerHTML = "";

    if (dateid.value == "") {
        dateError.innerHTML = "يرجى ادخال تاريخ بداية الكورس";
        // titleid.focus(); 
        return false;
    }
    dateError.innerHTML = "";


    if (endDateid.value == "") {
        endDateError.innerHTML = "يرجى ادخال تاريخ نهاية الكورس";
        // titleid.focus(); 
        return false;
    }
    endDateError.innerHTML = "";


    if (durationid.value == "") {
        durationError.innerHTML = "يرجى ادخال مدة الكورس";
        // titleid.focus(); 
        return false;    
    }
    durationError.innerHTML = "";
    
    if(!/^[0-9]+$/.test(durationid.value)){
      durationError.innerHTML = "الرجاء إدخال رقم فقط";
      // alert("Please only enter numeric characters only for your Age! (Allowed input:0-9)")
      return false;
    }
    durationError.innerHTML = "";

    

    if (imageid.value == "") {
        imageError.innerHTML = "يرجى ارفاق صورة";
        // titleid.focus(); 
        return false;
    }
    imageError.innerHTML = "";


    var sessiontitleid = document.querySelectorAll(".sessiontitleid");
    var sessiontitleError = document.getElementById("sessiontitleError");

    var sessiondateid = document.querySelectorAll(".sessiondateid");
    var sessiondateError = document.getElementById("sessiondateError");

    var timeid = document.querySelectorAll(".timeid");
    var timeError = document.getElementById("timeError");

    var sessiondurationid = document.querySelectorAll(".sessiondurationid");
    var sessiondurationError = document.getElementById("sessiondurationError");

   
    
    for (let i = 0; i < sessiontitleid.length; i++) { 



        if (sessiontitleid[i].value == "") {
            $('#upload-error').empty();
            // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>ادخل عنوان المحاضرة </p>
                          </div>`);
            sessiontitleid[i].focus(); 
            return false;
        }

        if (sessiondateid[i].value == "") {
            $('#upload-error').empty();
            // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>ادخل تاريخ المحاضرة </p>
                          </div>`);
            sessiondateid[i].focus(); 
            return false;
        }


        if (timeid[i].value == "") {
            $('#upload-error').empty();
            // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>ادخل وقت المحاضرة </p>
                          </div>`);
            timeid[i].focus(); 
            return false;
        }

        if (sessiondurationid[i].value == "") {
            $('#upload-error').empty();
            // nameError.innerHTML = "ادخل عنوان الفيديو  <b>";
            $('#upload-error').append(` <div class="bs-callout-pink callout-border-left mt-1 p-1 error-upload" >
                            <strong>خطأ !!</strong>
                            <p>ادخل مدة المحاضرة </p>
                          </div>`);
            sessiondurationid[i].focus(); 
            return false;
        }
        
        
    
       
    }
    
    $('.loader-container').show();
    // return false;
  }      
  


</script>



 <script>
        $(document).ready(function () {
            $('#payedId').on('change', function () {
                
                console.log("welcome sub"); 
                let payedId = $(this).val();
                console.log(payedId); 
                if(payedId ==1){
                    document.getElementById('priceId').disabled = false;
                }else{
                    document.getElementById('priceId').value = "";
                    document.getElementById('priceId').disabled = true;
                }
            });
        });
    </script>
    <!--@toastr_js-->
    <!--@toastr_render-->
@endsection
             
<!-- 200 مقدم
400 عند الانتهاد من  التطبيق اندرويد و ios
100  عند الانتهاد من لوحة التحكم
100 بعد رفع التطبيق --> 