@extends('layouts.app')
@if(auth()->user()->role == 1)
@include('layouts.modals.delete_user')
@include('layouts.modals.delete_photo')
@endif
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

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header text-white"
                   style="background: url('{{ asset('images/profiles/'.$profile->profile) }}') center center;">
                <h3 class="widget-user-username text-right">{{$profile->name}}</h3>
                <h5 class="widget-user-desc text-right"><span>@</span>{{$profile->username}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle" src="{{ asset('images/profiles/'.$profile->profile) }}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
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
              <a href="#" class="btn btn-primary btn-block "><b>Follow</b></a>
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
                 {{$profile->bio}}
                </p>

                <hr>

                <strong><i class="fa fa-phone mr-1"></i> Contact</strong>

                <p class="text-muted">{{$profile->phone}}</p>

                <hr>

                <strong><i class="fas fa-eye mr-1"></i> Skin Color</strong>

                <p class="text-muted">{{$profile->color}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">{{$profile->address}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Nationality</strong>

                @if($profile->nationality !== NULL)
                <p class="text-muted">{{$profile->country->name}}</p>
                @endif

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1 "></i> Marital Status</strong>

                <p class="text-muted toastrDefaultError">{{$profile->marital_status}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Height</strong>

                <p class="text-muted">{{$profile->height}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Weight</strong>

                <p class="text-muted">{{$profile->weight}}</p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
          @if (session('photo_delete'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Dear {{$user->name}}</strong> {{ session('photo_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a></li>
                  @if(auth()->user()->role == 1)
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Settings</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#settings" data-toggle="tab">Profile</a>
                            <a class="dropdown-item" href="#about" data-toggle="tab">About</a>
                            <!-- <a class="dropdown-item" href="#password" data-toggle="tab">Password</a> -->
                            <a class="dropdown-item" href="#password" data-toggle="modal" data-target="#delete_user">Delete User</a>
                        </div>
                  </li>
                  @endif
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="timeline">
                    <!-- Post -->
                    @foreach($profile->photos as $photo)
                    <div class="post card p-3 post_card">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('images/profiles/'.$profile->profile) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$profile->name}}</a>
                          <!-- Default dropleft button -->
                          @if(auth()->user()->role == 1)
                          <div class="btn-group dropleft float-right">
                            <a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item delete_photo" data-toggle="modal" data-target="#delete_photo">Delete</a>
                              <p class="id d-none">{{$photo->id}}</p>
                            </div>
                          </div>
                          @endif
                        </span>
                        <span class="description">Posted 5 - {{$photo->created_at->diffForHumans()}}</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-12">
                          <img class="img-fluid" src="{{ asset('images/gallery/'.$photo->name) }}" alt="Photo" >
                        </div>
                      </div>
                      <!-- /.row -->

                      <p>
                        <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="/photos/{{$photo->id}}" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> ({{$photo->comments->count()}})
                          </a>
                        </span>
                      </p>
                    </div>
                    @endforeach
                    <!-- /.post -->
                  </div>
                  @if(auth()->user()->role == 1)
                  <!-- Profile tab -->
                  <div class="tab-pane" id="settings">
                    <form method="POST" action="/admin_user_profile/{{$profile->username}}" class="form-horizontal">
                    @method('PUT')
                    @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" value="{{$profile->name}}" name="name">
                            <small class="text-danger error_text name"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" value="{{$profile->email}}" name="email">
                            <small class="text-danger error_text email"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" value="{{$profile->username}}" name="username">
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
                              <option value="{{$profile->code->country_id}}">{{$profile->code->country->code}} - {{$profile->code->country->callingcode}}</option>
                              @foreach($countries as $country)
                              <option value="{{$country->id}}">{{$country->code}} - {{$country->callingcode}}</option>
                              @endforeach
                            </select>
                          </div>
                          <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$profile->phone}}" data-inputmask='"mask": "999999999"' data-mask>
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
                    <form class="form-horizontal" method="POST" action="/admin_user_about/{{$profile->username}}">
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
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="dob" value="{{$profile->dob}}">
                          </div>
                          <small class="text-danger error_text dob"></small>
                        </div>
                      </div>
                      -->
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  value="{{$profile->color}}" name="color">
                          <small class="text-danger error_text color"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%;" name="gender">
                            <option selected="selected" value="{{$profile->gender}}">{{$profile->gender}}</option>
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
                            @if($user->nationality == NULL)
                            <option value="">Select Address</option>
                            @else
                            <option selected="selected" value="{{$profile->address}}">{{$profile->address}}</option>
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
                            <option  selected="selected" value="{{$profile->nationality}}">{{$profile->nationality}}</option>
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
                          <select class="form-control " style="width: 100%;" name="marital_status">
                            @if($user->marital_status == NULL)
                            <option value="">Select Marital Status</option>
                            @else
                            <option selected="selected" value="{{$profile->marital_status}}">{{$profile->marital_status}}</option>
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
                          <input type="text" class="form-control"  value="{{$profile->height}}" name="height">
                          <small class="text-danger error_text height"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Weight</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  value="{{$profile->weight}}" name="weight">
                          <small class="text-danger error_text weight"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputBio" name="bio">{{$profile->bio}}</textarea>
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

                  <!-- Password tab -
                  <div class="tab-pane" id="password" >
                    <form class="form-horizontal" method="POST" action="/admin_password_users/{{$profile->username}}">
                    @method('PUT')
                    @csrf
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary" id="save_password">Reset password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  -- //Password tab -->
                  @endif
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
  @include('layouts.js.user_profile_page_js')
  <!-- /.JS Files -->
  @endsection