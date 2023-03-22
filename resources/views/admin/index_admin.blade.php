
@extends('layout.admin_main')
@section('content') 		
<div id="crypto-stats-3" class="row">
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/courses')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">B</h1></a>
                    </div>
                    <div class="col-7 pl-2">
                        <a href="{{url('admin/courses')}}">
                            <h4>الدورات المسجلة</h4>
                            <h6 class="text-muted">عدد الدورات</h6>
                        </a>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{url('admin/courses')}}">
                            <h5>{{$courses_count}} </h5>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>

          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/students/active')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">S</h1></a>
                    </div>
                    <div class="col-8 pl-2">
                        <a href="{{url('admin/students/active')}}">
                            <h4>المشتركين الفعالين</h4>
                            <h6 class="text-muted">عدد المشتركين الفعالين</h6>
                        </a>
                    </div>
                    <div class="col-2 text-right">
                        <a href="{{url('admin/students/active')}}">
                            <h5>{{$student_active_count}} </h5>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>

           <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/students/notactive')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">S</h1></a>
                    </div>
                    <div class="col-8 pl-2">
                        <a href="{{url('admin/students/notactive')}}">
                            <h4>المشتركين الغير فعالين</h4>
                            <h6 class="text-muted">عدد المشتركين الغير فعالين</h6>
                        </a>
                    </div>
                    <div class="col-2 text-right">
                        <a href="{{url('admin/students/notactive')}}">
                            <h4>{{$student_not_active_count}} </h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>

          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/instructors')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">I</h1></a>
                    </div>
                    <div class="col-7 pl-2">
                        <a href="{{url('admin/instructors')}}">
                            <h4> المدربين </h4>
                            <h6 class="text-muted">عدد المدربين</h6>
                        </a>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{url('admin/instructors')}}">
                            <h4>{{$instructor_count}}</h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/instructors')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">I</h1></a>
                    </div>
                    <div class="col-7 pl-2">
                        <a href="{{url('admin/instructors')}}">
                            <h4> المدربين الفعالين </h4>
                            <h6 class="text-muted">عدد المدربين الفعالين</h6>
                        </a>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{url('admin/instructors')}}">
                            <h4>{{$instructor_count_active}} </h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>
          
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/instructors')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">I</h1></a>
                    </div>
                    <div class="col-7 pl-2">
                        <a href="{{url('admin/instructors')}}">
                            <h4>مدربين أضافو دورات</h4>
                            <h6 class="text-muted">عدد المدربين الفعالين الذين قامو بإضافة دورة علي الأقل</h6>
                        </a>
                    </div>
                    <div class="col-3 text-right">
                        <a href="{{url('admin/instructors')}}">
                            <h4>{{count($instructor_count_publish_course)}}</h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>

          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/bills')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">B</h1></a>
                    </div>
                    <div class="col-6 pl-2">
                        <a href="{{url('admin/bills')}}">
                            <h4> أرباح المعهد </h4>
                            <h6 class="text-muted">اجمالى الرصيد</h6>
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{url('admin/bills')}}">
                            <h4>{{$balance->balance_admin}} </h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('admin/bills')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">B</h1></a>
                    </div>
                    <div class="col-6 pl-2">
                        <a href="{{url('admin/bills')}}">
                            <h4> رصيد المدربين </h4>
                            <h6 class="text-muted">اجمالى الرصيد</h6>
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{url('admin/bills')}}">
                             {{round($balance->balance, 1)}}</h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="col-xl-4 col-12">
            <div class="card crypto-card-3 pull-up">
              <div class="card-content">
                <div class="card-body pb-0">
                  <div class="row">
                    <div class="col-2"><a href="{{url('instructor/stories')}}">
                      <h1 style="color: white; border-radius: 30px;padding: 6px 14px 6px 31px;background-color: #FF9149 !important;
                        }">V</h1></a>
                    </div>
                    <div class="col-6 pl-2">
                        <a href="{{url('instructor/stories')}}">
                            <h4> الزوار </h4>
                            <h6 class="text-muted"> الزوار الحاليين</h6>
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{url('instructor/stories')}}">
                            <h4>{{$balance->balance}} </h4>
                        </a>
                      <!--<h6 class="success darken-4">31% <i class="la la-arrow-up"></i></h6>-->
                    </div>
                    
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <canvas id="btc-chartjs" class="height-75"></canvas>
                </div>
              </div>
            </div>
            </div>
          </div>
          
        </div>
@endsection
	  