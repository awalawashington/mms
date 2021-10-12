<script>
     //comment
     $("#comment").submit(function (e) {
        e.preventDefault();
        let message = $("input[name=message]").val();
        let _token = $("input[name=_token]").val();
        let method = 'POST';

        $.ajax({
            url: "{{ route('photo_comment', $photo->id) }}", 
            type: method,
            data: {
                message:message,
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
                        toastr.error('Comment not  sent!');
                    });
                }else{
                    $("#comment_form").trigger("reset");
                    toastr.success('Comment sent');
                    $('.card-comments').append(body_data);
                }
            },
            complete:function () {
                $('.pre_load').fadeOut(1000);
            }
        });
    });

</script>