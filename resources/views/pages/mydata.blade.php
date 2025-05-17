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
                                    <th>Password</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td><span class="badge bg-label-secondary">Encrypted</span></td>
                                    <td>
                                        <a href="{{ route('updateuserdata') }}" class="btn btn-sm btn-primary">
                                            <i class="bx bx-edit-alt me-1"></i> Update
                                        </a>
                                        <a href="{{ route('changeuserpassword', ['id' => $data->id]) }}" class="btn btn-sm btn-warning">
                                            <i class="bx bx-lock-alt me-1"></i> Change Password
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
@endsection
