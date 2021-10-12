<!-- Modal -->
<div class="modal fade" id="edit_photo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display:none">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form method="POST" action="{{url('admin_edit_photos')}}" enctype="multipart/form-data" id="edit_photo_form">
        @method('PUT')
        @csrf
      <input type="hidden" name="id" id="id">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Edit photo</h5>
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
        <img id="img" style="width:100%; height:auto; border-radius: 5px;">
        <small class="text-danger error_text photo"></small>
      </div>
      <div class="modal-footer pb-0"> 
        <input type="submit" class="btn btn-block btn-primary px-4" value="Save" >
      </div>
      </form>
    </div>
  </div>
</div>
