<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	
	<!-- internet explorer meta -->
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<!-- first mobile responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="{{ asset('email/css/bootstrap.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('email/css/email.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('email/css/font-awesome.min.css') }}" type="text/css">
<style>
	body{
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 14px;
		line-height: 1.42857143;
		color: #333;
		background-color: #fff;
		margin: 0;
	}
	.text-center {
    text-align: center;
}
img {
    vertical-align: middle;
}
img {
    border: 0;
}
.container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.center-block {
    display: block;
    margin-right: auto;
    margin-left: auto;
}
p {
    margin: 0 0 10px;
}
a {
    background-color: transparent;
}
a {
    color: #337ab7;
    text-decoration: none;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1;
    color: inherit;
}
h4, .h4, h5, .h5, h6, .h6 {
    margin-top: 10px;
    margin-bottom: 10px;
}
h6, .h6 {
    font-size: 12px;
}
.img-responsive, .thumbnail > img, .thumbnail a > img, .carousel-inner > .item > img, .carousel-inner > .item > a > img {
    display: block;
    max-width: 100%;
    height: auto;
}


	.email-total
{
  background-color:#F4F5F4;
 

 
}
.email-head
{
  /*background:url(images/background.png) no-repeat center center ;*/
  width:500px;
  height:300px;
  background-color:dodgerblue;
  margin:auto;
 margin-top:10px;

 }
.email-head img[alt="logo"]
{
	max-width:100px;
	padding-top:30px;
}
.email-head img[alt="capture"]
{
	max-width:200px;
	padding-top:90px;
}
.email-body
{
	width:450px;
	height:300px;
	background-color:#FFF;
	border-radius:6px;
	margin:auto;
	margin-top:-40px;
}
.email-body h6
{
	padding-top:10px;
}

.social
{
	margin:auto;
	padding-bottom:10px;
	
}
.social ul
{
	overflow:hidden;
	margin-left:400px;
	padding-top:30px;
}

.social ul li
{
	float:left;
	margin-right:5px;
	opacity:.7;
	
}
.social ul li i
{
	color:grey;
}
.foooter
{
width:500px;
height:70px;
background-color:dodgerblue;
margin:auto;
margin-top:10px;
}
.foooter ul
{

}
.foooter ul li
{  
	float:left;
	margin-right:-5px;
	text-indent:5px;
	direction:rtl;
	overflow:hidden;
	width:33.3333%;
	float:left;
	padding-top:5px;

}

.foooter ul li a
{
	text-decoration:none;
	color:#fff;

}
.foooter ul li i
{
	color:#A6B06B
}
.location
{

	margin-top:-10px;
	padding-bottom:10px;
}
.location i
{

	direction:rtl;
	color:#A6B06B;
	float:left;
	margin-left:10px;
}
.location i span
{
	color:#FFF;

}
.website
{
	padding-top:60px;

}
.website p
{

	letter-spacing:2px;
}
.website p span
{
	color:dodgerblue;
}
</style>
</head>
<body>
	
<div class="email-total text-center">
  <div class="container">
  <div class="email-head">
      <img  style=" width:500px;
	  height:300px;"  src="{{ asset('email/images/background.png') }}" alt="">
  	<!--<img class="img-responsive center-block" src="{{ asset('email/images/logo.png') }}" alt="logo">-->
  	<!--  	<img class="img-responsive center-block" src="{{ asset('email/images/capture.png') }}" alt="capture">-->
  	</div>
  	<div class="email-body">
  		<h6>نحن سعداء برؤيتكم بيننا</h6>
  		<p class="text-center">
  		    ستكون أول من يسمع عن عروضنا الخاصة وأحدث العروض الترويجية. نأمل أن تستمتع بالتسوق على .</p>
  	 <a href="https://www.maojod.com/"> maojod.com</a>
  		<h6>
			رابط تفعيل حسابك</h6>
  
  	<a href="{{ url('user/activation', $link)}}">{{ url('user/activation', $link)}}</a>
  	<p class="text-center">تم إرسال هذه الرسالة الإلكترونية إليك بناءً على طلبك بأنشاء حساب لدى .  </p>
<a href="https://www.maojod.com/"> maojod.com</a>
 <br>

   	<a href="{{ url('user/activation', $link)}}">برجاء بالضغط هنا لتفعيل الحساب  </a>
  	{{-- <p class="text-center"> please note, if you didn't sign up for membership , please inform us via </p>
  	<a href="##">link</a> --}}
  	<h6>شكرا لك </h6>

  	</div>
  		<!-- start social -->
  	<div class="social">		
   <ul class="list-unstyled">
{{-- <li><a href=""> <i class="fa fa-google-plus"></i></a></li> --}}
<li><a href="https://twitter.com/MaojodC"> <i class="fa fa-twitter"></i></a></li>
<li><a href="https://www.instagram.com/maojodcom/"> <i class="fa fa-instagram"></i></a></li>
<li><a href="https://www.facebook.com/Maojodcom-103303251077384/"> <i class="fa fa-facebook"></i></a></li>
{{-- <li><a href="#"> <i class="fa fa-youtube"></i></a></li> --}}

   </ul>
  	</div>
  	<!-- end social -->
  <div class="foooter text-center">
  	<ul class="list-unstyled">
  	<li><a href="#"><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>{{$semail}}</a></li>

  	<li><a href="#"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>{{$sphone}}</a></li>
  	
  	<li class="text-right"><a href="#"><i class="fa fa-headphones fa-3x" aria-hidden="true"></i>اتصل بنا</a></li>
  	</ul>
  	<div class="location text-center">
<i class="fa fa-map-marker fa-lg" aria-hidden="true"><span>{{$saddress}}</span></i>

  	</div>
  	<div class="website text-center">
  		<p> www<span>.maojod.</span>com </p>
  	</div>
  	
  </div>
</div>

	


<!-- libraries-->
        <script src="{{ asset('email/js/html5shiv.min.js')}}"></script>
		<script src="{{ asset('email/js/respond.min.js')}}"></script>
		<script src="{{ asset('email/js/jquery-3.3.1.min.js')}}"></script>
		<script src="{{ asset('email/js/bootstrap.js')}}"></script>
<!-- libraries-->
</body>
</html>