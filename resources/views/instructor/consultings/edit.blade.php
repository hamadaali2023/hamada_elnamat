
@extends('layout.instructor.main')
@section('content')	

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">تعديل الاستشارة </h3><br>
                        <div class="row breadcrumbs-top d-inline-block">
	                        <div class="breadcrumb-wrapper col-12">
	                       	<ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>	</li>
		            	       	<li class="breadcrumb-item active">الاستشارة</li>
	                        </ol> 
                        </div>
                      	</div>
                    </div>
                    @if(session()->has('message'))
	                   @include('admin.includes.alerts.success')
	                @endif
	                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>خطأ</strong>
  	                        <ul>
                                @foreach ($errors->all() as $error)
                               	    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif    
                   
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
                   	
			        <form  method="post"  action="{{route('consultings.update',$consulting->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row form-row">
                           
                           <div class="form-group col-md-12 col-sm-6">                                   
                                <label>نوع الاستشارة </label>
                                <select name="title" class="form-control formselect" id="titleid">
                                    <option  value=""  selected>اختار</option>  
                                    <option value="نفسية" {{ $consulting->title == "نفسية" ? "selected" : "" }}>
                                        نفسية
                                    </option>  
                                    <option value="تربوية" {{ $consulting->title == "تربوية" ? "selected" : "" }}>
                                        تربوية
                                    </option>  
                                    <option value="أسرية" {{ $consulting->title == "أسرية" ? "selected" : "" }}>
                                         أسرية
                                    </option> 
                                    <option value="إدارية ومالية" {{ $consulting->title == "إدارية ومالية" ? "selected" : "" }}>
                                         إدارية ومالية 
                                    </option> 
                                    <option value="قانونية" {{ $consulting->title == "قانونية" ? "selected" : "" }}>
                                         قانونية
                                    </option> 
                                    <option value="تنمية بشرية" {{ $consulting->title == "تنمية بشرية" ? "selected" : "" }}>
                                         تنمية بشرية
                                    </option> 
                                    <option value="تغذية ورجيم" {{ $consulting->title == "تغذية ورجيم" ? "selected" : "" }}>
                                        تغذية ورجيم 
                                    </option> 
                                    <option value="بحث علمي" {{ $consulting->title == "بحث علمي" ? "selected" : "" }}>
                                        بحث علمي 
                                    </option> 
                                    <option value="تقنية وفنية" {{ $consulting->title == "تقنية وفنية" ? "selected" : "" }}>
                                        تقنية وفنية 
                                    </option> 
                                    
                                </select>
                                <span id="titleError" style="color: red;"></span>
                            </div>  
                            
                            <div class="form-group col-md-6 col-sm-6">                                   
                                <label>حدد مدة الاستشارة بالدقائق</label>
                                <select name="duration" class="form-control formselect" id="durationid">
                                    <!--<option  value=""  selected>اختار</option>  -->
                                    <option value="45" {{ $consulting->duration == "45" ? "selected" : "" }}>
                                        45
                                    </option>  
                                   
                                </select>
                                <span id="durationError" style="color: red;"></span>
                            </div>  
                            
                            
                            
                            
                            <div class="form-group col-md-6 col-sm-6">                                   
                                <label>  سعر الاستشارة</label>
                                <select name="price" class="form-control formselect" id="priceId" >
                                    <option value="0"  {{ $consulting->price == 0 ? "selected" : "" }}>0</option>  
                                    <option value="5" {{ $consulting->price == 5 ? "selected" : "" }}>5</option>  
                                    <option value="10" {{ $consulting->price == 10 ? "selected" : "" }}>10</option>
                                    <option value="15" {{ $consulting->price == 15 ? "selected" : "" }}>15</option>
                                    <option value="20" {{ $consulting->price == 20 ? "selected" : "" }}>20</option>
                                    <option value="25" {{ $consulting->price == 25 ? "selected" : "" }}>25</option>
                                    <option value="30" {{ $consulting->price == 30 ? "selected" : "" }}>30</option>
                                    <option value="35" {{ $consulting->price == 35 ? "selected" : "" }}>35</option>
                                    <option value="40" {{ $consulting->price == 40 ? "selected" : "" }}>40</option>
                                    
                                </select>
                                <span id="priceError" style="color: red;"></span>
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>وصف قصير والهدف من الاستشارة</label>
                                <textarea name="short_detail"  cols="30" rows="2"  class="form-control" id="short_detailid">{{$consulting->short_detail}}</textarea>
                                @error('short_detail')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="short_detailError" style="color: red;"></span>
                              </div>
                              
                            <div class="form-group col-md-6 col-sm-6">
                                <label>وضوعات الاستشارة </label>
                                <textarea name="mahawir"  cols="30" rows="2"  class="form-control" id="mahawirid">{{$consulting->mahawir}}</textarea>
                                @error('mahawir')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <span id="mahawirError" style="color: red;"></span>
                            </div>
                            
                            
                            <div class="form-group col-sm-6 ">
                                <img class="avatar-img" src="{{asset('assets_admin/img/consultings/'.$consulting->image) }}" width="100px" hieght="100px" alt="Speciality">
									       
                                <label>صورة العرض </label>
                                <input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF" id="imageid">
                                <span id="imageError" style="color: red;"></span>
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