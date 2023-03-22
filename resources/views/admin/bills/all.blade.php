

@extends('layout.admin_main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-12 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">كشف حساب</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">كشف حساب
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-left col-md-12 col-12">
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#send_profits" data-toggle="modal" class="btn btn-primary float-right mt-2">توزيع إيرادات المدربين</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#send_profits_teacher" data-toggle="modal" class="btn btn-primary float-right mt-2">توزيع إيرادات المعلمين</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">تحويل إلي البنك</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#sendـwithdrawals" data-toggle="modal" class="btn btn-primary float-right mt-2"> سحب شخصي</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#add_subscriptions" data-toggle="modal" class="btn btn-primary float-right mt-2"> تفعيل حساب</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#add_subscriptions_curriculums" data-toggle="modal" class="btn btn-primary float-right mt-2"> تفعيل طالب التوجيهي</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#course_certificates" data-toggle="modal" class="btn btn-primary float-right mt-2"> شراء شهادة دورة مسجلة</a>
			          	</div>
			          	<div class="dropdown float-md-right" style="margin-left: 10px;">
			               <a href="#live_certificates" data-toggle="modal" class="btn btn-primary float-right mt-2">شراء شهادة دورة أونلاين</a>
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
	                        	<div class="row">
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
								</div>
	                            <div class="table-responsive">
	                                <table class="table table-striped table-bordered keytable-integration">
	                                    <thead>
												<tr>
													<th>#</th>
													<th>رصيد البنك</th>
													<th>تحويل بنكي</th>
													<th>سحب شخصي</th>
													<th>أرباح المعهد</th>
													<th>رصيد المدربين</th>
													<th>رصيد المعلمين</th>
													<th> إيراد</th>
													<th> مصروف</th>
													<th>التاريخ</th>
													<th>البيان</th>
													<th>الطالب</th>
													<th>المدرب</th>
													<th>طريقة الدفع</th>
													<th>الدولة</th>
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
													{{round($_item->payments, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->transfers, 1)}} {{$_item->id}}
												</td>
												<td class="text-center">
													{{round($_item->withdrawals, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->balance_admin, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->balance, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->balance_teacher, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->transferFrom, 1)}}
												</td>
												<td class="text-center">
													{{round($_item->transferTo, 1)}}
												</td>	
												<td class="text-center">
													<div style="width:80px">{{$_item->date}} <br> {{$_item->time}}</div>
												</td>			
												<td class="text-center">
												    @if($_item->report=='create')
												        مشترك جديد
													@elseif($_item->report=='renew')
													    تجديد إشتراك
													@elseif($_item->report=='شهادة أونلاين')
													    شهادة أونلاين
													@elseif($_item->report=='تسجيل في دورة مسجلة')
													    تسجيل في دورة مسجلة
											    	@elseif($_item->report=='تسجيل في دورة اونلاين')
													   تسجيل في دورة اونلاين  
													@elseif($_item->report=='شهادة مسجلة')
													    شهادة مسجلة
													@else
													    {{$_item->report}}
													@endif
												</td>
												<td class="text-center">
													 
													@if($_item->user)
													    <a href="{{url('admin/student-profile/'.$_item->user->id) }}">
													    @if($_item->user->full_name !=null)
														    {{$_item->user->full_name}}
														@else
														    {{$_item->user->name}}
														@endif
														</a>
													@endif
													
												</td>
												<td class="text-center">
												    @if($_item->instructor)
												     <a href="{{url('admin/instructor-profile/'.$_item->instructor->id) }}">{{$_item->instructor->name}}
												     {{$_item->instructor->id}}
												     </a>
												    @endif
												</td>
												<td class="text-center">
												
													{{$_item->type_pay}}
												
												</td>
												<td class="text-center">
													@if($_item->user)
													{{$_item->user->country}}
													@endif
												</td>												
												
											</tr>
										@endforeach			
									</tbody>  
	                            	</table>
	                            </div>   

	                        </div>
	                        <p>الاجمالي : {{$balance_total}}</p>    
	                    </div>
	                </div>
	              </div>
	        </div>
        </div>	 

      	<div class="modal fade" id="send_profits" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title"> تحويل ارباح المدرب</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
    				<div class="modal-body">
    					<form action="{{route('send-balance-to-all-istructor')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                            @csrf
        					<div class="col-md-12">
        					<div class="form-group">
        						<label>البيان </label>
        						<input type="text" name="report" class="form-control" value="{{old('report')}}">
        					</div>
        					</div>
        					<button type="submit" class="btn btn-primary btn-block"> توزيع ايرادات جميع المدربين </button>
    					</form>
    				</div>
				</div>
			</div>
		</div>  
        <div class="modal fade" id="send_profits_teacher" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
							<h5 class="modal-title"> تحويل ارباح المعلمين</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
    				<div class="modal-body">
    					<form action="{{route('send-balance-to-teacher')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                            @csrf
        					<div class="col-md-12">
        					<div class="form-group">
        						<label>البيان </label>
        						<input type="text" name="report" class="form-control">
        					</div>
        					</div>
        					<button type="submit" class="btn btn-primary btn-block"> توزيع ايرادات جميع المعلمين </button>
    					</form>
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
		<div class="modal fade" id="sendـwithdrawals" aria-hidden="true" role="dialog">
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
		
		
		
		
		<div class="modal fade" id="add_subscriptions" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document" >
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title"> تفعيل حساب الطالب</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				    <div class="modal-body">
						<form action="{{route('add-subscriptions')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
						<div class="row form-row">
							<div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>تحديد الطالب </label><br>
        	                    <select name="user_id"  class="select2 form-control"  style="width: 100%;" id="get_instructor" required>
        	                        <option disabled value="" selected>حدد الطالب </option>
        	                        @foreach ($students as $_item)
        	                            <option value="{{$_item->id}}">{{$_item->full_name  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد فترة الاشتراك</label><br>
        	                    <select name="subtype"  class=" form-control"  style="width: 100%;" id="get_instructor" required>
        	                        <option disabled value="" selected>حدد الفترة </option>
        	                        @foreach ($subscription_type as $_item)
        	                            <option value="{{$_item->type}}">{{$_item->type  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد  طريقة الدفع:زين كاش /  فودافون كاش</label><br>
        	                    <select name="type_pay"  class="select2 form-control"  style="width: 100%;" id="get_instructor" required>
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="vodafone cash"> فودافون كاش</option>
        	                        <option value="zain cash"> زين كاش</option>
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد مشترك جديد / تجديد اشتراك</label><br>
        	                    <select name="type_renew"  class="select2 form-control"  style="width: 100%;" id="get_instructor" required>
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="create">مشترك جديد</option>
        	                        <option value="renew">تجديد اشتراك</option>
        	                    </select>
        	                  </div>
        	                </div>
    						<!--<div class="col-md-12">-->
    						<!--	<div class="form-group">-->
    						<!--		<label>المبلغ </label>-->
    						<!--		<input type="text" class="form-control" id="get_wallet_balance" disabled>-->
    						<!--	</div>-->
    						<!--</div>-->
    						<!--<div class="col-md-12">-->
        		<!--				<div class="form-group">-->
        		<!--					<label>البيان </label>-->
        		<!--					<input type="text" name="report" class="form-control" value="{{old('report')}}">-->
        		<!--				</div>-->
    						<!--</div>-->
						</div>
						<button type="submit" class="btn btn-primary btn-block"> تفعيل </button>
					</form>
				</div>
			</div>
			</div>
		</div>
		
		<div class="modal fade" id="add_subscriptions_curriculums" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document" >
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title">  تفعيل طالب التوجيهي</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				    <div class="modal-body">
						<form action="{{route('add-subscriptions-curriculums')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
						<div class="row form-row">
							<div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>تحديد الطالب </label><br>
        	                    <select name="user_id"  class="select2 form-control"  style="width: 100%;" id="" required>
        	                        <option disabled value="" selected>حدد الطالب </option>
        	                        @foreach ($students as $_item)
        	                            <option value="{{$_item->id}}">{{$_item->full_name  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد الفرع </label><br>
        	                    <select name="branch_id"  class=" form-control"  style="width: 100%;" id="" required>
        	                        <option disabled value="" selected>حدد الفرع </option>
        	                        @foreach ($branches as $branch)
        	                            <option value="{{$branch->id}}">{{$branch->name  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد  طريقة الدفع:زين كاش /  فودافون كاش</label><br>
        	                    <select name="type_pay"  class="select2 form-control"  style="width: 100%;" id="" required>
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="vodafone cash"> فودافون كاش</option>
        	                        <option value="zain cash"> زين كاش</option>
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد مشترك جديد / تجديد اشتراك</label><br>
        	                    <select name="type_renew"  class="select2 form-control"  style="width: 100%;" id="" required>
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="create">مشترك جديد</option>
        	                        <option value="renew">تجديد اشتراك</option>
        	                    </select>
        	                  </div>
        	                </div>
    						<!--<div class="col-md-12">-->
    						<!--	<div class="form-group">-->
    						<!--		<label>المبلغ </label>-->
    						<!--		<input type="text" class="form-control" id="get_wallet_balance" disabled>-->
    						<!--	</div>-->
    						<!--</div>-->
    						<!--<div class="col-md-12">-->
        		<!--				<div class="form-group">-->
        		<!--					<label>البيان </label>-->
        		<!--					<input type="text" name="report" class="form-control" value="{{old('report')}}">-->
        		<!--				</div>-->
    						<!--</div>-->
						</div>
						<button type="submit" class="btn btn-primary btn-block"> تفعيل </button>
					</form>
				</div>
			</div>
			</div>
		</div>
		
		<div class="modal fade" id="course_certificates" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document" >
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title"> شراء شهادة دورة مسجلة</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				    <div class="modal-body">
						<form action="{{route('buy-course-certificat')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
						<div class="row form-row">
							<div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>تحديد الطالب </label><br>
        	                    <select name="user_id"  class="select2 form-control"  style="width: 100%;" id="get_student_name">
        	                        <option disabled value="" selected>حدد الطالب </option>
        	                        @foreach ($students as $_item)
        	                            <option value="{{$_item->id}}">{{$_item->full_name  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label> اختر الدورة</label><br>
        	                    <select name="course_id"  class=" form-control"  style="width: 100%;" id="get_course_name">
        	                        <option disabled value="" selected>اختار الدورة  </option>
        	                        
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد  طريقة الدفع:زين كاش /  فودافون كاش</label><br>
        	                    <select name="type_pay"  class="select2 form-control"  style="width: 100%;" id="get_instructor">
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="vodafone cash"> فودافون كاش</option>
        	                        <option value="zain cash"> زين كاش</option>
        	                    </select>
        	                  </div>
        	                </div>
        	                
    						<!--<div class="col-md-12">-->
    						<!--	<div class="form-group">-->
    						<!--		<label>المبلغ </label>-->
    						<!--		<input type="text" class="form-control" id="get_wallet_balance" disabled>-->
    						<!--	</div>-->
    						<!--</div>-->
    						<!--<div class="col-md-12">-->
        		<!--				<div class="form-group">-->
        		<!--					<label>البيان </label>-->
        		<!--					<input type="text" name="report" class="form-control" value="{{old('report')}}">-->
        		<!--				</div>-->
    						<!--</div>-->
						</div>
						<button type="submit" class="btn btn-primary btn-block"> تحويل </button>
					</form>
				</div>
			</div>
			</div>
		</div>
		
		<div class="modal fade" id="live_certificates" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document" >
			<div class="modal-content">
				<div class="modal-header">
						<h5 class="modal-title"> شراء شهادة دورة اون لاين</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				    <div class="modal-body">
						<form action="{{route('buy-live-certificat')}}" method="POST" name="le_form"  enctype="multipart/form-data">
                        @csrf
						<div class="row form-row">
							<div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>تحديد الطالب </label><br>
        	                    <select name="user_id"  class="select2 form-control"  style="width: 100%;" id="get_student_live_name">
        	                        <option disabled value="" selected>حدد الطالب </option>
        	                        @foreach ($students as $_item)
        	                            <option value="{{$_item->id}}">{{$_item->full_name  }}</option>
        	                        @endforeach
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label> اختر الدورة</label><br>
        	                    <select name="course_id"  class=" form-control"  style="width: 100%;" id="get_live_name">
        	                        <option disabled value="" selected>اختار الدورة  </option>
        	                        
        	                    </select>
        	                  </div>
        	                </div>
        	                <div class="col-md-12" >
        	                  <div class="form-group">
        	                    <label>حدد  طريقة الدفع:زين كاش /  فودافون كاش</label><br>
        	                    <select name="type_pay"  class="select2 form-control"  style="width: 100%;" id="get_instructor">
        	                        <option disabled value="" selected>حدد</option>
        	                        <option value="vodafone cash"> فودافون كاش</option>
        	                        <option value="zain cash"> زين كاش</option>
        	                    </select>
        	                  </div>
        	                </div>
        	                
    						<!--<div class="col-md-12">-->
    						<!--	<div class="form-group">-->
    						<!--		<label>المبلغ </label>-->
    						<!--		<input type="text" class="form-control" id="get_wallet_balance" disabled>-->
    						<!--	</div>-->
    						<!--</div>-->
    						<!--<div class="col-md-12">-->
        		<!--				<div class="form-group">-->
        		<!--					<label>البيان </label>-->
        		<!--					<input type="text" name="report" class="form-control" value="{{old('report')}}">-->
        		<!--				</div>-->
    						<!--</div>-->
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
			
			
			
	
		$('#get_student_name').on('change', function () {
	        console.log("welcome course"); 
	        let id = $(this).val();
	        console.log(id); 
			    $.ajax({
				type: 'GET',
				url: "{{url('admin/get-course-name')}}/"+id,
				success: function (response) {
				    console.log("welcome coursesss"); 
				    var response = JSON.parse(response)
				    console.log(response);   
					$('#get_course_name').empty();
					$('#get_course_name').append(`<option  value="" selected>اختار </option>`);
					response.forEach(element => {
					    console.log(element['title']['en']);   
					    $('#get_course_name').append(`<option value="${element['id']}">
					    ${element['title']}  
					        </option>`);
					});
				}
			});
		});
		
		
		$('#get_student_live_name').on('change', function () {
	        console.log("welcome course"); 
	        let id = $(this).val();
	        console.log(id); 
			    $.ajax({
				type: 'GET',
				url: "{{url('admin/get-live-name')}}/"+id,
				success: function (response) {
				    console.log("welcome coursesss"); 
				    var response = JSON.parse(response)
				    console.log(response);   
					$('#get_live_name').empty();
					$('#get_live_name').append(`<option  value="" selected>اختار </option>`);
					response.forEach(element => {
					    console.log(element['title']['en']);   
					    $('#get_live_name').append(`<option value="${element['id']}">
					    ${element['title']}  
					        </option>`);
					});
				}
			});
		});
		
			
			
});
</script>

@endsection




