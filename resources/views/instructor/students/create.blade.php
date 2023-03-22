

@extends('layout.admin_main')
@section('content')
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">المستخدمين</h3><br>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a>
                </li>
                
                <li class="breadcrumb-item active">المستخدمين
                </li>
              </ol> 
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
                <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
          </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
    </div>

 	<section class="inputmask" id="inputmask">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Input Mask</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                      <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-xl-6 col-lg-12">
                        <fieldset>
                          <h5>Date Mask
                            <small class="text-muted">dd/mm/yyyy</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control date-inputmask" id="date-mask" placeholder="Enter Date"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Phone
                            <small class="text-muted">(999) 999-9999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control phone-inputmask" id="phone-mask" placeholder="Enter Phone Number"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>International Number
                            <small class="text-muted">+19 999 999 999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control international-inputmask" id="international-mask"
                            placeholder="International Phone Number" />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Phone / xEx
                            <small class="text-muted">(999) 999-9999 / x999999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control xphone-inputmask" id="xphone-mask" placeholder="Enter Phone Number"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Purchase Order
                            <small class="text-muted">aaaa 9999-****</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control purchase-inputmask" id="purchase-mask" placeholder="Enter Purchase Order"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Credit Card Number
                            <small class="text-muted">9999 9999 9999 9999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control cc-inputmask" id="cc-mask" placeholder="Enter Credit Card Number"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>SSN
                            <small class="text-muted">999-99-9999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control ssn-inputmask" id="ssn-mask" placeholder="Enter Social Security Number"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>ISBN
                            <small class="text-muted">999-99-999-9999-9</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control isbn-inputmask" id="isbn-mask" placeholder="Enter ISBN"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Percentage
                            <small class="text-muted">99%</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control percentage-inputmask" id="percentage-mask"
                            placeholder="Enter Value in %" />
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-xl-6 col-lg-12">
                        <fieldset>
                          <h5>Currency
                            <small class="text-muted">$9999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control currency-inputmask" id="currency-mask" placeholder="Enter Currency in USD"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Decimal using RadixPoint
                            <small class="text-muted">123.654658</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control decimal-inputmask" id="decimal-mask" placeholder="Enter Decimal Value"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Email
                            <small class="text-muted">xxx@xxx.xxx</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control email-inputmask" id="email-mask" placeholder="Enter Email Address"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>Optional masks
                            <small class="text-muted">(99) 9999[9]-9999</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control optional-inputmask" id="optional-mask" placeholder="With Optional Mask"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>JIT Masking
                            <small class="text-muted">mm-dd-yyyy</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control jit-inputmask" id="jit-mask" placeholder="With Optional Mask"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>OnComplete State
                            <small class="text-muted">Execute a function when the mask is completed.</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control oncomplete-inputmask" id="oncomplete-mask"
                            placeholder="Enter date" />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>OnInComplete State
                            <small class="text-muted">Execute a function when the mask is incomplete. Executes
                              on blur.</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control onincomplete-inputmask" id="onincomplete-mask"
                            placeholder="Enter date" />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>OnCleared State
                            <small class="text-muted">Execute a function when the mask is cleared.</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" class="form-control oncleared-inputmask" id="oncleared-mask" placeholder="Enter date"
                            />
                          </div>
                        </fieldset>
                        <fieldset>
                          <h5>RTL attribute
                            <small class="text-muted">dd/mm/yyyy</small>
                          </h5>
                          <div class="form-group">
                            <input type="text" dir="rtl" class="form-control date-inputmask" id="date-mask-rtl"
                            placeholder="Enter Date" />
                          </div>
                        </fieldset>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection