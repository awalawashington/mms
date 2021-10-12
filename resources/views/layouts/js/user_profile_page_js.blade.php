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
      timer: 3000
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
            url: "{{ route('admin_user_profile', $profile->username) }}",
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
                    $('small').text('');
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
            url: "{{ route('admin_user_about', $profile->username) }}",
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
    /*
    $("#save_password").click(function (e) {
        e.preventDefault();
        let current_password = $("input[name=current_password]").val();
        let password = $("input[name=password]").val();
        let password_confirmation = $("input[name=password_confirmation]").val();
        let _token = $("input[name=_token]").val();
        let method = $('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: "{{ route('admin_user_password', $profile->username) }}",
            type: method,
            data: {
                current_password:current_password,
                password:password,
                password_confirmation:password_confirmation,
                _token: _token
            
            },
            dataType: "json",
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                        toastr.error('Password has not been changed!');
                    });
                }else{
                    $('small').text('');
                    toastr.success('Password Successfully Changed');
                }
            },
        });
    });
    */

    //comment
    $("#comment").click(function (e) {
        e.preventDefault();
        let current_password = $("input[name=current_password]").val();
        let password = $("input[name=password]").val();
        let password_confirmation = $("input[name=password_confirmation]").val();
        let _token = $("input[name=_token]").val();
        let method = $('input[name="_method"]').val() || 'POST';

        $.ajax({
            url: "",
            type: method,
            data: {
                current_password:current_password,
                password:password,
                password_confirmation:password_confirmation,
                _token: _token
            
            },
            dataType: "json",
            success:function(response){
                if (response.status == 400) {
                    $.each(response.errors, function (prefix, val) {
                        $('small.'+prefix).text(val[0]);
                        toastr.error('Password has not been changed!');
                    });
                }else{
                    $('small').text('');
                    toastr.success('Password Successfully Changed');
                }
            },
        });
    });

    $(".delete_photo").click(function name() {
        let _this = $(this).parents('.post_card');
        let id= _this.find('.id').text();
        $("#delete_button").attr("href", "/admin_delete_photos/"+id);
        
    });

  });
</script>