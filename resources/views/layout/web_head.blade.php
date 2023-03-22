<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كوتبانة</title>
    <link rel="stylesheet" href="{{asset('web/asset/all.css')}}">
    
    <link rel="Stylesheet" type="text/css" href="{{asset('web/asset/styles.css')}}">

@php  
    use Stichoza\GoogleTranslate\GoogleTranslate;
    
    if(session()->get('locale')){
        $tr = new GoogleTranslate(session()->get('locale')); 
        $langg=session()->get('locale');
    }else{
        $tr = new GoogleTranslate(app()->getLocale()); 
        $langg=app()->getLocale();
    }
@endphp 


@if($langg == 'ar')
    <link rel="stylesheet" href="{{asset('web/asset/bootstrap-rtl.css')}}">
    <style type="text/css">
    body {
        direction: rtl;
    }
    .dropdown-menu {
        right: 0px !important;
    }
    </style>
@else
    <link rel="stylesheet" href="{{asset('web/asset/bootstrap.css')}}">
@endif


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">