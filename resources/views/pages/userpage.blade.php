@extends('layout.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title">Welcome User {{ $userdata->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <form action="{{route('userdatacheck')}}" method="post">
                                    @csrf
                                    <button class="btn btn-primary">
                                        <i class="bx bx-user me-1"></i> My Info
                                    </button>
                                </form>
                            </div>
                            
                            <div class="mb-3">
                                <form action="{{route('changeuserpassword')}}" method="post">
                                    @csrf
                                    <button class="btn btn-warning">
                                        <i class="bx bx-lock-alt me-1"></i> Change Password
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="list-group">
                                <a href="{{route('showallproducts')}}" class="list-group-item list-group-item-action">
                                    <i class="bx bx-store me-1"></i> Products
                                </a>
                                
                                <a href="{{route('cartedproduct')}}" class="list-group-item list-group-item-action">
                                    <i class="bx bx-cart me-1"></i> Cart Products
                                </a>
                                
                                <a href="{{route('orderedproduct')}}" class="list-group-item list-group-item-action">
                                    <i class="bx bx-package me-1"></i> My Orders
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
