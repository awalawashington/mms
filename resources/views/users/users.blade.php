@extends('layouts.app')
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
          <div class="col-md-3">

          
          <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-6">
            <!-- Profile Image -->
            @if($users->count() == 0)
            <div class="col-12">
                <div class="info-box d-flex justify-content-center align-content-center">
                  <h4>No results found for {{$search}}</h4>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            @endif
            @foreach($users as $user)     
              <div class="col-12">
                <div class="info-box">
                  <span class="info-box-icon"><img src="{{ asset('/images/profiles/'.$user->profile) }}" alt="" style="width:100%; height:100%;"></span>
                  <div class="info-box-content">
                    <span class="info-box-number"><a href="/user_profile/{{$user->username}}" class="stretched-link">{{$user->name}}</a></span>
                    <span class="info-box-text"><span>@</span>{{$user->username}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            @endforeach
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-3">
        
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
  @include('layouts.js.users_page_js')
  <!-- /.JS Files -->
  @endsection