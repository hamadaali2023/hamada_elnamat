@extends('layout.instructor.main')
@section('content')	

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">المشاهدات</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                
			                <li class="breadcrumb-item active">المشاهدات
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
                    <p class="card-text"></p>
                        <table class="table table-striped table-bordered keytable-integration">

		                        <thead>
									<tr>			
												<th>الفيديو </th>
												<th>عنوان الفيديو </th>
												<th>عدد دقائق المشاهدات</th>
												<th> المادة </th>
												<!--<th>اسم الطالب  </th>-->
												
												<!-- <th class="text-right">أكشن</th> -->
												</tr>
											</thead>
											<tbody>	
											
											@foreach ($videoviews as $_item)
												<tr>
													<td>
														 <video controls="controls" width="100">
									                        <source src="{{asset('assets_admin/img/curriculums/videos/'.$_item->video->url) }}" type="video/mp4">
									                    </video>
														
													</td>
													<td>
														{{ $_item->video->name }}
													</td>
													<td>
															{{round($_item->watchtime /60, 1)}}
													</td>
													<td>														
														{{$_item->material->name}}
													</td>
													<!--<td>														-->
													<!--	{{ $_item->instructor->full_name }}-->
													<!--</td>-->
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




         <!-- <div class="row match-height">
            @foreach ($videoviews as $_item)
            <div class="col-xl-4 col-md-6">
              <div class="card">
                
                <div class="card-content">
                  
                  <div class="embed-responsive embed-responsive-item embed-responsive-4by3">
                    
                    <video controls="controls" width="100">
                        <source src="{{asset('assets_admin/img/courses/videos/'.$_item->url) }}" type="video/mp4">
                    </video>
                  </div>
                  <div class="card-body">
                    <h5>{{ $_item->video->name }}</h5>
                  </div>
                  
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                  <span class="float-left">{{ $_item->watchtime }} مشاهدة</span>
               
                </div>
              </div>
            </div>
            @endforeach
          </div>
 -->
















          	<!-- Add Modal -->
			<!-- <div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
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
									<input type="hidden" name="author" value="">
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
			</div> -->
			<!-- /ADD Modal -->
			
		
        </section>
		

   
	<!--
	$('#delete').on('show.bs.modal', function (event) {

		      var button = $(event.relatedTarget) 

		      var cat_id = button.data('catid') 
		      var modal = $(this)

		      modal.find('.modal-body #cat_id').val(cat_id);
		})


		</script> -->
@endsection