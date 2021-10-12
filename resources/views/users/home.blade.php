@extends('layouts.admin.app')
@include('layouts.modals.add_photo')
@include('layouts.modals.edit_photo')
@include('layouts.modals.admin_delete_photo')
@section('content')
  <!-- Navbar -->
  @include('layouts.admin.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')
  <!-- /Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 ">

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
                    <a href="{{route('users')}}" class="description-block">
                      <h5 class="description-header">13,000</h5>
                      <span class="description-text">FOLLOWERS</span>
                    </a>
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

                <p class="text-muted">{{$user->nationality}}</p>

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
                    <li class="nav-item"><a class="nav-link btn btn-outline-outline " href="{{url('/add_photo')}}" data-toggle="modal" data-target="#delete_user"><i class="fas fa-upload"></i> Add Photo</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
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
            <div class="card">
              
              <div class="card-body">
                <div class="tab-content">
                <div class="tab-pane bg-transparent active" id="activity">
                    <!-- Post -->
                    @foreach($photos as $photo)
        
                    <div class="post card p-3 post_card">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('images/profiles/'.$photo->user->profile) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$photo->user->name}}</a>
                          <!-- Default dropleft button -->
                          @if(auth()->user()->id == $photo->user_id)
                          <div class="btn-group dropleft float-right">
                            <a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit_photo" data-toggle="modal" data-target="#edit_photo">Edit</a>
                              <a class="dropdown-item delete_photo" data-toggle="modal" data-target="#admin_delete_photo">Delete</a>
                              <p class="id d-none">{{$photo->id}}</p>
                            </div>
                          </div>
                          @endif
                        </span>
                        <span class="description">Posted 5 photos - {{$photo->created_at}} days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p class="desc">{{$photo->description}}</p>
                      <div class="row mb-3">
                        <div class="col-12">
                          <img class="img-fluid img" src="{{ asset('images/gallery/'.$photo->name) }}" alt="Photo" >
                        </div>
                      </div>
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="/admin_photos/{{$photo->id}}" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments ({{$photo->comments->count()}})
                          </a>
                        </span>
                      </p>
                    </div>
                    @endforeach
                    <!-- /.post -->
                  </div>
                  <div class="tab-pane bg-transparent" id="timeline">
                    <!-- Post -->
                    @foreach($user->photos as $photo)
                    <div class="post card p-3 post_card">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('images/profiles/'.$user->profile) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$user->name}}</a>
                          <!-- Default dropleft button -->
                          <div class="btn-group dropleft float-right">
                            <a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit_photo" data-toggle="modal" data-target="#edit_photo">Edit</a>
                              <a class="dropdown-item delete_photo" data-toggle="modal" data-target="#admin_delete_photo">Delete</a>
                              <p class="id d-none">{{$photo->id}}</p>
                            </div>
                          </div>
                        </span>
                        <span class="description">Posted 5 photos - {{$photo->created_at}} days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p class="desc">{{$photo->description}}</p>
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <img class="img-fluid" src="{{ asset('images/gallery/'.$photo->name) }}" alt="Photo" >
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments ({{$photo->comments->count()}})
                          </a>
                        </span>
                      </p>
                    </div>
                    @endforeach
                    <!-- /.post -->
                  </div>
                  
                  <!-- Profile tab -->
                  <div class="tab-pane" id="settings">
                    <form method="POST" action="{{url('admin_edit_profile')}}" class="form-horizontal">
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
                          <input name="phone" value="{{$user->phone}}" type="text" class="form-control"
                                data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                        </div>
                            <small class="text-danger error_text phone"></small>
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
                    <form class="form-horizontal" method="POST" action="/admin_user_about/{{$user->username}}">
                    @method('PUT')
                    @csrf
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Date of Birth</label>
                        <div class="col-sm-10">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="dob" value="{{$user->dob}}">
                          </div>
                          <small class="text-danger error_text dob"></small>
                        </div>
                      </div>
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
                            <option selected="selected" value="{{$user->address}}">{{$user->address}}</option>
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
                            <option  selected="selected" value="{{$user->nationality}}">{{$user->nationality}}</option>
                            <option value="Kenya">Kenya</option>
                            @foreach($counties as $county)
                            <option value="{{$county->name}}">{{$county->name}}</option>
                            @endforeach
                          </select>
                          <small class="text-danger error_text nationality"></small>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Marital Status</label>
                        <div class="col-sm-10">
                          <select class="form-control " style="width: 100%;" name="marital_status">
                            <option selected="selected" value="{{$user->marital_status}}">{{$user->marital_status}}</option>
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
                    <form class="form-horizontal" method="POST" action="{{url('admin_edit_password')}}">
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
  @include('layouts.admin.control_sidebar')
    <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.admin.footer')
  <!-- /.Main Footer -->

  <!-- JS Files -->
  @include('layouts.admin.js.profile_page_js')
  <!-- /.JS Files -->
  @endsection