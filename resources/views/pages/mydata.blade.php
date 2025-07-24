@extends('layout.app')

@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">User /</span> Profile
    </h4>

    <div class="card p-4">
        <h5 class="mb-3">Your Profile</h5>
        <p><strong>Name:</strong> {{ $data->name }}</p>
        <p><strong>Email:</strong> {{ $data->email }}</p>

        <button id="editBtn" class="btn btn-primary mt-2" data-id="{{ $data->id }}">
            <i class="bx bx-edit-alt me-1"></i> Edit Info
        </button>
        <button id="changePasswordBtn" class="btn btn-warning mt-2" data-id="{{ $data->id }}">
            <i class="bx bx-lock-alt me-1"></i> Change Password
        </button>
    </div>
</div>

<!-- ================== Update Info Modal ================== -->
<div id="updateModal" class="modal-blur">
    <div class="card p-4" style="max-width:400px; width:90%;">
        <h5 class="mb-4">Edit Profile</h5>
        <form id="updateForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="user_id" value="{{ $data->id }}">

            <div class="mb-3">
                <label for="nameField" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" id="nameField" required>
            </div>

            <div class="mb-3">
                <label for="emailField" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="emailField" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" id="cancelBtn" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- ================== Change Password Modal ================== -->
<div id="passwordModal" class="modal-blur">
    <div class="card p-4" style="max-width:400px; width:90%;">
        <h5 class="mb-4">Change Password</h5>
        <form id="passwordForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="password_user_id" value="{{ $data->id }}">

            <div class="mb-3">
                <label for="newPasswordField" class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" id="newPasswordField" required>
            </div>

            <div class="mb-3">
                <label for="confirmPasswordField" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="new_password_confirmation" id="confirmPasswordField" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update</button>
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
    $(document).ready(function () {
        // Hide modal on click outside card
        $('.modal-blur').on('click', function (e) {
            if ($(e.target).closest('.card').length === 0) {
                $(this).fadeOut();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Open Edit Modal
        $('#editBtn').on('click', function (e) {
            e.preventDefault();
            const userId = $(this).data('id');

            $.ajax({
                url: '/user/edit/' + userId,
                method: 'GET',
                success: function (res) {
                    $('#user_id').val(res.id);
                    $('#nameField').val(res.name);
                    $('#emailField').val(res.email);
                    $('#updateModal').css('display', 'flex').hide().fadeIn();
                },
                error: function () {
                    showCustomAlert('Failed to fetch user info');
                }
            });
        });

        // Submit Update Info
        $('#updateForm').on('submit', function (e) {
            e.preventDefault();
            const id = $('#user_id').val();
            const formData = $(this).serialize();

            $.ajax({
                url: '/user/update/' + id,
                method: 'POST',
                data: formData,
             success: function (res) {
    if (res.status === 'success') {
        $('#updateModal').fadeOut();
        $('p:contains("Name:")').html('<strong>Name:</strong> ' + res.updated_user.name);
        $('p:contains("Email:")').html('<strong>Email:</strong> ' + res.updated_user.email);

        showCustomAlert("Profile updated successfully!");
    }
},
                error: function () {
                    showCustomAlert('Update failed. Please try again.');
                }
            });
        });

        $('#cancelBtn').on('click', function () {
            $('#updateModal').fadeOut();
        });

        // Open Change Password Modal
        $('#changePasswordBtn').on('click', function (e) {
            e.preventDefault();
            const userId = $(this).data('id');
            $('#password_user_id').val(userId);
            $('#passwordForm')[0].reset();
            $('#passwordModal').css('display', 'flex').hide().fadeIn();
        });

        $('#cancelPasswordBtn').on('click', function () {
            $('#passwordModal').fadeOut();
        });

        // Submit Password Change
        $('#passwordForm').on('submit', function (e) {
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
                        showCustomAlert('Password changed successfully!');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        let msg = Object.values(errors).join('\n');
                        showCustomAlert(msg);
                    } else {
                        showCustomAlert('Something went wrong while changing password.');
                    }
                }
            });
        });
    });
</script>
@endsection
