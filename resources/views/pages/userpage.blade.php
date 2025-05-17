@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title text-primary">Welcome {{ $userdata->name }}!</h1>
                    <p class="mb-4">
                        We're delighted to have you at our Food Management Platform. Discover fresh, delicious meals 
                        and enjoy a seamless ordering experience tailored just for you. Your culinary journey starts here!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
