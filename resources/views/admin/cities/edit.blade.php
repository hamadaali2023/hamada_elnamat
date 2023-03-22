@extends('layout.admin_main')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">تعديل الدولة</h3>
								
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active"> العروض</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
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
								<div class="card-body">
															
								<form  method="post" action="{{ url('cities/'.$city->id.'/update') }}" enctype="multipart/form-data">
                                 @csrf
                                @method('put')
                               
								<div class="row form-row">
									<input type="hidden" name="id" value="{{$city->id}}" >
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الدولة عربي </label>
											<input type="text" name="name_ar" class="form-control" value="{{$city->name}}" >
											
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>الدولة انجليزي</label>
											<input type="text" name="name_en" class="form-control" value="{{$city->name}}" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>الدولة </label>
											<select class="form-control select" name="countryId">
												<option disabled>اختر الدولة</option>
												@foreach ($countries as $_item)
												   <option value="{{$_item->id}}" {{($_item->id==$city->countryId) ? 'selected' : '' }}>{{$_item->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									
								</div>
								<br/><br/>
								<button type="submit" class="btn btn-primary btn-block">حفظ التغيير</button>
							</form>
								</div>
							</div>
						</div>			
					</div>
				</div>			
			</div>
			<!-- /Page Wrapper -->
			
			
        </div>
		<!-- /Main Wrapper -->
@endsection