@extends('layouts.app')
<style>
  .form-group{
    margin-right:10px;
    margin-bottom:8px;
  }
</style>
@section('content')
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.admin.sidebar')
  <!-- /Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!--Collapsable filter-->
                <div class="row">
                        <div id="filter-panel" class="collapse filter-panel">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <form class="form-inline " role="form" method="GET" action="{{url('/admin_users')}}">
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="address">
                                            <option value="">Address</option>
                                            @foreach($counties as $county)
                                            <option value="{{$county->name}}">{{$county->name}}</option>
                                            @endforeach
                                          </select>                               
                                        </div>
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="nationality">
                                            <option value="">Nationality</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                          </select>                            
                                        </div>  
                                        <div class="form-group">
                                          <select class="form-control select2bs4" name="marital_status">
                                            <option value="">Marital Status</option>
                                            <option value="Married">Maried</option>
                                            <option valeue="Single">Single</option>
                                          </select>                              
                                        </div>  
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Color" name="color">                                
                                        </div> 
                                        <div class="form-group">
                                            <div class="">
                                              <input type="text" class="form-control col-6" placeholder="Min Height" name="min_height"> 
                                              <input type="text" class="form-control col-6 " placeholder="Max Height" name="max_height">
                                            </div>                              
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                              <input type="text" class="form-control col-6" placeholder="Min Weight" name="min_weight"> 
                                              <input type="text" class="form-control col-6 " placeholder="Max Weight" name="max_weight">
                                            </div>                              
                                        </div>
                                        <div class="form-group">
                                            <div class="">
                                              <input type="text" class="form-control col-6" placeholder="Min Age" name="min_age"> 
                                              <input type="text" class="form-control col- 6" placeholder="Max Age" name="max_age">
                                            </div>                              
                                        </div>
                                        <div class="form-group">    
                                            <button type="submit" class="btn btn-primary">
                                              <i class="fas fa-filter"></i> Filter
                                            </button>  
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>    
                        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel" onClick="(this).style.display = 'none'">
                          <i class="fas fa-filter"></i> Filter
                        </button>
                  </div>
                <!--//collapsalbe filter-->
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              @if (session('user_deleted'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Dear {{$user->name}}</strong> {{ session('user_deleted') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Phone(s)</th>
                    <th>Username</th>
                    <th>Address</th>
                    <th>Nationality</th>
                    <th>Role</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>Color</th>
                    <th>Marital Status</th>
                    <th>Date joined</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td>
                      @if($user->profile != NULL)
                      <img src="{{ asset('images/profiles/'.$user->profile) }}" class="img-circle img-size-32 mr-2">
                      @endif
                      {{$user->name}}
                    </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->nationality}}</td>
                    <td>
                      @if($user->role == TRUE)
                        Admin
                      @else
                        User
                      @endif
                    </td>
                    <td>{{$user->height}}</td>
                    <td>{{$user->weight}}</td>
                    <td>{{$user->color}}</td>
                    <td>{{$user->marital_status}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>
                      <a href="/user_profile/{{$user->username}}" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Name</th>
                      <th>E-mail</th>
                      <th>Phone(s)</th>
                      <th>Username</th>
                      <th>Address</th>
                      <th>Nationality</th>
                      <th>Role</th>
                      <th>Height</th>
                      <th>Weight</th>
                      <th>Color</th>
                      <th>Marital Status</th>
                      <th>Date joined</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
  @include('layouts.js.users_page_js')
  <!-- /.JS Files -->
  @endsection