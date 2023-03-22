<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<!-- internet explorer meta -->
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<!-- first mobile responsive-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="css/offer.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
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
  background:url(../images/background.png) no-repeat center center ;
  width:450px;
  height:300px;
  background-color:dodgreblue;
  margin:auto;
 margin-top:10px;

 }
.email-head img[alt="logo"]
{
	max-width:100px;
	padding-top:30px;
}
.email-head hr
{
	max-width:100px;
}
.email-head img[alt="offer"]
{
	max-width:100px;
	
}

 .three
{
	overflow:hidden;
	z-index:3;
	margin:auto;
	width:320px;
	margin-top:-100px;
}
 .three li
{
  width:33.3333%;
  float:left;
  z-index:3;
  margin:auto;
  margin-bottom:5px;

}
 .three li img
{
	max-width:100px;
	max-height:200px;
	

}
.email-body
{
	width:420px;
	height:600px;
	background-color:#FFF;
	border-radius:6px;
	margin:auto;
	margin-top:-200px;
	z-index:1;
}
.email-body .bordere 
{
	padding-top:210px;
	margin-bottom:-100px;

}
.email-body .bordere button
{
	border-radius:6px;
	border:1px solid dodgerblue;
	background-color:dodgerblue;
}
.email-body p.one
{
	margin-top:110px;
}
.email-body p.two
{
	margin-bottom:30px;
}
.email-body .firstt
{
	padding-top:200px;
}
.email-body h6
{
margin-top:-140px;
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

	
}
.social ul li i
{
	color:grey;
}
.social .rectangle img[alt="rectangle"]
{
   margin-left:230px;
   margin-top:-50px;
   position:static;
}

.social .rectangle img[alt="object"]
{
	 margin-top:-50px;
	 margin-right:100px;
}

.foooter
{
width:500px;
height:70px;
background-color:dodgerblue;
margin:auto;
margin-top:10px;
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
	  height:300px;"  src="{{ asset('email/images/background1.png') }}" alt="">
  	<!--<img class="img-responsive center-block" src="images/logo.png" alt="logo">-->
   <!-- <hr>-->
  	<!--  	<img class="img-responsive center-block" src="images/offer.png" alt="offer">-->
  	</div>
     <div class="three">
        <ul class="list-unstyled">
            @foreach($products_sell_more as $products_sell)
            @if(isset($products_sell->product_image[0]))
             <li><img width="100px" height="200px" src="{{ url('upload/product/'.$products_sell->product_image[0]->image) }}" alt="blank"></li>
             @endif
            @endforeach
      
        </ul>
      </div>
  	<div class="email-body">
     <div class="bordere">
 <button type="button" id="myButton" class="btn btn-primary">عروض اليوم</button> </div>
  		<p class="one">{{$bodyMessage}}</p>
  		<!--<p class="two">you will be the first to hear about our special offers and latest promotions. We hope you enjoy shopping on maojod.eg</p>-->
  		<!--<h5>Activation link</h5>-->
  	<!--<p>This e-mail has been sent to you on your request to subscribe to our newsletter when you registered to maojod.eg please click on the link if you wish to unsubscribe from the list</p>-->
  	<!--<a href="#">please click here to read our privacy policy </a>-->
  	<!--<p> please note,if you didn't sign up for membership,please inform us via </p>-->
  	<!--<a href="##">link</a>-->
  	<h4>thank you</h4>
  	</div>
  		<!-- start social -->
  	<div class="social ">		
   <ul class="list-unstyled">
{{-- <li><a href=""> <i class="fa fa-google-plus"></i></a></li> --}}
<li><a href="https://twitter.com/MaojodC"> <i class="fa fa-twitter"></i></a></li>
<li><a href="https://www.instagram.com/maojodcom/"> <i class="fa fa-instagram"></i></a></li>
<li><a href="https://www.facebook.com/Maojodcom-103303251077384/"> <i class="fa fa-facebook"></i></a></li>
{{-- <li><a href="#"> <i class="fa fa-youtube"></i></a></li> --}}

   </ul>
   <div class="rectangle">
    <img src="{{ asset('email/images/rectangle.png')}}" alt="rectangle">
  
  </div>
  	</div>
  	<!-- end social -->
  <div class="foooter text-center">
  	<ul class="list-unstyled">
  	<li><a href="#"><i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>info@maojod.com</a></li>

  	<li><a href="#"><i class="fa fa-phone fa-lg" aria-hidden="true"></i>01015042714</a></li>
  	
  	<li class="text-right"><a href="#"><i class="fa fa-headphones fa-3x" aria-hidden="true"></i>اتصل بنا</a></li>
  	</ul>
  	<div class="location text-center">
<i class="fa fa-map-marker fa-lg" aria-hidden="true"><span>طرابلس وليبياوشارع الشط ص box 1105,tripoli,liby</span></i>

  	</div>
  	<div class="website text-center">
  		<p> www<span>.maojod.</span>com </p>
  	</div>
  	
  </div>
</div>

	


<!-- libraries-->
        <script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
<!-- libraries-->
</body>
</html>