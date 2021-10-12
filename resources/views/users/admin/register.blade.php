@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<!--content-->  
<div class="container">
<div class="col-lg-8 ml-auto mr-auto">
<form method="post" action="{{url('register_user')}}">
                    @csrf
                    <h3 class="mb-3" style="text-align:center;">Add User</h3>
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="username" type="text" class="form-control" value="{{ old('username') }}">
                                        @error('username')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="email" type="email" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <select class="form-control" id="exampleFormControlSelect1" name="country">
                                                    <option>KENYA(+254)</option>
                                                    <option>UGANDA(+256)</option>
                                                    <option>TANZANIA(+255)</option>
                                                    <option>S. SUDAN(+211)</option>
                                                    <option>SOMALIA(+252)</option>
                                                </select>
                                            </div>
                                            <input name="phone" type="tel" class="form-control" value="{{ old('phone') }}">
                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" id="exampleFormControlSelect1" name="gender" value="{{ old('gender') }}">
                                            <option value="">Select Gender</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Skin Color</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select class="form-control" id="exampleFormControlSelect1" name="color" value="{{ old('color') }}">
                                            <option value="">Select Color</option>
                                            <option value="Light">Light</option>
                                            <option value="Dark">Dark</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        @error('color')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="dob" type="date" class="form-control" value="{{ old('dob') }}">
                                        @error('dob')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Register">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>    
<!--content ends-->
@endsection