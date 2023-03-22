

@extends('layout.instructor.main')
@section('content') 
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
  

<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> الاستشارات</h3><br>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a></li>   
                <li class="breadcrumb-item active">الاستشارات</li>
                </ol> 
            </div>
        </div>
    </div>
    @if(session()->has('message'))
            @include('admin.includes.alerts.success')
    @endif   
    @if(Session::has('errorss'))   
                             <div class="alert alert-danger mb-2" role="alert">
    							{{Session::get('errorss')}}
    						</div>
                        @endif 
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
                    <form action="{{route('consultings.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="row form-row">
                          <!--<div class="form-group col-md-12 col-sm-6">-->
                          <!--  <label>عنوان الاستشارة</label>-->
                          <!--  <input type="text" name="title" class="form-control" value="{{old('title')}}" id="titleid">-->
                          <!--  @error('title')-->
                          <!--  <span class="text-danger">{{$message}}</span>-->
                          <!--  @enderror-->
                          <!--  <span id="titleError" style="color: red;"></span>-->
                          <!--</div>-->
                            <div class="form-group col-md-12 col-sm-6">                                   
                                <label>نوع الاستشارة </label>
                                <select name="title" class="form-control formselect" id="titleid">
                                    <option  value=""  selected>اختار</option>  
                                    <option value="نفسية">
                                        نفسية
                                    </option>  
                                    <option value="تربوية" >
                                        تربوية
                                    </option>  
                                    <option value="أسرية" >
                                         أسرية
                                    </option> 
                                    <option value="إدارية ومالية " >
                                         إدارية ومالية 
                                    </option> 
                                    <option value="قانونية" >
                                         قانونية
                                    </option> 
                                    <option value="تنمية بشرية" >
                                         تنمية بشرية
                                    </option> 
                                    <option value="تغذية ورجيم" >
                                        تغذية ورجيم 
                                    </option> 
                                    <option value="بحث علمي" >
                                        بحث علمي 
                                    </option> 
                                    <option value="تقنية وفنية" >
                                        تقنية وفنية 
                                    </option> 
                                    
                                </select>
                                <span id="titleError" style="color: red;"></span>
                            </div>  
                          
                            <div class="form-group col-md-6 col-sm-6">
                                <label>موضوعات الاستشارة</label>
                                <textarea name="mahawir"  cols="30" rows="2"  class="form-control" id="mahawirid">{{old('mahawir')}}</textarea>
                                @error('mahawir')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="mahawirError" style="color: red;"></span>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>وصف قصير</label>
                                <textarea name="short_detail"  cols="30" rows="2"  class="form-control" id="short_detailid">{{old('short_detail')}}</textarea>
                                <!--<input type="text" name="short_detail" class="form-control" value="{{old('short_detail')}}" id="short_detailid">-->
                                @error('short_detail')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="short_detailError" style="color: red;"></span>
                            </div>
                            
                            
                            <div class="form-group col-md-6 col-sm-6">                                   
                                <label>حدد مدة الاستشارة بالدقائق</label>
                                <select name="duration" class="form-control formselect" id="durationid">
                                    <option  value=""  selected>اختار</option>  
                                    <option value="45">
                                        45
                                    </option>
                                </select>
                                <span id="durationError" style="color: red;"></span>
                            </div>  
                            
                            <div class="form-group col-md-6 col-sm-6">                                   
                                <label>حدد سعر الاستشارة</label>
                                <select name="price" class="form-control formselect" id="priceid">
                                    <option value="0"  selected>مجاني</option>  
                                    <option value="5">5</option>  
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                </select>
                                <span id="priceError" style="color: red;"></span>
                            </div>
                            
                            <div class="form-group col-sm-6 ">
                                <label>صورة العرض </label>
                                <input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF" id="imageid">
                                <span id="imageError" style="color: red;"></span>
                            </div>
                      </div>
                      <!--<div class="col-md-12"><hr/></div>-->
                    
                       

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
  





  function Validateallinput() {
    
    
    var titleid = document.getElementById("titleid");
    var titleError = document.getElementById("titleError");

    var short_detailid = document.getElementById("short_detailid");
    var short_detailError = document.getElementById("short_detailError");
    
    // var short_detailid = document.getElementById("short_detailid");
    // var short_detailError = document.getElementById("short_detailError");

    // var target_groupid = document.getElementById("target_groupid");
    // var target_groupError = document.getElementById("target_groupError");
    
    var mahawirid = document.getElementById("mahawirid");
    var mahawirError = document.getElementById("mahawirError");

    var priceid = document.getElementById("priceid");
    var priceError = document.getElementById("priceError");

    // var timeid = document.getElementById("timeid");
    // var timeError = document.getElementById("timeError");

    var durationid = document.getElementById("durationid");
    var durationError = document.getElementById("durationError");


    var imageid = document.getElementById("imageid");
    var imageError = document.getElementById("imageError");


    
    
    
    




    if (titleid.value == "") {
        titleError.innerHTML = "يرجى اختيار نوع الاستشارة";
            // titleid.focus(); 
            return false;
    }
    titleError.innerHTML = "";

    if (mahawirid.value == "") {
        mahawirError.innerHTML = "يرجى ادخال موضوعات الاستشارة ";
        // titleid.focus(); 
        return false;
    }
    mahawirError.innerHTML = "";

    if (short_detailid.value == "") {
        short_detailError.innerHTML = "يرجى ادخال وصف قصير";
        // titleid.focus(); 
        return false;
    }
    short_detailError.innerHTML = "";
    
    if (durationid.value == "") {
        durationError.innerHTML = "يرجى ادخال مدة الاستشارة";
        // titleid.focus(); 
        return false;    
    }
    durationError.innerHTML = "";

    
    if (priceid.value == "") {
        priceError.innerHTML = "يرجى تحديد السعر";
        // titleid.focus(); 
        return false;
    }
    priceError.innerHTML = "";

    
    if (imageid.value == "") {
        imageError.innerHTML = "يرجى ارفاق صورة";
        // titleid.focus(); 
        return false;
    }
    imageError.innerHTML = "";

    var allowedExtensionsImage = /(\.JPEG|\.JPG|\.PNG|\.GIF|\.TIF|\.TIFF)$/i;
    if(!allowedExtensionsImage.exec(imageid.value)){
        imageError.innerHTML = "  يجب أن يكون الأمتداد من نوع (.JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF)   فقط" ;
           
        imageid.value = '';
        // imageeid.focus(); 
        return false;
    }
    imageError.innerHTML = "";
     
   
    
    
   
    $('.loader-container').show();
    // return false;
  }      
  


</script>



@endsection
             