

@extends('layout.admin_main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">الشهادات</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">الشهادات
			                </li>
			              </ol> 
			            </div>
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
	                    <h4 class="card-title"></h4>
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
													<th>#</th>
													<th>اسم الطالب</th>
													<th> عنوان الكورس</th>
													<th> الرقم التسلسلي للشهادة</th>
													<th class="text-center">العمليات</th>
												</tr>
											</thead>
											<tbody>
												
											@foreach ($certificates as $key=>$_item)
												<tr>													
													<td class="text-center">
    													{{$key}}
    												</td>
													<td>
														{{ $_item->student->name }}
													</td>
													<td>
														{{ $_item->course->title }}
													</td>
													<td>
														{{ $_item->serial_number }}
													</td>
													<td class="text-center">
														
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



        </section>



@endsection

