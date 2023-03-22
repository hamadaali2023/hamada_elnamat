

@extends('layout.admin_main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">المسحوبات الشخصية</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">المسحوبات الشخصية
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">عملية سحب جديدة</a>
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
													<th>المبلغ</th>
													<th>البيان</th>
													<th>التاريخ</th>
													<!-- <th class="text-center">العمليات</th> -->
												</tr>
											</thead>
											<tbody>
												
											@foreach ($withdrawals as $key =>$_item)
												<tr>													
													<td class="text-center">
														
														{{$key}}
													</td>
													<td class="text-center">
														{{$_item->amount}}
													</td>
													<td class="text-center">
														{{$_item->report}}
													</td>
													<td class="text-center">
														{{$_item->date}} <br> {{$_item->time}}
													</td>
												
													<!-- <td class="text-center">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" >
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



			<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">عملية سحب جديدة</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('send-withdrawals')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="row form-row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>المبلغ</label>
											<input type="text" name="amount" class="form-control" value="{{old('amount')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>البيان</label>
											<input type="text" name="report" class="form-control" value="{{old('report')}}">
										</div>
									</div>
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">سحب</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /ADD Modal -->
			
			

        </section>




@endsection

