
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="editUserForm">
        @csrf
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
            <span class="text-danger error-text name_error"></span>
          </div>
          <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
            <span class="text-danger error-text email_error"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="updateUserBtn" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
