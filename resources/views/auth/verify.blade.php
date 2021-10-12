@extends('layouts.app')
@section('content')
<!--content-->  
<div class="container">
<div class="col-lg-8 ml-auto mr-auto mt-5">
<div class="card">
  <div class="card-header">
    Email Verification
  </div>
  <div class="card-body">
    <h5 class="card-title">Verify your email address</h5>
    <p class="card-text">Before proceeding, please check your email address for a verification link</p>
    <a href="/resend" class="btn btn-primary">Click here to request another link</a>
  </div>
</div>
</div>
<!--content ends-->
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
@endsection