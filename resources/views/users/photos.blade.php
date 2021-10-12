@extends('layouts.app')
@include('layouts.modals.add_photo')
@if(!auth()->user()->role == 1 || $photo->user_id == auth()->user()->id)
@include('layouts.modals.edit_photo')
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                <div class="bg-transparent">
                    <!-- Post -->
        
                    <div class="post card p-3 post_card">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('images/profiles/'.$photo->user->profile) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$photo->user->name}}</a>
                          <!-- Default dropleft button -->
                          @if(auth()->user()->role == 1 || $photo->user_id == auth()->user()->id)
                          <div class="btn-group dropleft float-right">
                            <a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit_photo" data-toggle="modal" data-target="#edit_photo">Edit</a>
                              <a class="dropdown-item delete_photo" href="/delete_photos/{{$photo->id}}">Delete</a>
                              <p class="id d-none">{{$photo->id}}</p>
                            </div>
                          </div>
                          @endif
                        </span>
                        <span class="description">Posted - {{$photo->created_at->diffForHumans()}}</span>
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
                      <!--<a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right link-black text-sm">
                            <i class="far fa-comments mr-1"></i>({{$photo->comments->count()}})
                        </span>
                      </p>

                        <form method="POST" action="/photo_comment/{{$photo->id}}" id="comment" >
                            @csrf
                            <img class="img-fluid img-circle img-sm" src="{{ asset('images/profiles/'.$photo->user->profile) }}" alt="Alt Text">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                                <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment" name="message" >
                            </div>
                            @error('message')
                            <small class="text-danger error_text message">{{$message}}</small>
                            @enderror
                            
                        </form>
                      <!-- Comment -->
                      <!-- /.card-body -->
                        <div class="card-footer card-comments">
                             <!-- Comment -->
                                @foreach($photo->comments as $comment)
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="{{ asset('images/profiles/'.$comment->user->profile) }}" alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                        {{$comment->user->name}}
                                        <span class="text-muted float-right">{{$comment->created_at->diffForHumans()}}</span>
                                        </span><!-- /.username -->
                                        {{$comment->message}}
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                                @endforeach     
                        </div>
                        <!-- /.card-footer -->
                      
                      <!-- /.comment -->
                    </div>
                    <!-- /.post -->
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
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
  @include('layouts.js.profile_page_js')
  @include('layouts.js.photo_page_js')
  <!-- /.JS Files -->
  @endsection