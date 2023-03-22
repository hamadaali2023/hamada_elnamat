<!-- 
@extends('layout.instructor.main')
@section('content') 

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                            @include('admin.includes.alerts.success')
                        @endif

                      </div>
                    </div>
                   
    </div>


<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4>
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

                     <div class="card-body">
                      <h4 class="card-title">Education</h4>
                      <div class="education-info" id="addvideo">

                        <div class="row form-row education-cont">
                          <div class="col-12 col-md-10 col-lg-11">
                            <div class="row form-row">
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" class="form-control">
                                </div> 
                              </div>
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="text" class="form-control">
                                </div> 
                              </div>
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                  <label>Year of Completion</label>
                                  <input type="text" class="form-control">
                                </div> 
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row form-row education-cont">
                          <div class="col-12 col-md-10 col-lg-11">
                            <div class="row form-row">
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" class="form-control">
                                </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="text" class="form-control">
                                </div>
                              </div>
                              <div class="col-12 col-md-6 col-lg-4">
                                  <div class="form-group">
                                    <label>Year of Completion</label>
                                    <input type="text" class="form-control">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-2 col-lg-1">
                            <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                            <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                          </div>
                        </div>
                        
                      </div>
                      <div class="add-more">
                        <button onclick="addVideo()">Click me</button>
                       
                      </div>
                    </div>
                    <form action="{{route('chapters.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                              @csrf
                              <div class="row form-row">
                                <div class="form-group col-12 col-sm-6">
                                  <label>اختر الكورس</label>
                                  <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                                    <option  disabled >Select</option>  
                                    @foreach ($courses as $_item) 
                                      <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                                    @endforeach
                                  </select>
                                  @error('courseId')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                  <label>العنوان</label>
                                  <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                                    @error('chapter_name')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-sm-6">
                                  <label>رقم الشابتر</label>
                                  <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                                                    @error('short_number')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                              </div>
                          <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                          </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    
 <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script> 
        $(document).ready(function () {
          function addVideo(){
            $('#addvideo').append(`<h3>dddddd efetgetg fetgwetgt fgte</h3>`);       
            
          }
        });
        $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getSubCategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']} - ${element['id']} 
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
</script> 
    @toastr_js
    @toastr_render
@endsection -->


<div class="education-info" id="addvideo">

 </div> 
 <div class="add-more">
                        <button onclick="addVideo()">Click me</button>
                       
                      </div>
<script> 
        $(document).ready(function () {
          function addVideo(){
            $('#addvideo').append(`<h3>dddddd efetgetg fetgwetgt fgte</h3>`);       
            
          }
        });
</script>        




<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel 8 Bootstrap 5 Progress Bar Example</title>
@include('layout.instructor.head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5" style="max-width: 500px">

        <form id="fileUploadForm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <input name="file" type="file" class="form-control">
            </div>

            <div class="d-grid mb-3">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>

            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
        </form>
    </div>
    @include('layout.instructor.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    <script>
        $(function () {
            $(document).ready(function () {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                    }
                });
            });
        });
    </script>


    
</body>

</html>








<form id="fileUploadForm" method="POST" action="http://localhost:8000/upload-doc-file" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="mgpGLYeYCAnZyg99gnG7uGZA9XoDdPucdiUrXxxi">                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onclick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </form>

<form id="fileUploadForm" method="POST" action="http://localhost:8000/upload-doc-file" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="mgpGLYeYCAnZyg99gnG7uGZA9XoDdPucdiUrXxxi">                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid0.01796940555222548" onclick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </form>






<script> 
    function addVideo(){
      const itemid = Math.random();
      // alert(itemid);
      $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}">
                          <div class="col-md-12 ">
                          <form id="fileUploadForm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name"  class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8 ">
                            <div class="form-group">
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                              </div>
                            </div>
                          </div> 
                          <div class="col-md-12">
                            <hr/>
                          </div>
                          </form>
                        </div>`); 

        

                      
  }

  function removevideo(videoId) {
    var myobj = document.getElementById(videoId);
    myobj.remove();
  }
</script> 

















@extends('layout.instructor.main')
@section('content') 

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif

                      </div>
                    </div>
                   
    </div>





<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4> -->
                  <form action="{{route('chapters.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                      </div>
                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                              <option  disabled >Select</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                              @endforeach
                            </select>
                            @error('courseId')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                              @error('chapter_name')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                              @error('short_number')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        </div>
                      
                    </form>


                    
                       <div class="add-more">
                        <button onclick="addVideo()">إضافة فيديو</button>
                      </div>

                      <div class="education-info" id="addvideo">
                        <div class="row form-row education-cont">
                          <div class=" col-md-12">
                            <form id="fileUploadForm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <input type="file" name="file" class="form-control">
                                  </div> 
                                </div>

                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                                <div class="col-md-8 ">
                                  <div class="form-group">
                                    <div class="progress proo">
                                      <div class="progress-bar barr progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div> 
                                <div class="col-md-12">
                                  <hr/>
                                </div>
                              </div>
                            </form>
                          </div>
                         


                         <div class="row form-row education-cont" id="itemid${itemid}">
                          <div class="col-md-12 ">
                          <form id="fileUploadFormm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name"  class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8 ">
                            <div class="form-group">
                              <div class="progress prooo">
                                <div class="progress-bar barrr progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                              </div>
                            </div>
                          </div> 
                          <div class="col-md-12">
                            <hr/>
                          </div>
                          </form>
                        </div>
                        </div>

                     
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    
<!--  <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
 -->
 <script>
        $(function () {
            $(document).ready(function () {
              // alert('ufuytuygyb');
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.proo .barr').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                    }
                });
            });
        });
        
        $(function () {
            $(document).ready(function () {
              // alert('ufuytuygyb');
                $('#fileUploadFormm').ajaxForm({
                    beforeSend: function () {
                        var percentage = '0';
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.prooo .barrr').css("width", percentage+'%', function() {
                          return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function (xhr) {
                        console.log('File has uploaded');
                    }
                });
            });
        });
        


        function addVideo(){
      const itemid = Math.random();
      // alert(itemid);
      $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}">
                          <div class="col-md-12 ">
                          <form id="fileUploadForm" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name"  class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8 ">
                            <div class="form-group">
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                              </div>
                            </div>
                          </div> 
                          <div class="col-md-12">
                            <hr/>
                          </div>
                          </form>
                        </div>`); 

        

                      
  }

  function removevideo(videoId) {
    var myobj = document.getElementById(videoId);
    myobj.remove();
  }
</script>


<script> 
    $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getSubCategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']} - ${element['id']} 
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
</script> 


    @toastr_js
    @toastr_render
@endsection


















<script type="text/javascript">
  
  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm2').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog2 .prog-bar2').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 





  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm3').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog3 .prog-bar3').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 




  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm4').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog4 .prog-bar4').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 




  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog5 .prog-bar5').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 



  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog6 .prog-bar6').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 



  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm7').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog7 .prog-bar7').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 



  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm8').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog8 .prog-bar8').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 


  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm9').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog9 .prog-bar9').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 


  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm10').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog10 .prog-bar10').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 


  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm11').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog11 .prog-bar11').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm12').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog12 .prog-bar12').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });


  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm13').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog13 .prog-bar13').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm14').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog14 .prog-bar14').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm15').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog15 .prog-bar15').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm16').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog16 .prog-bar16').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm17').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog17 .prog-bar17').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm18').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog18 .prog-bar18').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm19').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog19 .prog-bar19').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm20').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog20 .prog-bar20').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
 

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm21').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog21 .prog-bar21').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
    });
  });
</script>




































<!-- last code create chapters -->

@extends('layout.instructor.main')
@section('content') 

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif

                      </div>
                    </div>
                   
    </div>





<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4> -->
                  <form action="{{route('chapters.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                      </div>

                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                              <option  disabled >Select</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                              @endforeach
                            </select>
                            @error('courseId')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                              @error('chapter_name')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                              @error('short_number')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        </div>
                      
                    </form>


                    
                       <div class="add-more">
                        <button onclick="addVideo()">إضافة فيديو</button>
                      </div>

                      <div class="education-info" id="addvideo">
                        <div class="row form-row education-cont">
                          <div class=" col-md-12">
                            <form id="fileUploadForm1" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <input type="file" name="file" class="form-control">
                                  </div> 
                                </div>

                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                                <div class="col-md-8 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div> 
                                <div class="col-md-12">
                                  <hr/>
                                </div>
                              </div>
                            </form>
                          </div>
                         </div>
                       </div>


                        

                     
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    
<!--  <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
 -->

<script> 
    $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getSubCategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']} - ${element['id']} 
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
</script> 


 <script>
   

  // $(function () {
  //   $(document).ready(function () {
  //     $('#fileUploadForm1').ajaxForm({
  //       beforeSend: function () {
  //         var percentage = '0';
  //       },
  //       uploadProgress: function (event, position, total, percentComplete) {
  //         var percentage = percentComplete;
  //         $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
  //           return $(this).attr("aria-valuenow", percentage) + "%";
  //         })
  //       },
  //       complete: function (xhr) {
  //         console.log('File has uploaded');
  //       }
  //     });
  //   });
  // });
 


  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm1').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });

      $('#fileUploadForm2').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog2 .prog-bar2').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });

      ////////////////
      $('#fileUploadForm3').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog3 .prog-bar3').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////////
       $('#fileUploadForm4').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog4 .prog-bar4').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ///////////// 
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog5 .prog-bar5').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog6 .prog-bar6').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ///////////////
      $('#fileUploadForm7').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog7 .prog-bar7').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////
      $('#fileUploadForm7').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog7 .prog-bar7').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      //////
      $('#fileUploadForm8').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog8 .prog-bar8').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ////////
      $('#fileUploadForm9').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog9 .prog-bar9').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm10').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog10 .prog-bar10').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm11').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog11 .prog-bar11').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////
       $('#fileUploadForm12').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog12 .prog-bar12').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
     //////////
     $('#fileUploadForm13').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog13 .prog-bar13').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      //////////
      $('#fileUploadForm14').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog14 .prog-bar14').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      

    });
  });
 
 
 function removevideo(videoId) {
      var myobj = document.getElementById(videoId);
      myobj.remove();
}

    let classone = 1;
    let classtwo = 1;
    let classthree= 1
    let text = "";

  function addVideo(){
      classone += 1;
      classtwo += 1;
      classthree += 1;
      alert(classone);
      const itemid = Math.random();
      $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}">
                            <form id="fileUploadForm2" method="POST" action="{{ url('/upload-doc-file') }}" enctype="multipart/form-data">
                            @csrf
                          <div class="col-md-12 ">
                            <div class="row form-row">
                              <div class=" col-md-4">
                                <div class="form-group">
                                  <label>Degree</label>
                                  <input type="text" name="name"  class="form-control">
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>College/Institute</label>
                                  <input type="file" name="file" class="form-control">
                                </div>
                              </div>
                              <div class="col-md-2 ">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                              </div>
                              <div class="col-md-2">
                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8 ">
                            <div class="form-group">
                              <div class="progress prog2">
                                <div class="progress-bar prog-bar2 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                              </div>
                            </div>
                          </div> 
                          <div class="col-md-12">
                            <hr/>
                          </div>
                          </form>
                        </div>`); 
  }
        
  

  $(function () {
    $(document).ready(function () {
      $('#fileUploadForm2').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog2 .prog-bar2').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ////////////////
      $('#fileUploadForm3').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog3 .prog-bar3').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////////
       $('#fileUploadForm4').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog4 .prog-bar4').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ///////////// 
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog5 .prog-bar5').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm5').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog6 .prog-bar6').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ///////////////
      $('#fileUploadForm7').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog7 .prog-bar7').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////
      $('#fileUploadForm7').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog7 .prog-bar7').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      //////
      $('#fileUploadForm8').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog8 .prog-bar8').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      ////////
      $('#fileUploadForm9').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog9 .prog-bar9').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm10').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog10 .prog-bar10').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////////
      $('#fileUploadForm11').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog11 .prog-bar11').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      /////////
       $('#fileUploadForm12').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog12 .prog-bar12').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
     //////////
     $('#fileUploadForm13').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog13 .prog-bar13').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
      //////////
      $('#fileUploadForm14').ajaxForm({
        beforeSend: function () {
          var percentage = '0';
        },
        uploadProgress: function (event, position, total, percentComplete) {
          var percentage = percentComplete;
          $('.prog14 .prog-bar14').css("width", percentage+'%', function() {
            return $(this).attr("aria-valuenow", percentage) + "%";
          })
        },
        complete: function (xhr) {
          console.log('File has uploaded');
        }
      });
     

    });
  });
 

</script>
    @toastr_js
    @toastr_render
@endsection






































<!-- last code create chapters -->

@extends('layout.instructor.main')
@section('content') 

@toastr_css
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif

                      </div>
                    </div>
                   
    </div>





<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4> -->
                  <form action="{{route('chapters.store')}}" action="javascript:void(0)" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                      </div>

                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                              <option  disabled >Select</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                              @endforeach
                            </select>
                            @error('courseId')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                              @error('chapter_name')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                              @error('short_number')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        </div>
                    </form>
                    
                      <div class="col-md-2">
                        <!-- <button onclick="addVideo()">إضافة فيديو</button> -->
                        <button  onclick="addVideo()" class="btn btn-primary btn-block">إضافة فيديو </button>
                      </div>

                      <div class="education-info" id="addvideo">
                        <!-- <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                          <div class=" col-md-12">
                            <form id="fileUploadForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <input type="file" name="file" class="form-control">
                                  </div> 
                                </div>

                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                               

                              </div>
                              <div class=" row form-row">
                                <div class="col-md-2">
                                    
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                            </form>
                          </div>
                        </div> -->


                        
                       
                      
                       </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </section>
    
<!--  <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
 -->

<script> 
    $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getSubCategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']} - ${element['id']} 
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
</script> 
<script>
 
 $(document).ready(function (e) {
 
  $('#fileUploadForm').on('submit',(function(e) {
      // alert('dddddddddd');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = new FormData(this);
      alert(formData['file']);
      $.ajax({
           type:'POST',
           url: "{{url('ajax-image-upload')}}",
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               $('#ImgOri').attr('src', "/uploads/"+ data.name);
           },
           error: function(data){
               console.log(data);
         }
      });
  }));

 
});
$(document).ready(function(){
    $('#subscribe').click(function(e){
         e.preventDefault(); // this prevents the form from submitting
      $.ajax({
        url: "{{url('ajax-image-upload')}}",
        type: "post",
        data: {'file':$('input[name=file]').val(), '_token': $('input[name=_token]').val()},
        dataType: 'JSON',
        success: function (data) {
          console.log(data); // this is good
        }
      });
    });
  });
</script>

 <script>
   

  // $(function () {
  //   $(document).ready(function () {
  //     $('#fileUploadForm1').ajaxForm({
  //       beforeSend: function () {
  //         var percentage = '0';
  //       },
  //       uploadProgress: function (event, position, total, percentComplete) {
  //         var percentage = percentComplete;
  //         $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
  //           return $(this).attr("aria-valuenow", percentage) + "%";
  //         })
  //       },
  //       complete: function (xhr) {
  //         console.log('File has uploaded');
  //       }
  //     });
  //   });
  // });
 


  $(function () {
    $(document).ready(function () {

      // $('#fileUploadForm1').ajaxForm({
      //   beforeSend: function () {
      //     var percentage = '0';
      //   },
      //   uploadProgress: function (event, position, total, percentComplete) {
      //     var percentage = percentComplete;
      //     $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
      //       return $(this).attr("aria-valuenow", percentage) + "%";
      //     })
      //   },
      //   complete: function (xhr) {
      //     console.log('File has uploaded');
      //   }
      // });

      // $('#fileUploadForm2').ajaxForm({
      //   beforeSend: function () {
      //     var percentage = '0';
      //   },
      //   uploadProgress: function (event, position, total, percentComplete) {
      //     var percentage = percentComplete;
      //     $('.prog2 .prog-bar2').css("width", percentage+'%', function() {
      //       return $(this).attr("aria-valuenow", percentage) + "%";
      //     })
      //   },
      //   complete: function (xhr) {
      //     console.log('File has uploaded');
      //   }
      // });

    
      

    });
  });
 

 function removevideo(videoId) {
      var myobj = document.getElementById(videoId);
      myobj.remove();
  }

    let classone = 1;
    let classtwo = 1;
    let classthree= 1
    let text = "";

  function addVideo(){
      classone += 1;
      classtwo += 1;
      classthree += 1;
      // alert(classone);
      const itemid = Math.random();
      $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                           
                          <div class="col-md-12 ">
                             <form id="fileUploadForm2" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="name"  class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>College/Institute</label>
                                    <input type="file" name="file" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <button type="submit" id="subscribe" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                                <div class="col-md-2">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                                </div>
                            </div>
                          
                            
                            <div class=" row form-row">
                                <div class="col-md-2">
                                    <!-- <img  src="" /> -->
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                              <hr/>
                            </div>
                          </form>
                        </div>
                        </div>`); 
  }
        
  




</script>
    @toastr_js
    @toastr_render
@endsection








<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Data Submit Through Ajax | 8Bityard</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </head>
   <body>
    <div class="container">
        <form id="ajaxform">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" >
            </div>
            <div class="form-group">
                <button class="btn btn-success save-data">Save</button>
            </div>
        </form>
    </div>
  <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->
  <script>
    $(".save-data").click(function(event){
        event.preventDefault();

        let name = $("input[name=name]").val();
        
        let _token   = $('meta[name="csrf-token"]').attr('content');
        alert('fwrfwrferf');
        $.ajax({
          type:'POST',
             url: "{{url('ajax-image-upload')}}",
             
             cache:false,
             contentType: false,
             processData: false,
          data:{
            name:name,
            
            _token: _token
          },
          success:function(response){
            console.log(response);
            
          },
         });
    });
  </script>
</body>
</html>












@extends('layout.instructor.main')
@section('content') 

@toastr_css
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif

                      </div>
                    </div>
                   
    </div>





<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4> -->
                  <form action="{{route('chapters.store')}}" action="javascript:void(0)" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                      </div>

                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                              <option  disabled >Select</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                              @endforeach
                            </select>
                            @error('courseId')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                              @error('chapter_name')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                              @error('short_number')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        </div>
                    </form>
                    
                      <div class="col-md-2">
                        <!-- <button onclick="addVideo()">إضافة فيديو</button> -->
                        <button  onclick="addVideo()" class="btn btn-primary btn-block">إضافة فيديو </button>
                      </div>

                      <div class="education-info" id="addvideo">
                        <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                          <div class=" col-md-12">
                            <form id="fileUploadForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <input type="file" name="file" class="form-control">
                                  </div> 
                                </div>

                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                               
                              </div>
                              <div class=" row form-row">
                                <div class="col-md-2">
                                    
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                            </form>
                          </div>
                        </div>

                        

                      <!-- 
                        <div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                           
                          <div class="col-md-12 ">
                             <form id="fileUploadForm2" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="name"  class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>College/Institute</label>
                                    <input type="file" name="file" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <button type="submit" id="subscribe" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                                <div class="col-md-2">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                                </div>
                            </div>
                          
                            
                            <div class=" row form-row">
                                <div class="col-md-2">
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                              <hr/>
                            </div>
                          </form>
                        </div>
                        </div> -->

                        
                       
                      
                       </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="container">
        <form id="ajaxform">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name" >
            </div>
            <div class="form-group">
                <button class="btn btn-success save-data">Save</button>
            </div>
        </form>
    </div>
    </section>
    
 <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->


<script> 
    $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getSubCategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>Select </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']} - ${element['id']} 
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
</script> 
<script>
 
 // $(document).ready(function (e) {
 
  $('#fileUploadForm').on('submit',(function(e) {
      // alert('dddddddddd');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = new FormData(this);
      // alert(formData['file']);
      $.ajax({
           type:'POST',
           url: "{{url('ajax-image-upload')}}",
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               $('#ImgOri').attr('src', "/uploads/"+ data.name);
           },
           error: function(data){
               console.log(data);
         }
      });
  }));
// });


 // $(document).ready(function (e) {
 function sendvideo(videoid){
  // alert('reiufgre');
  // var element = document.getElementById(videoid);
  // alert('#'+videoid);
  $('#'+videoid).on('submit',(function(e) {
      // alert('dddddddddd');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = new FormData(this);
      // alert(formData['file']);
      $.ajax({
           type:'POST',
           url: "{{url('ajax-image-upload')}}",
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               $('#'+videoid).attr('src', "/uploads/"+ data.name);
           },
           error: function(data){
              console.log(data);
         }
      });
  }));
}

//  $(document).ready(function (e) {
 
//   $('#fileUploadForm2').on('submit',(function(e) {
//       // alert('dddddddddd');
//       $.ajaxSetup({
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//       });
//       let name = $("input[name=name]").val();
//       let _token   = $('meta[name="csrf-token"]').attr('content');


//       $.ajax({
//            type:'POST',
//            url: "{{url('ajax-image-upload')}}",
//            // data:formData,
//            cache:false,
//            contentType: false,
//            processData: false,
//            data:{
//             name:name,
//             _token: _token
//           }
//           success:function(response){
//             console.log(response);
            
//           },
//            error: function(data){
//                console.log(data);
//          }
//       });
//   }));
// });
// $(document).ready(function(){
//     $('#subscribe').click(function(e){
//          e.preventDefault(); // this prevents the form from submitting
//       $.ajax({
//         url: "{{url('ajax-image-upload')}}",
//         type: "post",
//         data: {'file':$('input[name=file]').val(), '_token': $('input[name=_token]').val()},
//         dataType: 'JSON',
//         success: function (data) {
//           console.log(data); // this is good
//         }
//       });
//     });
//   });
</script>
<!-- <script>
  let name = $("input[name=name]").val();
        let _token   = $('meta[name="csrf-token"]').attr('content');
        data:{
            name:name,
            _token: _token
          }
          success:function(response){
            console.log(response);
            
          },
  </script> -->
 <script>
   

  // $(function () {
  //   $(document).ready(function () {
  //     $('#fileUploadForm1').ajaxForm({
  //       beforeSend: function () {
  //         var percentage = '0';
  //       },
  //       uploadProgress: function (event, position, total, percentComplete) {
  //         var percentage = percentComplete;
  //         $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
  //           return $(this).attr("aria-valuenow", percentage) + "%";
  //         })
  //       },
  //       complete: function (xhr) {
  //         console.log('File has uploaded');
  //       }
  //     });
  //   });
  // });
 


  $(function () {
    $(document).ready(function () {

      // $('#fileUploadForm1').ajaxForm({
      //   beforeSend: function () {
      //     var percentage = '0';
      //   },
      //   uploadProgress: function (event, position, total, percentComplete) {
      //     var percentage = percentComplete;
      //     $('.prog1 .prog-bar1').css("width", percentage+'%', function() {
      //       return $(this).attr("aria-valuenow", percentage) + "%";
      //     })
      //   },
      //   complete: function (xhr) {
      //     console.log('File has uploaded');
      //   }
      // });

      // $('#fileUploadForm2').ajaxForm({
      //   beforeSend: function () {
      //     var percentage = '0';
      //   },
      //   uploadProgress: function (event, position, total, percentComplete) {
      //     var percentage = percentComplete;
      //     $('.prog2 .prog-bar2').css("width", percentage+'%', function() {
      //       return $(this).attr("aria-valuenow", percentage) + "%";
      //     })
      //   },
      //   complete: function (xhr) {
      //     console.log('File has uploaded');
      //   }
      // });


    });
  });
 

  function removevideo(videoId) {
    var myobj = document.getElementById(videoId);
    myobj.remove();
  }
  let classone = 1;
  let classtwo = 1;
  let classthree= 1
  let text = "";

  function addVideo(){
      classone += 1;
      classtwo += 1;
      classthree += 1;
      // alert(classone);
     
      
      const itemid = Math.random();
      $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;margin: 24px;">
                           
                          <div class="col-md-12 ">
                             <form id="videoid${classone}" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>Degree</label>
                                    <input type="text" name="name"  class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>College/Institute</label>
                                    <input type="file" name="file" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <button type="submit" id="videoid${classone}"  onClick="sendvideo(this.id)" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                                <div class="col-md-2">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                  <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                                </div>
                            </div>
                          
                            
                            <div class=" row form-row">
                                <div class="col-md-2">
                                    <video controls="controls" id="videoid${classone}" width="200">
                                      <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                              <hr/>
                            </div>
                          </form>
                        </div>
                        </div>`); 
  }
        
  




</script>
    @toastr_js
    @toastr_render
@endsection














    @include('layout.instructor.head')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <div class="container">
    
    <form id="fileUploadForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <input type="file" name="file" id="filename"class="form-control">
                                  </div> 
                                </div>

                                <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div>
                               
                              </div>
                              <div class=" row form-row">
                                <div class="col-md-2">
                                    
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>
                            </form>
  
  </div>

 
<script>
 
$(function () {
    $.ajaxSetup({
      headers: {'X-CSRF-Token': '{{csrf_token()}}'}
    });
    $('#filename').change(function () {
      var photo = $(this)[0].files[0];
      var formData = new FormData();
      formData.append('file', photo);
      $.ajax({
          url: "{{url('ajax-image-upload')}}",
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (data) {
            console.log('datasss');
            $('#ImgOri').attr('src', "/uploads/"+ data.name);
          }
      })
    })
})


// $(document).ready(function (e) {
 
//   $('#fileUploadForm').on('submit',(function(e) {
//       $.ajaxSetup({
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//       });
//       e.preventDefault();
//       // var formData = new FormData(this);
//       var photo = $('#filename').val();
//       var formData = new FormData();         
//       formData.append('file', photo);

//       $.ajax({
//            type:'POST',
//            url: "{{url('ajax-image-upload')}}",
//            data:formData,
//            cache:false,
//            contentType: false,
//            processData: false,
//            success:function(data){
//             alert(data);
//                // $('#ImgOri').attr('src', "/uploads/"+ data.name);
//            },
//            error: function(data){
//                console.log(data);
//          }
//       });
//   }));
 
// });
 // $(document).ready(function () {
    // $('#filename').on('change', function () {
    //   $('#fileUploadForm').on('submit',(function(e) {
    //       $.ajaxSetup({
    //         headers: {
    //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //       });
    //       e.preventDefault();
    //       var formData = new FormData(this);
    //       alert(formData['file']);
    //       $.ajax({
    //            type:'POST',
    //            url: "{{url('ajax-image-upload')}}",
    //            data:formData,
    //            cache:false,
    //            contentType: false,
    //            processData: false,
    //            success:function(data){
    //                $('#ImgOri').attr('src', "/uploads/"+ data.name);
    //            },
    //            error: function(data){
    //                console.log(data);
    //          }
    //       });
    //   }));

    // });
  // });
</script>


    @include('layout.instructor.footer')


















    @include('layout.instructor.head')

<div class="container">
  <form id="fileUploadForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
  @csrf
    <div class="row form-row">
        <div class=" col-md-4">
            <div class="form-group">
              <label>عنوان الفيديو</label>
              <input type="text" name="name" class="form-control">
            </div> 
        </div>
        <div class=" col-md-4">
            <div class="form-group">
              <label>ارفق الفيديو</label>
              <input type="file" name="file" id="filename"class="form-control">
            </div> 
        </div>
    </div>
    <div class=" row form-row">
          <div class="col-md-2">
            <video controls="controls" id="ImgOri" width="200">
              <source  src="" type="video/mp4">
            </video> 
          </div> 
          <div class="col-md-4 ">
            <div class="form-group">
                <div class="progress prog1">
                  <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
          </div>
    </div>
  </form>  
</div>

 
<script>
  $(function () {
      $.ajaxSetup({
        headers: {'X-CSRF-Token': '{{csrf_token()}}'}
      });
      $('#filename').change(function () {
        var photo = $(this)[0].files[0];
        var formData = new FormData();
        formData.append('file', photo);
        $.ajax({
            url: "{{url('ajax-image-upload')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              console.log('datasss');
              $('#ImgOri').attr('src', "/uploads/"+ data.name);
            }
        })
      })
  })
</script>


    @include('layout.instructor.footer')



































    
  
@extends('layout.instructor.main')
@section('content') 

@toastr_css
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس جديد</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الكورسات
                            </li>
                          </ol> 
                        </div>
                        @if(session()->has('message'))
                          @include('admin.includes.alerts.success')
                      @endif

                      </div>
                    </div>
                   
    </div>





<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <!-- <h4 class="card-title" id="bordered-layout-basic-form">Project Info</h4> -->
                  <form action="{{route('chapters.store')}}" action="javascript:void(0)" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12 col-sm-3">
                        <button type="submit" class="btn btn-primary btn-block">حفظ </button>
                      </div>

                </div>
                <div class="card-content collpase show">
                  <div class="card-body">
                        <div class="row form-row">
                          <div class="form-group col-12 col-sm-4">
                            <label>اختر الكورس</label>
                            <select name="courseId" class="form-control select2-diacritics required" placeholder="Select Category" >
                              <option  disabled >Select</option>  
                              @foreach ($courses as $_item) 
                                <option value="{{$_item->id}}" {{ old('courseId') == $_item->id ? "selected" : "" }}>{{$_item->title}}</option>
                              @endforeach
                            </select>
                            @error('courseId')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>عنوان الشابتر</label>
                            <input type="text" name="chapter_name" class="form-control" value="{{old('chapter_name')}}">
                              @error('chapter_name')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          <div class="form-group col-12 col-sm-4">
                            <label>رقم الشابتر</label>
                              <input type="text" name="chapter_number" class="form-control" value="{{old('short_number')}}">
                              @error('short_number')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                        </div>
                    </form>
                      <div class="col-md-2">
                        <button  onclick="addVideo()" class="btn btn-primary btn-block">إضافة فيديو </button>
                      </div>
                      <div class="education-info" id="addvideo">
                        <div class="row form-row education-cont" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;    margin: 24px;">
                          <div class=" col-md-12">
                            <form id="fileUploadForm" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                              <div class="row form-row">
                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>عنوان الفيديو</label>
                                    <input type="text" name="name" class="form-control">
                                  </div> 
                                </div>

                                <div class=" col-md-4">
                                  <div class="form-group">
                                    <label>ارفق الفيديو</label>
                                    <!-- <input type="text" name="file" id="video1" onchange="videoidd(this.id)" class="form-control"> -->
                                    <input type="file" name="file" id="video1" onchange="videoidd(video1)" class="form-control">

                                  </div> 
                                </div>

                                <!-- <div class="col-md-2 ">
                                  <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">تحميل </button>
                                </div> -->
                               
                              </div>
                              <div class=" row form-row">
                                <div class="col-md-2">
                                    <video controls="controls" id="ImgOri" width="200">
                                              <source  src="" type="video/mp4">
                                    </video> 
                                </div> 
                                <div class="col-md-4 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
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
                </div>
              </div>
            </div>
          </div>
    </section>
    
  <!-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<><<<><<<><><<ff -->
<!-- C:\fakepath\_احلى مقاطع حب قصيره ---- اروع اغنية رومانسية فيديوهات حالات واتس اب حب.mp4<[[[[[[[[[>>>   -->
<script>
  let videoid = 1;
  let video_with_id= 'video'+videoid;
  // alert(video_with_id);
  ///  add video if select
    // $(function () {
    //     $.ajaxSetup({
    //       headers: {'X-CSRF-Token': '{{csrf_token()}}'}
    //     });
    //     // $('#'+video_with_id).change(function () {
    //     $('#video1').change(function () {
    //       alert(video_with_id);
    //       var photo = $(this)[0].files[0];

    //       console.log($(this).val()+'<><<<><<<><><<ff');
    //       var formData = new FormData();
    //       formData.append('file', photo);
    //       $.ajax({
    //           url: "{{url('ajax-image-upload')}}",
    //           type: 'POST',
    //           data: formData,
    //           processData: false,
    //           contentType: false,
    //           success: function (data) {
    //             console.log(data);
    //             $('#ImgOri').attr('src', "/uploads/"+ data.name);
    //           }
    //       })
    //     })
    // })

  function videoidd(value){
    $(function () {
        $.ajaxSetup({
          headers: {'X-CSRF-Token': '{{csrf_token()}}'}
        });
        
          // var photo = document.getElementById(value).value;
          // var photo = value[0].files[0];
          // var formData = new FormData();
          // formData.append('file', photo);
          // console.log(formData);

          console.log(value.value+'<[[[[[[[[[>>>');
          // var photo = document.getElementById(value);
           // console.log(photo.value+'>>>>>>>>>');
          // var photo = value.files;
           var photo = $(value)[0].files[0];
          console.log($(value)[0].files[0]);
          // var photo = $(this).val();
          var formData = new FormData();
          formData.append('file', photo);
          console.log(formData);

          // var params = {};
          // params['file'] = photo;
          // console.log(params.file);

          $.ajax({
              url: "{{url('ajax-image-upload')}}",
              type: 'POST',
              data: formData,
              processData: false,
              contentType: false,
              success: function (data) {
                
                console.log(data+'>>>>>>>>>>>>>>>>>>>>><<<<');
                console.log('data');

                // $('#ImgOri').attr('src', "/uploads/"+ data.name);
              }
          })
         
        // })
    })
  }



   // $(function () {
   //      $.ajaxSetup({
   //        headers: {'X-CSRF-Token': '{{csrf_token()}}'}
   //      });
        
   //      $('#video1').change(function () {
   //        var photoo = document.getElementById('video1').value;
   //        console.log(photoo);
   //        // var photo = $(this)[0].files[0];
   //        // var formData = new FormData();
   //        // formData.append('file', photo);
   //        // console.log(formData);


   //        // var photo = $(this).val();
   //        var formData = new FormData();
   //        formData.append('file', photoo);
   //        console.log(formData);

   //        // var params = {};
   //        // params['file'] = photo;
   //        // console.log(params.file);

   //        $.ajax({
   //            url: "{{url('ajax-image-upload')}}",
   //            type: 'POST',
   //            data: formData,
   //            processData: false,
   //            contentType: false,
   //            success: function (data) {
                
   //              console.log(data);
   //              console.log('data');

   //              // $('#ImgOri').attr('src', "/uploads/"+ data.name);
   //            }
   //        })
         
   //      })
   //  })

 /// remove video from list
    function removevideo(videoId) {
      var myobj = document.getElementById(videoId);
      myobj.remove();
    }
    
    

    function addVideo(){
        videoid += 1;
        video_with_id= 'video'+videoid;
        // alert(video_with_id);
        const itemid = Math.random();
        $('#addvideo').append(`<div class="row form-row education-cont" id="itemid${itemid}" style="background-color: #f0f1f6;border-bottom-color: red; padding: 10px;margin: 24px;">
                             
                            <div class="col-md-12 ">
                               <form id="video${videoid}" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                              @csrf
                              <div class="row form-row">
                                  <div class=" col-md-4">
                                    <div class="form-group">
                                      <label>Degree</label>
                                      <input type="text" name="name"  class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>College/Institute</label>
                                      <input type="text" name="file" id="video${videoid}"  class="form-control">
                                    </div>
                                  </div>
                                  <!-- <div class="col-md-2 ">
                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <button type="submit" id="video${videoid}"  onchange="videoidd(this.id)" class="btn btn-primary btn-block">تحميل </button>
                                </div> -->
                                  <div class="col-md-2">
                                    <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                    <a href="#" class="btn btn-danger trash" id="itemid${itemid}" onClick="removevideo(this.id)"><i class="far fa-trash-alt"></i>X</a>
                                  </div>
                              </div>
                            
                              
                              <div class=" row form-row">
                                  <div class="col-md-2">
                                      <video controls="controls" id="videoid${videoid}" width="200">
                                        <source  src="" type="video/mp4">
                                      </video> 
                                  </div> 
                                  <div class="col-md-4 ">
                                    <div class="form-group">
                                      <div class="progress prog1">
                                        <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                <hr/>
                              </div>
                            </form>
                          </div>
                          </div>`); 


 
    }
        
  

 // $(document).ready(function (e) {
 $('#fileUploadForm').on('submit',(function(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
           type:'POST',
           url: "{{url('ajax-image-upload')}}",
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               $('#ImgOri').attr('src', "/uploads/"+ data.name);
           },
           error: function(data){
               console.log(data);
         }
      });
  }));
// });


  function sendvideo(videoid){
    $('#'+videoid).on('submit',(function(e) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
             type:'POST',
             url: "{{url('ajax-image-upload')}}",
             data:formData,
             cache:false,
             contentType: false,
             processData: false,
             success:function(data){
                 $('#'+videoid).attr('src', "/uploads/"+ data.name);
             },
             error: function(data){
                console.log(data);
           }
        });
    }));
  }

</script>
    @toastr_js
    @toastr_render
@endsection




