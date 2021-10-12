@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<!--content-->  
<div class="container">
<div class="row flex-lg-nowrap">
<div class="col-12 col-lg-3 mb-3">
        <div class="card">
          <div class="card-body">
          <form method="POST" action="{{url('users')}}">
          @csrf
          <div class="e-navlist e-navlist--active-bold">
              <ul class="nav">
                <li class="nav-item active"><span>Results</span>&nbsp;<small>/&nbsp;{{$users->count()}}</small></li>
              </ul>
            </div>
            <hr class="my-3">
            <div>
              <div class="form-group">
                <label>Search</label>
                <div><input class="form-control w-100" type="text" placeholder="Search user" name="search" value=""></div>
              </div>
              <div class="form-group">
                <label>Address</label>
                <div><input class="form-control w-100" type="text" placeholder="Search user" name="address" value=""></div>
              </div>
              <div class="form-group">
                <label>Nationality</label>
                <select class="form-control" id="exampleFormControlSelect1" name="nationality">
                  <option value="">Select Nationality</option>
                  @foreach($countries as $key => $country)
                    <option value="{{$country['name']}}">{{$country['name']}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Gender</label>
                <select class="form-control" id="exampleFormControlSelect1" name="gender">
                  <option value="">Select Gender</option>
                  <option value="Female">Female</option>
                  <option value="Male">Male</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label>Marital Status</label>
                <select class="form-control" id="exampleFormControlSelect1" name="marital_status">
                  <option value="">Select Status</option>
                  <option value="Married">Married</option>
                  <option value="Single">Single</option>
                </select>
              </div>
              <div class="row">
                <label class="col-sm-12">Filter by age </label>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Min" value="" name="min_age"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Max" value="" name="max_age"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-12">Filter by Height</label>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Min" value="" name="min_height"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Max" value="" name="max_height"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-12">Filter by Weight</label>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Min" value="" name="min_weight"></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <div><input class="form-control w-100" type="text" placeholder="Max" value="" name="max_weight"></div>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" value="Filter" class="btn btn-block btn-primary">
          </form>
          </div>
        </div>
      </div>
      <div class="col mb-3">
        <div class="e-panel card">
          <div class="card-body">
            <div class="e-table">
              <div class="table-responsive table-lg mt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Photo</th>
                      <th class="max-width">Name</th>
                      <th class="sortable">Phone</th>
                      <th class="sortable">Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($users->isNotEmpty())
                        @foreach($users as $user)
                        <tr>
                            <td class="align-middle text-center">
                                <div class="bg-light d-inline-flex justify-content-center align-items-center align-top" style="width: 35px; height: 35px; border-radius: 3px; overflow:hidden;">
                                <img src="{{ asset('images/profiles/'.$user->profile) }}" alt="{{$user->name}}" style="width:100%; height:100%;">
                            </div>
                            </td>
                            <td class="text-nowrap align-middle">{{$user->name}}</td>
                            <td class="text-nowrap align-middle">{{$user->phone}}</td>
                            <td class="text-nowrap align-middle">{{$user->email}}</td>
                            <td class="text-center align-middle">
                                <div class="btn-group align-top">
                                <a href="/profile/{{$user->id}}" class="btn btn-sm btn-outline-secondary badge" type="button">Profile</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else 
                    <tr>                  
                        <td colspan="5" class="text-center"><h4>No Results Found</h4></td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
              <!-- PAGINATION
              <div class="d-flex justify-content-center">
                <ul class="pagination mt-3 mb-0">
                  <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                  <li class="active page-item"><a href="#" class="page-link">1</a></li>
                  <li class="page-item"><a href="#" class="page-link">2</a></li>
                  <li class="page-item"><a href="#" class="page-link">3</a></li>
                  <li class="page-item"><a href="#" class="page-link">4</a></li>
                  <li class="page-item"><a href="#" class="page-link">5</a></li>
                  <li class="page-item"><a href="#" class="page-link">›</a></li>
                  <li class="page-item"><a href="#" class="page-link">»</a></li>
                </ul>
              </div>
              PAGINATION ENDS-->
            </div>
          </div>
        </div>
      </div>
      

    </div>
</div>
<!--content ends-->
@endsection