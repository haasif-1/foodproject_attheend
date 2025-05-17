@extends('layout.auth')

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Login Card -->
        <div class="card">
            <div class="card-body">
                <div class="app-brand justify-content-center mb-4">
                    <span class="app-brand-text demo text-body fw-bolder">Food Ordering System</span>
                </div>
                <h4 class="mb-2 text-center">Welcome to Food Ordering 👋</h4>
                <p class="mb-4 text-center">Please sign-in to your account</p>

                <form class="mb-3" action="{{ route('logincontroller') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            autofocus
                            required
                        />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                required
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Login Card -->
    </div>
</div>
@endsection
