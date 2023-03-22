<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
<style>
    body {
    background: #ccc;
        direction: rtl;
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 20px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>    
    <body>
        
       <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{asset('assets_admin/img/travel/'.$user->personal_photo) }}">
                <span class="font-weight-bold">{{$user->name}}</span><span class="text-black-50">{{$user->email}}</span><span> </span>
                </div>
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="{{asset('assets_admin/img/travel/'.$user->passport_photo) }}">
                <span class="font-weight-bold">صورة جواز السفر</span><span class="text-black-50"></span><span> </span>
            </div>

        </div>
        <div class="col-md-8 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">بيانات التأشيرة</h4>
                </div>
                <!--<form class="form-horizontal form-simple"  novalidate method="POST" action="{{route('travel-user-data')}}" enctype="multipart/form-data">-->
                <!--       				 @csrf-->
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">الاسم :</label> {{$user->name}}</div>
                        <div class="col-md-6"><label class="labels">البريد الالكتروني : </label>{{$user->email}} </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">رقم الموبايل :</label>{{$user->mobile}}</div>
                        <div class="col-md-6"><label class="labels">نوع التأشيرة: </label>{{$user->type}} </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">تاريخ الوصول :</label>{{$user->departure_date}}</div>
                        <div class="col-md-6"><label class="labels">تاريخ المغادرة : </label>{{$user->departure_date}} </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">المهن  :</label>{{$user->profession}}</div>
                        <div class="col-md-6"><label class="labels"> نوع الغرفة : </label>{{$user->room_type}} </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">تاريخ الوصول :</label>{{$user->departure_date}}</div>
                        <div class="col-md-6"><label class="labels">تاريخ المغادرة : </label>{{$user->departure_date}} </div>
                    </div>
                    <!-- <div class="row mt-2">-->
                    <!--    <div class="col-md-6"><label class="labels">Name</label><input type="text" class="form-control" placeholder="first name" value=""></div>-->
                    <!--    <div class="col-md-6"><label class="labels">Surname</label><input type="text" class="form-control" value="" placeholder="surname"></div>-->
                    <!--</div>-->
                    
                    <div class="mt-5 text-center"><a href="{{url('travel-user-done/'. $user->id)}}" ><button  class="btn btn-primary profile-button">التالي </button></a></div>
                    <br>
                    @if(session()->has('message'))
                      @include('admin.includes.alerts.success')
                    @endif
                    <!--<div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>-->
                <!--</form>-->
            </div>
        </div>
       
    </div>
</div>
</div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </body>
</html>
