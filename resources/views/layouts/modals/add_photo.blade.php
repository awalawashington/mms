<!-- Modal -->
<div class="modal fade" id="add_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:none">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="post" action="{{url('add_photos')}}" enctype="multipart/form-data" id="upload_photo">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Add photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-sm-12">
              
            <textarea class="form-control border-0" id="description" name="description" placeholder="Add some text"></textarea>
            <small class="text-danger error_text description"></small>
          </div>
        </div>
        <img id="frame"  style="width:100%; height:auto; border-radius: 5px;" style="display:none;">
        <input type="file" id="photo" class="form-control-file" id="exampleFormControlFile1" name="photo" accept="image/" onchange="loadImg()">
        <small class="text-danger error_text photo"></small>
      </div>
      <div class="modal-footer pb-0">
        <input type="submit" class="btn btn-block btn-primary px-4" value="Upload" >
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  function loadImg(){
    $('#frame').show();
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
}
</script>



