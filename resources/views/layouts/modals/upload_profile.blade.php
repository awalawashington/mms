<!-- Modal -->
<div class="modal fade" id="upload_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:none">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="{{url('profile_picture')}}" enctype="multipart/form-data" id="upload_profile_pic">
      @method('PUT')
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Add photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="frame"  style="width:100%; height:auto; border-radius: 5px;">
        <input type="file" id="profile_picture" class="form-control-file" id="exampleFormControlFile1" name="photo" accept="image/" onchange="loadImg()">
      </div>
      <div class="modal-footer pb-0">
        <input type="submit" class="btn btn-block btn-primary px-4" value="Save" >
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  function loadImg(){
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
}
</script>
