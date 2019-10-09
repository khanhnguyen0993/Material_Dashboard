<div class="modal fade" id="deleteConfirmation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-danger">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <input type="hidden" id="object" value="">
      </div>
      <div class="modal-body">
        <p>This action <span class="text-danger">can not</span> be undone. Are you sure you still want to delete?</p>
        <button type="button" class="btn btn-outline-secondary float-right  ml-3" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-outline-danger float-right" data-dismiss="modal" id="delete-btn">Delete</button>
      </div>
    </div>
  </div>
</div>