@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Users /</span> User Management
    </h4>

    <div class="card">
        
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Member Since</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($agents as $agent)
                        <tr>
                            <td><strong>{{ $agent->name }}</strong></td>
                            <td>{{ $agent->email }}</td>
                            <td>{{ $agent->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('edituser', ['id' => $agent->id]) }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <a href="javascript:void(0);" 
                                           class="dropdown-item delete-btn" 
                                           data-id="{{ $agent->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($agents->isEmpty())
                <div class="text-center p-5">
                    <div class="alert alert-primary" role="alert">
                        <i class="bx bx-info-circle me-1"></i>
                        No users found in the system.
                    </div>
                </div>
            @endif
            
            <div class="mt-4 text-end">
                <a href="{{ route('admin_dashboard') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<!-- CSRF Meta (should already be in layout) -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- User Delete Script -->
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.delete-btn').click(function () {
            let id = $(this).data('id');
            let row = $(this).closest('tr');

             showCustomConfirm("Are you sure you want to delete this product?", function () {
                $.ajax({
                    url: `/deleteuser/${id}`,
                    type: 'GET',
                    success: function (res) {
                        if (res.status === 'success') {
                            showCustomAlert("User deleted successfully");
                            row.fadeOut(300, function () {
                                $(this).remove();
                            });
                        } else {
                            showCustomAlert("Failed to delete user");
                        }
                    },
                    error: function () {
                        showCustomAlert("Server error occurred");
                    }
                });
             });
        });
    });
</script>
@endsection
