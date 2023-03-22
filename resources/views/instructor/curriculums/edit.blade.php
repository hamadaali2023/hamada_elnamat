
@extends('layout.instructor.main')
@section('content')	

@toastr_css
    <link rel="stylesheet" href="{{asset('admin/vendors/css/forms/selects/select2.min.css')}}">

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block"> تعديل دورة </h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-6">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a>
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


<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">Project Inf {{$curriculum->id}}</h4>
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
                   
			        <form  method="post"  action="{{route('curriculums.update',$curriculum->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="row form-row">
                                <div class="form-group col-md-6 col-sm-6">               
                                    <label> اختر المنهج </label>
                                    <select name="title" class="form-control formselect"  id="get_title">
                                        <option value="" selected>اختار </option> 
                                        <option value="المنهج الاردن"
                                        {{ $curriculum->name == 'المنهج الاردن' ? "selected" : "" }}>
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
                                             <option  disabled>اختار</option> 
                                            @foreach ($branches as $_item) 
                                                @foreach ($curricul_Branch as $item) 
                                                    
                                                        <option value="{{$_item->id}}" {{ $item->branch_id == $_item->id ? "selected" : "" }}>{{$_item->name}}
                                                        </option>
                                                    
                                                @endforeach
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
                                            
                                                <option value="{{$_item->id}}" {{ $curriculum->material_id == $_item->id ? "selected" : "" }}>{{$_item->name}}
                                                </option>
                                            
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <span id="subcategoryError" style="color: red;"></span>
                                </div>
                                
                                <div class="form-group col-md-6 col-sm-6">               
                                    <label> اختر الفصل الدراسي </label>
                                    <select name="classroom" class="form-control formselect"  id="get_classroom">
                                        <option value="" selected>اختار </option> 
                                        <option value="1" {{ $curriculum->classroom == '1' ? "selected" : "" }}>الفصل الاول
                                        <option value="2" {{ $curriculum->classroom == '2' ? "selected" : "" }}>الفصل الثاني
                                    </option>
                                    </select>
                                    @error('classroom')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <span id="classroomError" style="color: red;"></span>
                                </div>
                            </div>
                            
                            
                            
                                
                                
                                
			                                <div class="row form-row">
			                                    

			                                   
			                                   
			                                    
                        					
			                                    
			                                 
			                                   

			                                    <div class="form-group col-md-6 col-sm-6	">
			                                    	 <img class="avatar-img" src="{{asset('assets_admin/img/curriculums/'.$curriculum->image) }}" alt="Speciality" width="100px">
			                                            <label>صورة العرض </label>
			                                            <input type="file" name="image" class="form-control" >
			                                        
			                                        @error('image')
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
    
 <script src="{{asset('admin/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('admin/js/scripts/forms/select/form-select2.js')}}" type="text/javascript"></script>

 <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

<script> 
        $(document).ready(function () {
            $('#get_sub_category_name').on('change', function () {
                console.log("welcome sub"); 
                let id = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: "{{url('instructor/getsubcategory')}}/"+id,
                    success: function (response) {
                        var response = JSON.parse(response)
                        console.log(response);   
                        $('#get_sub_category').empty();
                        $('#get_sub_category').append(`<option value="0" disabled selected>أختر </option>`);
                        response.forEach(element => {
                            $('#get_sub_category').append(`<option value="${element['id']}">
                            ${element['title']['ar']}
                            </option>`);
                        });
                    }
                });
            });
        });

        $(document).ready(function () {
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
                            $('#get_child_category').append(`<option value="${element['id']}">
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