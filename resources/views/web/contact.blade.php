@extends('layout.web_main')
@section('content')
    <main class="mt-5 pt-5" id="cart">
        <div class="containerwow fadeIn">
            <!-- Heading -->
            <h3 class="my-5 h3 text-center">البلاغ</h3>
            <!--Grid row-->
            <div class="row">
                <div class="col-md-8 mb-4">
                    <!--Card-->
                    <div class="card">
                        <form id="payment-form" action="addContactUs.php" accept-charset="UTF-8" method="POST" class="card-body text-right">
                            <div id="card-element" dir="rtl">
                                <div class="form-group">
									<label for="name">الاسم</label>
									<input id="name" type="text" class="form-control" name="name" required="" autofocus="">
									<div class="invalid-feedback">
										الرجاء ادخال الاسم
									</div>
								</div>
                                <div class="field-row my-4" dir="rtl">
                                    <label>الايميل</label> <span id="email-info" class="info"></span><br>
                                    <input type="email" id="email" class="form-control" name="email" required="">
                                </div>
                                <div class="form-group">
									<label for="phone"> نوع البلاغ </label>
                                    <select name="cars" id="cars" class="form-control" required="">	
                                        <option value="" disabled="disabled" selected="selected"> الرجاء الاختيار </option>
                                        <option value="general"> بلاغ عام </option>
                                        <option value="refound">استرجاع اموال </option>
                                        <option value="privacy"> انتهاك الحقوق الفكرية </option>
                                    </select>
                                    <div class="error"></div>
									<div class="invalid-feedback">
										الرجاء ادخال نوع البلاغ
									</div>
								</div>
                                <div class="form-group">
									<label for="view"> تعليق </label>
									<textarea id="view" type="text" class="form-control" name="view" required=""></textarea>
									<div class="invalid-feedback">
										الرجاء ادخال تعليق
									</div>
								</div> 
                                <div>
                                    <button type="submit" class="btn btn-primary form-control my-4" id="buttontn"> ارسال </button>
                                        <div class="modal fade" id="myModal" role="dialog">
    										<div class="modal-dialog">
      										    <!-- Modal content-->
       											<div class="modal-content">
            										<div class="modal-header">
               											<button type="button" class="close" data-dismiss="modal">×</button>
               											<h4 class="modal-title">  </h4>
            										</div>
            									    <div class="modal-body">  شكرا لثقتكم </div>
            									    <div class="modal-footer">
                								   		<button type="button" class="btn btn-success" data-dismiss="modal"> المزيد من الكتب</button>
            								    	</div>
        									    </div>
    									    </div>
										</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--/.Card-->

                </div>
                <!--Grid column-->
                <div class="col-md-4 mb-4" dir="rtl">

                    <!-- Heading -->
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">الاتصال بنا</span>
                        
                    </h4>
                    <ul class="list-group mb-3 z-depth-1">
                        <li class="list-group-item d-flex justify-content-between">
                            <span> <i class="fas fa-globe-europe"> admin@kutuphanah.com  </i></span>
                            
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <i class="fa fa-phone"> 009 054 438 073 88 </i>                            
                        </li>
                    </ul>
                    <!-- Cart -->
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->
        </div>
    </main>
@endsection