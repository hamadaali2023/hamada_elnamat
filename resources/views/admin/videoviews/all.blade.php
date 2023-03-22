@extends('layout.admin_main')
@section('content')	
<style type="text/css">
    body { font-family: DejaVu Sans, sans-serif; }
</style>
<link rel="stylesheet" href="{{asset('admin/vendors/css/tables/extensions/buttons.dataTables.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">


		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">ارباح المدربين</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">ارباح المدربين
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <!-- <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			            
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">أضافة اسليد جديد</a>
			            
			          </div>
			        </div> -->
			        
			         
			        @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
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
                  <h4 class="card-title">ارباح المدربين</h4>
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



	                        	<div class="row">
	                        	<div class="col-md-6">
	                        	<form action="{{route('less_than')}}" method="get" name="le_form"  enctype="multipart/form-data">
	                                @csrf
									<div class="row form-row">
										
										<div class="col-md-4">
											<div class="form-group">
												<label>المبلغ </label>
												<input type="text"  class="form-control"  name="lessthan" id="lessInput" onkeyup="myFunctionSearch()">
											</div>
										</div>
										
										<div class="col-md-4" style="margin-top: 5px">
											<label> </label>
											<button type="submit" class="btn btn-primary btn-block"> أقل من </button>
										</div>
									</div>
									
								</form>
								</div>
								<div class="col-md-6">
								<form action="{{route('bigger_than')}}" method="get" 
	                                name="le_form"  enctype="multipart/form-data">
	                                @csrf
									<div class="row form-row">
										
										<div class="col-md-4">
											<div class="form-group">
												<label>المبلغ </label>
												<input type="text"  class="form-control" name="biggerthan" id="biggerInput">
											</div>
										</div>
										
										<div class="col-md-4" style="margin-top: 5px">
											<label> </label>
											<button type="submit" class="btn btn-primary btn-block"> أكبر من </button>
										</div>
									</div>
									
								</form>
								</div></div>
				              	<br>

	                            <div class="table-responsive">
	                                <table class="table table-striped table-bordered dataex-html5-export" id="lessBiggerThan">
	                                    <thead>
												<tr>
													
													<th >  أسم المدرب  </th>
													<th style="width:30px !important;">رصيد المدرب</th>
													<th>دقائق المشاهدة </th>

													<th>Beneficiary Name</th>
													<th>Country </th>
													<th>city </th>
													<th>Bank name </th>
													<th>branch name </th>
													<th>acount number </th>
													<th>swift</th>
												</tr>
										</thead>
										<tbody>			
											@foreach ($instructors as $_item)
											<tr>	
											
												<td  >
													<div style="width:140px !important;">{{ $_item->name }}</div>
												</td>
												
												<td style="width:30px !important;">
													{{round($_item->result_balance, 1)}}
												</td>
												
												<td style="width:50px !important;">
													<!-- {{ $_item->inst_videoviews }}  -->
													{{round($_item->inst_videoviews, 1)}}
												</td>
												<td>{{$_item->bank_data->persone_name}}</td>
												<td>{{$_item->bank_data->country}}</td>
												<td>{{$_item->bank_data->city}}</td>
												<td>{{$_item->bank_data->bank_name}}</td>
												<td>{{$_item->bank_data->bank_sub_name}}</td>
												<td>{{$_item->bank_data->acount_number}}</td>
												<td>{{$_item->bank_data->swift_code}}</td>
											</tr>
											@endforeach	
									</tbody>  
	                            	</table>
	                            </div>   

	                        </div>
	                        <p></p>    
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
							<h5 class="modal-title">أضافة مقال جديد</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('sliders.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="row form-row">
									<input type="hidden" name="author" value=" {{Auth::user()->name}}">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان عربي</label>
											<input type="text" name="title_ar" class="form-control" value="{{old('title_ar')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان انجليزي</label>
											<input type="text" name="title_en" class="form-control" value="{{old('title_en')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الوصف عربي</label>
											<input type="text" name="description_ar" class="form-control" value="{{old('description_ar')}}">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الوصف انجليزي</label>
											<input type="text" name="description_en" class="form-control" value="{{old('description_en')}}">
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>الصوره </label>
											<input type="file" name="image" class="form-control">
										</div>
									</div>
									
									
								</div>
								<button type="submit" class="btn btn-primary btn-block">حفظ </button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /ADD Modal -->

<script>
	function myFunctionSearch() {
	  	var input, filter, table, tr, td, i, txtValue;
	  	input = document.getElementById("lessInput");
	  	filter = input.value.toUpperCase();
	  	table = document.getElementById("lessBiggerThan");
	  	tr = table.getElementsByTagName("tr");
	  	console.log(input.value);
	  	for (i = 0; i < tr.length; i++) {
	    	td = tr[i].getElementsByTagName("td")[1];

	    	if (td) {
	      		txtValue = td.textContent || td.innerText;
	      		console.log(txtValue);
	      		if (txtValue.toUpperCase().indexOf(filter) > -1) {
	        		tr[i].style.display = "";
	      		} else {
	        		tr[i].style.display = "none";
	      		}

	      		
	  	  	}       
	  	}
	}
</script>
		
        </section>
		
      
   
	<!--
	$('#delete').on('show.bs.modal', function (event) {

		      var button = $(event.relatedTarget) 

		      var cat_id = button.data('catid') 
		      var modal = $(this)

		      modal.find('.modal-body #cat_id').val(cat_id);
		})


		</script> -->

  <script src="{{asset('admin/vendors/js/tables/datatable/dataTables.buttons.min.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/datatable/buttons.bootstrap4.min.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/jszip.min.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/pdfmake.min.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/vfs_fonts.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/buttons.html5.min.js')}}" type="text/javascript"></script>

   <script src="{{asset('admin/vendors/js/tables/buttons.print.min.js')}}" type="text/javascript"></script>
 
   <script src="{{asset('admin/vendors/js/tables/buttons.colVis.min.js')}}" type="text/javascript"></script>


   <script src="{{asset('admin/js/scripts/tables/datatables-extensions/datatable-button/datatable-html5.js')}}" type="text/javascript"></script>




@endsection