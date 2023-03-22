
@extends('layout.instructor.main')
@section('content')	

    @toastr_css

	<div class="content-header row">
		<div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			<h3 class="content-header-title mb-0 d-inline-block">Western Union معلومات</h3><br>
			<div class="row breadcrumbs-top d-inline-block">
	            <div class="breadcrumb-wrapper col-12">
			        <ol class="breadcrumb">
		                <li class="breadcrumb-item"><a href="{{url('instructor/dashboard')}}">الرئيسية</a></li>
			            <li class="breadcrumb-item active">Bank info</li>
			        </ol> 
			    </div>
            </div>
		</div>
		
    	<div class="content-header-center col-md-12 col-12">
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
	</div>

	<div class="content-body">
        <section class="inputmask" id="inputmask">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"> Western Union information </h4>
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
                  <div class="card-body" style="direction:ltr">
                    <form action="{{route('update-western-info')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data" style="text-align: left;">
                                @csrf
								<div class="row form-row">	
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Name: &nbsp;&nbsp;&nbsp;       (Your name  must be identical to your ID card or passport and must be in English)</label>
											<input type="text" name="persone_name" class="form-control" value="{{$bankdetails->persone_name}}">
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Country</label>
											<input type="text" name="western_country" class="form-control" value="{{$bankdetails->western_country}}">
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>City</label>
											<input type="text" name="western_city" class="form-control" value="{{$bankdetails->western_city}}">
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Mobile</label>
											<input type="text" name="western_mobile" class="form-control" value="{{$bankdetails->western_mobile}}">
										</div>
									</div>
									
			                       
			                        
									
								<button type="submit" class="btn btn-primary btn-block">save change </button>
							</form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

	

    @toastr_js
    @toastr_render
@endsection


								