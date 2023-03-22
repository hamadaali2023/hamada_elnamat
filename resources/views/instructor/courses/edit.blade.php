
@extends('layout.instructor.main')
@section('content')	

@toastr_css

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
                  <h4 class="card-title" id="bordered-layout-basic-form">Project Inf {{$course->id}}</h4>
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
                   
			        <form  method="post"  action="{{route('courses.update',$course->id)}}" enctype="multipart/form-data">
                                 @csrf
                                @method('put')
			                                <div class="row form-row">
			                                    <div class="form-group col-md-6 col-sm-6">
			                                                <label>التخصص</label>
			                                                <select name="categoryId" class="form-control select2-diacritics required" placeholder="Select Category" id="get_sub_category_name">
			                                                <option  disabled >Select</option>  
			                                                @foreach ($categories as $_item)
															   <option value="{{$_item->id}}" {{($_item->id==$course->categoryId) ? 'selected' : '' }}>{{$_item->title}}</option>
															@endforeach
			                                            </select>
			                                        @error('childCategoryId')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>

			                                    <div class="form-group col-md-6 col-sm-6">                                 
			                                        <label>تخصص فرعي</label>
			                                        <select name="subCategoryId" class="form-control formselect"  id="get_sub_category">
			                                            <option  disabled >تخصص فرعي </option> 
			                                               @foreach ($subcategory as $_item)
													   	<option value="{{$_item->id}}" {{($_item->id==$course->subCategoryId) ? 'selected' : '' }}>{{$_item->title}}</option>
															@endforeach  
			                                        </select>
			                                        @error('childCategoryId')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    <!--<div class="form-group col-12 col-sm-6">                                 
			                                                <label>تخصص فرعي</label>
			                                                <select name="childCategoryId" class="form-control formselect"  id="get_child_category">
			                                                   <option  disabled >تخصص فرعي </option>  
			                                                    @foreach ($childcategory as $_item)
																   	<option value="{{$_item->id}}" {{($_item->id==$course->childCategoryId) ? 'selected' : '' }}>{{$_item->title}}</option>
																@endforeach  
			                                                </select>
			                                                @error('childCategoryId')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div> -->
			                                    
			                                    <div class="form-group col-md-6 col-sm-6">
			                                        <label>عنوان الدورة عربي</label>
			                                        <input type="text" name="title" class="form-control" value="{{$course->title}}">
			                                        @error('title')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    <div class="form-group col-md-6 col-sm-6">
			                                        <label>عنوان الدورة انجليزي</label>
			                                        <input type="text" name="title_ar" class="form-control" value="{{$course->title_ar}}">
			                                        @error('title_ar')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    
			           <!--                         <div class="form-group col-md-4 col-sm-6">-->
			           <!--                             <label>مستوي الكورس</label>-->
			           <!--                             <input type="text" name="level" class="form-control" value="{{$course->level}}">-->
 													<!--@error('level')-->
			           <!--                             	<span class="text-danger">{{$message}}</span>-->
			           <!--                         	@enderror-->
			           <!--                         </div>-->
                        			   <!--        <div class="form-group col-md-4 col-sm-6">							 -->
                        					 <!--       <label>مستوى الكورس</label>-->
                        					 <!--      <select name="level" class="form-control formselect"  id="levelid">-->
                        				  <!--              <option  disabled selected>حدد مستوى الكورس </option>-->
                        				  <!--              <option value="مبتدئ" {{($course->level=="مبتدئ") ? 'selected' : '' }}>مبتدئ</option>-->
	                             <!--                       <option value="متقدم" {{($course->level=="متقدم") ? 'selected' : '' }}>متقدم</option>-->
                        								
                        						<!--	</select>-->
                        						<!--	@error('level')-->
                              <!--                          <span class="text-danger">{{$message}}</span>-->
                              <!--                      @enderror-->
                              <!--                      <span id="levelError" style="color: red;"></span>-->
                        						<!--</div>-->
                        						<div class="form-group col-md-12 col-sm-6">
			                                        <label>وصف طويل للكورس</label>
			                                        <!--<input type="text" name="detail" class="form-control" value="{{$course->detail}}">-->
			                                        <textarea name="detail" id="ckeditor" cols="30" rows="3"  class="form-control ckeditor" >{{$course->detail}}</textarea>
			                                        @error('detail')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    <div class="form-group col-md-6 col-sm-6">
			                                        <label>وصف قصير</label>
			                                        <!--<input type="text" name="short_detail" class="form-control" value="{{$course->short_detail}}">-->
			                                        <textarea name="short_detail" id="ckeditor" cols="30" rows="2"  class="form-control ckeditor" >{{$course->short_detail}}</textarea>
			                                        @error('short_detail')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    
			                                    <div class="form-group col-md-6 col-sm-6">
			                                        <label>المتطلبات للكورس </label>
			                                        <!--<input type="text" name="requirement" class="form-control" value="{{$course->requirement}}">-->
			                                        <textarea name="requirement" id="ckeditor" cols="30" rows="2"  class="form-control ckeditor" >{{$course->requirement}}</textarea>
			                                        @error('requirement')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div>
			                                    <!-- <div class="form-group col-12 col-sm-6">
			                                        <label>السعر </label>
			                                        <input type="text" name="price" class="form-control" value="{{$course->price}}">
			                                        @error('price')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div> 
			                                     -->
			                                   <!--  <div class="form-group col-md-4 col-sm-6">
			                                        <label>مدة الكورس</label>
			                                        <input type="text" name="duration" class="form-control" value="{{$course->duration}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
			                                    	@error('duration')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
			                                    </div> -->
			                                 
			                                    <div class="form-group col-md-12 col-sm-6">
						                            <label for="projectinput9">كلمات دلالية</label>
						                            <textarea id="projectinput9" rows="2" class="form-control" name="meta_key" placeholder="About Project">{{$course->meta_key}}</textarea>
						                            @error('meta_key')
			                                        	<span class="text-danger">{{$message}}</span>
			                                    	@enderror
						                        </div>
						                        <!--<div class="form-group col-md-4 col-sm-6	">-->
						                        <!--    <label for="projectinput9">شرح للسيرش انجن</label>-->
						                        <!--    <textarea id="projectinput9" rows="1" class="form-control" name="meta_desc" placeholder="About Project">{{$course->meta_desc}}</textarea>-->
						                        <!--    @error('meta_desc')-->
			                           <!--             	<span class="text-danger">{{$message}}</span>-->
			                           <!--         	@enderror-->
						                        <!--</div>-->


			                                    <div class="form-group col-md-6 col-sm-6	">
			                                    	 <img class="avatar-img" src="{{asset('assets_admin/img/courses/'.$course->image) }}" alt="Speciality" width="100px">
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