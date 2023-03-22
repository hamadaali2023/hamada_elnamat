

@extends('layout.instructor.main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">كشف حسابي</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">كشف حسابي
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <!-- <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">تحويل ايراد المدرب</a>
			          </div>
			        </div> -->
			        
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
	                    <h4 class="card-title">رصد المحفظة:{{$user_wallet->total}} </h4>
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
													
													<th>  الارباح </th>
													<th>التاريخ</th>

													<th>البيان</th>
													 <th>عنوان الدورة </th> 

													
													<!-- <th class="text-center">العمليات</th> -->
												</tr>
											</thead>
											<tbody>
												
											@foreach ($bills as $key=>$_item)
												<tr>			
												<td class="text-center">
													{{$key}}
												</td>
													
													
													<td class="text-center">
														{{$_item->transferTo}}
													</td>
													<td class="text-center">
														{{$_item->date}} <br> {{$_item->time}}
													</td>
													<td class="text-center">
														{{$_item->report}}
													</td>
													<td>
													    @if($_item->course)
													        {{$_item->course->title}}
													    @endif      
													</td>
												
													<!-- <td class="text-center">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal" 
															data-catid="{{ $_item->id }}"
															data-target="#edit">
																 <button type="button" class="btn btn-outline-success "><i class="la la-edit"></i></button>
															</a>
															<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" class="delete-course">
				                                           <button type="button" class=" btn btn-outline-warning"><i class="la la-trash-o"></i></button>
				                                           
				                                        </a>
														</div>
													</td> -->
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

