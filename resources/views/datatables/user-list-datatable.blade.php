<table id="datatable" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.list') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Open Edit Modal and Load Data
        $(document).on('click', '.editUser', function() {
            var userId = $(this).data('id');
            $.get("/users/" + userId, function(user) {
                $('#editUserModal input[name="id"]').val(user.id);
                $('#editUserModal input[name="name"]').val(user.name);
                $('#editUserModal input[name="email"]').val(user.email);
                $('#editUserModal').modal('show');
            });
        });

        // Update User via AJAX
        $('#updateUserBtn').click(function() {
            var formData = $('#editUserForm').serialize();
            $.ajax({
                url: "{{ route('users.update') }}",
                type: "POST",
                data: formData,
                success: function(res) {
                    $('#editUserModal').modal('hide');
                    table.ajax.reload();
                    toastr.success(res.success);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var form = $('#editUserForm');
                            form.find('.' + key + '_error').text(value[0]);
                        });
                    } else if (xhr.status === 404) {
                        toastr.error(xhr.responseJSON.error);
                    } else if (xhr.status === 500) {
                        toastr.error('Something went wrong. Please try again.');
                    } else {
                        toastr.error('Unexpected error occurred.');
                    }
                }
            });
        });
    });
</script>
