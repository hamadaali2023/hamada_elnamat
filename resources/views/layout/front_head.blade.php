 @php  
    
    if(session()->get('locale')){
        $langg=session()->get('locale');
    }else{
        $langg=app()->getLocale();
    }
@endphp 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
    
    
    <!-- title -->
    <title>منصة النمط هي منصة تعليمية للتدريب عن بعد من كافة دول العالم</title>
  
    <!-- meta tags -->
    <meta name="author" content="منصة النمط ">
    <meta name="description" content="منصة النمط هي منصة تعليمية للتدريب عن بعد من كافة دول العالم ">
    <meta name="keywords" content="تنمية بشرية، التنمية البشرية، الصحة النفسية، الاستثمار وتحقيق الارباح، علم النفس، ادارة، علوم، لغات، التصوير والفيديو، الفن والهوايات، فن التصوير الرقمي، المهارات الرقمية، تنمية الشخصية، تنمية المهارات، الرجيم، تخسيس الوزن، الصحة والغذاء، الصحة والتغذية، نظام الغذاء المتوازن، دورات تدريبية، دورات تعليمية، دورات اون لاين ، دورات اونلاين، دورات رسم، مواهب وهوايات، برمجة وتطوير، تصميم، التصميم الرقمي، الاستثمار وتحقيق الارباح، زيادة الدخل، الربح من النت، الربح من الانترنت، العمل من المنزل، العمل الحر، تنمية القدرات الشخصية، كمبيوتر، موبايل، صيانة الجوال، التواصل الاجتماعي، مهارات التواصل الاجتماعي، مهارات الحاسب الالي، ديكور داخلي، تصميم داخلي، لغات، علوم، تعليم لغات، تعليم اللغة الانجليزية، الصحة النفسية، الصحة والسعادة، رجيم، تخسيس الوزن، الغذاء المتوازن، مواهب وهوايات، الرسم، فن الرسم، الرسم الرقمي، النحت، رحلات وصيد، من الشغف الى الهدف، حسني المستريحي، التفكير السلبي، الذكاء العاطفي، ريادة الاعمال، المشاريع، ادارة المشاريع، المشاريع الاستثمارية، كيف تربح المال، العلاج النفسي، العلاج المعرفي، العلاج السلوكي، تنمية بشرية، التنمية البشرية، تنمية المهارات، مهارات النجاح، مهارات سوق العمل، طلاب، تعليم، تدريب، تدرب، تعلم، تدريب المدربين، اعداد المعلمين، شهادات معتمدة، شهادات حضور، شهادات انجاز,منصة النمط">
    <meta property="og:url" content="https://elnamat.com/" />
    <meta property="og:image" content="	https://elnamat.com/assets_admin/img/settings/1659165683.png" /> 






  
    <link rel="shortcut icon" href="{{asset('assets_admin/img/settings/'.$contact->favicon) }}">



    <!-- font-awesome icon -->
    <link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}" />

    <!-- swiper carousel -->
    <link rel="stylesheet" href="{{asset('front/css/swiper.min.css')}}">

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{asset('front/css/bootsnav.css')}}">

    <!-- style -->
   
    @if($langg == 'ar')
    <link 
  rel="stylesheet"
  href="https://cdn.rtlcss.com/bootstrap/v4.3.1/css/bootstrap.min.css"
  integrity="sha384-LobEUEN+vN9RjeqoGV210e9rydU8P3KMTgX9FKxalf0zavDGgINz6K+iXoTLpNFA"
  crossorigin="anonymous" />
        <link rel="stylesheet" href="{{asset('front/css/style-arabic.css')}}" />
    @else
        <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('front/css/style-english.css')}}" />
    @endif

    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset('front/css/responsive-style.css')}}" />

    
    
     <!-- Data table -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
    
 

