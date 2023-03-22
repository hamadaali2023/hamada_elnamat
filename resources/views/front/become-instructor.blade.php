@extends('layout.front_main')
@section('content') 
    <!-- start login -->
<br><br><br>
    
    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">



                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">

                        <p class="text-bold-500 text-dark text-extra-large mt-3">{{$user->name}}</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                        
                        <!-- <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-video pr-2"></i> My Courses
                        </a> -->
                        <a class="profile-links" href="{{url('/')}}">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a>
                        <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart pr-2"></i> My Wishlist
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user pr-2"></i> My Profile
                        </a>

                        <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> Become an Instructor
                        </a>

                        <a class="profile-links" href="{{url('bank-details')}}">
                            <i class="fas fa-money-check pr-2"></i> Bank Details
                        </a>
                    </div>


                </aside>



                <main class="col-12 col-lg-9 left-sidebar bg-white mb-5 pt-5 pb-5">



    <section class="form-section form-section-edit mt-0 pt-0">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-12">
                    <h6>Become an Instructor</h6>
                    <hr>
                    @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>خطا</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                      <form action="{{route('become-instructor-update')}}" method="POST" 
                                    name="le_form"  enctype="multipart/form-data">
                                    @csrf
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Country:</label>
                                        <select class="form-control" name="type" id="">
                                            <option value="student">Student</option>
                                            <option value="instructor">instructor</option>
                                        </select>
                                    </div>
                                </div> 


                        <!-- <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="User" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Name" required>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="user@gmail.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="00000000" required>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Details <span class="text-danger">*</span></label>
                                    <textarea rows="6" class="form-control" required>text text text
                                        </textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Resume <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Upload Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" required>
                                </div>
                            </div>

                        </div> -->

                   
                      

                        <div class="row mb-3 ">

                            <div class="col-md-2">
                                <button type="submit" class="w-100 btn header-btn text-medium font-weight-600">
                                    Sumbit    
                                </button>
                            </div>
                          
                        </div>





                    </form>


                </div>
  

                 




            </div>
        </div>
    </section>


    </main>

    </div>

    </div>

    </section>
    <!-- end login -->

@endsection
