@extends('layout.admin_main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">إضافة قيمة الإشتراك </h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">الشرائح
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			               <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mt-2">إضافة نوع إشتراك جديد</a>
			          </div>
			        </div>
			        
			         
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
                  <h4 class="card-title">إضافة نوع إشتراك جديد  </h4>
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
                    <p class="card-text"></p>
                        <table class="table table-striped table-bordered keytable-integration">
		                        <thead>
									<tr>			
										<th> نوع الاشتراك</th> </th>
										<th> قيمة الإشتراك  </th>
										<th class="text-right">العمليات</th>
					    			</tr>
								</thead>
								<tbody>	
									@foreach ($subscription_values as $_item)
									<tr>
										<td>
											{{ $_item->type }}
										</td>
										<td>														
											{{ $_item->value }}
										</td>
										<td class="text-right">
				                            <a class="btn btn-sm bg-success-light edit-course" data-toggle="modal"
											    data-type ="{{ $_item->type }}"
												data-value ="{{ $_item->value }}"
												data-catid="{{ $_item->id }}" 
												data-target="#edit">
		                                        <button type="button" class="btn btn-outline-success "><i class="la la-edit"></i></button>
				                                <span class="editcourse"> تعديل</span>
				                            </a>
				                            <a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" class="btn btn-sm bg-danger-light delete-course">
				                               <button type="button" class=" btn btn-outline-warning"><i class="la la-trash-o"></i></button>
				                               <span class="deletecourse"> حذف</span>
				                            </a>
										</td>
									</tr>
									@endforeach
								</tbody>
		                                </table>
		                            </div>
                     
                    </table>
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
							<h5 class="modal-title">  </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('subscription_values.store')}}" method="POST" 
                                name="le_form"  enctype="multipart/form-data">
                                @csrf
								<div class="row form-row">

									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label> نوع الاشتراك</label>
											<select class="form-control select" name="type">
  												<option disabled selected>اختر نوع الاشتراك</option>
						                            <option value="شهري"> 
						                                شهري 
						                            </option>
						                            <option value="سنوي">
						                                 سنوي
						                            </option>
						                            <option value="عام دراسي">
						                                 عام دراسي
						                            </option>
  											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label> قيمة الاشتراك </label>
											<input type="text" name="value" class="form-control" >
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
			
			<!-- Edit Details Modal -->
			<div class="modal fade" id="edit" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"> </h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							 <form  method="post" action="{{route('subscription_values.update','test')}}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
								<div class="row form-row">
									<input type="hidden" name="id" id="cat_id">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label> نوع الإشتراك </label>
											<select class="form-control select" name="type">
  												<option disabled selected>اختر نوع الاشتراك</option>
						                          
						                             <option value="شهري" >شهري</option>
						                             <option value="سنوي">سنوي</option>
						                            
						                            <option value="عام دراسي">
						                                 عام دراسي
						                            </option>
  											</select>
										</div>
									</div>
									
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label> قيمة الاشتراك   </label>
											<input type="text" name="value" class="form-control" id="value" >
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
						<div class="modal-body">
							<div class="form-content p-2">
								<h4 class="modal-title">حذف</h4>
								<p class="mb-4">هل انت متأكد من حذف هذا العنصر ؟</p>
								<div class="row text-center">
									<div class="col-sm-3">
									</div>
									<div class="col-sm-2">
										<form method="post" action="{{route('subscription_values.destroy','test')}}">
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
        </section>



<script src="{{asset('js/app.js')}}"></script>

<script>
    $('#edit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var type = button.data('type') 
      var value = button.data('value') 
     
      var cat_id = button.data('catid') 
      var modal = $(this)

      modal.find('.modal-body #type').val(type);
      modal.find('.modal-body #value').val(value);
      
      modal.find('.modal-body #cat_id').val(cat_id);
    })


	 $('#delete').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 

      var cat_id = button.data('catid') 
      var modal = $(this)

      modal.find('.modal-body #cat_id').val(cat_id);
})


</script>
<style>
    .add-video {
      position: relative;
      display: inline-block;
    }

    .add-video .addvideo {
      visibility: hidden;
      width: 76px;
      font-size: 10px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .add-video:hover .addvideo {
      visibility: visible;
    }
    /*//////////////*/

    .all-video {
      position: relative;
      display: inline-block;
    }

    .all-video .allvideo {
      visibility: hidden;
      width: 75px;
      font-size: 10px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .all-video:hover .allvideo {
      visibility: visible;
    }

    /*//////////////*/

    .edit-course {
      position: relative;
      display: inline-block;
    }

    .edit-course .editcourse {
      visibility: hidden;
      width: 75px;
      font-size: 10px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .edit-course:hover .editcourse {
      visibility: visible;
    }

    /*//////////////*/

    .delete-course {
      position: relative;
      display: inline-block;
    }

    .delete-course .deletecourse {
      visibility: hidden;
      width: 75px;
      font-size: 10px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 5px 0;
      
      position: absolute;
      z-index: 1;
      bottom: 100%;
      left: 50%;
      margin-left: -35px;
    }

    .delete-course:hover .deletecourse {
      visibility: visible;
    }
</style>
@endsection