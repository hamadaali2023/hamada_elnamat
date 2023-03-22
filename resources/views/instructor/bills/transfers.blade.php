

@extends('layout.instructor.main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">تحويل للبنك</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">تحويل للبنك
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-right col-md-6 col-12">
			          
<!-- 			          <div class="dropdown float-md-right">
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">تحويل إلي البنك</a>
			          </div> -->
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
			                <strong></strong>
			                <ul>
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ul>
			            </div>
			        @endif

			        @if(Session::has('errorss'))   
                         <div class="alert alert-danger mb-2" role="alert">
							{{Session::get('errorss')}}
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
	                        	<!-- <div class="row">
		                        	<div class="col-md-12">
		                        	<form action="{{route('search_date')}}" method="get" name="le_form"  enctype="multipart/form-data">
		                                @csrf
										<div class="row form-row">
											
											<div class="col-md-3">
												<div class="form-group">
													<label>من تاريخ  </label>
													<input type="date"  class="form-control"  name="from_date" id="lessInput" onkeyup="myFunctionSearch()">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>إلى تاريخ </label>
													<input type="date"  class="form-control"  name="to_date" id="lessInput" onkeyup="myFunctionSearch()">
												</div>
											</div>
											
											<div class="col-md-2" style="margin-top: 5px">
												<label> </label>
												<button type="submit" class="btn btn-primary btn-block">  بحث </button>
											</div>
										</div>
										
									</form>
									</div>
								</div> -->
	                            <div class="table-responsive">
	                                <table class="table table-striped table-bordered keytable-integration">
	                                    <thead>
												<tr>
													<th> #</th>
													
													<th>المبلغ المحول</th>
													<th> البيان</th>
													<th>التاريخ</th>
													<!-- <th class="text-center">العمليات</th> -->
												</tr>
										</thead>
										<tbody>			
										@foreach ($transfers as $_item)
											<tr>
											    <td class="text-center">
													{{$_item->id}}
												</td>	
													
																						
												<td class="text-center">
													{{$_item->transfers}}
												</td>
												<td class="text-center">
													{{$_item->report}}
												</td>
												<td class="text-center">
													{{$_item->date}} <br> {{$_item->time}}
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

   
			<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"> تحويل ارباح المدرب</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('send-to-bank')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                @csrf
								<div class="row form-row">
									<div class="col-md-12" >
	                  <div class="form-group">
	                    <label>تحديد مدرب او اكثر </label><br>
	                    <select name="user_id"  class="select2 form-control"  style="width: 100%;" id="get_instructor">
	                     	<option disabled value="" selected>حدد مدرب </option>
	                      @foreach ($instructors as $_item)
	                        <option value="{{$_item->id}}">{{$_item->name  }}</option>
	                      @endforeach
	                    </select>
	                  </div>
	                </div>
									<div class="col-md-12">
										<div class="form-group">
											<label>المبلغ </label>
											<input type="text" class="form-control" id="get_wallet_balance" disabled>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>البيان </label>
											<input type="text" name="report" class="form-control" value="{{old('report')}}">
										</div>
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-block"> تحويل </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			
 </section>



<!-- <script src="{{asset('js/app.js')}}"></script> -->

<script>
    
	$(document).ready(function () {
			$('#get_instructor').on('change', function () {
	        	// console.log("welcome sub"); 
	        	let id = $(this).val();
	        		// console.log(id); 
	        		// console.log(id); 
			    $.ajax({
				    type: 'GET',
				    url: "{{url('admin/wallet-user-balance')}}/"+id,
				    success: function (response) {
				        var response = JSON.parse(response)
				        // console.log(response);   
					    $('#get_wallet_balance').empty();
					    document.getElementById('get_wallet_balance').value = response['total']; 
					}
				});
			});
});
</script>

@endsection




