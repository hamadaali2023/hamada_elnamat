
@extends('layout.instructor.main')
@section('content') 

@toastr_css

  <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h3 class="content-header-title mb-0 d-inline-block">إضافة كورس مباشر  (اونلاين)</h3><br>
                        <div class="row breadcrumbs-top d-inline-block">
                            <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a>  </li>
                                <li class="breadcrumb-item active">كورسات مباشرة  (اونلاين)</li>
                            </ol> 
                        </div>
                        </div>
                    
                    <!--@if(session()->has('message'))-->
                    <!--        @include('admin.includes.alerts.success')-->
                    <!--    @endif-->
                    <!--@if (count($errors) > 0)-->
                 <!--       <div class="alert alert-danger">-->
                 <!--           <button aria-label="Close" class="close" data-dismiss="alert" type="button">-->
                 <!--               <span aria-hidden="true">&times;</span>-->
                 <!--           </button>-->
                 <!--           <strong>خطا</strong>-->
                  <!--          <ul>-->
                 <!--               @foreach ($errors->all() as $error)-->
                 <!--                   <li>{{ $error }}</li>-->
                 <!--               @endforeach-->
                 <!--           </ul>-->
                 <!--       </div>-->
                 <!--   @endif-->
                    </div>
                    
                   
    </div>


<section id="basic-form-layouts">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="bordered-layout-basic-form">معلومات عن الكورس</h4>
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
                    <form action="{{route('straights.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
                                            <div class="row form-row">
             
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label>عنوان الكورس</label>
                                                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                                    @error('title')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label>وصف قصير </label>
                                                    <input type="text" name="short_detail" class="form-control" value="{{old('short_detail')}}">
                                                    @error('short_detail')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4 col-sm-6">
                                                    <label>وصف طويل للكورس</label>
                                                    <input type="text" name="detail" class="form-control" value="{{old('detail')}}">
                                                    @error('detail')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>تاريخ بداية الكورس </label>
                                                    <input type="date" name="date" class="form-control" value="{{old('date')}}">
                                                    @error('date')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                          <div class="form-group col-md-6 col-sm-6">
                                              <label>تاريخ نهاية الكورس </label>
                                              <input type="date" name="endDate" class="form-control" value="{{old('endDate')}}">
                                              @error('endDate')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                          </div>
                                                
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label>مدة الكورس</label>
                                                    <input type="text" name="duration" class="form-control" value="{{old('duration')}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                    @error('duration')
                                                        <span class="text-danger">{{$message}}</span>
                                                    @enderror
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
                                                        <input type="file" name="image" class="form-control" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
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