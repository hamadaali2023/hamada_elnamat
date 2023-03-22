

<!doctype html>
<html class="no-js" lang="en">

<head>
    @include('layout.front_head')
</head>


    <section class="form-section">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <h6>إكمال البيانات المطلوبة</h6>
                    <hr>

                    
                    @if(session()->has('message'))
                        @include('admin.includes.alerts.success')
                    @endif

                    @if(Session::has('errorss'))                                
                        <span class="text-danger">{{Session::get('errorss')}}</span>
                    @endif 
                    
                  
						@if(session()->has('message'))
				                @include('admin.includes.alerts.success')
				            @endif

				            @if(Session::has('errorss'))				              	
				               <span class="text-danger">{{Session::get('errorss')}}</span>
				            @endif 
				            <br><br>
							<form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('travel-user-data')}}" enctype="multipart/form-data">
                       				 @csrf
								<input type="hidden" name="token" value="{{ $token }}">
							<div class="row col-md-12 ">	
								<div class="form-group col-md-6">
									<div  >
										<label for="email">تاريخ الوصول</label>
										<input  type="date" class="form-control" name="arrival_date"  >										
							    	</div>
							    	@error('arrival_date')
			                                <strong>{{ $message }}</strong>
			                        @enderror
								</div>
								<div class="form-group col-md-6">
									<div  >
										<label for="email">تاريخ المغادرة</label>
										<input  type="date" class="form-control" name="departure_date"  >										
							    	</div>
								</div>
								
								<div class="form-group col-md-6">
									<div  >
										<label for="email">المهنة</label>
										<input  type="text" class="form-control" name="profession" >										
							    	</div>
								</div>
								<div class="form-group col-md-6">
									<div  >
										<label for="email">نوع الغرفة</label>
										<input  type="text" class="form-control" name="room_type"  >										
							    	</div>
								</div>
								
								<div class="form-group col-md-6">
                                    <!--<i class=" icon"></i>-->
                                    <label for="email">اختر نوع التأشيرة</label>
                                    <select name="type" class="form-control">
                                        <option  disabled selected>اختر نوع التأشيرة</option>  
                                        
                                        <option value="السياحة">
                                            السياحة
                                        </option>
                                        <option value="العمرة">
                                            العمرة
                                        </option>
                                        <option value="العمل">
                                            العمل
                                        </option>
                                    </select>
                                </div>
								<div class="form-group col-md-6">
									<div  >
										<label for="email">صورة شخصية</label>
										<input  type="file" class="form-control" name="personal_photo"  >										
							    	</div>
								</div>
								<div class="form-group col-md-6">
									<div  >
										<label for="email">صورة الجواز</label>
										<input  type="file" class="form-control" name="passport_photo"  >										
							    	</div>
								</div>
							</div>	
								

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">التالي </button>
								</div>
								
							</form>







                </div>





            </div>
        </div>
    </section>
    <!-- end login -->


    <style>
        .form-section .form-control {
   
             padding: 11px 20px 12px 40px; 
          
        }
    </style>
</body>

</html>