@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account /</span> Update Profile
    </h4>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <h5 class="card-header">Edit Your Information</h5>
                <div class="card-body">
                    <form action="{{ route('editmyselfdata', $edit->id) }}" method="post">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf

                        <div class="mb-3 row">
                            <label for="id" class="col-md-2 col-form-label">User ID</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control-plaintext" id="id" name="id" value="{{ $edit->id }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $edit->name }}" placeholder="Enter your full name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $edit->email }}" placeholder="Enter your email address" required>
                            </div>
                            <div class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">
                                    <i class="bx bx-check me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('user_dashboard') }}" class="btn btn-outline-secondary">
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
@endsection
