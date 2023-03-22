<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
       
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <h4 class="text-center">Autocomplete Search Box with <br> Laravel + Ajax + jQuery</h4><hr>
                    <div class="form-group">
                        <label>Type a country name</label>
                        <input type="text" name="country" id="country" placeholder="Enter country name" class="form-control">
                    </div>
                    <div id="country_list"></div>                    
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#country').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                        url:"{{ route('searchbook') }}",
                        type:"GET",
                        data:{'country':query},
                        success:function (data) {
                            $('#country_list').html(data);
                        }
                    })
                });

                
            });
        </script>
    </body>
</html>  

