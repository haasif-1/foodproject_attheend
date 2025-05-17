@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Change Your Password</h5>
                <div class="card-body">
                    <form action="{{ route('changedone', $data->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Current Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="oldPassword" name="pass" value="{{ $data->password }}" placeholder="Enter current password">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="form-text">This is your current stored password</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="newPassword" name="password" placeholder="Enter new password">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div class="form-text">Make sure it's at least 8 characters</div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-check me-1"></i> Update Password
                            </button>
                            <a href="{{ route('user_dashboard') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
