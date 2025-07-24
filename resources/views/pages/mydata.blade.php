@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account /</span> My Profile
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">My Personal Information</h5>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="profile-table-body">
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary" id="editBtn" data-id="{{ $data->id }}">
                                            <i class="bx bx-edit-alt me-1"></i> UpdateData
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning" id="changePasswordBtn" data-id="{{ $data->id }}">
                                            <i class="bx bx-lock-alt me-1"></i> Change Password
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('user_dashboard') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="updateModal" class="modal-blur" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; backdrop-filter:blur(5px); background-color:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div class="card p-4" style="max-width:400px; width:90%;">
        <h5 class="mb-4">Edit Your Information</h5>
        <form id="updateForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="user_id">

            <div class="mb-3">
                <label for="nameField" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="nameField" required>
            </div>

            <div class="mb-3">
                <label for="emailField" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="emailField" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>


<!-- Change Password Modal -->
<div id="passwordModal" class="modal-blur" style="display:none">
    <div class="modal-content">
        <form id="passwordForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="password_user_id">

            <h5 class="mb-4">Change Your Password</h5>

            <div class="mb-3">
                <label>New Password</label>
                <input type="password" class="form-control" name="new_password" id="newPasswordField" required>
            </div>

            <div class="mb-3">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" name="new_password_confirmation" id="confirmPasswordField" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Update Password</button>
                <button type="button" id="cancelPasswordBtn" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // Edit user button click
        $(document).on('click', '#editBtn', function (e) {
            e.preventDefault();
            const userId = $(this).data('id');

            $.ajax({
                url: '/user/edit/' + userId,
                type: 'GET',
                success: function (res) {
                    $('#user_id').val(res.id);
                    $('#nameField').val(res.name);
                    $('#emailField').val(res.email);
                    $('#updateModal').fadeIn();
                }
            });
        });

        // Submit edit form
        $('#updateForm').submit(function (e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: '/user/update/' + id,
                type: 'POST',
                data: formData,
                success: function (res) {
                    if (res.status === 'success') {
                        $('#updateModal').fadeOut();
                        $('#profile-table-body').html(res.html);
                        showCustomAlert("Updated successfully!");
                    }
                },
                error: function () {
                    alert('Update failed');
                }
            });
        });

        // Cancel edit modal
        $('#cancelBtn').click(function () {
            $('#updateModal').fadeOut();
        });

        // Open change password modal
        $(document).on('click', '#changePasswordBtn', function (e) {
            e.preventDefault();
            const userId = $(this).data('id');
            $('#password_user_id').val(userId);
            $('#passwordModal').fadeIn();
        });

        // Cancel password modal
        $('#cancelPasswordBtn').click(function () {
            $('#passwordModal').fadeOut();
        });

        // Submit password form
        $('#passwordForm').submit(function (e) {
            e.preventDefault();

            const password = $('#newPasswordField').val();
            const confirmPassword = $('#confirmPasswordField').val();

            if (password !== confirmPassword) {
                showCustomAlert('Passwords do not match!');
                return;
            }

            const id = $('#password_user_id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: '/user/change-password/' + id,
                method: 'POST',
                data: formData,
                success: function (res) {
                    if (res.status === 'success') {
                        $('#passwordModal').fadeOut();
                        showCustomAlert('Password updated successfully!');
                    }
                },
              error: function (xhr) {
    if (xhr.status === 422) {
        const errors = xhr.responseJSON.errors;
        let msg = Object.values(errors).join('\n');
        showCustomAlert(msg);
    } else {
        showCustomAlert('Something went wrong.');
    }
}
            });
        });
    });
</script>
@endsection
