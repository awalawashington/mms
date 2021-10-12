@extends('layouts.app')

@section('content')
<!--content-->  
<div class=" hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
            <b class="h1">Model Management</b>
            </div>
            <div class="card-body">
            <p class="login-box-msg">Register to</p>

            <form method="post" action="{{route('register')}}" id="login_form">
                @csrf
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @error('code')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select class="form-control select2" style="width: 100%;" name="code" >
                            @if (!old('code'))
                            <option value="">Select Code</option>
                            @endif
                            @foreach($countries as $country)
                                @if (old('code') == $country->id)
                                    <option value="{{$country->id}}" selected>{{$country->code}} - {{$country->callingcode}}</option>
                                @endif
                                <option value="{{$country->id}}">{{$country->code}} - {{$country->callingcode}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ old('phone') }}" data-inputmask='"mask": "999999999"' data-mask>
                    <div class="input-group-append input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                
                @error('dob')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3 date" id="reservationdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="dob" value="{{ old('dob') }}" placeholder="Date of Birth">
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text">
                        <span class="fa fa-calendar"></span>
                        </div>
                    </div>
                </div>
                
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <div class="form-control">
                        <select class="select2" style="width: 100%;" name="gender">
                            @if (old('gender') == "Female")
                                <option value="Female" selected>Female</option>
                            @endif
                            @if(old('gender') == "Male")
                                <option value="Male">Male</option>
                            @endif
                            <option value="">Select Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                   
                    <div class="input-group-append input-group-text">
                        <span class="fa fa-mars"></span>
                    </div>
                </div>
                
                @error('color')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Skin Color" name="color" value="{{ old('color') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-palette"></span>
                        </div>
                    </div>
                </div>
                
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                
                
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
             
                <div class="row">
                <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
                <!-- /.col -->
                </div>
            </form>
            <!--- Yet to Come
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>

            -- /.social-auth-links -->

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!--content ends-->
@include('layouts.inputs')
@endsection


