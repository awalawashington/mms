@extends('layouts.app')
@include('layouts.modals.delete_user')
@section('content')
@include('layouts.navbar')
<!--content-->  
<div class="container">
<div class="col">
<form method="POST" action="/edit_user/{{$profile->id}}" enctype="multipart/form-data">
@method('PUT')
@csrf
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile"> 
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                    <img src="{{ asset('images/profiles/'.$profile->profile) }}" alt="Image of {{$profile->name}}" style="width:100%; height:100%;">
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0"> 
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$profile->name}}</h4>
                    <p class="mb-0"><span>@</span>{{$profile->username}}</p>
                    <p class="mb-0">{{$profile->email}}</p>
                    <p class="mb-0">{{$profile->phone}}</p>
                    <div class="mt-2">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="profile">
                        @error('profile')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    <div class="form-group">
                        <label for="exampleFormControlFile1">photo</label>
                        
                      </div>
                      <!--
                      <button class="btn btn-primary" type="button">
                      
                      
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                        -->
                      </button>
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                      <span class="badge badge-secondary">{{$profile->color}} skin</span>
                      <span class="badge badge-secondary">{{$profile->gender}}</span>
                      @if($profile->role == TRUE)
                      <span class="badge badge-secondary">Administrator</span>
                      @else
                      <span class="badge badge-secondary">User</span>
                      @endif

                      @if($profile->active == TRUE)
                      <span class="badge badge-primary">Activated</span>
                      @else
                      <span class="badge badge-warning">Deactivated</span>
                      @endif
                      
                    <div class="text-muted"><small>Joined {{$profile->created_at->diffForHumans()}}</small></div>
                    <div class="text-muted"><small>Born {{$profile->dob}}</small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Profile</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Name</label>
                              <input class="form-control" type="text" name="name" value="{{$profile->name}}">
                              @error('name')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                          <label>Phone Number</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select class="form-control" id="exampleFormControlSelect1" name="code">
                                  <option value="{{explode('-', $profile->phone)[0]}}">{{explode('-', $profile->phone)[0]}}</option>
                                  @foreach($countries as $key => $country)
                                    <option value="{{$country['calling_code']}}">{{ $key.' +'. $country['calling_code']}}</option>
                                  @endforeach
                                </select>
                              </div>
                                <input name="phone" type="tel" class="form-control" value="{{explode('-', $profile->phone)[1]}}">
                              </div>
                              @error('code')
                                <small class="text-danger">{{ $message }} | </small>
                              @enderror
                              @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" name="email" value="{{$profile->email}}">
                              @error('email')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Username</label>
                              <input class="form-control" type="phone" name="username" value="{{$profile->username}}">
                              @error('username')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Address</label>
                              <input class="form-control" type="text" name="address" value="{{$profile->address}}">
                              @error('address')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Nationality</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="nationality">
                              @if($profile->nationality == NULL)
                                <option value="">Select Country</option>
                                @else
                                <option value="{{$profile->nationality}}">{{$profile->nationality}}</option>
                                @endif
                                @foreach($countries as $key => $country)
                                  <option value="{{$country['name']}}">{{$country['name']}}</option>
                                @endforeach
                              </select>
                              @error('nationality')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col">
                              <div class="form-group">
                                <label>Color</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="color">
                                  @if($profile->color == NULL)
                                  <option value="">Select Status</option>
                                  @else
                                  <option value="{{$profile->color}}">{{$profile->color}}</option>
                                  @endif
                                    <option value="Dark">Dark</option>
                                    <option value="Light">Light</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('color')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                              </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Marital Status</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="marital_status">
                                @if($profile->marital_status == NULL)
                                <option value="">Select Status</option>
                                @else
                                <option value="{{$profile->marital_status}}">{{$profile->marital_status}}</option>
                                @endif
                                  <option value="Married">Married</option>
                                  <option value="Single">Single</option>
                              </select>
                              @error('marital_status')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Gender</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="gender">
                                @if($profile->gender == NULL)
                                <option value="">Select Gender</option>
                                @else
                                <option value="{{$profile->gender}}">{{$profile->gender}}</option>
                                @endif
                                  <option value="Female">Female</option>
                                  <option value="Male">Male</option>
                                  <option value="Other">Other</option>
                              </select>
                              @error('gender')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Date of Birth</label>
                              <input class="form-control" type="date" name="dob" value="{{$profile->dob}}">
                              @error('dob')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Height</label>
                              <input class="form-control" type="text" name="height" value="{{$profile->height}}">
                              @error('height')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Weight</label>
                              <input class="form-control" type="text" name="weight"  value="{{$profile->weight}}">
                              @error('weight')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>Bio</label>
                              <textarea name="bio" class="form-control" rows="3" placeholder="{{$profile->bio}}">{{$profile->bio}}</textarea>
                              @error('bio')
                                  <small class="text-danger">{{ $message }}</small>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                        <div class="mb-2"><b>For Admins</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="custom-controls-stacked px-2">
                              <div class="custom-control custom-checkbox">
                              <div class="form-check">
                                <input name="role" class="form-check-input" type="checkbox" value="{{$profile->role}}" id="defaultCheck1" 
                                    @if($profile->role == TRUE)
                                        checked=""
                                    @endif
                                >
                                <label name="active" class="form-check-label" for="defaultCheck1">
                                    Make Admin
                                </label>
                                </div>
                              </div>
                              <div class="custom-control custom-checkbox">
                              <div class="form-check">
                                <input name="active" class="form-check-input" type="checkbox" value="{{$profile->active}}" id="defaultCheck1" 
                                    @if($profile->active == TRUE)
                                        checked=""
                                    @endif
                                >
                                <label class="form-check-label" for="defaultCheck1">
                                    Activate
                                </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex">
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                      </div>
                      <div class="col d-flex justify-content-end">
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_user">Delete User</button>
                      </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</form>

  </div>
</div>
<!--content ends-->
@endsection