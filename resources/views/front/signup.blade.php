
    @extends('layout.front_main')
@section('content') 



    <section class="form-section">
        <div class="container">
            <!-- <div class="row justify-content-center">

                <div class="col-md-4">
                    <h6> {{__('front.sign up and start learning')}}</h6>
                    <hr>
                    <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" >dgbg</button>    
                </div>
            </div> -->
            <!-- <div class="row justify-content-center" >
                <div class="col-md-6" style="border:1px solid #ebe9e9 ;padding: 30px">
                    <h6>اختر نوع الاشتراك</h6>
                    <p>الاشتراك بمنصة النمط يؤهلك بحضور جميع الدورات المنشورة على المنصة والتي يتم اضافتها بأي وقت ومن أي مكان بالعالم وبلا حدود  وتستطيع الغاء الاشتراك بأي وقت</p>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" >الاشتراك الشهرى 7 دولار</button>
                        </div>    
                        <div class="col-md-6"> 
                            <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" >الاشتراك الشهرى 70 دولار</button> 
                        </div>
                    </div>
                    <hr>
                     <br>
                    <h6>إنضمام  المدرب</h6>
                   
                     <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" >إنضم إلينا كمدرب</button>
                        </div>    
                        
                    </div>
                </div>
            </div>
             <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
 -->




            <div class="row justify-content-center" >
                <div class="col-md-6" style="border:1px solid #ebe9e9 ;padding: 30px">
                    <!--<h6> إشتراك المستخدم (المتدرب) </h6>-->
                    <!--<p>سوف يتم تفعيل خدمة الاشتراك بالمنصة قريباً</p>-->
                    
                    <p>الاشتراك بمنصة النمط يؤهلك لحضور جميع الدورات المنشورة على المنصة والتي يتم اضافتها بأي وقت ومن أي مكان بالعالم وبلا حدود  وتستطيع الغاء الاشتراك بأي وقت.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{url('student-signup')}}">
                            <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit">إشتراك المتدرب</button>
                            </a>
                        </div> 
                        
                       <!--  <div class="col-md-6"> 
                            <a href="{{url('student-signup')}}">
                                <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" > الاشتراك السنوي 70 دولار</button> 
                            </a>
                        </div> -->
                    </div>
                </div>
               
            </div>
            </br></br>
             <div class="row justify-content-center" >
                 <div class="col-md-6" style="border:1px solid #ebe9e9 ;padding: 30px">
                     <!--<h6>إشتراك المدرب</h6>-->
                    <p>هذا الاشتراك يتيح لك فقط أن تنشر  الدورات الخاصة بك على المنصة واتاحة مشاهدتها للمشتركين بالمنصة بمقابل عائد بمقدار 60%  من الارباح حسب عدد دقائق   المشاهدات على الدورات الخاصة بك كمدرب.</p>                   
                     <div class="row">
                        <div class="col-md-6">
                            <a href="{{url('instructor-signup')}}">
                            <button type="submit" class="w-100 btn header-btn text-large font-weight-bold mb-4" id="agreem_submit" >إنضم إلينا كمدرب</button></a>
                        </div>    
                        
                    </div>
                </div>    
            </div>
             <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        </div>
    </section>
   
   
@endsection
