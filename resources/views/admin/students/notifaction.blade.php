@extends('layout.admin_main')
@section('content') 
<div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                      <h3 class="content-header-title mb-0 d-inline-block">إرسال إشعارات للطلاب</h3><br>
                      <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('admin/dashboard')}}">الرئيسية</a>
                            </li>
                            
                            <li class="breadcrumb-item active">الإشعارات
                            </li>
                          </ol> 
                        </div>
                      </div>
                    </div>

                    <!-- <div class="content-header-right col-md-6 col-12">
                      <div class="dropdown float-md-right">
                           <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">إضافة خدمة</a>
                      </div>
                    </div> -->
                    @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-warning">
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
                  <h4 class="card-title">إرسال إشعار</h4>
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
                        <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2" 
                                 action="{{route('student-send-notifaction')}}" method="POST">
                            @csrf
                            <div class="row form-row">
                                
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label>تحديد طالب او اكثر </label>
                                        <select name="device_token[]" class="select2 form-control" multiple="multiple">
                                            <option disabled >حدد دكتور </option>
                                            @foreach ($students as $_item)
                                                <option value="{{$_item->device_token}}">
                                                    رقم :{{$_item->id}}  &nbsp; {{$_item->name  }} 
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="parsley-input col-md-6" >
                                    <label>رسالة التنبية </label>
                                    <input class="form-control form-control-sm mg-b-20" name="message"  required="" type="text">
                                </div>
                            </div> 

                            

                            <br>
                            <div class="col-12 col-sm-3"><button type="submit" class="btn btn-primary btn-block">ارسال </button></div>  
                        </form>
                    </div>

                    <div class="card-body">
                         <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2" 
                                 action="{{route('student-send-notifaction')}}" method="POST">
                                @csrf                          
                                            <div class="row form-row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">تحديد طالب او مجموعه  او الكل </label>
                                        <select name="device_token[]" required multiple id="select-beast" class="form-control  nice-select  custom-select">
                                         @foreach ($students as $_item)
                                                            <option value="{{$_item->device_token}}">
                                                                 {{$_item->name  }} 
                                                            </option>
                                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="parsley-input col-md-6" >
                                    <label>رسالة التنبية <span class="tx-danger">*</span></label>
                                    <input class="form-control form-control-sm mg-b-20" name="message" required="" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <button type="submit" class="btn btn-primary btn-block">ارسال </button>
                            </div>
                            
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</section>
<!-- Page Wrapper -->




@endsection

