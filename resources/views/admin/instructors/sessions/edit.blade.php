
@extends('layout.instructor.main')
@section('content')	

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">تعديل المحاضرة</h3><br>
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
                  <h4 class="card-title" id="bordered-layout-basic-form"></h4>
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
                   
			        <form  method="post"  action="{{route('sessions.update',$lecture->id)}}" enctype="multipart/form-data">
                                 @csrf
                                @method('put')
			                                 <div class="row form-row">
                                          


                                          
                                          
                                          <div class="form-group col-12 col-sm-6">
                                              <label> عنوان الجلسة</label>
                                              <input type="text" name="title" class="form-control" value="{{$lecture->title}}">
                                              @error('title')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-6">
                                              <label> تاريخ الجلسة</label>
                                              <input type="date" name="date" class="form-control" value="{{$lecture->date}}">
                                              @error('date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-6">
                                              <label> وقت الجلسة </label>
                                              <input type="time" name="time" class="form-control" value="{{$lecture->time}}">
                                              @error('time')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-6">
                                              <label> مدة الجلسة (دقيقة) </label>
                                              <input type="number" name="duration" class="form-control" value="{{$lecture->duration}}">
                                              @error('duration')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                           <div class="form-group col-12 col-md-12">
                                          </hr>
                                          </div>   
                                          <div class="form-group col-12 col-md-12">
                                              <label> يرجى إضافة بيانات الزوم قبل موعد المحاضرة ب 15 دقيقة </label>
                                          </div>   
                                          <div class="form-group col-12 col-md-4">
                                              <label> الرابط </label>
                                              <input type="text" name="url" class="form-control" value="{{$lecture->url}}">
                                              @error('url')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-4">
                                              <label> كلمة المرور</label>
                                              <input type="text" name="meeting_password" class="form-control" value="{{$lecture->meeting_password}}">
                                              @error('meeting_password')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <div class="form-group col-12 col-md-4">
                                              <label>meeting Id </label>
                                              <input type="text" name="meeting_id" class="form-control" value="{{$lecture->meeting_id}}">
                                              @error('meeting_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                          <!--<input type="time" name="timehamada"  onchange="onTimeChange()" id="timeInput" >-->
                                               
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
</script> 
    @toastr_js
    @toastr_render
@endsection