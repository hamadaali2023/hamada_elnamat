@extends('layout.front_main')
@section('content') 
 <!-- start slider section -->
   <!-- Latest compiled and minified CSS -->
 <article class="slider">
        @foreach ($sliders as $_item)
        <section class="slide">
            <img   src="{{asset('assets_admin/img/sliders/'.$_item->image) }}" alt="" style="">
            <div class="slide-content">
                <h2 class="slide-title">{{ $_item->title }}</h2>
                <p>
                    {{ $_item->description }}                   
                    <br>
                    <!-- Lorem Ipsum has been the industry's. -->
                </p>
            </div>

        </section>
        @endforeach
      
        <nav class="slider-nav">
            <span class="prev-slide"></span>
            <span class="next-slide"></span>
        </nav>
    </article>
    


    <section class="home-page-section home-page-section1">
        <div class="container">
            <div class="row justify-content-center">
                    <div class="col-md-5">
                        <a href="#">
                            <img src="{{asset('front/img/home-img1.png')}}" class="img-thumbnail">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h2>منصة تعليمية رقمية للتدريب عن بعد على مستوى الوطن العربي </h2>
                        <h6>
                            نوفّر لك الخدمات التالية:
                        </h6>
                        <ol>
                            <li>مشاهدة الدورات المسجلة الجاهزة</li>
                            <li>حضور الدورات الاونلاين </li>
                            <li>استشارات</li>
                            <li>شهادات معتمدة</li>
                            <li>الانضمام الى فريق المدربين</li>
                            <li>شرح دروس التوجيهي الأردني</li>
                        </ol>
                    </div>
                </div>


            </div>
        </div>


    </section>

    <section class="home-page-section home-page-section2">
    
        <div class="container">
            <div class="row flex-row-reverse justify-content-center">
    
    
                <div class="col-md-5">
                    <a href="{{url('courses')}}">
                        <img src="{{asset('front/img/home-img2.png')}}" class="img-thumbnail">
                    </a>
    
                </div>
    
    
                <div class="col-md-6">
                    <h2>مكتبة تحتوي على مئات من الدورات المسجلة الجاهزة على شكل مقاطع فيديو </h2>
                    <h6>
                        للاشتراك بها :
                    </h6>
                    <p>
                        إذا كان لديك حساب معنا قم بتسجيل الدخول وإذا لم يكن لديك حساب قم بإنشاء حساب جديد
                    </p>
    
                    <ol>
                        <li>قم بتسجيل الدخول الى حسابك </li>
                        <li>اضغط على لوحة التحكم </li>
                        <li>اضغط على (اشتراك جديد / تجديد الاشتراك)</li>
                    </ol>
                </div>
    
    
    
            </div>
    
    
        </div>
        </div>
    
    
    </section>

    <section class="home-page-section home-page-section1">
    
        <div class="container">
            <div class="row justify-content-center">
    
    
                <div class="col-md-5">
                    <a href="{{url('lives-courses')}}">
                        <img src="{{asset('front/img/home-img3.png')}}" class="img-thumbnail">
                    </a>
    
                </div>
    
    
                <div class="col-md-6">
                    <h2>هي الدورات التفاعلية التي تتم مباشرة مع المدرب بشكل متزامن</h2>
                    <h6>
                        للتسجيل فيها:
                    </h6>
    
                    <p>
                        إذا كان لديك حساب معنا قم بتسجيل الدخول وإذا لم يكن لديك حساب قم بإنشاء حساب جديد
                    </p>
    
                    <ol>
                        <li>قم بتسجيل الدخول الى حسابك </li>
                        <li>اضغط على الدورات الاونلاين </li>
                        <li>سجّل بالدورة التي تريدها</li>
                    </ol>
                    <p class="note-paragraph">
                        قبل موعد الدورة بعشرة دقائق احصل على رابط الدخول من لوحة التحكم من قسم دوراتي الاونلاين
                    </p>
                </div>
    
    
    
            </div>
    
    
        </div>
        </div>
    
    
    </section>
   
    <section class="home-page-section home-page-section2">
    
        <div class="container">
            <div class="row flex-row-reverse justify-content-center">
    
    
                <div class="col-md-5">
                    <a href="#">
                        <img src="{{asset('front/img/home-img4.png')}}" class="img-thumbnail">
                    </a>
    
                </div>
    
    
                <div class="col-md-6">
                    <h2>
                        يمكنك الحصول على شهادة رقمية معتمدة من منصة النمط لجميع الدورات التي حضرتها سواءً الدورات المسجلة أو الدورات الاونلاين
                    </h2>
                    <h6>
                        للحصول على الشهادة :
                    </h6>
    
    
                    <ol>
                        <li>اضغط على لوحة التحكم </li>
                        <li>اضغط على شهادات الدورات المسجلة أو اضغط على شهادات الدورات الاونلاين </li>
                        <li>تسديد رسوم الشهادة </li>
                        <li>قم بالرجوع الى لوحة التحكم بقسم الشهادات وحمًل الشهادة على جهازك فوراً </li>
                    </ol>
                </div>
    
    
    
            </div>
    
    
        </div>
        </div>
    
    
    </section>

    <section class="home-page-section home-page-section1">
    
        <div class="container">
            <div class="row justify-content-center">
    
    
                <div class="col-md-5">
                    <a href="{{url('consultings')}}">
                        <img src="{{asset('front/img/home-img5.png')}}" class="img-thumbnail">
                    </a>
    
                </div>
    
    
                <div class="col-md-6">
                    <h2>تستطيع حجز موعد خاص مع المدرب الخبير</h2>
                    <h6>
                        من أجل أن تحصل على الاستشارة:
                    </h6>
    
                    <p>
                        إذا كان لديك حساب معنا قم بتسجيل الدخول وإذا لم يكن لديك حساب قم بإنشاء حساب جديد
                    </p>
    
                    <ol>
                        <li>اضغط على الاستشارات </li>
                        <li>اختر المدرب</li>
                        <li>احجز الموعد </li>
                    </ol>
    
                </div>
    
    
    
            </div>
    
    
        </div>
        </div>
    
    
    </section>

    <section class="home-page-section home-page-section2">
    
        <div class="container">
            <div class="row flex-row-reverse justify-content-center">
    
    
                <div class="col-md-5">
                    <a href="{{url('instructor-signup')}}">
                        <img src="{{asset('front/img/home-img6.png')}}" class="img-thumbnail">
                    </a>
    
                </div>
    
    
                <div class="col-md-6">
                    <h2>
                        تستطيع أن تنضم الى فريق المدربين وتقدم دورات مسجلة ودورات اونلاين واستشارات
                    </h2>
                    <p>
                        إذا كان لديك حساب معنا قم بتسجيل الدخول وإذا لم يكن لديك حساب قم بإنشاء حساب جديد بالضغط على (انضم الينا مع فريق المدربين
                        من أسفل الشاشة الرئيسية)
                    </p>
    
    
                    <ol>
                        <li>اضغط على لوحة التحكم </li>
                        <li>اقرأ الارشادات وشاهد الفيديوهات الارشادية</li>
                        <li>ابدأ العمل فوراً فنحن نوفر لك الخدمة الذاتية </li>
                    </ol>
                </div>
    
    
    
            </div>
    
    
        </div>
        </div>
    
    
    </section>






@endsection


