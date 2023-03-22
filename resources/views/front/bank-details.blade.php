@extends('layout.front_main')
@section('content') 

    <section class="bg-light">
        <div class="container">
            <div class="row">

                <aside class="col-12 col-lg-3 float-left">

                    <div class="bg-light p-3 pt-4 mb-3   bg-white text-center">

                        <img src="{{asset('img/profiles/'.$user->photo) }}" class="img-thumbnail profile-img-edit">

                         <p class="text-bold-500 text-dark text-extra-large mb-2 mt-3">{{$user->name}}</p>

                        <p class="text-medium2">{{$user->email}}</p>

                    </div>

                    <div class="margin-45px-bottom sm-margin-25px-bottom bg-white p-4">
                       <a class="profile-links" href="{{url('/')}}">
                            <i class="fas fa-home"></i> الصفحة الرئيسية
                        </a> 
                       <a class="profile-links" href="{{url('my-wishlist')}}">
                            <i class="fas fa-heart pr-2"></i> My Wishlist
                        </a>

                        <a class="profile-links" href="{{url('my-profile')}}">
                            <i class="fas fa-user pr-2"></i> My Profile
                        </a>

                        <!-- <a class="profile-links" href="{{url('become-instructor')}}">
                            <i class="fas fa-chalkboard-teacher pr-2"></i> Become an Instructor
                        </a> -->

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
                        <h6>Bank Details</h6>
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


                        <form action="{{route('updatebankdetails')}}" method="POST" 
                                    name="le_form"  enctype="multipart/form-data">
                                    @csrf


                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Account Holder Name <span class="text-danger">*</span></label>
                                        <input type="text" name="persone_name" class="form-control" value="{{$bank->persone_name}}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Name <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_name" class="form-control" value="{{$bank->bank_name}}" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank sub name <span class="text-danger">*</span></label>
                                        <input type="text" name="bank_sub_name" class="form-control" value="{{$bank->bank_sub_name}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Acount Number <span class="text-danger">*</span></label>
                                        <input type="text" name="acount_number" class="form-control" value="{{$bank->acount_number}}" required>
                                    </div>
                                </div>
                               

                            </div>

                            
                            <div class="row mb-3">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Swift Code <span class="text-danger">*</span></label>
                                        <input type="text" name="swift_code" class="form-control" value="{{$bank->swift_code}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>
                                            <!-- IFSC Code -->
                                            Iban
                                             <span class="text-danger">*</span></label>
                                        <input type="text" name="iban" value="{{$bank->iban}}" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Country <span class="text-danger">*</span></label>
                                        <input type="text" name="countryId" class="form-control" value="{{$bank->countryId}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank City <span class="text-danger">*</span></label>
                                        <input type="text" name="cityId" class="form-control" value="{{$bank->cityId}}" required>
                                    </div>
                                </div>
                               

                            </div>

                          

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