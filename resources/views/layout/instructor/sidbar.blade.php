    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <!-- <li class=" nav-item"><a href="#"><i class="la la-bolt"></i><span class="menu-title" data-i18n="nav.flot_charts.main">الرئيسية</span></a>
          <ul class="menu-content">            
            <li  class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{url('admin/dashboard')}}" data-i18n="nav.flot_charts.flot_pie_charts">الرئيسية</a>
            </li>
          </ul>
        </li> -->
       
      
        <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a href="{{url('/')}}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n="">الذهاب للموقع</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/dashboard') ? 'active' : '' }}">
            <a href="{{url('instructor/dashboard')}}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n="">الرئيسية</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/profile') ? 'active' : '' }}">
            <a href="{{url('instructor/profile')}}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n="">حسابي</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/bankdetails') ? 'active' : '' }}">
            <a href="{{url('instructor/bankdetails')}}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n="">معلومات البنك</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/western-info') ? 'active' : '' }}">
            <a href="{{url('instructor/western-info')}}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n="">معلومات Western Union</span></a>
        </li>
        
        <li class="nav-item {{ Request::is('instructor/courses') ? 'active' : '' }}">
            <a href="{{ url('instructor/courses') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> الدورات المسجلة</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/straights') ? 'active' : '' }}">
            <a href="{{ url('instructor/straights') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> الدورات الاونلاين</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/consultings') ? 'active' : '' }}">
            <a href="{{ url('instructor/consultings') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> الاستشارات </span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/curriculums') ? 'active' : '' }}">
            <a href="{{ url('instructor/curriculums') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> مواد المنهاج الاردني </span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/bills') ? 'active' : '' }}">
            <a href="{{ url('instructor/bills') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> ارباحي</span></a>
        </li>
        <li class="nav-item {{ Request::is('instructor/transfers') ? 'active' : '' }}">
            <a href="{{ url('instructor/transfers') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> تحويلات البنك</span></a>
        </li>
        <!--<li class="nav-item {{ Request::is('instructor/video_views') ? 'active' : '' }}">-->
        <!--    <a href="{{ url('instructor/video_views') }}">-->
        <!--        <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> المشاهدات</span></a>-->
        <!--</li>-->
        <li class="nav-item {{ Request::is('instructor/video_views_curriculums') ? 'active' : '' }}">
            <a href="{{ url('instructor/video_views_curriculums') }}">
                <i class="la la-envelope"></i><span class="menu-title" data-i18n=""> مشاهدات التوجيهي الاردني</span></a>
        </li>
        <!--<li  class="nav-item {{ Request::is('instructor/straights') ? 'active' : '' }}"> -->
        <!--        <a class="menu-item" href="{{ url('instructor/straights') }}" data-i18n="nav.flot_charts.flot_line_charts">الكورسات المباشرة</a>-->
        <!--</li>-->
        <!-- <li class="nav-item {{ Request::is('instructor/stories') ? 'active' : '' }}">
            <a href="{{url('instructor/stories')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">الكتب</span>
            </a>
        </li>
 -->

       <!--  <li class=" nav-item"><a href="#"><i class="la la-bolt"></i><span class="menu-title" data-i18n="nav.flot_charts.main">الكورسات</span></a>
          <ul class="menu-content">
            <li  class="{{ Request::is('instructor/courses') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{ url('instructor/courses') }}" data-i18n="nav.flot_charts.flot_line_charts">الكورسات</a>
            </li>
          
          </ul>
        </li> -->
        
        <!--<li class=" nav-item"><a href="#"><i class="la la-bolt"></i><span class="menu-title" data-i18n="nav.flot_charts.main">الكورسات المباشرة</span></a>-->
        <!--  <ul class="menu-content">-->
        <!--    <li  class="{{ Request::is('instructor/straights') ? 'active' : '' }}"> -->
        <!--        <a class="menu-item" href="{{ url('instructor/straights') }}" data-i18n="nav.flot_charts.flot_line_charts">الكورسات المباشرة</a>-->
        <!--    </li>-->
           
            
        <!--  </ul>-->
        <!--</li>-->
        
        
        
        
       
        <li class="nav-item {{ Request::is('instructor/agreements') ? 'active' : '' }}">
            <a href="{{url('instructor/agreements')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">اتفاقية المدرب</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('instructor/terms/conditions') ? 'active' : '' }}">
            <a href="{{url('instructor/terms/conditions')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">إرشادات المدرب</span>
            </a>
        </li>
        <li class="nav-item {{ Request::is('instructor/instructional-video') ? 'active' : '' }}">
            <a href="{{url('instructor/instructional-video')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n=""> فيديوهات إرشادية</span>
            </a>
        </li>

        <!-- <li class="nav-item {{ Request::is('instructor/report/sales') ? 'active' : '' }}">
            <a href="{{url('instructor/report/sales')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">تقرير المبيعات</span>
            </a>
        </li>
         <li class="nav-item {{ Request::is('instructor/report/transfers') ? 'active' : '' }}">
            <a href="{{url('instructor/report/transfers')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">تقرير التحويلات</span>
            </a>
        </li>
         <li class="nav-item {{ Request::is('instructor/report/statistics') ? 'active' : '' }}">
            <a href="{{url('instructor/report/statistics')}}">
                <i class="la la-envelope"></i>
                <span class="menu-title" data-i18n="">الإحصائيات</span>
            </a>
        </li> -->
        
        


       
        
        
      </ul>
    </div>
  </div>