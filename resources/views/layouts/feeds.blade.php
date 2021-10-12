@foreach($photos as $photo)
        
                    <div class="post card p-3 post_card">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="{{ asset('images/profiles/'.$photo->user->profile) }}" alt="User Image">
                        <span class="username">
                          <a href="#">{{$photo->user->name}}</a>
                          @if($photo->user_id == auth()->user()->id)
                          <!-- Default dropleft button -->
                          <div class="btn-group dropleft float-right">
                            <a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item edit_photo" data-toggle="modal" data-target="#edit_photo">Edit</a>
                              <a class="dropdown-item delete_photo" data-toggle="modal" data-target="#delete_photo">Delete</a>
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