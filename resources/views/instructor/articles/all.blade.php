@extends('layout.mainlayout_admin')
@section('content')	
<!-- Page Wrapper -->
<div class="page-wrapper">
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-7 col-auto">
								<h3 class="page-title">المقالات</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Dashboard</a></li>
									<li class="breadcrumb-item active">المقالات</li>
								</ul>
							</div>
							<div class="col-sm-5 col">
								<a href="#Add_article" data-toggle="modal" class="btn btn-primary float-right mt-2">أضافة مقال جديد</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					<div class="row">
						<div class="col-sm-12">
							@if(session()->has('message'))
                            @include('admin.includes.alerts.success')
                            @endif
                            @if(Session::has('error'))
                               <div class="row mr-2 ml-2" >
                                    <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2" id="type-error">
                                       {{Session::get('error')}}
                                    </button>
                                </div>
                            @endif 
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
		                                <table
		                                    class="table table-bordered table-striped table-hover js-basic-example dataTable">
		                                    <thead>
												<tr>													
													<th>صورة المقال</th>
													<th>عنوان المقال عربي</th>
													<th>عنوان المقال انجليزي</th>
													<th>الوصف عربي</th>
													<th>الوصف انجليزي</th>
													<th class="text-right">أكشن</th>
												</tr>
											</thead>
											<tbody>
												
											@foreach ($articles as $_item)
												<tr>	
												    <td class="text-center">
														<img class="avatar-img" src="{{asset('assets_admin/img/article/'.$_item->image) }}" alt="Speciality" width="50" height="50">
													</td>												
													<td>
														{{ $_item->title_ar }}
													</td>
													<td>
														{{ $_item->title_en }}
													</td>
													<td>
														{{ $_item->description_ar }}
													</td>
													<td>
														{{ $_item->description_en }}
													</td>
												
													<td class="text-right">
														<div class="actions">
															<a class="btn btn-sm bg-success-light" data-toggle="modal" 
															data-title_ar ="{{ $_item->title_ar }}" 
															data-title_en ="{{ $_item->title_en }}" 
															data-description_ar ="{{ $_item->description_ar }}" 
															data-description_en ="{{ $_item->description_en }}"
															data-image ="{{ $_item->image }}" 
															data-catid="{{ $_item->id }}" 
															data-target="#edit_article">
																<i class="fe fe-pencil"></i> تعديل
															</a>
															<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete_article" class="btn btn-sm bg-danger-light">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
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
			<!-- /Page Wrapper -->
			
			
			<!-- Add Modal -->
			<div class="modal fade" id="Add_article" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">أضافة مقال جديد</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{route('articles.store')}}" method="POST" 
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
									
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label >الوصف عربي</label>											
												<textarea rows="5" cols="5" name="description_ar" class="form-control" placeholder="أدخل النص فقط">{{old('description_ar')}}</textarea>
											
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label >الوصف انجليزي</label>
											
												<textarea rows="5" cols="5" name="description_en" class="form-control" placeholder="أدخل النص فقط">{{old('description_en')}}</textarea>
											
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
			
			<!-- Edit Details Modal -->
			<div class="modal fade" id="edit_article" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">تعديل المقال</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							 <form  method="post" action="{{route('articles.update','test')}}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                               
								<div class="row form-row">
									<input type="hidden" name="id" id="cat_id" >
									<input type="hidden" name="author" value=" {{Auth::user()->name}}" >
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان عربي</label>
											<input type="text" name="title_ar" class="form-control" id="titlear">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>العنوان انجليزي</label>
											<input type="text" name="title_en" class="form-control" id="titleen">
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label >الوصف عربي</label>											
												<textarea rows="5" cols="5"  name="description_ar" class="form-control" id="descriptionar" placeholder="أدخل النص فقط"></textarea>
											
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>الوصف انجليزي</label>
												<textarea rows="5" cols="5"  name="description_en" class="form-control" id="descriptionen" id="descriptionar" placeholder="أدخل النص فقط"></textarea>
											
										</div>
									</div>
									
									
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>الصوره </label>
											<input type="file" name="image" class="form-control">
											<input type="hidden" name="url"  class="form-control" id="image">
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
			<div class="modal fade" id="delete_article" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document" >
					<div class="modal-content">
					<!--	<div class="modal-header">
							<h5 class="modal-title">Delete</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>-->
						<div class="modal-body">
							<div class="form-content p-2">
								<h4 class="modal-title">Delete</h4>
								<p class="mb-4">هل انت متأكد من حذف هذا العنصر</p>
								<div class="row text-center">
									<div class="col-sm-3">
									</div>
									<div class="col-sm-2">
										<form method="post" action="{{route('articles.destroy','test')}}">
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
			<!-- /Delete Modal -->
        </div>
		<!-- /Main Wrapper -->


		<script src="{{asset('js/app.js')}}"></script>

		<script>

			$('#edit_article').on('show.bs.modal', function (event) {

			  var button = $(event.relatedTarget) 
			  var title_ar = button.data('title_ar') 
			  var title_en = button.data('title_en') 
			  var description_ar = button.data('description_ar') 
			  var description_en = button.data('description_en') 
			  var image = button.data('image') 
			  var cat_id = button.data('catid') 
			  var modal = $(this)

			  modal.find('.modal-body #titlear').val(title_ar);
			  modal.find('.modal-body #titleen').val(title_en);
			  modal.find('.modal-body #descriptionar').val(description_ar);
			  modal.find('.modal-body #descriptionen').val(description_en);
			  modal.find('.modal-body #image').val(image);
			  modal.find('.modal-body #cat_id').val(cat_id);
			})


		  

		$('#delete_article').on('show.bs.modal', function (event) {

		      var button = $(event.relatedTarget) 

		      var cat_id = button.data('catid') 
		      var modal = $(this)

		      modal.find('.modal-body #cat_id').val(cat_id);
		})


		</script>

@endsection