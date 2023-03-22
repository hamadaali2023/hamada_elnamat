@extends('layout.admin_main')
@section('content')	

  <script src="{{asset('admin/vendors/js/editors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
  <script src="  {{asset('admin/js/scripts/editors/editor-ckeditor.js')}}" type="text/javascript"></script>

		<div class="content-header row">
			        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
			          <h3 class="content-header-title mb-0 d-inline-block">حسابي</h3><br>
			          <div class="row breadcrumbs-top d-inline-block">
			            <div class="breadcrumb-wrapper col-12">
			              <ol class="breadcrumb">
			                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">الرئيسية</a>
			                </li>
			                <li class="breadcrumb-item active">حسابي
			                </li>
			              </ol> 
			            </div>
			          </div>
			        </div>
			        <div class="content-header-right col-md-6 col-12">
			          <div class="dropdown float-md-right">
			           
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
               
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <div class="card-body">
						<div class="row">
						<div class="col-md-12">
							<div class="profile-header">
								<div class="row align-items-center">
									<div class="col-auto profile-image">
										<a href="#">
											<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/'.$instructor->photo) }}" width="120px">
										</a>
									</div>
									<div class="col ml-md-n2 profile-user-info">
										<h4 class="user-name mb-0">{{$instructor->name}}</h4>
										<h6 class="text-muted">{{$instructor->email}}</h6>
										<div class="user-Location"><i class="fa fa-map-marker"></i> {{$instructor->address}}</div>
										<!-- <div class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div> -->
									</div>
									<!-- <div class="col-auto profile-btn">
										
										<a href="" class="btn btn-primary">
											Edit
										</a>
									</div> -->
								</div>
							</div>
							<div class="profile-menu">
								<ul class="nav nav-tabs nav-tabs-solid">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#per_details_tab">من أنا</a>
									</li>

									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#courses_tab">الدورات المسجلة</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#straights_tab">الدورات التفاعلية</a>
									</li>
									<!--<li class="nav-item">-->
									<!--	<a class="nav-link" data-toggle="tab" href="#courses_live_tab">الكورسات المباشرة</a>-->
									<!--</li>-->
									
									<!--<li class="nav-item">-->
									<!--	<a class="nav-link" data-toggle="tab" href="#join_courses_live_tab">حجوزات الكورسات المباشرة</a>-->
									<!--</li>-->
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#reviews_tab">التقييمات</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#bank_tab">بيانات البنك</a>
									</li>
									
									
									<!-- <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#password_tab">كلمة المرور</a>
									</li> -->
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#notify_tab">ارسال اشعار</a>
									</li>
									
									
									
									
                                    <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#documents_tab">المستندات</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#certificates_tab">الشهادات </a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#cv_tab">السيرة الذاتية</a>
									</li>
									
								</ul>
							</div>	
							<div class="tab-content profile-tab-cont">
							    <!-- Personal Details Tab -->
							    <div class="tab-pane fade" id="documents_tab">
									<!-- Personal Details -->
									<div class="row">
										<div class="col-lg-12">
											<div class="card">
												<div class="card-body">
													
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">جواز السفر :</p>
														@if($instructor->passport != null)
														<div class="col-auto profile-image">
															<a href="#">
																<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/documents/'.$instructor->passport) }}" width="100px" height="100px">
															</a>
                                                            <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/documents/'.$instructor->passport) }}" target="_black"> عرض جواز السفر  </a>  &nbsp;&nbsp;
    														<a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/documents/'.$instructor->passport) }}" download> تحميل جواز السفر  </a> 
														</div>
														@else
														    لم يتم الإضافة
														@endif
													</div>
													<hr>
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3"> الهوية  الشخصية</p>
														@if($instructor->identity != null)
														<div class="col-auto profile-image">
															<a href="#">
																<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/documents/'.$instructor->identity) }}" width="100px" height="100px">
															</a>
															<a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/documents/'.$instructor->identity) }}" target="_black"> عرض الهوية  الشخصية  </a>  &nbsp;&nbsp;

														    <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/documents/'.$instructor->identity) }}" download> تحميل الهوية  الشخصية  </a> 
														</div>
														@else
														    لم يتم الإضافة
														@endif
													</div>
												</div>
											</div>
											
											
										</div>
									</div>
									<!-- /Personal Details -->
								</div>
								<!-- Personal Details Tab -->
								
								<!-- Personal Details Tab -->
								<div class="tab-pane fade" id="certificates_tab">
									<!-- Personal Details -->
									<div class="row">
										<div class="col-lg-12">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title d-flex justify-content-between">
														<span>الشهادات	</span> 
														<!-- <a class="edit-link btn-primary" data-toggle="modal" href="#edit_certificates"><i class="fa fa-edit mr-1"></i>رفع الشهادات</a> -->
													</h5>
													

													<!--<form action="{{url('instructor/profile/update/certificates')}}" method="POST" name="le_form"  enctype="multipart/form-data">-->
								     <!--         @csrf-->
															<div class="row form-row">    
																<input type="hidden" name="id" value="">
																<!--<div class="col-12 col-sm-6">-->
																<!--	<div class="form-group">-->
																<!--		<label>شهادة الدكتوراه</label>-->
																<!--		<input type="file" name="certificate_one" class="form-control" value="Miami" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF,.PDF">-->
																<!--	</div>-->
																<!--</div>-->
																<div class="col-12 col-sm-8">
																    <label>شهادة الدكتوراه :</label>
																    @if($instructor->certificate_one != null)
																	<div class="form-group">
																	    <br>
																		<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/certificate/'.$instructor->certificate_one) }}" width="100px" height="100px">
																	    <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_one) }}" target="_black"> عرض    </a>  &nbsp;&nbsp;
														                <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_one) }}" download> تحميل  </a> 
																	</div>
																	@else
																	   لم يتم إضافة الشهادة
																	@endif
																</div>
																<!--<div class="col-12 col-sm-6">-->
																<!--	<div class="form-group">-->
																<!--		<label>شهادة الماجستير</label>-->
																<!--		 <input type="hidden" name="url" value="{{$instructor->passport}}" > -->
																<!--		<input type="file" name="certificate_two" class="form-control" value="Miami" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF,.PDF">-->
																<!--	</div>-->
																<!--</div>-->
																<div class="col-12 col-sm-8">
																	<div class="form-group">
																	    <br>
																	    <label>شهادة الماجستير :</label>
											    					    @if($instructor->certificate_two != null)
    																		<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/certificate/'.$instructor->certificate_two) }}" width="100px" height="100px">
    																		<a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_two) }}" target="_black"> عرض    </a>  &nbsp;&nbsp;
    															            <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_two) }}" download> تحميل    </a> 
																	    @else
    																	   لم يتم إضافة الشهادة
    																	@endif
																	</div>
																</div>
																<!--<div class="col-12 col-sm-6">-->
																<!--	<div class="form-group">-->
																<!--		<label>شهادة البكالوريوس</label>-->
																<!--		 <input type="hidden" name="url" value="{{$instructor->passport}}" > -->
																<!--		<input type="file" name="certificate_three" class="form-control" value="Miami" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF,.PDF">-->
																<!--	</div>-->
																<!--</div>-->
																<div class="col-12 col-sm-6">
																	<div class="form-group">
																	    <br>
																	    <label>شهادة البكالوريوس</label>
																	    @if($instructor->certificate_three != null)
																		<img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/certificate/'.$instructor->certificate_three) }}" width="100px" height="100px">
																		    <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_three) }}" target="_black"> عرض    </a>  &nbsp;&nbsp;
															                <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/certificate/'.$instructor->certificate_three) }}" download> تحميل    </a> 
																	    @else
    																	   لم يتم إضافة الشهادة
    																	@endif
																	</div>
																</div>	
																
															</div>
															<!--<button type="submit" class="btn btn-primary btn-block">حفظ التغيير </button>-->
													<!--</form>-->

												</div>
											</div>
											
											
											
										</div>
									</div>
									<!-- /Personal Details -->
								</div>
								<!-- /Personal Details Tab --> 

								<!-- Personal Details Tab -->
								<div class="tab-pane fade" id="cv_tab">
									<!-- Personal Details -->
									<div class="row">
										<div class="col-lg-12">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title d-flex justify-content-between">
														<span>السيرة الذاتيه	</span> 
														<!-- <a class="edit-link" data-toggle="modal" href="#edit_documents"><i class="fa fa-edit mr-1"></i>تعديل</a> -->
													</h5>
													<!--<form action="{{url('instructor/profile/update/cv')}}" method="POST" name="le_form"  enctype="multipart/form-data">-->
								     <!--         @csrf-->
															<div class="row form-row">    
																<!--<input type="hidden" name="id" value="">-->
																<!--<div class="col-12 col-sm-6">-->
																<!--	<div class="form-group">-->
																<!--		<label>شهادة البكالوريوس</label>-->
																<!--		 <input type="hidden" name="url" value="{{$instructor->passport}}" > -->
																<!--		<input type="file" name="cv" class="form-control" value="Miami" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF,.PDF">-->
																<!--	</div>-->
																<!--</div>-->
																<div class="col-12 col-sm-6">
																	<div class="form-group">
																	    <br>
																	    <label>شهادة البكالوريوس :</label>
																	    @if($instructor->certificate_one != null)
																		    <img class="rounded-circle" alt="User Image" src="{{asset('img/profiles/certificate/'.$instructor->certificate_one) }}" width="100px" height="100px">
																		    <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/cv/'.$instructor->cv) }}" target="_black"> عرض    </a>  &nbsp;&nbsp;
															                <a class="btn btn-primary " style="padding-right: 30px;padding-left: 30px;" href="{{asset('img/profiles/cv/'.$instructor->cv) }}" download> تحميل    </a> 
																	    @else
																	        لم يتم إضافة الشهادة
																	    @endif
																	</div>
																</div>
																
																
																
																
															</div>
													<!--		<button type="submit" class="btn btn-primary btn-block">حفظ التغيير </button>-->
													<!--</form>-->
												</div>
											</div>
											
											
											
										</div>
									</div>
									<!-- /Personal Details -->
								</div>
								<!-- /Personal Details Tab --> 
								
								<!-- Personal Details Tab -->
								<div class="tab-pane fade show active" id="per_details_tab">
									<!-- Personal Details -->
									<div class="row">
										<div class="col-lg-12">
											<div class="card">
												<div class="card-body">
													<h5 class="card-title d-flex justify-content-between">
														<span>البيانات الشخصية	</span> 
														<a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>تعديل</a>
													</h5>
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">الاسم</p>
														<p class="col-sm-10">{{$instructor->name}}</p>
													</div>
													<div class="row">
                                                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3"> الدولة </p>
                                                        <p class="col-sm-10">{{$instructor->country}}</p>
                                                      </div> 
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">البريد الالكتروني</p>
														<p class="col-sm-10">{{$instructor->email}}</p>
													</div>
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">الهاتف</p>
														<p class="col-sm-10">{{$instructor->mobile}}</p>
													</div>
													<div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">نبذه</p>
														<p class="col-sm-10">{!! $instructor->detail !!}</p>
													</div>
													<!-- <div class="row">
														<p class="col-sm-2 text-muted text-sm-right mb-0">العنوان</p>
														<p class="col-sm-10">{{$instructor->address}}</p>
																
													</div> -->
												</div>
											</div>
											
											<!-- Edit Details Modal -->
											<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
												<div class="modal-dialog modal-dialog-centered" role="document" >
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title">البيانات الشخصية</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form action="{{url('/admin/instructor-update')}}" method="POST" 
								                                name="le_form"  enctype="multipart/form-data">
								                                @csrf
																<div class="row form-row">           
																 
																	<input type="hidden" name="id" value="{{$instructor->id}}">
																	<div class="col-12 col-sm-12">
																		<div class="form-group">
																			<label> الاسم</label>
																			<input type="text" name="name" class="form-control" value="{{$instructor->name}}">
																		</div>
																	</div>
																	
																	<!-- <div class="col-12">
																		<div class="form-group">
																			<label>تاريخ الميلاد</label>
																			<div class="cal-icon">
																				<input type="date" name="dateOfBirth" class="form-control" value="{{Auth::user()->dateOfBirth}}">
																			</div>
																		</div>
																	</div> -->
																	<!-- <div class="col-12 col-sm-6">
																		<div class="form-group">
																			<label>Email ID</label>
																			<input type="email" class="form-control" value="johndoe@example.com">
																		</div>
																	</div> -->
																	<div class="col-12 col-sm-12">
																		<div class="form-group">
																			<label>الهاتف</label>
																			<input type="text" name="mobile" value="{{$instructor->mobile}}" class="form-control">
																		</div>
																	</div>
																	<!-- <div class="col-12">
																		<h5 class="form-title"><span>Address</span></h5>
																	</div> -->
																	<!-- <div class="col-12">
																		<div class="form-group">
																		<label>العنوان</label>
																			<input type="text" name="address" class="form-control"
																			 value="{{Auth::user()->address}}">
																		</div>
																	</div> -->
																	<div class="col-12 col-sm-12">
	                                                                    <div class="form-group ">
	                                                                        <label for="projectinput9">وصف طويل ومعلومات عن المدرب</label>
	                                                                        <textarea name="detail" id="ckeditor" cols="30" rows="4"  class="form-control ckeditor" >{{$instructor->detail}}</textarea>
	                                                                    </div>
	                                                                </div>
																	<div class="col-12 col-sm-12">
																		<div class="form-group">
																			<label>الصورهة الشخصية</label>
																			<input type="hidden" name="url" value="{{$instructor->photo}}" >
																			<input type="file" name="photo" class="form-control" value="Miami" accept=".JPEG,.JPG,.PNG,.GIF,.TIF,.TIFF">
																		</div>
																	</div>
																	
																</div>
																<button type="submit" class="btn btn-primary btn-block">حفظ التغيير </button>
															</form>
														</div>
													</div>
												</div>
											</div>
											<!-- /Edit Details Modal -->
											
										</div>
									</div>
									<!-- /Personal Details -->
								</div>
								<!-- /Personal Details Tab -->
								<!-- Change Password Tab -->
								<div id="password_tab" class="tab-pane fade">
								
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">تغيير كلمة المرور</h5>
											<div class="row">
												<div class="col-md-10 col-lg-6">
															<form action="{{route('user.changepassword')}}" method="POST" 
	                                name="le_form"  enctype="multipart/form-data">
	                                @csrf
	                                					<input type="hidden" name="id" value="{{Auth::user()->id}}">
														<div class="form-group">
															<label>كلمة المرور الحالية</label>
															<input type="password" name="current-password" class="form-control">
														</div>
														<div class="form-group">
															<label>كلمة المرور الجديدة</label>
															<input type="password" name="new-password" class="form-control">
														</div>
														<!-- <div class="form-group">
															<label>Confirm Password</label>
															<input type="password" class="form-control">
														</div> -->
														<button class="btn btn-primary" type="submit">حفظ التغيير</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Change Password Tab -->

								

								<!-- courses  Tab -->
								<div id="courses_tab" class="tab-pane fade">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">الكورسات المسجلة</h5>
											<div class="card-content collapse show">
									   	        <div class="card-body card-dashboard">
									                <p class="card-text"></p>
									                <table class="table table-striped table-bordered keytable-integration">
									                    <thead>
									   	                    <tr>    
									                            <th>الصورة</th>
								                                <th>العنوان </th>
								                                <!--<th>الوصف </th>-->
								                                <th>الحالة </th>
								                                <th class="text-center">العمليات</th>
								                            </tr>
								                        </thead>
								                        <tbody>                     
								                            @foreach ($courses as $key=>$_item)
								                            <tr>
									                            <td>
									                                <a href="profile" class="avatar avatar-sm mr-2">
									                                <img class="avatar-img" src="{{asset('assets_admin/img/courses/'.$_item->image) }}" alt="Speciality">
									                                </a>
									                            </td>
									                            <td>{{ $_item->title }}</td>    
									                            <!--<td>  -->
									                            <!--    {{ Str::limit($_item->detail, 90) }}-->
									                            <!--</td>      -->
									                            <!--<td>-->
                                				 <!--                       <button type="button" class=" btn btn-outline-warning">-->
                                				 <!--                           @if($_item->status==0)-->
                                     <!--                                           بانتظار الموافقة-->
                                     <!--                                       @elseif($_item->status==1)  -->
                                     <!--                                           مقبولة-->
                                     <!--                                       @else-->
                                     <!--                                           بحاجة إلى إجراء تعديل-->
                                     <!--                                       @endif-->
                                     <!--                                   </button>-->
                                     <!--                           </td>-->
                                                                <td>
                                                                    <!--<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#status{{$key}}" class="delete-course">-->
                                				                        <button type="button" class=" btn btn-outline-warning">
                                				                            @if($_item->status==0)
                                                                                بانتظار الموافقة
                                                                            @elseif($_item->status==1)  
                                                                                مقبولة
                                                                            @elseif($_item->status==2)  
                                                                                بحاجة إلى إجراء تعديل
                                                                            @elseif($_item->status==3) 
                                                                                إضافة دروس 
                                                                            @else
                                                                                يرجى التواصل معنا
                                                                            @endif
                                                                        </button>
                                				                    <!--</a>-->
                                                                </td>
									                            <td class="text-center">
									                                <div class="actions">
									                                    <a href="{{url('admin/allvideos',$_item->id)}}" class="all-video" >
									                                    <button type="button" class="btn btn-outline-danger "><i class="la la-file-video-o"></i></button>
									                                        <span class="allvideo">الفيديوهات</span>
									                                    </a>
									                                    <a data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#deletecourse" class="delete-course">
									                                        <button type="button" class=" btn btn-outline-warning"><i class="la la-trash-o"></i></button>
									                                        <span class="deletecourse">حذف الكورس</span>
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
								<!-- /courses Tab -->
                                
								<!-- courses live  Tab -->
								<div id="straights_tab" class="tab-pane fade">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">الكورسات المباشرة</h5>
											<div class="card-content collapse show">
									            <div class="card-body card-dashboard">
										            <p class="card-text"></p>
										            <table class="table table-striped table-bordered keytable-integration">
										              <thead>
                    									   <th>الصورة</th>
                    									   <th>العنوان </th>
                    									  
                    									   <th>الحالة</th>
                    									    <th class="text-center">العمليات</th>
                    									 </tr>
								                        </thead>
								                        <tbody>                     
										                  @foreach ($straights as $key=>$_item)
                            								<tr>
                                							    <td>
                                							       <a href="profile" class="avatar avatar-sm mr-2">
                                								       <img class="avatar-img" src="{{asset('assets_admin/img/livecourses/'.$_item->image) }}" alt="Speciality">
                                							       </a>
                                							   </td>
                            								    <td>{{ $_item->title }}</td>    
                                							   
                                							    <td>
                                                                    <a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#status{{$key}}" class="delete-course">
                                			                        <button type="button" class=" btn btn-outline-warning">
                                				                    @if($_item->status==0)
                                                                        بانتظار الموافقة
                                                                    @elseif($_item->status==1)  
                                                                        مقبولة
                                                                    @elseif($_item->status==2)  
                                                                       بحاجة إلى  تغيير الوقت
                                                                    @elseif($_item->status==3)
                                                                        بحاجة الى تأجيل الموعد 
                                                                    @elseif($_item->status==4)
                                                                        يرجى التواصل معنا
                                                                    @else
                                                                       انتهت
                                                                    @endif
                                                                    </button>
                                        				            </a>
                                                                </td>
                                								<td class="text-right">
                                									<a href="{{url('admin/students/sign-online/'.$_item->id)}}"  class="edit-course">
                                                                        <button type="button" class="btn btn-outline-success "><i class="la la-users"></i></button>
                                                                        <span class="editcourse">المسجلين ف الدورة</span>
                                                                    </a>
                                                                    <a href="{{url('admin/straights/'.$_item->id.'/edit')}}"  class="edit-course">
                                                                        <button type="button" class="btn btn-outline-success "><i class="la la-edit"></i></button>
                                                                        <span class="editcourse">تعديل الدورة</span>
                                                                    </a>
                                				                    <a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete" class="delete-course">
                                				                        <button type="button" class=" btn btn-outline-warning"><i class="la la-trash-o"></i></button>
                                				                        <span class="deletecourse">حذف الكورس</span>
                                				                    </a>
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
								<!-- /courses live Tab -->

								
								<!-- reviews  Tab -->
								<div id="reviews_tab" class="tab-pane fade">
									<div class="page-header">
												<div class="row">
													<div class="col-sm-7 col-auto">
														<h3 class="page-title">التقييمات  </h3>
													</div>
													<!-- <div class="col-sm-5 col">
														<a data-target="#Add_services_details"  data-toggle="modal" class="btn btn-primary float-right mt-2">إضافة خدمة جديدة</a>
													</div> -->
												</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="card">
													<div class="card-body">
														<div class="table-responsive">
							                                <table
							                                    class="table table-bordered table-striped table-hover js-basic-example dataTable">
							                                    <thead>
																	<tr>
																		<th>اسم الطالب</th>
																		<th>التقييم</th>
																		<th>الوصف</th>
																		<th>التاريخ</th>
																		<!-- <th class="text-right">أكشن</th> -->
																	</tr>
																</thead>

																<tbody>
																	@foreach ($reviews as $_item)
																
																	
																	<tr role="row" class="odd">
																		<td class="sorting_1">
																			<h2 class="table-avatar">
																				<!-- <a href="profile.html" class="avatar avatar-sm mr-2">
																					<img class="avatar-img rounded-circle" src="" alt="User Image" width="60px" height="60px">
																				<a href="profile.html">  -->
																				
																				
																				{{$_item->student->name}}
																				<!-- </a> -->
																			</h2>
																		</td>
																	
																		<td>
																			@for ($i = 0; $i < $_item->rate; $i++)
																				<span style="size: 20,color: red">*</span>
																		    @endfor							        
																		</td>
																		<td>
																			{{$_item->comment}}
																		<td>{{ mb_strimwidth($_item->created_at,0,10) }} <br>
																			<small>{{ substr($_item->created_at,10,11) }}</small></</td>
																		<!-- <td class="text-right">
																			<div class="actions">

																				<a  data-toggle="modal" data-catid="{{ $_item->id }}" data-target="#delete_review" class="btn btn-sm bg-danger-light">
																							<i class="fe fe-trash"></i> حذف
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
								<!-- reviews Tab -->
								<div id="notify_tab" class="tab-pane fade">
									<div class="row">
										<div class="col-lg-12">
											<div class="card-body" >
					              <form action="{{route('one-instructor-notifaction')}}" method="POST" name="le_form" >
					                @csrf
													<div class="row form-row">	
														<div class="col-md-12 col-sm-6">
															<div class="form-group">
																<label>رسالة التنبية</label>
																<input type="hidden" name="userId" value="{{$instructor->id}}">
																<input type="text" name="message" class="form-control" >
															</div>
														</div>
													</div>	
													<div class="col-md-4 col-sm-6">	
														<button type="submit" class="btn btn-primary btn-block">ارسال </button>
													</div>
												</form>
				              </div>
										</div>
									</div>
								</div>
								<!-- banks Tab -->
								<div id="bank_tab" class="tab-pane fade">
									<div class="row">
										<div class="col-lg-12">
											<div class="card-body" style="direction:ltr">
					                    		<form action="{{route('instructor.bank.store')}}" method="POST" 
					                                name="le_form"  enctype="multipart/form-data" style="text-align: left;">
					                                @csrf
													<div class="row form-row">	
														<div class="col-md-4 col-sm-6">
															<div class="form-group">
																<label>Beneficiary Name</label>
																<input type="text" name="persone_name" class="form-control" value="{{$bankdetails->persone_name}}">
															</div>
														</div>	                	
														<div class="col-md-4 col-sm-6">
																<div class="form-group ">
																	<label>Country</label>
																	<select name="countryId" class="form-control select2-diacritics required" placeholder="Select Category" id="get_city_name">
																	<option   disabled selected>Select</option>

																	@foreach ($country as $_item)
																	   <option value="{{$_item->id}}" {{($_item->id==$bankdetails->countryId) ? 'selected' : '' }}>{{$_item->getTranslation('name','en')}}</option>
																	@endforeach
																</select>
															</div>
														</div>

														<div class="col-md-4 col-sm-6">
															<div class="form-group ">									 
															        <label>city</label>
															        <select name="cityId" class="form-control formselect"  id="get_city">
															        @foreach ($cities as $_item)
																	   <option value="{{$_item->id}}" {{($_item->id==$bankdetails->cityId) ? 'selected' : '' }}>
																	   	{{$_item->getTranslation('name','en')}}
																	   </option>
																	@endforeach
															        </select>
															</div>
														</div>

														
														
														<div class="col-md-4 col-sm-6">
															<div class="form-group">
																<label>Bank name</label>
																<input type="text" name="bank_name" class="form-control" value="{{$bankdetails->bank_name}}">
															</div>
														</div>
														<div class="col-md-4 col-sm-6">
															<div class="form-group">
																<label>Bank branch name</label>
																<input type="text" name="bank_sub_name" class="form-control" value="{{$bankdetails->bank_sub_name}}">
															</div>
														</div>
														<div class="col-md-4 col-sm-6">
															<div class="form-group">
																<label>Account Number</label>
																<input type="text" name="acount_number" class="form-control" value="{{$bankdetails->acount_number}}">
															</div>
														</div>
														
								                        <div class="col-12 col-sm-6">
															<div class="form-group">
																<label>IBAN  </label>
																<input type="text" name="iban" class="form-control" value="{{$bankdetails->iban}}">
															</div>
														</div>
														<div class="col-12 col-sm-6">
															<div class="form-group">
																<label>SWIFT code (optional)</label>
																<input type="text" name="swift_code" class="form-control" value="{{$bankdetails->swift_code}}">
															</div>
														</div>
													<!--<button type="submit" class="btn btn-primary btn-block">save change </button>-->
												</form>
				                  			</div>
										</div>
									</div>
								</div>
								<!-- /banks Tab -->

								

							</div>
						</div>
					</div>			
					</div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal fade" id="deletecourse" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">                                
                        <div class="modal-body">
                            <div class="form-content p-2">
                                <h4 class="modal-title">حذف !</h4>
                                <p class="mb-4">هل انت متأكد من حذف هذا العنصر</p>
                                <div class="row text-center">
                                <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-2">
                                        <form method="post" action="{{route('destroy-course')}}">
                                            @csrf
                                           
                                            <input type="hidden" name="id" id="cat_id">
                                            <button type="submit" class="btn btn-primary">حذف </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>  
        <div class="modal fade" id="delete_course_live" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document" >
                    <div class="modal-content">                                
                        <div class="modal-body">
                            <div class="form-content p-2">
                                <h4 class="modal-title">حذف !</h4>
                                <p class="mb-4">هل انت متأكد من حذف هذا العنصر</p>
                                <div class="row text-center">
                                <div class="col-sm-3">
                                    </div>
                                    <div class="col-sm-2">
                                        <form method="post" action="{{route('destroy-course-live')}}">
                                            @csrf
                                            <input type="hidden" name="id" id="cat_id">
                                            <button type="submit" class="btn btn-primary">حذف </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">إغلاق</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
<script>
    $('#edit_course').on('show.bs.modal', function (event) {
      	var button = $(event.relatedTarget) 
      	var name_ar = button.data('name_ar') 
      	var cat_id = button.data('catid') 
      	var modal = $(this)
      	modal.find('.modal-body #namear').val(name_ar);
      	modal.find('.modal-body #cat_id').val(cat_id);
    })
   

	 $('#deletecourse').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) 

      var cat_id = button.data('catid') 
      var modal = $(this)

      modal.find('.modal-body #cat_id').val(cat_id);
	})

	$('#delete_course_live').on('show.bs.modal', function (event) {
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