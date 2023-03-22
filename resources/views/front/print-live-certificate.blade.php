<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Certificate</title>

    
      <!--<link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">-->
                               
    <!--<link rel="stylesheet" href="{{asset('front/css/style-arabic.css')}}">-->
    <style>
         
      @page {
            margin: 0mm;
            margin-header: 0mm;
            margin-footer: 0mm;
        }
    
    @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');

        @font-face {
            font-family: "vivaldi";
            /*src: url("front/vivaldi.ttf");*/
            src: url("{{ URL::asset('front/img/vivaldi.ttf') }}") ;
        }
        
        body{
            direction: rtl;
    text-align: right;
    font-family: 'Tajawal', Calibri !important;
    font-size: 15px;
    color: #6f6f6f;
    font-weight: normal;
    line-height: 24px;
        }
        .certificate-section h1 {
            color: #f0ca69;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 55px;
            margin-bottom: 20px;
        }

        .certificate-section h2 {
            color: #244082;
            font-family: 'Tajawal', sans-serif;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .certificate-section h3 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            line-height: 30px;
        }

        .certificate-section .certificate-h3-ar {
            direction: rtl;
            font-size: 20px;
            margin-bottom: 0;
             line-height: 30px;
        }


        .certificate-section .certificate-name h4 {
            font-size: 28px;
            color: #222222;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .certificate-section .certificate-title {
            margin: 10px 0;
        }

        .certificate-section .certificate-title h4 {
            font-size: 28px;
            color: #222222;
            font-weight: bold;
        }

        .certificate-section h5 {
            font-size: 22px;
            font-weight: bold;
        }
            .course-details{
        margin-top: -140px;
    }
        
        .ceo-title{
            margin-top:15px;
        }

     
        .ceo-description{
            margin-top: -100px;
            margin-left: 80px;
        }

        .ceo-description hr {
            border-top: solid 2px #70948d;
            width: 80%;
            margin: 10px 0;
        }

        .ceo-description img {
            width: 50px;
        }

        .certificate-section h6 {
            font-size: 17px;
            color: #222222;
            text-align: right;
            margin-right: 100px;
            margin-bottom: 3px;
            font-weight: normal
        }

        .certificate-section h6 span {
            padding-left: 15px;
            font-weight: bold;
        }

        .ceo-description p{
            font-family: "vivaldi",sans-serif;
            text-align: left;
            font-size: 18px;
            font-weight: bold;
            color:#222222;
            margin-bottom: 5px;
        }

        .copyright p{
            color: #222222;;
            font-size: 14px;
            margin-bottom: 0;
            margin-top:35px;
            margin-bottom: 10px;
        }
        .copyright a{
            color: #244082;
            font-weight: bold;
        }
    

        
        .certificate-section {
            /*background: url("{{ URL::asset('front/certificate/Certificate.png') }}"); */
            background: url("{{ asset('front/img/certificate.png')}}");
            background-repeat: no-repeat;
            height: 100vh;
            background-size: contain;
            background-position: top center;
            text-align: center;
            padding: 10px 0;
            direction: ltr;
            margin:0;
            /*height: 100%*/
        }
        

.row{
display: flex;
}

.col-3{
    width: 25%;
}
.offset-3 {
    margin-left: 15%;
}

.col-9 {
   width: 75%;
}
    </style>

</head>

<body>

    <section class="certificate-section">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <h1>Certificate</h1>
                    <h2>شركة النمط المتقدم للتدريب</h2>
                    <h3>is proudly awarded ths certificate to:</h3>
                    <h3 class="certificate-h3-ar">أُعطيت هذه الشهادة إلى:</h3>
                </div>

                <div class="col-12 certificate-name">
                    <h4>{{$user->full_name}}</h4>
                </div>

                <div class="col-12">
                    <h3>for attending an online course entitled:</h3>
                    <h3 class="certificate-h3-ar">لحضور دورة تدريبية - عن بعد-  بعنوان:</h3>
                </div>

                <div class="col-12 certificate-title">
                    <h4>
                        {{$straight->title_ar}}
                    </h4>
                    <h4>{{$straight->title}}</h4>
                </div>
         
                <div class="col-3 offset-3">
                    <div class="row">

                        <div class="col-3 ceo-title">
                            <h5>CEO: </h5>
                        </div>

                        <div class="col-9 ceo-description">
                            <p>Khadijeh Alshishani </p>
                            <hr>
                            <img src="{{ asset('front/img/ceo.png') }}" width="60px">
                        </div>
                    </div>
                </div>

                <div class="col-6 mt-3 course-details">
                    <h6>Course Duration:
                        <span>
                            {{$straight->duration}} days
                        </span>
                    </h6>
                    <h6>Date:
                        <span>{{$straight->date}}</span>
                    </h6>
                    <h6>Certificate number:
                        <span>{{$certificate->serial_number}}</span>
                    </h6>
                </div>

                <div class="col-12 copyright">
                    <p>
                        Check the validity of the certificate from <a href="www.elnamat.com" target="_blank">www.elnamat.com</a> 
                    </p>
                </div>

            </div>
        </div>

    </section>

  
</body>

</html>