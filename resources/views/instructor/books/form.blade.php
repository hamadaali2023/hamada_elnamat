
@extends('layout.instructor.main')
@section('content') 


    @toastr_css
    <div class="content-header row">
              <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">المستخدمين</h3><br>
                <div class="row breadcrumbs-top d-inline-block">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a>
                      </li>
                      
                      <li class="breadcrumb-item active">المستخدمين
                      </li>
                    </ol> 
                  </div>
                </div>
              </div>
              <div class="content-header-right col-md-6 col-12">
                <div class="dropdown float-md-right">
                     <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">أضافة كتاب</a>
                </div>
              </div>
              
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
  




    <section id="keytable">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">KeyTable integration</h4>
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
                    <div class="card-body card-dashboard">
                      <div class="card-body">
              <div class="table-responsive">
                          <table class="table table-striped table-bordered keytable-integration">
                                          <thead>
                          <tr>                          
                            <th class="text-center">الدولة </th>
                            <th class="text-center">العمليات</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $_item)
                          <tr>            
                            <td class="text-center">
                              {{ $_item->name }}
                            </td>
                            <td class="text-center">
                              <div class="actions">
                                <!-- <a class="btn btn-sm bg-success-light" data-toggle="modal" 
                                data-name_ar ="{{ $_item->name_ar }}" 
                                data-name_en ="{{ $_item->name_en }}"
                                data-icon ="{{ $_item->icon }}" 
                                data-catid="{{ $_item->id }}" 
                                data-target="#edit">
                                  <i class="fe fe-pencil"></i> تعديل
                                </a> -->
                                <a class="btn btn-sm bg-success-light" href="{{ url('admin/countries/'.$_item->id).'/edit' }}"><i class="fe fe-pencil"></i> تعديل</a>

                                <a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" class="btn btn-sm bg-danger-light">
                                  <i class="fe fe-trash"></i> حذف
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                          
                        </tbody>
                                          
                                      </table>
                                  </div>      
            </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>




      <!-- Add Modal -->
      <div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">أضافة تخصص</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('books.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
                <div class="row form-row">
                  
                
                          <div class="col-md-6 col-sm-6">
                      <div class="form-group ">
                        <label class="col-form-label col-md-2">التصنيف</label>
                        <select name="categoryId" class="form-control select2-diacritics required" placeholder="Select Category" id="get_sub_category_name">
                        <option  disabled selected>Select</option>  
                        @foreach ($categories as $_item) 
                          <option value="2">sss</option>
                            <option value="{{$_item->id}}">{{$_item->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="form-group ">                  
                            <label class="col-form-label col-md-2">القسم</label>
                            <select name="subCategoryId" class="form-control formselect"  id="get_sub_category">
                               <option  disabled selected>اختار </option> 
                            </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                      <div class="form-group ">
                        <label class="col-form-label col-md-2">لغة الكتاب</label>
                        <select name="languageId" class="form-control select2-diacritics required" placeholder="Select Category" >
                        <option  disabled selected>Select</option>  
                        @foreach ($categories as $_item) 
                          <option value="2">sss</option>
                            <option value="{{$_item->id}}">{{$_item->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                      <div class="form-group ">
                        <label class="col-form-label col-md-2">البلد</label>
                        <select name="countryId" class="form-control select2-diacritics required" placeholder="Select Category" >
                        <option  disabled selected>Select</option>  
                        @foreach ($categories as $_item) 
                          <option value="2">sss</option>
                            <option value="{{$_item->id}}">{{$_item->title}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>عنوان الكتاب</label>
                      <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>
                  </div>
                  
                              <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>السعر بالدولار </label>
                      <input type="text" name="price" class="form-control" value="{{old('price')}}">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>تاريخ الاصدار </label>
                      <input type="text" name="date" class="form-control" value="{{old('date')}}">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>عدد الصفحات </label>
                      <input type="text" name="pages" class="form-control" value="{{old('pages')}}">
                    </div>
                  </div>
                              <div class="form-group col-6 mb-2">
                                  <label for="projectinput9">كلمات مفتاحية</label>
                                  <textarea id="projectinput9" rows="5" class="form-control" name="meta_key" placeholder="About Project"></textarea>
                              </div>
                              <div class="form-group col-6 mb-2">
                                  <label for="projectinput9">نبذه عن الكتاب</label>
                                  <textarea id="projectinput9" rows="5" class="form-control" name="description" placeholder="About Project"></textarea>
                              </div>

                  

                  
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label> ISBN رقم الكتاب</label>
                      <input type="text" name="isbn_num" class="form-control" value="{{old('name_en')}}">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>رقم ترخيص الكتاب</label>
                      <input type="text" name="license_number" class="form-control" value="{{old('name_en')}}">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>جهة ترخيص الكتاب</label>
                      <input type="text" name="licensing_authority" class="form-control" value="{{old('name_en')}}">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                            <div class="form-group">
                              <label>سنة ترخيص الكتاب</label>
                              <select class="select2-diacritics form-control" name="License_year" id="select2-diacritics">
                                <option>2000</option>
                                <option>2001</option>
                                <option>2002</option>
                                <option>2003</option>                               
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
                                      <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01">
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
                                      <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
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
      <!-- /ADD Modal -->
      
      <!-- Edit Details Modal -->
      <div class="modal fade" id="edit" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">تعديل الدولة</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               <form  method="post" action="{{route('countries.update','test')}}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                               
                <div class="row form-row">
                  <input type="hidden" name="id" id="cat_id" >
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>الدولة عربي </label>
                      <input type="text" name="name_ar" class="form-control" id="namear" >
                      
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label>الدولة انجليزي</label>
                      <input type="text" name="name_en" class="form-control" id="nameen" >
                    </div>
                  </div>
                  
                  
                </div>
                <button type="submit" class="btn btn-primary btn-block">حفظ التغيير</button>
              </form>



            </div>
          </div>
        </div>
      </div>
      <!-- /Edit Details Modal -->
      
      <!-- Delete Modal -->
      <div class="modal fade" id="delete" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document" >
          <div class="modal-content">
          <!--  <div class="modal-header">
              <h5 class="modal-title">Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>-->
            <div class="modal-body">
              <div class="form-content p-2">
                <h4 class="modal-title">حذف</h4>
                <p class="mb-4">هل انت متأكد من حذف هذا العنصر ؟</p>
                <div class="row text-center">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-2">
                    <form method="post" action="{{route('countries.destroy','test')}}">
                                         @csrf
                                           @method('delete')
                                           <input type="hidden" name="id" id="cat_id" >
                                        <button type="submit" class="btn btn-primary">حذف </button>
                                      </form>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Delete Modal -->
        </section>


 <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
<script>

  $(document).ready(function () {
    // console.log("welcome subbbb");
                // get doctors
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

    // $('#get_sub_category').on('change', function () {
  //        console.log("welcome sub"); 
  //        let id = $(this).val();
    //     $.ajax({
    //      type: 'GET',
    //      url: "{{url('instructor/getchildcategory')}}/"+id,
    //      success: function (response) {
    //          var response = JSON.parse(response)
    //          console.log(response);   
    //        $('#get_child_category').empty();
    //        $('#get_child_category').append(`<option value="0" disabled selected>Select </option>`);
    //        response.forEach(element => {
    //            $('#get_child_category').append(`<option value="${element['id']}">
    //            ${element['title']} - ${element['id']} 
    //            </option>`);
    //        });
    //    }
    //  });
    // });
  
    });


  $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
      var cat_id = button.data('catid') 
      var modal = $(this)
      modal.find('.modal-body #cat_id').val(cat_id);
  });


</script>

<style type="text/css">
                .select2-container {                      
                  width: 100% !important;       
                }
                .select2-container .select2-selection--single{
                      height: 40px;
                }
                .select2-container--default .select2-selection__rendered{
                  line-height: 35;
                }
                .select2-container--default .select2-selection--single .select2-selection__arrow b{
                  margin-top: 5px;
                }
                .select2-container--default .select2-search--dropdown .select2-search__field {
                  
                    direction: rtl;
                }
              </style>
            


@section('js')
    @toastr_js
    @toastr_render
@endsection
@endsection


                  <!-- <div class="col-12 col-sm-6">
                    <div class="form-group">
                                <label> التخصص</label>
                                <select class="select2-diacritics form-control" id="select2-diacritics">
                                  <option>Aeróbics</option>
                                  <option>Aeróbics en Agua</option>
                                </select>
                              </div>
                          </div>

                          <div class="form-group">                              
                              <select class="select2-rtl form-control" id="select2-rtl">
                                <optgroup label="Central Time Zone">
                                  <option value="AL">Alabama</option>
                                  <option value="AR">Arkansas</option>                                 
                              </select>
                            </div> -->


  <!-- <form action="{{route('books.store')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                @csrf
        <div class="row form-row">
        <div class="col-12 col-sm-6">
          <div class="form-group">
            <label>عنوان الكتاب</label>
              <input type="file" name="photo" class="form-control" >
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">أضافة تخصص </button>

        </div>  

    </form> -->

