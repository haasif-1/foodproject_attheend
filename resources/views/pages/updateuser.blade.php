@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Users /</span> Update User
    </h4>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Edit User Information</h5>
                <div class="card-body">
                    <form id="upd_form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $edit->id }}">

                        <div class="mb-3 row">
                            <label for="id" class="col-md-2 col-form-label">User ID</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control-plaintext" value="{{ $edit->id }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $edit->name }}" placeholder="Enter user's full name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $edit->email }}" placeholder="Enter user's email address" required>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                    <i class="bx bx-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('userlist') }}" class="btn btn-outline-secondary">
                                    <i class="bx bx-x me-1"></i> Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

     $('#upd_form').submit(function(e) {
    e.preventDefault();

    let id = $('input[name="id"]').val();
    let name = $('#name').val();
    let email = $('#email').val();

    $.ajax({
        url: "{{ route('updateuser', ['id' => '__id__']) }}".replace('__id__', id),
        type: "POST",
        data: {
            _method: 'PUT',
            name: name,
            email: email
        },
        success: function(response) {
            showCustomAlert('User updated successfully!');
        },
        error: function(xhr) {
            let errorMessage = 'Something went wrong.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            showCustomAlert(errorMessage);
        }
    });
});
    });
</script>
@endsection
