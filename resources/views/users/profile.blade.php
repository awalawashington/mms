@extends('layouts.app')
@include('layouts.modals.add_photo')
@include('layouts.modals.upload_profile')
@include('layouts.modals.edit_photo')
@include('layouts.modals.delete_photo')
@include('layouts.preload')
@section('content')
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(auth()->user()->role == 1)
  @include('layouts.admin.sidebar')
  @else
  @include('layouts.sidebar')
  @endif
  
  <!-- /Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 profile">
          @error('photo')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Dear {{$user->name}}</strong> {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
            @if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Dear {{$user->name}}</strong> {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <!-- Profile Image -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="background: url('{{ asset('images/profiles/'.$user->profile) }}') center center;">
                <h3 class="widget-user-username text-right">{{$user->name}}</h3>
                <h5 class="widget-user-desc text-right"><span>@</span>{{$user->username}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('images/profiles/'.$user->profile) }}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="description-block">
                      <h5 class="description-header">35</h5>
                      <span class="description-text">FOLOWING</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <a href="#" class="btn btn-primary btn-block " data-toggle="modal" data-target="#upload_profile"><b>Upload Profile Pic</b></a>
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Bio</strong>

                <p class="text-muted">
                 {{$user->bio}}
                </p>

                <hr>

                <strong><i class="fa fa-phone mr-1"></i> Contact</strong>

                <p class="text-muted">{{$user->phone}}</p>

                <hr>

                <strong><i class="fas fa-eye mr-1"></i> Skin Color</strong>

                <p class="text-muted">{{$user->color}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">{{$user->address}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Nationality</strong>
                @if($user->nationality !== NULL)
                <p class="text-muted">{{$user->country->name}}</p>
                @endif
                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1 "></i> Marital Status</strong>

                <p class="text-muted toastrDefaultError">{{$user->marital_status}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Height</strong>

                <p class="text-muted">{{$user->height}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Weight</strong>

                <p class="text-muted">{{$user->weight}}</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
          <div class="card">
              <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link btn btn-outline-outline " data-toggle="modal" data-target="#add_photo"><i class="fas fa-upload"></i> Add Photo</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Feeds</a></li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="#settings" data-toggle="tab">Profile</a>
                              <a class="dropdown-item" href="#about" data-toggle="tab">About</a>
                              <a class="dropdown-item" href="#password" data-toggle="tab">Password</a>
                          </div>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
            </div>
            @if (session('photo_delete'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Dear {{$user->name}}</strong> {{ session('photo_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card bg-transparent border-0 shadow-none">
              <div class="">
                <div class="tab-content">
                <div class="tab-pane bg-transparent active" id="timeline">
                    <!-- Post -->
                    @include('layouts.posts')
                    <!-- /.post -->
                  </div>
                  <div class="tab-pane bg-transparent feeds" id="activity">
                    <!-- Post -->
                    @include('layouts.feeds')
                    <!-- /.post -->
                  <div class="ajax_load text-center" style="display:none">
                    <p><img src="{{asset('/images/preload/loader.gif') }}" alt="MMS"></p>
                  </div>
                  </div>
                  <!-- Profile tab -->
                  <div class="tab-pane" id="settings">
                    <form method="POST" action="{{url('edit_profile')}}" class="form-horizontal">
                    @method('PUT')
                    @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" value="{{$user->name}}" name="name">
                            <small class="text-danger error_text name"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" value="{{$user->email}}" name="email">
                            <small class="text-danger error_text email"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" value="{{$user->username}}" name="username">
                            <small class="text-danger error_text username"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                          </div>
                          <div class="input-group-prepend">
                            <select class="form-control select2" style="width: 100%;" name="code">
                              <option value="{{$user->code->country_id}}">{{$user->code->country->code}} - {{$user->code->country->callingcode}}</option>
                              @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->code}} - {{$country->callingcode}}</option>
                              @endforeach
                            </select>
                          </div>
                          <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$user->phone}}" data-inputmask='"mask": "999999999"' data-mask>

                        </div>
                            <small class="text-danger error_text phone"></small>
                            <small class="text-danger error_text code"></small>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" id="save_profile">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- //Profile tab -->
                
                  <!-- About tab -->
                  <div class="tab-pane" id="about">
                    <form class="form-horizontal" method="POST" action="/edit_about/{{$user->username}}">
                    @method('PUT')
                    @csrf
                    <!--
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <div class="input-group-prepend" data-target="#reservationdate" data-toggle="datetimepicker">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" value="{{$user->dob}}" class="form-control datetimepicker-input" data-inputmask-alias="datetime" data-target="#reservationdate" name="dob" >
                          </div>
                          <small class="text-danger error_text dob"></small>
                        </div>
                      </div>
                      -->
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  value="{{$user->color}}" name="color">
                          <small class="text-danger error_text color"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%;" name="gender">
                            <option selected="selected" value="{{$user->gender}}">{{$user->gender}}</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                          </select>
                          <small class="text-danger error_text gender"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%;" name="address">
                            @if($user->address == NULL)
                            <option value="">Select Address</option>
                            @else
                            <option value="{{$user->address}}">{{$user->address}}</option>
                            @endif
                            
                            @foreach($counties as $county)
                            <option value="{{$county->name}}">{{$county->name}}</option>
                            @endforeach
                          </select>
                          <small class="text-danger error_text nationality"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nationality</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%;" name="nationality">
                            @if($user->nationality == NULL)
                            <option value="">Select Nationality</option>
                            @else
                            <option value="{{$user->nationality}}">{{$user->country->name}}</option>
                            @endif
                            @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                          </select>
                          <small class="text-danger error_text nationality"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Marital Status</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%;" name="marital_status">
                            @if($user->marital_status == NULL)
                            <option value="">Select Marital Status</option>
                            @else
                            <option value="{{$user->marital_status}}">{{$user->marital_status}}</option>
                            @endif
                            <option value="Married">Maried</option>
                            <option valeue="Single">Single</option>
                          </select>
                          <small class="text-danger error_text marital_status"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Height</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  value="{{$user->height}}" name="height">
                          <small class="text-danger error_text height"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  value="{{$user->weight}}" name="weight">
                          <small class="text-danger error_text weight"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputBio" name="bio">{{$user->bio}}</textarea>
                          <small class="text-danger error_text bio"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" id="save_about">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- //About Tab tab -->

                  <!-- Password tab -->
                  <div class="tab-pane" id="password" >
                    <form class="form-horizontal" method="POST" action="{{url('edit_password')}}">
                    @method('PUT')
                    @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="current_password">
                          <small class="text-danger error_text current_password"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password">
                          <small class="text-danger error_text password"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control"  >
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" id="save_password">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- //Password tab -->

                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  @include('layouts.control_sidebar')
    <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.footer')
  <!-- /.Main Footer -->

  <!-- JS Files -->
  @include('layouts.js.profile_page_js')
  <!-- /.JS Files -->
  @endsection