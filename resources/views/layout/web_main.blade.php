<!doctype html>
<html style="height: 100%;" lang="en">

<head>
    @include('layout.web_head')
</head>

<body>
    <header>
        @include('layout.web_header')
    </header>    

	<body>    
	<div class="container">
	    <!-- <div class="container-fluid"> -->
	    	    @yield('content')
	    <!-- </div> -->
	</div>    	
    @include('layout.web_footer')
</body>

</html>

