
@extends('layout.instructor.main')
@section('content')	

    @toastr_css

	<div class="content-header row">
		<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			<h3 class="content-header-title mb-0 d-inline-block">المستخدمين</h3><br>
			<div class="row breadcrumbs-top d-inline-block">
	            <div class="breadcrumb-wrapper col-12">
			        <ol class="breadcrumb">
		                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
			            <li class="breadcrumb-item active">المستخدمين</li>
			        </ol> 
			    </div>
            </div>
		</div>
		<div class="content-header-right col-md-6 col-12">
            <div class="dropdown float-md-right">
                <a href="{{route('stories.index')}}"  class="btn btn-primary float-right mt-2">رجوع</a>
            </div>
        </div>
    	<div class="content-header-center col-md-12 col-12">
			@if (session('message'))
			    <div class="alert alert-success">
		            {{ session('message') }}
	            </div>
			@endif
			@if (count($errors) > 0)
                <div class="alert alert-danger">
			        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        	            <span aria-hidden="true">&times;</span>
		            </button>
			        <strong>خطا</strong>
	                <ul>
	                    @foreach ($errors->all() as $error)
	                        <li>{{ $error }}</li>
		                @endforeach
				    </ul>
			    </div>
		    @endif
        </div>
	</div>

	<div class="content-body">
        <section class="inputmask" id="inputmask">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Input Mask</h4>
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
                <div class="card-content collapse show">
                  <div class="card-body">
                    <form action="{{route('stories.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="row form-row">
				                	<div class="col-md-6 col-sm-6">
											<div class="form-group ">
												<label>التصنيف</label>
												<select name="categoryId" class="form-control select2-diacritics required" placeholder="Select Category" id="get_sub_category_name">
												<!-- <option>اختر التصنيف</option> -->
												
												@foreach ($categories as $_item)
												   <option value="{{$_item->id}}" {{($_item->id==$story->categoryId) ? 'selected' : '' }}>{{$_item->title}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="col-md-6 col-sm-6">
										<div class="form-group ">									 
										        <label>القسم</label>
										        <select name="subCategoryId" class="form-control formselect"  id="get_sub_category">
										           <!-- <option  disabled selected>اختار </option>	 -->
										        @foreach ($subcategory as $_item)
												   <option value="{{$_item->id}}" {{($_item->id==$story->subCategoryId) ? 'selected' : '' }}>{{$_item->title}}</option>
												@endforeach
										        </select>
										</div>
									</div>

									
									<div class="col-md-6 col-sm-6">
											<div class="form-group ">
												<label>البلد</label>
												<select name="countryId" class="form-control select2-diacritics required" placeholder="Select Category" >
<!-- 												<option  disabled selected>Select</option>	
 -->												
												@foreach ($country as $_item)
												   <option value="{{$_item->id}}" {{($_item->id==$story->countryId) ? 'selected' : '' }}>{{$_item->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>عنوان الكتاب</label>
											<input type="text" name="name" class="form-control" value="{{$story->name}}">
										</div>
									</div>
									
			                        <div class="col-12 col-sm-6">
										<div class="form-group">
											<label>السعر بالدولار (لا يقل عن 2 ولا يزيد عن ٩ ) </label>
											<input type="text" name="price" class="form-control" value="{{$story->price}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>تاريخ الاصدار </label>
											<input type="date" name="date" class="form-control" value="{{$story->date}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>عدد الصفحات </label>
											<input type="number" name="pages" class="form-control" value="{{$story->pages}}">
										</div>
									</div>
			                        <div class="form-group col-6 mb-2">
			                            <label for="projectinput9">كلمات مفتاحية</label>
			                            <textarea id="projectinput9" rows="5" class="form-control" name="meta_key" placeholder="About Project">{{$story->meta_key}}</textarea>
			                        </div>
			                        <div class="form-group col-6 mb-2">
			                            <label for="projectinput9">نبذه عن الكتاب</label>
			                            <textarea id="projectinput9" rows="5" class="form-control" name="description" placeholder="About Project">{{$story->description}}</textarea>
			                        </div>
									
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label> ISBN رقم الكتاب (اختياري)</label>
											<input type="text" name="isbn_num" class="form-control" value="{{$story->isbn_num}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>رقم ترخيص الكتاب ( ردمك / الفسح / الايداع)</label>
											<input type="text" name="license_number" class="form-control" value="{{$story->license_number}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>جهة ترخيص الكتاب</label>
											<input type="text" name="licensing_authority" class="form-control" value="{{$story->licensing_authority}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
				                    <div class="form-group">
				                      <label>سنة ترخيص الكتاب</label>
				                      <select class="select2-diacritics form-control" name="License_year" id="select2-diacritics">
				                        <option value="2000" @if (old('License_year') == "2000") {{ 'selected' }} @endif>2000</option>
				                        <option value="2001" @if (old('License_year') == "2001") {{ 'selected' }} @endif>2001</option>
				                        <option value="2002" @if (old('License_year') == "2002") {{ 'selected' }} @endif>2002</option>
				                        <option value="2003" @if (old('License_year') == "2003") {{ 'selected' }} @endif>2003</option>				                        
				                      </select>
				                    </div>
				                	
				                    </div>
				                     <div class="col-lg-12 col-md-6">
							            <div class="card">
							                <div class="card-header" style="padding: 0.5rem 0.5rem;">
							                  <h4 class="card-title">اختر صورة العرض</h4>
							                </div>
							                <div class="card-block">
							                  <div class="card-body" style="padding: 0.5rem !important;">
							                    <fieldset class="form-group">
							                      <div class="custom-file">
							                        <input type="file" name="photo" class="custom-file-input" value="{{old('photo')}}" id="inputGroupFile01">
							                        <label class="custom-file-label" for="inputGroupFile01">صورة العرض</label>
							                      </div>
							                    </fieldset>
							                  </div>
							                </div>
							            </div>
							        </div>
							        <div class="col-lg-12 col-md-6">
							            <div class="card">
							                <div class="card-header" style="padding: 0.5rem 0.5rem;">
							                  <h4 class="card-title">اختار الكتاب</h4>
							                </div>
							                <div class="card-block">
							                  <div class="card-body" style="padding: 0.5rem !important;">
							                    <fieldset class="form-group">
							                      <div class="custom-file">
							                        <input type="file" name="file" value="{{old('file')}}" class="custom-file-input" id="inputGroupFile01">
							                        <label class="custom-file-label" for="inputGroupFile01">ارفق الكتاب</label>
							                      </div>
							                    </fieldset>
							                  </div>
							                </div>
							            </div>
							        </div>
									<!-- <div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الايكون</label>
											<input type="file"  name="icon" class="form-control" value="{{old('icon')}}">
										</div>
									</div> -->
									
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">أضافة تخصص </button>
							</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>

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

	</script>


    @toastr_js
    @toastr_render
@endsection


								