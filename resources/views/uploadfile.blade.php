<head>
  <title>Laravel Image Upload Using Ajax - W3Adda</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
  
  <div class="container">
    <h3 class="jumbotron">Laravel Image Upload Using Ajax - W3Adda</h3>
  <form method="post" id="FrmImgUpload" action="javascript:void(0)" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
          <input type="file" name="profile_image" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
          <button type="submit" class="btn btn-success" style="margin-top:10px">Upload Image</button>
          </div>
        </div>
        

       <div class="col-md-8 ">
                                  <div class="form-group">
                                    <div class="progress prog1">
                                      <div class="progress-bar prog-bar1 progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                  </div>
                                </div> 

       <div class="row">
         <div class="col-md-8">
              <strong>Original Image:</strong>
              <br/>
              <p id="dataaaa"></p>
              <img  src="" />
              <video controls="controls" id="ImgOri" width="400">
                        <source  src="" type="video/mp4">
                    </video> 
        </div>
        
   </div>
  </form>
  </div>
</body>
</html>
 
<script>
 
$(document).ready(function (e) {
 
  $('#FrmImgUpload').on('submit',(function(e) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
           type:'POST',
           url: "{{url('ajax-image-upload')}}",
           data:formData,
           cache:false,
           contentType: false,
           processData: false,
           success:function(data){
               $('#ImgOri').attr('src', "/uploads/"+ data.name);
           },
           error: function(data){
               console.log(data);
         }
      });
  }));
 
});
 
</script>