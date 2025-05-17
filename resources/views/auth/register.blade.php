@extends('layout.auth')

@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
            <div class="card-body">
                <div class="app-brand justify-content-center mb-4">
                    <span class="app-brand-text demo text-body fw-bolder">Food Ordering System</span>
                </div>
                <h4 class="mb-2 text-center">Adventure starts here 🚀</h4>
                <p class="mb-4 text-center">Make your food ordering experience easy and fun!</p>

                <form class="mb-3" action="{{ route('registercontroller') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="Enter your username"
                            autofocus
                            required
                        />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required
                        />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
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
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                </form>

                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">
                        <span>Sign in instead</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register Card -->
    </div>
</div>
@endsection
