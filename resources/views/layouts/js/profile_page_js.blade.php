<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
<!-- Page specific script -->
<script>
  $(function () {
    
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 30000
    });

    $("#save_profile").click(function (e) {
        e.preventDefault();
        let name = $("input[name=name]").val();
        let email = $("input[name=email]").val();
        let phone = $("input[name=phone]").val();
        let code = $("select[name=code]").val();
        let username = $("input[name=username]").val();
        let _token = $("input[name=_token]").val(); 
        let method = $('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: "/edit_profile",
            type: method,
            data: {
                name:name,
                email:email,
                code:code,
                phone:phone,
                username:username,
                _token: _token
            
            },
            dataType: "json",
            beforeSend:function () {
                $('.pre_load').fadeIn();
            },
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                    });
                }else{
                    toastr.success('Changes were successfully saved');
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
        });
    });

    //about information update
    $("#save_about").click(function (e) {
        e.preventDefault();
        let dob = $("input[name=dob]").val();
        let color = $("input[name=color]").val();
        let gender = $("select[name=gender]").val();
        let address = $("select[name=address]").val();
        let nationality = $("select[name=nationality]").val();
        let marital_status = $("select[name=marital_status]").val();
        let height = $("input[name=height]").val();
        let weight = $("input[name=weight]").val();
        let bio = $("textarea[name=bio]").val();
        let _token = $("input[name=_token]").val();
        let method = $('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: "/edit_about",
            type: method,
            data: {
                dob:dob,
                color:color,
                gender:gender,
                address:address,
                nationality:nationality,
                marital_status:marital_status,
                height:height,
                weight:weight,
                bio:bio,
                _token: _token
            
            },
            dataType: "json",
            beforeSend:function () {
                $('.pre_load').fadeIn();
            },
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                    });
                }else{
                    toastr.success('Changes were successfully saved');
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
        });
    });

    //password update
    $("#save_password").click(function (e) {
        e.preventDefault();
        let current_password = $("input[name=current_password]").val();
        let password = $("input[name=password]").val();
        let password_confirmation = $("input[name=password_confirmation]").val();
        let _token = $("input[name=_token]").val();
        let method = $('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: "/edit_password",
            type: method,
            data: {
                current_password:current_password,
                password:password,
                password_confirmation:password_confirmation,
                _token: _token
            
            },
            dataType: "json",
            beforeSend:function () {
                $('.pre_load').fadeIn();
            },
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                    });
                }else{
                    toastr.success('Password Successfully Changed');
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
        });
    });

   
  

    

    

    //edit photo

    $(".edit_photo").click(function name() {
        let _this = $(this).parents('.post_card');
        let description = _this.find('.desc').text();
        let src = _this.find('.img').attr('src');
        let id= _this.find('.id').text();
        $("#description").val(description);
        $("#img").attr("src", src);
        $("#id").val(id);
    });
    //delete photo

    $(".delete_photo").click(function name() {
        let _this = $(this).parents('.post_card');
        let id= _this.find('.id').text();
        $("#delete_button").attr("href", "/delete_photos/"+id); 
        
    });

    //edit photo form

    $("#edit_photo_form").on('submit', function (event) {
        event.preventDefault();
        let method = 'POST';

        $.ajax({
            url: "{{url('edit_photos')}}",
            type: method,
            processData: false,
            dataType: 'JSON',
            contentType: false,
            cache:false,
            data: new FormData(this),
            beforeSend:function () {
                $('.pre_load').fadeIn();
            },
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                        toastr.error(val[0]);
                    });
                }else{
                    $("#edit_photo_form").trigger("reset");
                    $('#edit_photo').modal('hide');
                    let url = '<a href="/photos/'+response.photo_id+'" class="link-black text-sm text-danger">Here</a>'
                    toastr.success('Changes saved. Click '+url+' to view');
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
        });
    });

    //get postss
   
   /* 
    function fetchPosts() {
        $.ajax({
            url: "{{url('posts')}}",
            type: 'GET',
            async: true,
            processData: true,
            dataType: 'JSON',
            success: function (response) {
                var body_data ="";
                $.each(response.photos, function (key, item) {
                    body_data += '<div class="post card p-3 post_card">'
                    body_data += '<div class="user-block">'
                    body_data += '<img class="img-circle img-bordered-sm" src="images/profiles/'+item.user.profile+'"  alt="User Image">'
                    body_data += '<span class="username">'
                    body_data += '<a href="#">'+item.user.name+'</a>'
                    body_data += '<div class="btn-group dropleft float-right">'
                    body_data += '<a href="#" class=" btn-tool dropdown-toggle" data-toggle="dropdown"  aria-expanded="false"><i class="fa fa-ellipsis-H"></i></a>'
                    body_data += '<div class="dropdown-menu">'
                    body_data += '<a class="dropdown-item edit_photo" data-toggle="modal" data-target="#edit_photo">Edit</a>'
                    body_data += '<a class="dropdown-item delete_photo" data-toggle="modal" data-target="#delete_photo">Delete</a>'
                    body_data += '<p class="id d-none">'+item.id+'</p>'
                    body_data += '</div>'
                    body_data += '</div>'
                    body_data += '</span>'
                    body_data += '<span class="description">Posted - '+item.created_at+'</span>'
                    body_data += '</div>'
                    body_data += '<p class="desc">'+ item.description +'</p>'
                    body_data += '<div class="row mb-3">'
                    body_data += '<div class="col-12">'
                    body_data += '<img class="img-fluid img" src="images/gallery/'+item.name+'" alt="Photo" >'
                    body_data += '</div>'
                    body_data += '</div>'
                    body_data += '<p>'
                    body_data += '<a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>'
                    body_data += '<a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>'
                    body_data += '<span class="float-right">'
                    body_data += '<a href="/photos/'+item.id+'" class="link-black text-sm">'
                    body_data += '<i class="far fa-comments mr-1"></i> ('+item.comments.length+')'
                    body_data += '</a>'
                    body_data += '</span>'
                    body_data += '</p>'
                    body_data += '</div>'
                });
                $('.feeds').append(body_data);
            }
        });
    }
    */

    //post photo
    $("#upload_photo").on('submit', function (event) {
        event.preventDefault();
        let photo = $('#photo').prop('files');
        let description = $("textarea[name=description]").val();
        let _token = $("input[name=_token]").val();
        let method = 'POST';

        $.ajax({
            url: "{{ route('add_photos') }}",
            type: method,
            processData: false,
            dataType: 'JSON',
            contentType: false,
            cache:false,
            data: new FormData(this),
            beforeSend:function () {
                $('.pre_load').fadeIn();
            },
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('.pre_load').hide();
                        $('small.'+prefix).text(val[0]);
                        toastr.error(val[0]);
                    });
                }else{
                    $('.pre_load').fadeOut(1000);
                    $('#add_photo').modal('hide');
                    $("#upload_photo").trigger("reset");
                    $('#frame').removeAttr( "src" );
                    let url = '<a href="/photos/'+response.photo_id+'" class="link-black text-sm text-danger">Here</a>'
                    toastr.success('Photo  uploaded successfully. Click '+url+' to view');
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
            
        });
    });

    $(".fa-thumbs-up").click(function (e) {
        e.preventDefault();
        $(this).attr("class", "fas fa-thumbs-up mr-1");
    });
  
  });
  function loadMoreData(page) {
      //post photo
        $.ajax({
            url: '?page=' + page,
            type: 'get',
            beforeSend:function () {
                $('.ajax_load').show();
            }
        })
        .done(function (data) {
            if (data.html == "") {
                $('.ajax_load').html("No more photos");
                return;
            }  
            $('.ajax_load').hide();
            $('#activity').append(data.html);
        })
        .fail(function (data) {
            alert("Server not responding");
        });
     }
        var page = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page = page+1;
                loadMoreData(page);
            }
        });

  
</script>